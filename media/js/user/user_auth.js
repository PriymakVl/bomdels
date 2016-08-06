$(document).ready(function() {
	$('#auth').click(function() {
	   var login = $('input[name="login"]').val();
       if(!login) {alert('Вы не указали логин'); return;}
       var password = $('input[name="password"]').val();
       if(!password) {alert('Вы не указали пароль'); return;}
       check = document.querySelector('#remember');
       if(check.checked) var remember = true;
       else remember = false;
       $.post('/user/auth', {login: login, password: password, remember: remember}, resultAuth);
	})
});

function resultAuth(data) {
    if(data == true) {
        alert('Вы успешно авторизованы');
        $('input[name="password"]').val('');
        $('input[name="login"]').val('');
        location.reload();
    }
    else alert('Вы еще не зарегестрированы');
}