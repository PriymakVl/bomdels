<div class="content">
    <h2><?=$name_title?></h2>
    <table>
        <tr>
            <th >Чертеж</th>
            <th >Наименование</th>
        </tr>
        <? if (isset($draws)): ?>
            <? foreach ($draws as $draw): ?>
                <tr>
                    <td id="field-code"><?=$draw['code']?></td>
                    <td>
                        <? if(empty($draw['rus'])): ?>
                            <a href="/?draw_id=<?=$draw['id']?>" title="<?=$draw['eng']?>"><?=$draw['eng']?></a>
                        <? else: ?>
                            <a href="/?draw_id=<?=$draw['id']?>" title="<?=$draw['eng']?>"><?=$draw['rus']?></a>
                        <? endif; ?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? endif; ?>
    </table>
</div>