<div class="content">
    <div class="info-menu-box">
        <?=$detail->rus?> - <span>спецификация</span>
        <a id="history-back-link" href="javascript:history.back();">назад</a>
    </div>
    <table>
        <tr>
            <th width="30"><input type="radio" disabled="disabled" /></th>
            <th >Наименование</th>
            <th width="50">Поз</th>
            <th width="180">Код</th>
        </tr>
        <? if ($details): ?>
            <? foreach ($details as $detail): ?>
                <tr>
                    <td class="cat-data">
                        <input type="radio"  name="detail" detail_id="<?=$detail->id?>" equipment="<?=$detail->equipment?>"/>
                    </td>
                    <td style="padding-left: 5px;">
                        <? if(!$detail->sub_id): ?>
                            <a href="/data?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>" title="<?=$detail->eng?>"><?=$detail->rus?></a>
                        <? else: ?>
                            <a href="/specification?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>" title="<?=$detail->eng?>"><?=$detail->rus?></a>
                        <? endif; ?>
                    </td>
                    <td style="text-align: center;"><?=$detail->item?></td>
                    <td style="text-align: center;">
                        <? if(!$detail->drawings): ?>
                            <?=$detail->code?>
                        <? else: ?>
                            <a href="/drawings?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>" ><?=$detail->code?></a>
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