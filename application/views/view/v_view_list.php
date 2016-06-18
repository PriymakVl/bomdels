<div class="view-button-list-draws-wp">
    <img src="/media/images/style/button_list_draws.jpg" />
</div>
<div class="view-list-draws-wp">
    <div class="header-list-draws">
        <a href="#" id="close_list" onclick="return false">закрыть</a>
    </div>
    <table>
        <tr>
            <th><input type="checkbox" /></th>
            <th>Файл</th>
            <th>Тип</th>
        </tr>
        <? foreach ($draws as $draw): ?> 
            <tr>
                <td><input type="checkbox" /></td>
                <td>
                    <a href="/view?draw_id=<?=$draw['id']?>"><?=$draw['file']?></a>
                </td>
                <td><?=$draw['type']?></td>
            </tr>
        <? endforeach ?>
    </table>
</div>