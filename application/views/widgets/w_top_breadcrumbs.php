<div class="topnav top-breadcrumbs">
    <ul>
        <li>
            <a href="/">Главная</a>
        </li>
        <? if ($draw->parent): ?>
            <li>
                <a href="/specification?id=<?=$draw->parent['id']?>"><?=$draw->parent['rus']?></a>
                <img src="/media/images/style/breadcrumbs_arrow3.png" />
            </li>
        <? endif; ?>
        <li>
            <a onclick="return: false;"><?=$draw->rus?></a>
        </li>
    </ul>
</div>
