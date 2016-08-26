<div class="right-sidebar">
    <div class="right-sidebar-header">
        <ul>
            <li id="sections" class="active-item-menu-sidebar">Разделы</li>
            <li id="elect">Списки</li>
            <? if ($role == 'admin'): ?>
                <li id="admin">Админка</li>
            <? endif; ?>
        </ul>
    </div>
    <div class="sidebar-content-wrp">
        <div id="menu_sections_box">   
            <ul>
                <li><a href="/category?equipment=danieli">Danieli</a></li>
                <li><a href="/category?equipment=sundbirsta">Sundbirsta</a></li>
                <li><a href="/category?equipment=crane">Грузоподъемное</a></li>
                <li>
                    <a href="/software/application">Заявки</a>
                </li>
                <li><a href="/standart">Стандартные изделия</a></li>
                <li><a href="/bearing">Подшипники</a></li>
            </ul>
        </div>
        <!-- start elect box -->
        <div id="menu_elect_box" style="display: none;">
            <ul id="menu_elect_main_box">
                <li id="elect_elements_management">Управл. элем. ваших списков</li>
                <li id="elect_lists_management">Управление вашими списками</li> 
                <li><a href="/electlist">Перечень всех списков</a></li>   
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
                <li><a href="/admin/category?equipment=danieli">Ред. категорий Danieli</a></li>
                <li><a href="/admin/category?equipment=sundbirsta">Ред. категорий Sundbirsta</a></li>
                <li><a href="/admin/category?equipment=crane">Ред. категорий Грузоподъемное</a></li>
            </ul>
        </div>
        <!-- end admin box -->
    </div>
</div>