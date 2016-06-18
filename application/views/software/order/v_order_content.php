<div class="content">
    <? if(isset($order)): ?>
    <div class="info-menu-box">
         <?=$order->title?> - <span>информация</span>
         <a id="history-back-link" href="javascript:history.back();">назад</a>
    </div>
    
    <!-- start order info box -->
    <table id="order_info_box" >
        <tr>
            <td width="30">
                <input type="radio" name="order" />
            </td>
            <th width="220">Наименование</th>
            <th>Значение</th>
        </tr>
        <tr>
            <td>
                <input type="radio" name="order"/>
            </td>
            <td style="padding-left: 5px;">Название</td>
            <td style="padding-left: 5px;">
                <span><?=$order->title?></span>
                <!-- for edit title -->
                <input type="text" value="<?=$order->title?>" id="order_title" style="display: none;" />
            </td>
        </tr>
        <tr>
        <td>
            <input type="radio" name="order" />
            </td>
            <td style="padding-left: 5px;">Номер заказа</td>
            <td style="padding-left: 5px;">
                <span><?=$order->fullnumber?></span>
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="order" />
            </td>
            <td style="padding-left: 5px;">Дата выдачи</td>
            <td style="padding-left: 5px;"><?=$order->date?></td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="order" />
            </td>
            <td style="padding-left: 5px;">Оборудование</td>
            <td style="padding-left: 5px;">
                <span><?=$order->equipment?></span>
                <input type="text" value="/category?cat_id=<?=$order->cat_id?>" id="category_id" style="display: none;" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="order" />
            </td>
            <td style="padding-left: 5px;">Узел</td>
            <td style="padding-left: 5px;">
                <a href="/specification?id=<?=$order->detail['id']?>&equipment=<?=$order->detail['equipment']?>"><?=$order->detail['rus']?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="order" />
            </td>
            <td style="padding-left: 5px;">Вес</td>
            <td style="padding-left: 5px;">
                <?=$order->weight?><span> кг</span>
                <input type="text" value="<?=$order->weight?>" id="order_weight" style="display: none;" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="order" />
            </td>
            <td style="padding-left: 5px;">Тип заказа</td>
            <td style="padding-left: 5px;">
                <?=$order->type?>
            </td>
        </tr>
            <tr>
                <td>
                    <input type="radio" name="order" order_note="<?=$order->note?>" />
                </td>
                <td style="padding-left: 5px;">Примечание</td>
                <td style="padding-left: 5px;">
                    <?=$order->note_cut?>              
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="order" />
                </td>
                <td style="padding-left: 5px;">Служба</td>
                <td style="padding-left: 5px;">
                    <?=$order->service?>            
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="order" />
                </td>
                <td style="padding-left: 5px;">Ответственный руководитель</td>
                <td style="padding-left: 5px;">
                    <?=$order->responsible?>       
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="order" />
                </td>
                <td style="padding-left: 5px;">Лицо выдавшее заказ</td>
                <td style="padding-left: 5px;">
                    <?=$order->issuing?>       
                </td>
            </tr>
            <? if($order->type == 'ремонт'): ?>
                <tr>
                    <td>
                        <input type="radio" name="order" nature_repair="<?=$nature_repair?>" />
                    </td>
                    <td style="padding-left: 5px;">Характер ремонта</td>
                    <td style="padding-left: 5px;">
                         <?=$order->nature_repair?>       
                    </td>
                </tr>
                <tr>
            <? endif; ?>
    </table>
    <? endif; ?>
    <!-- end order info box -->
    
    <!-- start order content box -->
        <table id="order_content_box" style="display: none;">
        <tr>
            <td width="30"><input type="radio" disabled="disabled" /></td>
            <th width="100">Чертеж</th>
            <th width="60">Лист</th>
            <th width="40">Поз.</th>
            <th width="385">Наименование</th>
            <th width="60">Кол-во</th>
        </tr>
        <? if (isset($order_content)): ?>
            <? foreach ($order_content as $item): ?>
                <tr>
                    <td>
                        <input type="radio" name="element"  />
                    </td>
                    <td style="text-align: center;">
                        <?=$item->code?>
                    </td>
                    <td style="text-align: center;">
                        <? if($item->path): ?>
                            <? echo "<a href='{$item->path}'>Лист {$item->sheet}</a>"; ?>
                        <? else: ?>
                            <?='Лист '.$item->sheet?>
                        <? endif; ?>
                    </td>
                    <td style="text-align: center;"> 
                        <?=$item->item?>                     
                    </td>
                    <td style="padding-left: 5px;">
                        <? echo "<a href='/sofware/ordercontent?elem_id={$item->id}'>{$item->title}</a>"; ?>
                    </td>
                    <td style="text-align: center;">
                        <?=$item->count?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? endif; ?>
    </table>
    <!-- end order content box -->
    
    
</div>




















