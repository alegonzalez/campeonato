$(document).ready(function() {
    //This event click show message before destroy the championship
    $(".setting_button").click(function() {
        var championship = $(this).attr('id').split("_");
        Swal.fire({
            title: '¿Deseas eliminar el torneo ' + championship[0] + ' ?',
            text: "No podrás revertir esto",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminarlo',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.value) {
                $("#form_" + championship[1]).submit();
            }
        })
    });
});