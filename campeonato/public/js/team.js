$(document).ready(function() {
  $("#search_team").click(function() {
    var val = $('#team').val()
    if (val == "") {
      Swal.fire({
        title: 'Debes seleccionar algun torneo para ver los equipos.',
        icon: 'warning',
        confirmButtonText: 'Aceptar',
        showCloseButton: true
      })
    } else {
      var id_championship = $('#list_team option').filter(function() {
        return this.value == val;
      }).data('xyz');
      $("#id_championschip").val(id_championship);
      $("#form_serch_team").submit();
    }
  });
/**
*this function performs the value change when the user selects it
*/
  $( "#championship" ).change(function() {
    var val = $('#championship').val()
    if (val == "") {
      $("#id_championschip").val("");
      Swal.fire({
        title: 'Debes seleccionar algun torneo para ver los equipos.',
        icon: 'warning',
        confirmButtonText: 'Aceptar',
        showCloseButton: true
      })
    } else {
      var id_championship = $('#list_championship option').filter(function() {
        return this.value == val;
      }).data('xyz');
      $("#id_championschip").val(id_championship);
    }
  });
});

/*
*This function load image  when the user chooses an image using the file type button
*return void
*/
function readURL(input_file) {
  if (input_file.files && input_file.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#img_show_image').remove();
      $('.line_break').remove();
      $(".content_load_photo").prepend ("<br class='line_break'><img src='' class='img-circle img_team' id='img_show_image' alt='La image no se pudo cargar'>");
      $('#img_show_image')
      .attr('src', e.target.result);
    };
    $("#img_show_image").show();
    reader.readAsDataURL(input_file.files[0]);
  }
}
