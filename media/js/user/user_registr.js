$(document).ready(function() {
	$('#registr_user').click(function() {
	   var login = $('#form_registr input[name="login"]').val();
       if(!login) {alert('Вы не указали логин'); return;}
       var password = $('#form_registr input[name="password"]').val();
       if(!password) {alert('Вы не указали пароль'); return;}
       $.post('/user/checkexistlogin', {login: login}, checkExistLogin);
	})
});

function checkExistLogin(login) {
    if(login) alert('Логин "' + login + '" уже существует');
    else $('#form_registr').submit();
}