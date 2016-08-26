<div class="content">
    <div class="info-menu-box">
        <? echo isset($category) ? $category->title : $info ?>
        <a id="history-back-link" href="javascript:history.back();">назад</a>
    </div>
    <!-- start form add category -->
    <div id="category_data_box" style="display: none;">
        <label>Name:</label>
        <input type="text" name="title" />
        <br />
        <label>Rating:</label>
        <input type="text" name="rating" />
        <br />
        <label>Alias:</label>
        <input type="text" name="alias" />
        <br />
        <label>Equipment:</label>
        <input type="text" name="equipment" value="<?=$equipment?>" readonly />
        <br />
        <label>Id parent:</label>
        <input type="text" name="parent" value="<? echo (empty($category)) ? 0 : $category->id; ?>" readonly />
        <br />
        <input type="submit" id="add_cat" value="создать"/>
        <input type="submit" id="edit_cat" value="сохранить"/>
        <input type="button" id="cancel" value="отменить"/>
    </div>
    <!-- end form add category -->
    <div id="category_content_box">
        <table>
            <tr>
                    <th width="30"><input type="radio" disabled="disabled" /></th>
                    <th width="100">Обор-ние</th>
                    <th>Наименование</th>
                    <th width="150">Alias</th>
                    <th width="80">Рейтинг</th>
            </tr>
            <? if ($cats): ?>
                <? foreach ($cats as $cat): ?>
                    <tr>
                        <td>    
                            <input type="radio"  name="cat" cat_id="<?=$cat->id?>" rating="<?=$cat->rating?>" title="<?=$cat->title?>" alias="<?=$cat->alias?>"/>
                        </td>
                        <td style="text-align: center;"><?=$cat->equipment?></td>
                        <td style="padding-left: 5px;">
                            <? if($cat->sub_id): ?>
                                <a href="/admin/category?cat_id=<?=$cat->id?>"><?=$cat->title?></a>
                            <? elseif($cat->details): ?>
                                <a href="/admin/categorycontent?cat_id=<?=$cat->id?>"><?=$cat->title?></a>
                            <? else: ?>
                                <?=$cat->title?>
                            <? endif; ?>
                        </td>
                        <td style="text-align: center;"><?=$cat->alias?></td>
                        <td style="text-align: center;"><?=$cat->rating?></td>
                    </tr>
                <? endforeach; ?>
            <? else: ?>
            <tr>
                <td colspan="5">Ничего нет</td>
            </tr>
            <? endif; ?>
        </table>
    </div>
</div>