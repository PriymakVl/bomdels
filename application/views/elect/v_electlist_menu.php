<div class="right-sidebar">
    <div class="right-sidebar-header">
        <ul>
            <li id="sections" class="active-item-menu-sidebar">Меню</li>
        </ul>
    </div>
    <!-- start elect box -->
    <div class="sidebar-content-wrp">
        <div id="menu_elect_box">
            <ul id="menu_elect_main_box">
                <li id="add_list_menu" employee_id="<?if($employee) echo $employee->id; ?>">Добавить список в ваше меню</li>
                <li id="delete_list_menu" employee_id="<?if($employee) echo $employee->id; ?>">Удалить список из вашего меню</li>
                <li id="show_elements_list">Показать элементы списка</li>
                 
                <? if($employee && $all_lists): ?>  
                    <li>    
                        <a href="electlist?employee_id=<?=$employee->id?>">Показать мои списки</a>
                    </li>
                <? endif; ?>
                <? if(!$all_lists): ?>
                    <li>
                        <a href="electlist">Показать все списки</a>
                    </li>
                <? endif; ?>
                <li><a href="/">Главная</a></li>
            </ul>           
        </div>
    </div>
    <!-- end elect box -->
</div>