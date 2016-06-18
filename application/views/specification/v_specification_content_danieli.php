<div class="content">
    <div class="info-menu-box">
        <?=$detail->rus?> - <span>спецификация</span>
        <a id="history-back-link" href="javascript:history.back();">назад</a>
    </div>
    <table>
        <tr>
                <th width="30"><input type="radio" disabled="disabled" /></th>
                <th width="60">Заказ</th>
                <th width="60">Заявка</th>
                <th >Наименование</th>
                <th width="50">Поз</th>
                <th width="150">Код</th>
        </tr>
        <? if ($details): ?>
            <? foreach ($details as $det): ?>
                <tr>
                    <td class="cat-data">    
                        <input type="radio"  name="detail" detail_id="<?=$det->id?>" type_elem="<?=$det->type?>" equipment="<?=$det->equipment?>" role="<?=$employee->role?>"/>
                    </td>
                    <td></td>
                    <td></td>
                    <td style="padding-left: 5px;">
                        <? if(!$det->sub_id): ?>
                            <a href="/data?id=<?=$det->id?>&equipment=<?=$det->equipment?>" title="<?=$det->eng?>"><?=$det->rus?></a>
                        <? else: ?>
                            <a href="/specification?id=<?=$det->id?>&equipment=<?=$det->equipment?>" title="<?=$det->eng?>"><?=$det->rus?></a>
                        <? endif; ?>
                    </td>
                    <td style="text-align: center;"><?=$det->item?></td>
                    <td style="text-align: center;">
                        <? if(!$det->drawings): ?>
                            <?=$det->code?>
                        <? else: ?>
                            <a href="/drawings?id=<?=$det->id?>&equipment=<?=$det->equipment?>" ><?=$det->code?></a>
                        <? endif; ?>                      
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
        <tr>
            <td colspan="4">Таких деталей в спецификации нет</td>
        </tr>
        <? endif; ?>
    </table>
</div>