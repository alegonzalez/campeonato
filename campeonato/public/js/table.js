$(document).ready(function(){
  $("#edit_specific_table").click(function(){
    if(validate_fields_empty()){

      $("#form_edit_data_table").submit();
    }
  });
});

//this function validate all fields
function validate_fields_empty(){
  var message = "";
  var won_match = $("#won_match").val();
  var tied_matches = $("#tied_matches").val();
  var lose_match = $("#lose_match").val();
  var goals_scored = $("#goals_scored").val();
  var goals_against = $("#goals_against").val();
  var cont = 1;
  if(won_match == ""){
    message += "<h5>" + cont+"- El campo de partidos ganados no puede quedar vacío." +"</h5><br>" ;
    cont++;
  }
  if(tied_matches == ""){
    message += "<h5>" + cont+"- El campo de partidos empatados no puede quedar vacío." +"</h5><br>" ;
    cont++;
  }
  if(lose_match == ""){
    message += "<h5>" + cont+"- El campo de partidos perdidos no puede quedar vacío." +"</h5><br>" ;
    cont++;
  }
  if(goals_scored == ""){
    message += "<h5>" + cont+"- El campo de goles anotados no puede quedar vacío." +"</h5><br>" ;
    cont++;
  }
   if(goals_against == ""){
    message += "<h5>" + cont+"- El campo de goles en contra no puede quedar vacío." +"</h5><br>" ;
    cont++;
  }
  if(message == ""){
    return true;
  }else{
    show_message(message);
    return false;
  }
}

//this function validate fiel only numbers
function only_number(text,id_field){

  var reg = new RegExp('^[0-9]+$');
  if(!reg.test(text)){
    $("#"+id_field).val("");
  }
}
//This function show warning message
function show_message(text){
  Swal.fire({
    title: '',
    html:text,
    icon: 'warning',
    confirmButtonText: 'Aceptar',
    showCloseButton: true
  })
}
