$(document).ready(function() {
    $(':submit').click(function(event) {
        event.preventDefault();
        var login = $('#login').val();
        var pass = $('#password').val();
        var url = 'http://' + location.host;
        if(!login) {alert('Вы не указали логин'); return}
        if(!pass) {alert('Вы не указали пароль'); return}
        if(login !== 'admin') {alert('Вы указали не верный логин'); return}
        if(pass !== '1q2w3e') {alert('Вы указали не верный пароль'); return}
        location.href = url + '/admin/main';
    });
});