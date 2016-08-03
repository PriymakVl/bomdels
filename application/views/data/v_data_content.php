<div class="content">
    <? if(isset($detail)): ?>
    <!-- start info-menu-box -->
    <div class="info-menu-box">
         <?=$detail->rus?> - <span>информация</span>
         <a id="history-back-link" href="javascript:history.back();">назад</a>
    </div>
    <!-- end info-menu-box -->
    
    <!-- start full note box -->
    <div id="full_note_box" style="display: none;">
        <h4>Полный текст примечания</h4>
        <p></p>
        <a href="#" onclick="return false;" id="hide_note">закрыть</a>
    </div>
    <!-- end full note box -->
    
    <!-- start detail data box -->
    <table class="detail-info">
        <tr>
            <td width="30">
                <input type="radio" name="detail" />
            </td>
            <th width="220">Наименование</th>
            <th>Значение</th>
        </tr>
        <tr>
            <td>
                <input type="radio" name="detail"/>
            </td>
            <td style="padding-left: 5px;">Название</td>
            <td style="padding-left: 5px;">
                <? if($detail->sub_id): ?>
                    <a href="/specification?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>"><?=$detail->rus?></a>
                <? else: ?>
                    <span><?=$detail->rus?></span>
                <? endif; ?>
                <!-- for edit title -->
                <input type="text" value="<?=$detail->rus?>" id="rus" style="display: none;" />
            </td>
        </tr>
        <tr>
        <? if($role == 'admin'): ?>
            <td>
                <input type="radio" name="detail" disabled="disabled" />
                </td>
                <td style="padding-left: 5px;">Name</td>
                <td style="padding-left: 5px;">
                    <span><?=$detail->eng?></span>
                </td>
            </tr>
        <? endif; ?>
        <tr>
            <td>
                <input type="radio" name="detail" disabled="disabled" />
            </td>
            <td style="padding-left: 5px;">Код</td>
            <td style="padding-left: 5px;">
                <? if($detail->count_draws == 1): ?>
                    <a target="_blank" href="media/drawings/<?=$detail->equipment?>/<?=$detail->drawings[0]['folder']?>/<?=$detail->drawings[0]['file']?>"><?=$detail->code?></a>
                <? elseif($detail->count_draws): ?>   
                    <a href="/drawings?id=<?=$detail->id?>&equipment=<?=$detail->equipment?>"><?=$detail->code?></a>
                <? else: ?>
                    <?=$detail->code?>
                <? endif; ?>
            </td>
            <!-- input hidden start -->
            <input type="hidden" id="equipment" value="<?=$detail->equipment?>"/>
            <input type="hidden" id="detail_id" value="<?=$detail->id?>" />
            <input type="hidden" id="role" value="<?=$role?>" />
            <!-- input hidden end -->
        </tr>
        <? if($detail->variant): ?>
            <tr>
                <td>
                    <input type="radio" name="detail" />
                </td>
                <td style="padding-left: 5px;">Вариант</td>
                <td style="padding-left: 5px;">
                    <span><?=$detail->variant?></span>
                    <input type="text" value="<?=$detail->variant?>" id="variant" style="display: none;" />
                </td>
            </tr>
        <? endif; ?>
        <tr>
            <td>
                <input type="radio" name="detail" disabled="disabled"/>
            </td>
            <td style="padding-left: 5px;">Примечание</td>
            <td style="padding-left: 5px;" id="full_note_field" note="<?=$detail->note?>">
                <? if($detail->note_cut): ?>
                    <a href="#" onclick="return false;" id="link_full_note" note="<?=$detail->note?>"><?=$detail->note_cut?></a>
                <? else: ?>
                    <span><?=$detail->note?></span>
                <? endif; ?>        
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="detail" />
            </td>
            <td style="padding-left: 5px;">Входит в состав</td>
            <td style="padding-left: 5px;">
                <a href="/specification?id=<?=$detail->parent['id']?>&equipment=<?=$detail->equipment?>"><?=$detail->parent['rus']?></a>
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="detail" />
            </td>
            <td style="padding-left: 5px;">Code parent</td>
            <td style="padding-left: 5px;">
                <?=$detail->parent['code']?>
                <input type="text" value="<?=$detail->parent['code']?>" id="parent" style="display: none;" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="detail" />
            </td>
            <td style="padding-left: 5px;">Количество в узле</td>
            <td style="padding-left: 5px;">
                <span><?=$detail->qty?></span>
                <input type="text" value="<?=$detail->qty?>" id="qty" style="display: none;" />
            </td>
        </tr>
        <? if($detail->sub_id): ?>
            <tr>
                <td>
                    <input type="radio" name="detail" />
                </td>
                <td style="padding-left: 5px;">Материал</td>
                <td style="padding-left: 5px;">Сборочный узел</td>
            </tr> 
        <? else: ?> 
            <tr>
                <td>
                    <input type="radio" name="detail" />
                </td>
                <td style="padding-left: 5px;">Материал</td>
                <td style="padding-left: 5px;">
                    <span><?=$detail->material?></span>
                    <input type="text" value="<?=$detail->material?>" id="material" style="display: none;" />
                </td>
            </tr>
            <? if($detail->analog): ?>
                <tr>
                    <td>
                        <input type="radio" name="detail"  />
                    </td>
                    <td style="padding-left: 5px;">Аналог</td>
                    <td style="padding-left: 5px;">
                        <span><a href="#"><?=$detail->analog?></a></span>
                        <input type="text" value="<?=$detail->analog?>" id="analog" style="display: none;" />
                    </td>
                </tr>
            <? endif; ?>
        <? endif; ?>
            <tr>
                <td>
                    <input type="radio" name="detail" />
                </td>
                <td style="padding-left: 5px;">Вес</td>
                <td style="padding-left: 5px;">
                    <span><?=$detail->weight?> кг</span>
                    <input type="text" value="<?=$detail->weight?>" id="weight" style="display: none;" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="detail" />
                </td>
                <td style="padding-left: 5px;">Чертежи</td>
                <td style="padding-left: 5px;">
                    <? if($detail->drawings): ?>
                        <?=$detail->count_draws?> шт.
                        <? else: ?>
                        <span>нет</span>
                     <? endif; ?>  
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="detail" />
                </td>
                <td style="padding-left: 5px;">Дата последней замены</td>
                <td style="padding-left: 5px;">
                    25.04.16 <a href="#">График замен</a>        
                </td>
            </tr>
             <tr>
                <td>
                    <input type="radio" name="detail" />
                </td>
                <td style="padding-left: 5px;">Срок эксплуатации</td>
                <td style="padding-left: 5px;">
                    1 год        
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="detail" />
                </td>
                <td style="padding-left: 5px;">Неснижаемый минимум</td>
                <td style="padding-left: 5px;">
                    5        
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="detail" />
                </td>
                <td style="padding-left: 5px;">Резерв</td>
                <td style="padding-left: 5px;">
                    <span style="color: red;">нет в наличии (пример)</span>        
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="detail" />
                </td>
                <td style="padding-left: 5px;">Заказы</td>
                <td style="padding-left: 5px;">
                    <a href="#">27314.1 (изготовление)</a><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                    <a href="#">273655.1 (ремонт)</a>        
                </td>
            </tr>
             <tr>
                <td>
                    <input type="radio" name="detail" />
                </td>
                <td style="padding-left: 5px;">Заявка</td>
                <td style="padding-left: 5px;">
                    <a href="#">исх №048/27т-754 (пример)</a>        
                </td>
            </tr>
             <tr>
                <td>
                    <input type="radio" name="detail" />
                </td>
                <td style="padding-left: 5px;">Код ЕНС</td>
                <td style="text-align: center;">
                    <?=$detail->ens?>  
                    <input type="text" value="<?=$detail->ens?>" id="ens" style="display: none;" />         
                </td>
            </tr>
    </table>
    <!-- end data box -->
    
    <!-- start drawings-form-note -->
    <div id="detail_form_note_box" style="display: none;">
        <form method="post" id="detail_form_note" action="/data/addnote">
            <textarea name="note"></textarea>
            <input type="hidden" name="detail_id" value="<?=$detail->id?>"/>
            <input type="hidden" name="equipment" value="<?=$detail->equipment?>" />
            <input type="submit" id="save_note" value="Сохранить запись" />
            <input type="button" id="cancel_note" value="Отменить" />
        </form>
    </div>
    <!-- end drawings-form-note -->
    <? endif; ?>
</div>