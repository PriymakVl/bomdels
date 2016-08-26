<div class="content">
    <div class="info-menu-box">
        <a href="/category?equipment=<?=$cat->equipment?>"><?=$section?>
        </a><span><?=$info?></span>
        <a id="history-back-link" href="javascript:history.back();">назад</a>
    </div>
    <table>
        <tr>
            <td width="30"><input type="radio" disabled="disabled" /></td>
            <th width="80">Обор-ние</th>
            <th >Наименование</th>
            <th width="150">Code</th>
        </tr>
        <? if (isset($details)): ?>
            <? foreach ($details as $detail): ?>
                <tr>
                    <td class="cat-data">
                        <input type="radio" name="element" det_id="<?=$detail->id?>" equipment="<?=$detail->equipment ?>" role="<? if(isset($employee)) echo $employee->role; ?>" />
                    </td>
                    <td style="text-align: center;">
                        <?=$detail->equipment ?>
                    </td>
                    <td style="padding-left: 5px;">
                        <a href="/data?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>" title="<?=$detail->eng?>"><?=$detail->rus?></a>
                    </td> 
                    <td style="text-align: center;">
                        <? if($detail->count_draws == 1): ?>
                            <a target="_blank" href="/media/drawings/<?=$detail->equipment?>/<?=$detail->drawings[0]['folder']?>/<?=$detail->drawings[0]['file']?>"><?=$detail->code?></a>
                        <? elseif($detail->count_draws): ?>   
                            <a href="/drawings?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>"><?=$detail->code?></a>
                        <? else: ?>
                            <?=$detail->code?>
                        <? endif; ?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? endif; ?>
    </table>
</div>