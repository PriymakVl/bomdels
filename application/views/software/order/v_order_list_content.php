<div class="content">
    <div class="info-menu-box">
        Перечень заказов - <span>механики</span>
    </div>
    
    <!-- start box list order -->
    <table id="list_order_box">
        <tr>
            <td width="30"><input type="radio" disabled="disabled" /></td>
            <th width="50">Номер</th>
            <th width="70">Дата</th>
            <th >Наименование</th>
            <th width="100">Служба</th>
        </tr>
        <? if (isset($orders)): ?>
            <? foreach ($orders as $order): ?>
                <tr>
                    <td>
                        <input type="radio" name="element"  />
                    </td>
                    <td style="text-align: center;">
                        <a href="/software/order?number=<?=$order->number?>"><?=$order->number?></a>
                    </td>
                    <td style="text-align: center;">
                        <?=$order->date?>
                    </td>
                    <td style="padding-left: 5px;"> 
                        <?=$order->title?>                     
                    </td>
                    <td style="text-align: center;">
                        <?=$order->service?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? endif; ?>
    </table>
   <!-- end box list order --> 
</div>















