<div class="right-sidebar">
    <div class="right-sidebar-header">
        <ul>
            <li id="add_data" class="active-item-menu-sidebar">Страницы</li>
            <li id="manager_link">Управление</li>
            <li id="add_data">Добавление данных sundbirsta</li>
        </ul>
    </div>
    <div class="sidebar-content-wrp">
        <div id="menu-pages-box">
            <ul>
                <li>
                     <a href="#" class="active-item-menu-sidebar" onclick="return false;">Информация</a>
                </li>
                <? if($detail->sub_id): ?>
                    <li>
                         <a href="/specification?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>">Спецификация</a>
                    </li>
                <? endif; ?>
                <li>
                     <a href="/drawings?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>">Чертежи</a>
                </li>
            </ul>  
        </div>
        <div id="data_add_box" style="display: none;">
            <div>
                <h3>Добавление данных</h3>
                <form enctype="multipart/form-data" method="post" action="/auto/data/sundbirsta">
                    <input type="file" name="data" />
                    <input type="hidden" name="parent_code" value="<?=$detail->code?>" />
                    <input type="hidden" name="parent_id" value="<?=$detail->id?>" />
                    <input type="submit" value="Добавить данные" />
                </form>
            </div>
             <div>
                <h3>Проверка данных</h3>
                <form enctype="multipart/form-data" method="post" action="/auto/data/checkDataFile">
                    <input type="file" name="data" />
                    <input type="hidden" name="parent_code" value="<?=$detail->code?>" />
                    <input type="hidden" name="parent_id" value="<?=$detail->id?>" />
                    <input type="submit" value="Проверить данные" />
                </form>
            </div>
        </div>
        <div id="data_edit_box">
            <ul>
                <li id="edit_item">Редактирвание</li>
                <li id="save_edit" style="display:none;">Сохранить редактирование</li>
                <li id="cancel_edit"  style="display:none;">Отменить редактирование</li>
            </ul>
        </div>
    </div>
</div>