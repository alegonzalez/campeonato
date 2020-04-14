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
            var xyz = $('#list_team option').filter(function() {
                return this.value == val;
            }).data('xyz');
            $("#id_championschip").val(xyz);
            $("#form_serch_team").submit();
//$('#search_team').trigger('click');
        }
    });
});
