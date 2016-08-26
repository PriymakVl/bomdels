<div class="right-sidebar">
    <div class="right-sidebar-header">
        <ul>
            <li id="filter" class="active-item-menu-sidebar">Фильтр</li>
            <li id="pages">Страницы</li>
            <li id="manager_link">Управление</li>
        </ul>
    </div>
    <div class="sidebar-content-wrp">
        <div id="menu_pages_box" style="display: none;">
            <ul>
                <li>
                     <span style="color: green; font-size: 1.2em;">Спецификация</span>
                </li>
                <li>
                     <a href="/data?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>">Информация</a>
                </li>
                <li>
                     <a href="/drawings?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>">Чертежи</a>
                </li>
            </ul>  
        </div>
        <div id="sort_menu_danieli_box">
            <ul>
                <li>
                    <input type="radio" name="sort" type_sort="all" checked="checked"/>
                    <span>Всё</span>
                </li>
                 <li>
                    <input type="radio" name="sort" type_sort="component" />
                    <span>Узлы</span>
                </li>
                <li>
                    <input type="radio" name="sort" type_sort="detail" />
                    <span>Детали</span>
                </li>
                <li>
                    <input type="radio" name="sort" type_sort="standart" />
                    <span>Стандартные изделия</span>
                </li>
                <li>
                    <input type="radio" name="sort" type_sort="assembly" />
                    <span>Компоновочные чертежи</span>
                </li>
                 <li>
                    <input type="radio" name="sort" type_sort="schema" />
                    <span>Схемы</span>
                </li>
            </ul>
        </div>
        <!-- start action box -->
        <div id="menu_action_box" style="display: none;">
            <ul>
                <li id="add_elect">Добавить в список</li>
                <? if($role == 'admin'): ?>
                    <li id="delete_detail">Удалить узел (деталь)</li>   
                <? endif; ?> 
            </ul>            
        </div>
        <!-- end action box -->
    </div>
</div>