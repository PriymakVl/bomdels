<div class="content">
    <div class="info-menu-box">
        <?=$equipment?> - <span><?=$info?></span>
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
                        <input type="radio" name="element" det_id="<?=$detail->id?>" equipment="<?=$detail->equipment ?>" role="<?=$employee->role?>" />
                    </td>
                    <td style="text-align: center;">
                        <?=$detail->equipment ?>
                    </td>
                    <td style="padding-left: 5px;">
                        <? if($detail->sub_id): ?>
                            <a href="/specification?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>" title="<?=$detail->eng?>"><?=$detail->rus?></a>
                        <? else: ?>
                            <a href="/data?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>" title="<?=$detail->eng?>"><?=$detail->rus?></a>
                        <? endif; ?>
                    </td> 
                    <td style="text-align: center;">
                         <? if(!$detail->drawings): ?>
                            <?=$detail->code?>
                        <? else: ?>
                            <a href="/drawings?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>" ><?=$detail->code?></a>
                        <? endif; ?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? endif; ?>
    </table>
</div>