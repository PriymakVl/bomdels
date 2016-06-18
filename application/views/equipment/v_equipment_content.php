<div class="content">
    <div class="info-menu-box">
        <?=$equipment?> - <span><?=$info?></span>
    </div>
    <table>
        <tr>
            <td width="30"><input type="radio" disabled="disabled" /></td>
            <th width="100">Что то</th>
            <th >Наименование</th>
            <th width="190">Код</th>
        </tr>
        <? if (isset($elements)): ?>
            <? foreach ($elements as $element): ?>
                <tr>
                    <td>
                        <input type="radio" name="element" detail_id="<?=$element->id?>" />
                    </td>
                    <td style="text-align: center;">
                        <span style="text-transform: capitalize;">что то</span>
                    </td>
                    <td style="padding-left: 5px;">
                        <? if(!$element->sub_id): ?>
                            <a href="/data?id=<?=$element->id?>&equipment=<?=$element->equipment?>" title="<?=$element->eng?>"><?=$element->rus?></a>
                        <? else: ?>
                            <a href="/specification?id=<?=$element->id?>&equipment=<?=$element->equipment?>" title="<?=$element->eng?>"><?=$element->rus?></a>
                        <? endif; ?>
                    </td>
                    <td style="text-align: center !important;">
                        <? if(!$element->drawings): ?>
                            <?=$element->code?>
                        <? else: ?>
                            <a href="/drawings?id=<?=$element->id?>&equipment=<?=$element->equipment?>" ><?=$element->code?></a>
                        <? endif; ?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? endif; ?>
    </table>
</div>