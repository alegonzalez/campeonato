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
  var date =("0" + (today.getMonth()+1)).slice(-2) +'/'+("0" + +today.getDate()).slice(-2)+'/'+today.getFullYear();
  if($("#name_championship").val() == ""){
    showMessage("El campo nombre de usuario es requerido");
  }else if($("#start_match").val() == ""){
    showMessage("Debes seleccionar la fecha de inicio del torneo.");
  }else if($("#start_match").val() <= date){
    showMessage("Debes seleccionar una fecha mayor o igual a la actual.");
  }else{
    $("#championship_form").submit();
  }
}
//This function show warming message
function showMessage(message){
  Swal.fire({
    title: message,
    icon: 'warning',
    confirmButtonText: 'Aceptar',
    showCloseButton: true
  })
}
