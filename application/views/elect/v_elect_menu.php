<div class="right-sidebar">
    <div class="right-sidebar-header">
        <ul>
            <li id="sections" class="active-item-menu-sidebar">Разделы</li>
            <li id="elect">Популярное</li>
            <? if ($role == 'admin'): ?>
                <li id="admin">Админка</li>
            <? endif; ?>
        </ul>
    </div>
    <div class="sidebar-content-wrp">
        <div id="menu_sections_box">   
            <ul>
                <li><a href="/category/danieli">Danieli</a></li>
                <li><a href="/category/sundbirsta">Sundbirsta</a></li>
                <li><a href="#">Краны</a></li>
                <li><a href="/software/orders">Заказы</a></li>
                <? if ($role == 'admin'): ?>
                    <li><a href="/admin/category">Редактирование категорий</a></li>
                <? endif; ?>
            </ul>
        </div>
        <div id="menu_elect_box" style="display: none;">   
            <ul>
                <li id="delete_elect">Удалить элемент</li>
                <li id="edit_elect_description">Редактировать элемент</li>
                <li id="show_box_add_list">Создать новый список</li>
                <li id="show_box_edit_list">Редактировать списки</li>
            </ul>
        </div>
        <div id="menu_admin_box" style="display: none;">   
            <ul>
                <li><a href="/auto/data">Добавление данных в базу</a></li>
                <li><a href="/glossary">Глоссарий</a></li>
            </ul>
        </div>
    </div>
</div>