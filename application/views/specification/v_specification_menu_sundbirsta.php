<div class="right-sidebar">
    <div class="right-sidebar-header">
        <ul>
            <li id="pages" class="active-item-menu-sidebar" >Страницы</li>
            <li id="filter">Фильтр</li>
            <li id="manager_link">Управление</li>
        </ul>
    </div>
    <div class="sidebar-content-wrp">
        <div id="menu_pages_box">
                <ul>
                    <li>
                         <a href="#" class="active-item-menu-sidebar" onclick="return false;">Спецификация</a>
                    </li>
                    <li>
                         <a href="/data?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>">Информация</a>
                    </li>
                    <li>
                         <a href="/drawings?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>">Чертежи</a>
                    </li>
                    <li>
                         <a href="/order?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>">Заказы</a>
                    </li>
                    <li>
                         <a href="/requistion?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>">Заявки</a>
                    </li>
                </ul>  
            </div>
        <div id="sort-sundbirsta-box" style="display: none;">
            <ul>
                <li>
                    <input type="checkbox" id="select_all" /><span>Выделить все</span>
                </li>
                <li>
                    <input type="checkbox" value="балк" /><span>балки</span>
                </li>
                 <li>
                    <input type="checkbox" value="винт" /><span>винты</span>
                </li>
                <li>
                    <input type="checkbox" value="втулк" /><span>втулки</span>
                </li>
                <li>
                    <input type="checkbox" value="гидр" /><span>гидрав. оборудование</span>
                </li>
                 <li>
                    <input type="checkbox" value="головк" /><span>головки</span>
                </li>
                 <li>
                    <input type="checkbox" value="дорн" /><span>дорн</span>
                </li>
                 <li>
                    <input type="checkbox" value="знак" /><span>знаки</span>
                </li>
                <li>
                    <input type="checkbox" value="колонн" /><span>колонны</span>
                </li>
                <li>
                    <input type="checkbox" value="кронштейн" /><span>кронштейны</span>
                </li>
                <li>
                    <input type="checkbox" value="опор" /><span>опоры</span>
                </li>
                <li>
                    <input type="checkbox" value="плит" /><span>плиты</span>
                </li>
                <li>
                    <input type="checkbox" value="подшипник" /><span>подшипники</span>
                </li>
                 <li>
                    <input type="checkbox" value="полка" /><span>полки</span>
                </li>
                
                 <li>
                    <input type="checkbox" value="рефлектор" /><span>рефлектор</span>
                </li>
                 <li>
                    <input type="checkbox" value="ролик" /><span>ролики</span>
                </li>
                <li>
                    <input type="checkbox" value="стол" /><span>столы</span>
                </li>
                 <li>
                    <input type="checkbox" value="фотодатчик" /><span>фотодатчики</span>
                </li>
                 <li>
                    <input type="checkbox" value="шайба" /><span>шайбы</span>
                </li>
            </ul>
            <button id="hide">Скрыть</button><button id="reset">Сбросить</button>
        </div>
        <div id="menu_action_box" style="display: none;">   
            <ul>
                <li id="add_elect">Добавить в популярные</li>
            </ul>
        </div>
    </div>
</div>