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
                <th width="170">Код</th>
        </tr>
        <? if ($details): ?>
            <? foreach ($details as $det): ?>
                <tr>
                    <td class="cat-data">    
                        <input type="radio"  name="detail" detail_id="<?=$det->id?>" type_elem="<?=$det->type?>" 
                        equipment="<?=$det->equipment?>" parent_code="<?=$det->parent_code?>" role="<? if(isset($employee)) echo $employee->role; ?>"/>
                    </td>
                    <td style="padding-left: 5px;">
                        <a href="/data?id=<?=$det->id?>&equipment=<?=$det->equipment?>" title="<?=$det->eng?>"><?=$det->rus?></a>
                    </td>
                    <td style="text-align: center;"><?=$det->item?></td>
                    <td style="text-align: center;">
                        <? if($det->count_draws == 1): ?>
                            <a target="_blank" href="media/drawings/<?=$det->equipment?>/<?=$det->drawings[0]['folder']?>/<?=$det->drawings[0]['file']?>"><?=$det->code?></a>
                        <? elseif($det->count_draws): ?>   
                            <a href="/drawings?id=<?=$det->id?>&equipment=<?=$det->equipment?>"><?=$det->code?></a>
                        <? else: ?>
                            <?=$det->code?>
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