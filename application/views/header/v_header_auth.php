<div class="header">
    <a href="/" class="logo">400/200</a>
     <form id="auth-form" method="post" action="user" <? if($role) echo 'style="display: none;"' ?> >
        <label><input type="checkbox" id="remember"/> Запомнить</label>
        <input type="text" name="login" placeholder="Введите логин" />
        <input type="text" name="password"  placeholder="Введите пароль" />
        <a href="#" onclick="return false;" id="auth">Авторизация</a>
        <a href="#" onclick="return false;" id="registr">Регистрация</a>
        <!--
<a href="#">Забыли?</a>
-->
    </form>
    <div class="wellcome" <? if(!$role) echo 'style="display: none;"' ?>>
        <a href="/user/cancel">Выйти</a>
        <a href="/profile">Кабинет</a>
        <span>Добро пожаловать</span>
        <? if($user_name): ?>
            <span id="user_name"><?=$user_name?>!</span>
        <? else: ?>
            <span id="user_name">Гость!</span>
        <? endif; ?>
    </div>
</div>