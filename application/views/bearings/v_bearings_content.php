<div class="content">
    <div class="info-menu-box"><?=$info?></div>
    
    <!-- start bearign list box -->
    <div id="bearign_list_box">
        <table>
            <tr>
                <td width="30"><input type="radio" disabled="disabled" /></td>
                <th width="40px">Код</th>
                <th>Номер</th>
                <th width="80px">Производитель</th>
                <th width="40px">Тип</th>
                <th width="40px">Оборудование</th>
            </tr>
            <? if (!empty($bearings)): ?>
                <? foreach ($bearings as $bearing): ?>
                    <tr>
                        <td>
                            <input type="radio" name="bearing" bearing_id="<?=$bearing['id']?>" />
                        </td>
                        <td style="text-align: center">
                            <?=$bearing['code']?> 
                        </td >
                        <td style="text-align: center">
                            <?=$bearing['origin']?> 
                        </td >
                        <td style="text-align: center">
                            <?=$bearing['manufacturer']?>    
                        </td>
                        <td style="text-align: center">
                            <?=$bearing['type']?> 
                        </td>
                        <td style="text-align: center">
                            <?=$bearing['equipment']?>
                        </td>
                    </tr>
                <? endforeach; ?>
                <? else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: red; height: 30px;">В базе еще подшипников</td>
                 </tr>
            <? endif; ?>
        </table>
    </div>
    <!-- end bearign list box -->
    
</div>