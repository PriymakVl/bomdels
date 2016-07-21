<div class="content">
    <div class="info-menu-box"><?=$info?></div>
    
    <!-- start standart box -->
    <div id="standart_box">
        <table>
            <tr>
                <td width="30"><input type="radio" disabled="disabled" /></td>
                <th width="40px">Код</th>
                <th>Наименование</th>
                <th width="80px">Тип</th>
                <th width="40px">Стандарт</th>
            </tr>
            <? if (!empty($data)): ?>
                <? foreach ($data as $item): ?>
                    <tr>
                        <td>
                            <input type="radio" name="standart" item_id="<?=$item['id']?>" />
                        </td>
                        <td style="text-align: center">
                            <?=$item['code']?> 
                        </td>
                        <td style="padding: 5px;">
                            <? if ($item['rus']): ?>
                                <?=$item['rus']?>
                            <? else: ?>
                                <?=$item['eng']?> 
                            <? endif; ?>
                        </td>
                        <td style="text-align: center">
                            нет 
                        </td>
                        <td style="text-align: center">
                            <? if($item['standart_value'] == 'not found'): ?>
                                не определен
                            <? else: ?>
                                <? echo $item['standart'].' '.$item['standart_value']?> 
                            <? endif; ?>
                        </td>
                    </tr>
                <? endforeach; ?>
                <? else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: red; height: 30px;">В базе еще нет стандартных изделий</td>
                 </tr>
            <? endif; ?>
        </table>
    </div>
    <!-- end standart box -->
    
</div>