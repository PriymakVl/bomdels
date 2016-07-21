<div class="right-sidebar">
    <div class="right-sidebar-header">
        <ul>
            <li id="sections" class="active-item-menu-sidebar">Разделы</li>
            <li id="elect">Управление списками</li>
            <? if ($role == 'admin'): ?>
                <li id="admin">Админка</li>
            <? endif; ?>
        </ul>
    </div>
    <div class="sidebar-content-wrp">
        <div id="menu_sections_box">   
            <ul>
                <li><a href="/category/danieli">Danieli</a></li>
                <!--<li><a href="/category/sundbirsta">Sundbirsta</a></li>
                <li><a href="#">Краны</a></li>
                <li><a href="/software/orders">Заказы</a></li>-->
                <li><a href="/standart">Стандартные изделия</a></li>
                <li><a href="/bearing">Подшипники</a></li>
                <? if ($role == 'admin'): ?>
                    <li><a href="/admin/category">Редактирование категорий</a></li>
                <? endif; ?>
            </ul>
        </div>
        <!-- start elect box -->
        <div id="menu_elect_box" style="display: none;">
            <ul id="menu_elect_main_box">
                <li id="elect_elements_management">Управление  элем. списков</li>
                <li id="elect_lists_management">Управление  списками</li>    
            </ul>   
            <ul style="display: none;" id="menu_elect_elements_box">
                <li id="delete_elect_element">Удалить элемент</li>
                <li id="edit_elect_element">Редактировать элемент</li>
                <li class="cancel_elect_subbox">Выйти</li>
            </ul>
            <ul style="display: none;" id="menu_elect_list_box">
                <li id="show_box_add_list">Создать новый список</li>
                <li id="delete_list_elect">Удалить список</li>
                <li id="edit_list_elect">Редактировать список</li>
                <li class="cancel_elect_subbox">Выйти</li>
            </ul>           
        </div>
        <!-- end elect box -->
        
        <!-- start admin box -->
        <div id="menu_admin_box" style="display: none;">   
            <ul>
                <li><a href="/auto/data">Добавление данных в базу</a></li>
                <li><a href="/glossary">Глоссарий</a></li>
            </ul>
        </div>
        <!-- end admin box -->
    </div>
</div>