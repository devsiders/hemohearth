$(document).ready(function () {
    $('#vercontrasena').click(function () {
        if ($('#vercontrasena').is(':checked')) {
            $('#contrasena').attr('type', 'text');
        } else {
            $('#contrasena').attr('type', 'password');
        }
    });
});