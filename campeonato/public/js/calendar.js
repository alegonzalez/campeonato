$( document ).ready(function() {

  $("#add_hour_match").click(function(){
    add_time();
  });
  $("#generate_calendar").click(function(){
    if(validate_select_day()){
      if(get_all_time()){
        $("#form_generate_calendar").submit();
      }
    }
  });
});
//this function show message if user  delete  calendar
function destroy_calendar(name_championship,id_championship){
  Swal.fire({
    title: '¿Deseas eliminar el calendario que pertenece al torneo ' + name_championship + '?',
    text: "No podrás revertir esto",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminarlo',
    cancelButtonText: 'Cancelar',
  }).then((result) => {
    if (result.value) {
      $("#form_"+id_championship).submit();
    }
  })
}


//Validate select any day for the match
function validate_select_day(){
  var weekdays = [$("#weekdays_1").val(),$("#weekdays_2").val(),$("#weekdays_3").val(),$("#weekdays_4").val(),$("#weekdays_5").val(),$("#weekdays_6").val(),$("#weekdays_7").val()];
  var id_day = "";
  for (var i = 0; i < weekdays.length; i++) {
    if(weekdays[i] !=""){
      id_day = weekdays[i];
    }
  }
  if(id_day !=""){
    return true;
  }else{
    showMessage("Debes seleccionar los días en que se jugaran los partidos.");
    return false;
  }
}
//This function get all time from list group
function get_all_time(){
  var optionTexts = [];
  $("ul .list-group-item").each(function() {
    time = $(this).text().replace(/ /g, "");
    optionTexts.push(time);
  });

  if(optionTexts.length <= 0){
    if(validate_time($("#time_match").val())){
      $("#values_time").val($("#time_match").val());
      return true;
    }
    return false;
  }else{
    $("#values_time").val(optionTexts);
    return true;
  }
}
//this function set in list group the time
function add_time(){
  var time = $("#time_match").val();
  var tag = "";
  if(validate_time(time)){
    tag = '<li class="list-group-item">'+ time +' <button type="button" class="btn btn-outline-danger remove_hour" onclick="remove_time(this);">    <i class="fa fa-trash" aria-hidden="true"></i> </button></li>'
    $(".list-group").append(tag);
  }
}

//Thi function validate input time
function validate_time(time){
  time = time.replace(/ /g, "");
  var patt = new RegExp("^(1[0-2]|0?[1-9]):([0-5]?[0-9])(●?[AP]M)?$");
  if(time == ""){
    showMessage("Debes seleccionar una hora.");
  }else if(!patt.test(time)){
    showMessage("El formato de la hora es incorrecto, por favor intentelo nuevamente.");
  }else{
    return true;
  }
  return false;
}
//this function delete from list group the time
function remove_time(value){
  $(value).closest('li').remove();
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
//change color when select user  any day
function chageColor(id_weekday){
  var value_input_id = $("#weekdays_"+id_weekday).val();
  if(value_input_id == ""){
    $("#content_day_"+id_weekday).css("background-color","#117a8b");
    $("#content_day_"+id_weekday).css("color","#fff");
    $("#weekdays_"+id_weekday).val(id_weekday);
    var tag = '<span class="material-icons">done</span>';
    $("#content_day_"+id_weekday+" div h5").append(tag);
  }else{
    $("#content_day_"+id_weekday).css("background-color","#fff");
    $("#content_day_"+id_weekday).css("color","#343a40");
    $("#content_day_"+id_weekday+" div h5 span").remove();
    $("#weekdays_"+id_weekday).val("");
  }
}
