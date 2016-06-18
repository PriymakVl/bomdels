<? if (isset($details)): ?>
<div class="view-button-specification-wp">
    <img src="/media/images/style/button_specification.jpg" />
</div>
<div class="view-specification-wp">  
    <div class="header-specification">
        <a href="#" id="close_specification" onclick="return false">закрыть</a>
    </div>
    <table>
        <tr>
            <th><input type="checkbox" /></th>
            <th>Поз.</th>
            <th>Наименование</th>
        </tr>
    <? foreach ($details as $detail): ?> 
        <tr>            
            <td><input type="checkbox" /></td>
            <td><?=$detail->item?></td>
            <td>
                <a href="</view?id=<?=$detail->id?>" class="link-detail-specification" onclick="return false;"><?=$detail->rus?></a>
            </td>   
        </tr>
    <? endforeach ?>
    </table>
</div>
<? endif; ?>