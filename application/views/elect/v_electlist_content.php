<div class="content">
    <!-- start list box -->
    <table id="edit_list_box" style="width: 100%; display: none;">
        <caption>Перечень всех списков</caption>
        <tr>
            <th width="30">
                <input type="radio" disabled="disabled" />
            </th>
            <th width="290">Наименование</th>
            <th>Описание</th>
        </tr>
        <? if ($lists): ?>
            <? foreach ($lists as $list): ?>
                <tr>
                    <td>
                        <input type="radio" name="list" list_id="<?=$list['id']?>" />
                    </td>
                    <td style="padding-left: 5px;">
                       <?=$list['name']?>
                    </td>
                    <td style="padding-left: 5px;">
                       <?=$list['description']?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? endif; ?>
    </table>
    <!-- end list box -->
</div>















