<div class="header">
    <a href="/" class='link-home-profile'>Главная</a>
    <div class="wellcome">
        <a href="/user/cancel">Выйти</a>
        <span>Добро пожаловать</span>
        <? if($user_name): ?>
            <span id="user_name"><?=$user_name?>!</span>
        <? else: ?>
            <span id="user_name">Гость!</span>
        <? endif; ?>
    </div>
</div>