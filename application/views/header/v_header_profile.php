<div class="header">
    <a href="/" class='link-home-profile'>Главная</a>
    <div class="wellcome">
        <a href="/employee/cancel">Выйти</a>
        <span>Добро пожаловать</span>
        <? if(!empty($employee_name)): ?>
            <span id="employee_name"><?=$employee_name?>!</span>
        <? else: ?>
            <span id="employee_name">Гость!</span>
        <? endif; ?>
    </div>
</div>