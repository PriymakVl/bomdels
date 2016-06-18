<div class="right-sidebar">
    <div class="right-sidebar-header">
        <ul>
            <li id="manager_link" class="active-item-menu-sidebar">Меню</li>
        </ul>
    </div>
    <div class="sidebar-content-wrp">
       <div id="menu_equipment_box" <? if(isset($equipment)) echo 'style="display: none;"';?> >
            <ul>
                <li>
                    <a href="/admin/category/danieli">Danieli</a>
                </li>
                <li id="show_sundbirsta">
                    <a href="/admin/category/danieli">Sundbirsta</a>
                </li>
            </ul>
        </div>
         <div id="menu_action_box" <? if(!isset($equipment)) echo 'style="display: none;"'; ?> >
            <ul>
                <li id="show_edit_box">Редактировать категорию</li>
                <li id="show_add_box">Добавить категорию</li>
                <li id="delete_cat">Удалить категорию</li>
                <li id="add_content">Добавить контент</li>   
            </ul>
        </div>
    </div>
</div>