$(document).ready(function(){
  $("#team").change(function(){
    var value_datalist_team = $('#team').val();
    if(value_datalist_team == ""){
      $("#player").attr('disabled','disabled');
      $("#player").val("");
    }

    var id_team = $('#list_team option').filter(function() {
      return this.value == value_datalist_team;
    }).data('xyz');
    get_player_by_id_team(id_team);
  });

  $("#player").change(function(){
    var value_datalist_player = $('#player').val();
    var id_player = $('#list_player option').filter(function() {
      return this.value == value_datalist_player;
    }).data('xyz');
    $("#id_player").val(id_player);
  });

  $("#create_new_breach").click(function(){
    if(validate_field()){
      $("#form_breach").submit();
    }
  });
});
//this function validate all input to create a new breach
function validate_field(){
  var team = $("#team").val();
  var player = $("#player").val();
  var yellow_card = $("#yellow_card").val();
  var red_card = $("#red_card").val();
  var played_matches = $("#number_matches_played").val();
  var message = "";
  var cont = 1;
  if(team == ""){
    message += "<h5>" + cont+"- Debe seleccionar un equipo y luego el respectivo jugador." +"</h5><br>" ;
    cont++;
  }
  if(player == ""){
    message += "<h5>" + cont+"- Debe seleccionar un jugador." +"</h5><br>" ;
    cont++;
  }
  if(yellow_card == ""){
    message += "<h5>" + cont+"- El campo de tarjetas amarillas no puede quedar vacío." +"</h5><br>" ;
    cont++;
  }
  if(red_card == ""){
    message += "<h5>" + cont+"- El campo de tarjetas rojas no puede quedar vacío." +"</h5><br>" ;
    cont++;
  }
  if(yellow_card > played_matches * 2 ){
    if(played_matches == 0){
      message += "<h5>" + cont+"- La cantidad de tarjetas amarillas ingresadas es inconrrecto debido que no han disputado  ningún partido" +"</h5><br>" ;
    }else{
      message += "<h5>" + cont+"- La cantidad de tarjetas amarillas ingresadas es inconrrecto debido que solo han disputado " + played_matches + " partidos" +"</h5><br>" ;
    }
    cont++;
  }
  if(red_card > played_matches ){
    if(played_matches == 0){
      message += "<h5>" + cont+"- La cantidad de tarjetas rojas ingresadas es incorrecto debido que no han disputado ningún partido" + "</h5><br>" ;
    }else{
      message += "<h5>" + cont+"- La cantidad de tarjetas rojas ingresadas es incorrecto debido que solo han disputado " + played_matches + " partidos" +"</h5><br>" ;
    }
    cont++;
  }
  if(cont != 1){
    warning_message_field(message);
  }else{
    return true;
  }
}
//This function show message of any warning
function warning_message_field(message){

  Swal.fire({
    title:'',
    html: message,
    icon: 'warning',
    confirmButtonText: 'Aceptar',
    showCloseButton: true
  });
}
//this function validate fiel only numbers
function only_number(text,id_field){
  var reg = new RegExp('^[0-9]+$');
  if(!reg.test(text)){
    $("#"+id_field).val("");
  }
}
//this function get all player with ajax by id_team
function get_player_by_id_team(id_team){
  $.ajax({
    url: '/breach/get_players/'+id_team,
    type: 'get',
    data: {
      "_token": $('meta[name="csrf-token"]').attr('content') ,
    },
    success: function(response){
      if(response['players'].length > 0){
        set_list_player_datalist(response['players'],response['matches_played']);
      }else{
        //No hay jugadores registrados
      }
    }
  });
}
//this function set inside datalist all player that belong to team
function set_list_player_datalist(list_player,number_matches_played){
  $(".option_player").remove();
  $("#player").removeAttr('disabled');
  number_matches_played = (number_matches_played.length == 0) ? 0 : number_matches_played[0]['played_matches'];
  $("#number_matches_played").val(number_matches_played);
  var tag_datalist = "";
  var name = "";
  var id ="";
  for (var i = 0; i < list_player.length; i++) {
    name = list_player[i]['name'];
    id = list_player[i]['id'];
    tag_datalist += "<option value='"+name+"' id='"+id+"' class='option_player' data-xyz='"+id+"'>";
    $("#list_player").append(tag_datalist);
    name = id = tag_datalist = "";
  }
  $(".datalist_player").prop('disabled',false);
}


//this function destroy specific breach
function destroy_breach(id_breach,player_name){
  Swal.fire({
    title: '¿Deseas eliminar el dato indiciplinario del jugador ' + player_name + '?',
    text: "No podrás revertir esto",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminarlo',
    cancelButtonText: 'Cancelar',
  }).then((result) => {
    if (result.value) {
      $("#form_"+id_breach).submit();
    }
  })
}
