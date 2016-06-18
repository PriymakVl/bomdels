<div class="header search-box">
    <a href="/" class="link-home">Главная</a>
     <form class="search-code" method="post" action="/data">
        <label>Номер заказа: <input type="radio" name="search" search="number" checked="checked" /></label>       
        <label>Наименование: <input type="radio" name="search" search="title" /></label>
        <input type="text" name="number" value="" placeholder="Введите номер заказа"/>
        <input type="submit" name="search_order" value="Найти" />
    </form>
</div>