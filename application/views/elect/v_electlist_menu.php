<div class="right-sidebar">
    <div class="right-sidebar-header">
        <ul>
            <li id="sections" class="active-item-menu-sidebar">Меню</li>
            
        </ul>
    </div>
    <!-- start elect box -->
    <div id="menu_elect_box">
        <ul id="menu_elect_main_box">
            <li id="elect_elements_management">Управл. элем. ваших списков</li>
            <? if ($role == 'admin'): ?>
            <li id="delete_list">Удалить список</li>
        <? endif; ?> 
            <li id="cancel_page">Назад</li>   
        </ul>           
    </div>
    <!-- end elect box -->
</div>