<div class="content">
    <h2><?=$submenu?></h2>
    <table>
        <tr>
            <td width="30"><input type="checkbox" /></td>
            <th >Наименование</th>
            <th width="50">Поз.</th>
            <th width="200">Код</th>
        </tr>
        <? if (isset($draws)): ?>
            <? foreach ($draws as $draw): ?>
                <tr>
                    <td><input type="checkbox" draw_id="<?=$draw->id?>" /></td>
                    <td>
                        <? if(!$draw->sub_id): ?>
                            <a href="/data?id=<?=$draw->id?>" title="<?=$draw->eng?>"><?=$draw->rus?></a>
                        <? else: ?>
                            <a href="/specification?id=<?=$draw->id?>" title="<?=$draw->eng?>"><?=$draw->rus?></a>
                        <? endif; ?>
                    </td>
                    <td><?=$draw->item?></td>
                    <td>
                        <? if(!$draw->image): ?>
                            <?=$draw->code?>
                        <? else: ?>
                            <a href="/view?id=<?=$draw->id?>" ><?=$draw->code?></a>
                        <? endif; ?>
                    </td>
                    
                </tr>
            <? endforeach; ?>
        <? endif; ?>
    </table>
</div>