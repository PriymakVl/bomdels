<div class="content">
    <div class="info-menu-box">
        <? if(isset($cat)): ?>
            <a href="/category?equipment=<?=$cat->equipment?>"><?=$section?></a>
            <span><?=$info?></span>
        <? else: ?>
            <?=$section?> - <span><?=$info?></span>
        <? endif; ?>
        <a id="history-back-link" href="javascript:history.back();">назад</a>
    </div>  
    <table>
        <tr>
            <td width="30"><input type="radio" disabled="disabled" /></td>
            <th >Наименование</th>
            <th width="190">Что то</th>
        </tr>
        <? if (isset($cats)): ?>
            <? foreach ($cats as $cat): ?>
                <tr>
                    <td class="cat-data">
                        <input type="radio" name="element" cat_id="<?=$cat->id?>" role="<?=$role?>"/>
                    </td>
                    <td style="padding-left: 5px;">
                        <? if($cat->sub_id): ?>
                            <a href="/category?cat_id=<?=$cat->id?>"><?=$cat->title?></a>
                        <? elseif($cat->details): ?>
                            <a href="/category/content?cat_id=<?=$cat->id?>"><?=$cat->title?></a>
                        <? else: ?>
                            <?=$cat->title?>
                        <? endif; ?>
                    </td>   
                    <td>
                        <span>что то</span>
                    </td>
                </tr>
            <? endforeach; ?>
        <? endif; ?>
    </table>
</div>