<div class="content">
    <div class="info-menu-box"><?=$info?></div>
    
    <!-- start glossary box -->
    <div id="glossary_box">
        <table>
            <tr>
                <td width="30"><input type="radio" disabled="disabled" /></td>
                <th width="45%">Name</th>
                <th>Наименование</th>
            </tr>
            <? if (!empty($names)): ?>
                <? foreach ($names as $name): ?>
                    <tr>
                        <td>
                            <input type="radio" name="element" name_id="<?=$name['id']?>" />
                        </td>
                        <td style="padding: 5px;">
                            <?=$name['eng']?>
                        </td>
                        <td style="padding: 5px;">
                            <?=$name['rus']?> 
                        </td>
                    </tr>
                <? endforeach; ?>
                <? else: ?>
                <tr>
                    <td colspan="4" style="text-align: center; color: red; height: 30px;">Глоссарий пуст</td>
                 </tr>
            <? endif; ?>
        </table>
    </div>
    <!-- end glossary box -->
    
    <!-- start add translation box -->
    
    <div id="add_translation_box"  style="display: none;">
        <a href="#" id="hide_translation_box" onclick="return false;">выйти</a>
         <form action="/glossary/addtranslationfromfile" method="post" enctype="multipart/form-data">
            <p>выберите файл</p>
            <input type="file" name="table"/>
            <br />
            <input type="submit" value="добавить данные"/>
            <input type="submit" name="check" value="показать данные"/>
        </form>
    </div>
    <!-- end add translation box -->
</div>