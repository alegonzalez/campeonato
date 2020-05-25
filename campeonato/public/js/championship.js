$(document).ready(function(){

  $("#create_championship").click(function(){
    validation();

  });
  $("#edit_championship").click(function(){
    validation();
  });
});

function validation(){
  var today = new Date();
  var message = "";
  var cont = 1;
  var date =("0" + (today.getMonth()+1)).slice(-2) +'/'+("0" + +today.getDate()).slice(-2)+'/'+today.getFullYear();
  if($("#name_championship").val() == ""){
    message += "<h5>" + cont+"- El campo nombre de usuario es requerido." +"</h5><br>" ;
    cont++;
  }
  if($("#start_match").val() == ""){
    message += "<h5>" + cont+"- Debes seleccionar la fecha de inicio del torneo." +"</h5><br>" ;
    cont++;
  }else if($("#start_match").val() < date){
    message += "<h5>" + cont+"- Debes seleccionar una fecha mayor o igual a la actual." +"</h5><br>" ;
    cont++;
  }
  if(cont == 1)
  {
    $("#championship_form").submit();
  }else{
    show_message(message);
  }
}
//This function show warming message
function show_message(message){
  Swal.fire({
    title: '',
    html: message,
    icon: 'warning',
    confirmButtonText: 'Aceptar',
    showCloseButton: true
  })
}
