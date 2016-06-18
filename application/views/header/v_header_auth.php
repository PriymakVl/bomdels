<div class="header">
    <span class="logo">ЦРМО СПС</span>
     <form id="auth-form" method="post" action="user" <? if($role) echo 'style="display: none;"' ?> >
        <label><input type="checkbox" id="remember"/> Запомнить</label>
        <input type="text" name="login" placeholder="Введите логин" />
        <input type="text" name="password"  placeholder="Введите пароль" />
        <a href="#" onclick="return false;" id="auth">Авторизация</a>
        <a href="#" onclick="return false;" id="registr">Регистрация</a>
        <a href="#">Забыли?</a>
    </form>
    <div class="wellcome" <? if(!$role) echo 'style="display: none;"' ?>>
        <a href="/employee/cancel">Выйти</a>
        <a href="/profile">Кабинет</a>
        <span>Добро пожаловать</span>
        <? if(!empty($employee_name)): ?>
            <span id="employee_name"><?=$employee_name?>!</span>
        <? else: ?>
            <span id="employee_name">Гость!</span>
        <? endif; ?>
    </div>
</div>