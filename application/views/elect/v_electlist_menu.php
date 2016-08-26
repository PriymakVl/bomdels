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
                <li id="add_list_menu" user_id="<?if($user) echo $user->id; ?>">Добавить список в ваше меню</li>
                <li id="delete_list_menu" user_id="<?if($user) echo $user->id; ?>">Удалить список из вашего меню</li>
                <li id="show_elements_list">Показать элементы списка</li>
                <? if($user): ?>  
                    <li>    
                        <a href="/electlist?user_id=<?=$user->id?>">Показать мои списки</a>
                    </li>
                <? endif; ?>
                    <li>
                        <a href="/electlist">Показать все списки</a>
                    </li>
                <li id="show_box_sort_list">Сортировать списки</li>
            </ul>           
        </div>
        <!-- end elect box -->

        <!-- start sort list box -->
        <div id="sort_list_box" style="display: none;" >
        <label>Тип списка:</label>
            <select name="typelist">
                <option value="mill">Не выбран</option>
                <option value="mill">Стан</option>
                <option value="finish">Отделка</option>
                <option value="crane">Краны</option>
                <option value="hydra">Гидравлика</option>
                <option value="grease">Смазка</option>
                <option value="other">Разное</option>    
            </select>
            <ul>
                <li id="cancel_sort_box">Выйти</li>
            </ul>
        </div>
        <!-- end sort list box -->
    </div>
    
</div>