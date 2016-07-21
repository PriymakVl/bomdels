<div class="content">
    <!-- start info-menu-box -->
    <div class="info-menu-box">
        <?=$detail->rus?> - <span>чертежи</span>
        <a id="history-back-link" href="javascript:history.back();">назад</a>
    </div>
    <!-- end info-menu-box -->
    
    <!-- start full note box -->
    <div id="full_note_box" style="display: none;">
        <h4>Полный текст примечания</h4>
        <p></p>
        <a href="#" onclick="return false;" id="hide_note">закрыть</a>
    </div>
    <!-- end full note box -->
    
    <!-- start drawings-main-box -->
    <div id="drawings_main_box">
        <table>        
            <tr>
                <td width="30"><input type="radio" disabled="disabled" /></td>
                <th width="120">Информация</th>
                <th width="250">Файл</th>
                <th>Примечание</th>
            </tr>
            <? if($draws): ?>
            <? foreach($draws as $draw): ?>
                <tr>
                    <td>
                        <input type="radio" name="draw" draw_id="<?=$draw->id?>" note="<?=$draw->note?>"/>
                    </td>
                    <td>
                        <a href="#" onclick="return false;" id="show_data"><?=$draw->type?></a>
                    </td>
                    <td>
                        <a target="_blank" href="media/drawings/<?=$draw->equipment?>/<?=$draw->folder?>/<?=$draw->file?>"><?=$draw->file?></a>
                    </td>
                    <td>
                        <? if($draw->note_cut): ?>
                            <a href="#" onclick="return false;" class="show_note" note="<?=$draw->note?>" title="показать полный текст примечания"><?=$draw->note_cut?></a>
                        <? else: ?>
                            <?=$draw->note?> 
                        <? endif; ?>   
                    </td>
                </tr>
            <? endforeach; ?>
            <? else: ?>
            <tr>
                <td colspan="6" style="text-align: center; color: red; height: 30px;">У детали(узла) нет чертежей</td>
            </tr>
            <? endif; ?>
        </table>
    </div>
    <!-- end drawings-main-box -->  
    
    <!-- start drawings-data-box -->
    <div id="drawing_data_box" style="display: none;">
        <span>Информация по чертежу</span>
        <a href="#" onclick="return false;" id="hide_data">закрыть</a>
        <table>
            <tr>
                <td width="30"><input type="radio" disabled="disabled" /></td>
                <th>Наименование</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td><input type="radio" /></td>
                <td>Наименование детали</td>
                <td><?=$detail->rus?></td>
            </tr>
            <tr>
                <td><input type="radio" /></td>
                <td>Код детали</td>
                <td><?=$detail->code?></td>
            </tr>
             <tr>
                <td><input type="radio" /></td>
                <td>Файл чертежа</td>
                <td>image.pdf</td>
            </tr>
             <tr>
                <td><input type="radio" /></td>
                <td>Место разработки</td>
                <td>цех</td>
            </tr>
            <tr>
                <td><input type="radio" /></td>
                <td>Разработчик</td>
                <td>Иванов</td>
            </tr>
             <tr>
                <td><input type="radio" /></td>
                <td>Дата добавления</td>
                <td>12.05.16</td>
            </tr>
             <tr>
                <td><input type="radio" /></td>
                <td>Размер</td>
                <td>A4</td>
            </tr>
            <tr>
                <td><input type="radio" /></td>
                <td>Масштаб</td>
                <td>1:1</td>
            </tr>
        </table>
    </div>
    <!-- end drawings-data-box -->
    
    <!-- start drawings-form-note -->
    <div id="drawings_form_note_box" style="display: none;">
        <form method="post" id="drawings_form_note" action="/drawings/addnote">
            <textarea name="note"></textarea>
            <input type="hidden" name="draw_id" />
            <input type="submit" id="save_note" value="Сохранить запись" />
            <input type="button" id="cancel_note" value="Отменить" />
        </form>
    </div>
    <!-- end drawings-form-note -->
    
    <!-- start drawings-form-draw -->
    <div id="drawings_form_draw_box" style="display: none;">
        <form method="post" id="drawings_form_draw" action="/drawings/adddraw">
            <select name="type" style="width: 150px; height: 26px;">
                <option value="производитель">производитель</option>
                <option value="пко">ПКО</option>
                <option value="цех">цех</option>
                <option value="стандарт">стандарт</option>
                <option value="другое">другое</option>
            </select>
            <br />
            <label>Файл</label>
            <input type="text" name="file" style="width: 200px; height: 24px;"/>
            <br />
            <input type="hidden" name="detail_id" value="<?=$detail->id?>" />
            <input type="hidden" name="code" value="<?=$detail->code?>" />
            <input type="hidden" name="equipment" value="<?=$detail->equipment?>" />
            <input type="submit" id="add_draw" value="Добавить чертеж" />
            <input type="button" id="cancel_draw" value="Отменить" />
        </form>
    </div>
    <!-- end drawings-form-draw -->
</div>