<div class="content">
    <h2 style="text-align: center; font-weight: normal; margin-bottom: 5px;">Результаты поиска</h2>
    <div class="info-menu-box">
        <span>Оборудование:&nbsp;&nbsp;&nbsp;</span>&laquo;&nbsp;<?=$equipment?>&nbsp;&raquo;<br />
        <span>Запрос:&nbsp;&nbsp;&nbsp;</span>&laquo;&nbsp;<?=$search?>&nbsp;&raquo;<br />
        <span>Поиск по:&nbsp;&nbsp;&nbsp;</span>&laquo;&nbsp;<? echo ($type == 'code') ? 'коду' : 'наименованию'; ?>&nbsp;&raquo;
    </div>
    
<? if (!empty($details)): ?>
    <table>
        <tr>
            <td width="30"><input type="radio" disabled="disabled" /></td>
            <th>Входит в состав</th>
            <th >Наименование</th>
            <th width="150">Код</th>
        </tr>
        <? foreach ($details as $detail): ?>
            <tr>
                <td>
                    <input type="radio" name="element" detail_id="<?=$detail->id?>" />
                </td>
                <td style="padding-left: 5px;">
                    <? if($detail->parent): ?>
                        <a href="/specification?id=<?=$detail->parent['id']?>&equipment=<?=$detail->equipment?>"><?=$detail->parent['rus']?>
                    <? endif; ?>
                </td>
                <td style="padding-left: 5px;">
                        <a href="/data?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>" title="<?=$detail->eng?>"><?=$detail->rus?></a>
                </td>
                <td style="text-align: center !important;">
                    <? if(!$detail->drawings): ?>
                        <?=$detail->code?>
                    <? else: ?>
                        <a href="/drawings?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>" ><?=$detail->code?></a>
                    <? endif; ?> 
                </td>
            </tr>
            <? endforeach; ?>
    </table>
<? else: ?>
    <p style="color: red; padding: 5px 10px; margin-top: 15px; border: 1px solid #B49A6A;">Поиск не дал результатов</p>
<? endif; ?>
</div>