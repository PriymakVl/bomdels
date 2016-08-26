<div class="content">
    <!-- start info box -->
    <div class="info-menu-box">
        <?=$product->name?>
        <a id="history-back-link" href="javascript:history.back();">назад</a>
    </div>
    <!-- end info box -->

    <!-- start app info box -->
    <table id="app_item_box" >
        <tr>
            <td width="30">
                <input type="radio" name="item" disabled="disabled" />
            </td>
            <th width="150">Наименование</th>
            <th>Значение</th>
        </tr>
        <tr>
            <td>
                <input type="radio" name="product" />
            </td>
            <td style="padding-left: 5px;">Название</td>
            <td style="padding-left: 5px;">
                <span><?=$product->name?></span>
                <!-- name -->
                <input type="text" value="<?=$product->name?>" id="product_name" style="display: none;" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="product"/>
            </td>
            <td style="padding-left: 5px;">Код ЕНС</td>
            <td style="padding-left: 5px;">
                <span><?=$product->ens?></span>
                <!-- code ens -->
                <input type="text" value="<?=$product->ens?>" id="product_ens" style="display: none;" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="product"/>
            </td>
            <td style="padding-left: 5px;">Код(чертеж)</td>
            <td style="padding-left: 5px;">
                <? if ($product->equipment == 'danieli'): ?>
                    <a href="/data?id=<?=$product->detail_id?>&equipment=<?=$product->equipment?>"><?=$product->code?></a>
                <? else: ?>
                    <span><?=$product->code?></span>
                <? endif; ?>
                <!-- code -->
                <input type="text" value="<?=$product->code?>" id="product_code" style="display: none;" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="product"/>
            </td>
            <td style="padding-left: 5px;">Оборудование</td>
            <td style="padding-left: 5px;">
                <span><?=$product->equipment?></span>
                <!-- equipment -->
                <input type="text" value="<?=$product->equipment?>" id="app_equipment" style="display: none;" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="product"/>
            </td>
            <td style="padding-left: 5px;">Входит в состав</td>
            <td style="padding-left: 5px;">
                <span>Какой то узел</span>
                <!-- unit 
                <input type="text" value="<?=$product->equipment?>" id="app_equipment" style="display: none;" />-->
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="product"/>
            </td>
            <td style="padding-left: 5px;">Кто приобретает</td>
            <td style="padding-left: 5px;">
                <span><?=$product->departent?></span>
                <!-- departent -->
                <input type="text" value="<?=$product->departent?>" id="product_departent" style="display: none;" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="product"/>
            </td>
            <td style="padding-left: 5px;">Исполнитель</td>
            <td style="padding-left: 5px;">
                <span><?=$product->executor?></span>
                <!-- executor -->
                <input type="text" value="<?=$product->executor?>" id="product_executor" style="display: none;" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="product"/>
            </td>
            <td style="padding-left: 5px;">Заказал</td>
            <td style="padding-left: 5px;">
                <span><?=$product->customer?></span>
                <!-- customer -->
                <input type="text" value="<?=$product->customer?>" id="product_customer" style="display: none;" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="product"/>
            </td>
            <td style="padding-left: 5px;">Добавил в базу</td>
            <td style="padding-left: 5px;">
                <span><?=$product->created?></span>
                <!-- created -->
                <input type="text" value="" id="product_created" style="display: none;" />
            </td>
        </tr>

        <tr>
            <td>
                <input type="radio" name="product"/>
            </td>
            <td style="padding-left: 5px;">Цена</td>
            <td style="padding-left: 5px;">
                <span><?=$product->price?></span>
                <!-- price -->
                <input type="text" value="<?=$product->price?>" id="app_department" style="display: none;" />
            </td>
        </tr>
         <tr>
            <td>
                <input type="radio" name="product"/>
            </td>
            <td style="padding-left: 5px;">Единицы измерения</td>
            <td style="padding-left: 5px;">
                <span><?=$product->units?></span>
                <!-- units -->
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="product"/>
            </td>
            <td style="padding-left: 5px;">Дополнительные документы</td>
            <td style="padding-left: 5px;">
                <span><?=$product->document?></span>
                <!-- document -->
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="item"/>
            </td>
            <td style="padding-left: 5px;">Дата создания</td>
            <td style="padding-left: 5px;">
                <span><?=$product->date?></span>
                <!-- created date -->
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="product"/>
            </td>
            <td style="padding-left: 5px;">Примечание</td>
            <td style="padding-left: 5px;">
                <span><?=$product->note?></span>
                <!-- note -->
            </td>
        </tr>
    </table>
    <!-- end app info box>
</div>