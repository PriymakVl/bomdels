<div class="right-sidebar">
     <div class="right-sidebar-header">
        <ul>
            <li id="pages" class="active-item-menu-sidebar" >Страницы</li>
            <li id="manager_link">Управление</li>
        </ul>
    </div>
    <div class="sidebar-content-wrp">
        <div id="menu_pages_box">
            <ul>
                <li>
                     <a href="#" class="active-item-menu-sidebar" onclick="return false;">Чертежи</a>
                </li>
                <li>
                     <a href="/data?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>">Информация</a>
                </li>
                <li>
                     <a href="/specification?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>">Спецификация</a>
                </li>
                <li>
                     <a href="/order?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>">Заказы</a>
                </li>
                <li>
                     <a href="/requistion?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>">Заявки</a>
                </li>
            </ul>  
        </div>
       <!-- <div id="drawings-form-sidebar-box" style="display: none;">
            <form enctype="multipart/form-data" method="post" action="/drawings/addSundbirsta">
                <p>Разработчик:</p>
                <select name="type">
                    <option value="производитель">Производитель</option>
                    <option value="пко">ПКО комбината</option>
                    <option value="цех">Цех</option>
                    <option value="стандарт">Стандарт</option>
                    <option value="другое">Другое</option>
                </select>
                <input type="file" name="draw" />
                <input type="hidden" name="id" value="<?=$detail->id?>" />
                <input type="hidden" name="equipment" value="<?=$detail->equipment?>" />
                <input type="submit" value="Добавить изображение" name="draw" />
            </form>
        </div>-->
        <div id="menu_action_box" style="display: none;">
            <ul>
                <li id="show_add_draw_box">Добавить чертеж</li>
                <li id="delete_draw">Удалить чертеж</li>
                <li id="add_note">Добавить примечание</li>
                <li id="edit_rating">Редактирование рейтинга</li>
                <li id="save_rating" style="display: none;">Сохранить рейтинг</li>
                <li id="cancel_edit_rating" style="display: none;">Отменить редакт. рейтинга</li>
            </ul>
        </div>
    </div>
</div>