<div class="header search-box">
    <a href="/" class="link-home">Главная</a>
     <form id="form_search_detail" class="search-code" method="post" action="/search/<?=$equipment?>">
        <input type="radio" name="type_search" value="code" checked="checked" />
        <label>Код</label>
        <input type="radio" name="type_search" value="name" />
        <label>Наименование</label>
        <? if (isset($search)): ?>
            <input type="text" name="search"  value="<?=$search?>" />
        <? else: ?>
            <input type="text" name="search" placeholder="Введите код (можно часть)" />
        <? endif; ?>
        <input type="submit" name="search_detail" value="Найти" />
    </form>
</div>