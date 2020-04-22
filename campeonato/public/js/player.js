$(document).ready(function(){
  //method keyup for search team with ajax
  $("#search_team").keyup(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: '/player/getPlayer',
      type: 'POST',
      data: {
        "_token": $('meta[name="csrf-token"]').attr('content') ,
        'team': $("#search_team").val(),
      },
      success: function(response){
        set_players_table(response['players']);
      }
    });
  });

  /**
  *this function performs the value change when the user selects it
  */
  $( "#championship" ).change(function() {
    var value_datalist_championship = $('#championship').val();
    var url = window.location.href;
    $("#id_team").val("");
    $("#team").val("");
    if (value_datalist_championship == "") {
      $("#id_championschip").val("");
      if(url.split("/")[4] !="edit"){
        $(".datalist_championship").attr("class","datalist_championship ");
        $(".datalist_team").attr("class","datalist_team disable_div");
        $(".form-group").attr("class","form-group disable_div");
        $(".form-check").attr("class","form-check form-check-inline disable_div");
      }
    } else {
      var id_championship = $('#list_championship option').filter(function() {
        return this.value == value_datalist_championship;
      }).data('xyz');
      get_teams_by_id_championship(id_championship);
      $("#id_championschip").val(id_championship);
    }
  });
  /**
  *this function performs the value change when the user selects it
  */
  $("#team").change(function(){
    var value_datalist_team =$('#team').val();
    if(value_datalist_team == ""){
      $(".form-group").attr("class","form-group disable_div");
      $(".form-check").attr("class","form-check form-check-inline disable_div");
      $(".datalist_team").attr("class","datalist_team");
      $('#team').val("");
    }else{
      $(".form-group").attr("class","form-group");
      $(".form-check").attr("class","form-check form-check-inline");
      var id_team = $('#list_team option').filter(function() {
        return this.value == value_datalist_team;
      }).data('xyz');
      $("#id_team").val(id_team);
    }

  });
  //event click when user click button create or edit
  $("#button_create_edit").click(function(){
    var message = "";
    var cont = 1;
    if($("#championship").val() == ""){
      message += "<h5>" + cont+"- Debes seleccionar algún torneo." +"</h5><br>" ;
      cont++;
    }
    if($("#team").val() == ""){
      message += "<h5>" + cont+"- Debes seleccionar algún equipo." + "</h5><br>";
      cont++;
    }
    if($("#player_name").val() == ""){
      message += "<h5>" + cont+"- El campo nombre del jugador es requerido." + "</h5><br>";;
      cont++;
    }
    if($('[name="position"]:checked').length >0){
    }else{
      message += cont+"- Debes seleccionar la pocisión del jugador.\n\n";
      cont++;
    }
    if(message != ""){
      message_field_required(message);
    }else{
      $("#form-player").submit();
    }
  });
  //validate only number on input shirt_number
  $("#shirt_number,#goals").on("keypress keyup blur",function (event) {
    $(this).val($(this).val().replace(/[^0-9\.]/g,''));
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
      event.preventDefault();
    }
  });
});


//this function get team by id_champioship
function get_teams_by_id_championship(id_champioship){
  $.ajax({
    url: '/player/get_teams/'+id_champioship,
    type: 'get',
    data: {
      "_token": $('meta[name="csrf-token"]').attr('content') ,
    },
    success: function(response){
      if(response['message'] == ''){
        add_option_team(response['teams']);
      }else{
        var message = 'No hay ningún equipo registrado en el torneo ' + $('#championship').val() + ', primero debes crear un equipo al torneo';
        message_field_required(message);
      }
    }
  });
}

//This function show message of any warning
function message_field_required(message){

  Swal.fire({
    title:'',
    html: message,
    icon: 'warning',
    confirmButtonText: 'Aceptar',
    showCloseButton: true
  });
}
//this function show teams in the datalist
function add_option_team(teams){
  $(".option_team").remove();
  var option = "";
  for (var i = 0; i < teams.length; i++) {
    name = teams[i]['name'];
    id = teams[i]['id'];
    option = "<option value='"+name+"' id='"+id+"' class='option_team' data-xyz='"+id+"'>";
    $("#list_team").append(option);
  }
  $(".datalist_team").attr("class","datalist_team");
}

//this function set data of players in the table
function set_players_table(players){
  $('tbody').empty();
  var tag = "";
  var shirt_number = "";
  for (var i = 0; i < players.length; i++) {
    shirt_number = (players[i]['shirt_number'] == -1) ? '-': players[i]['shirt_number'] ;
    tag = "<tr id='player_"+ players[i]['id']+"'><td class='text-center'>" + players[i]['name'] + "</td>";
    tag += "<td class='text-center'>" + shirt_number + "</td>";
    tag += "<td class='text-center'>" + players[i]['name_position'] + "</td>";
    tag += "<td class='text-center'>" + players[i]['goals'] + "</td>";
    tag += "<td class='text-center'> <a href='/player/edit/" + players[i]['id'] + "' class='btn btn-outline-success setting_button btn-lg btn-block'><i class='fa fa-pencil' aria-hidden='true'></i></a> </td>";
    tag += '<td class="text-center"> <button type ="button" onclick="destroy_player(\''+ players[i]['id'] +'\',\''+ players[i]['name'] +'\' );" class="btn btn-outline-danger setting_button btn-lg btn-block"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';
    $("tbody").append(tag);
  }
}

//this function destroy any player by id
function destroy_player(id_player,player_name){
  Swal.fire({
    title: '¿Deseas eliminar al jugador ' + player_name + '?',
    text: "No podrás revertir esto",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminarlo',
    cancelButtonText: 'Cancelar',
  }).then((result) => {
    if (result.value) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: '/player/destroy/' + id_player,
        type: 'POST',
        data: {
          "_token": $('meta[name="csrf-token"]').attr('content') ,
        },
        success: function(response){
          if(response['status'] == '200'){
            Swal.fire({
              title: "El jugador " + player_name + " se ha eliminado con exito",
              icon: 'success',
              showCloseButton: true
            });
            $("#player_"+id_player).remove();
          }else{
            message_field_required('No se pudo eliminar el jugador, por favor inténtelo nuevamente.');
          }
        }
      });
    }
  })
}
