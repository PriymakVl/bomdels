<div class="content">
    <!-- start list box -->
    <div class="info-menu-box" style="color: green;">
        <?=$title_table?>
    </div>
    
    <table id="edit_list_box" style="width: 100%;">
        <tr>
            <th width="30">
                <input type="radio" disabled="disabled" />
            </th>
            <th width="150">Наименование</th>
            <th>Описание</th>
            <th width="100">Создал</th>
        </tr>
        <? if ($lists): ?>
            <? foreach ($lists as $list): ?>
                <tr>
                    <td>
                        <input type="radio" name="list" list_id="<?=$list->id?>" />
                    </td>
                    <td style="padding-left: 5px;">
                       <?=$list->name?>
                    </td>
                    <td style="padding-left: 5px;">
                       <?=$list->description?>
                    </td>
                    <td style="padding-left: 5px;">
                       <?=$list->login?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? endif; ?>
    </table>
    <!-- end list box -->
</div>















