<div class="content">
    <div class="info-menu-box">
        <?=$cat->title?>
        <a id="history-back-link" href="javascript:history.back();">назад</a>
    </div>
    <div id="cat_content_data_box" style="display: none;">
        <label>Код</label>
        <input type="text" name="code_new" /><br />
        <label>Рейтинг</label>
        <input type="text" name="rating" /><br /><span style="color: red;">рейтинг пока не работает менять надо в детали</span>
        <input type="hidden" name="code" /><br />
        <input type="hidden" name="cat_id" value="<?=$cat->id?>" />
        <input type="submit" id="add_content_cat" value="создать"/>
        <input type="submit" id="edit_content_cat" value="сохранить"/>
        <input type="button" id="cancel" value="отменить"/>
    </div>
    <div id="cat_content_content_box">
        <table>
            <tr>
                    <th width="30"><input type="radio" disabled="disabled" /></th>
                    <th>Наименование</th>
                    <th width="150">Код</th>
                    <th width="80">Рейтинг</th>
            </tr>
            <? if ($cat): ?>
                <? foreach ($details as $detail): ?>
                    <tr>
                        <td>    
                            <input type="radio"  name="cat" code="<?=$detail->code?>" rating="<?=$detail->rating?>" title="<?=$detail->rus?>"/>
                        </td>
                        <td style="padding-left: 5px;"><?=$detail->rus?></td>
                        <td style="text-align: center;"><?=$detail->code?></td>
                        <td style="text-align: center;"><?=$detail->rating?></td>
                    </tr>
                <? endforeach; ?>
            <? else: ?>
            <tr>
                <td colspan="5">Ничего нет</td>
            </tr>
            <? endif; ?>
        </table>
    </div>
</div>