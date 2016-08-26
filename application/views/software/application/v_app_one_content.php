<div class="content">
    <!-- start info box -->
    <div class="info-menu-box">
        Перечень позиций заявки
        <a id="history-back-link" href="javascript:history.back();">назад</a>
    </div>
    <!-- end info box -->
    
    <!-- start list item box -->
    <table id="app_list_item_box">
        <tr>
            <th width="30"><input type="radio" disabled="disabled" /></th>
            <th width="40">№ поз.</th>
            <!--
<th width="120">Код</th>
-->
            <th >Наименование</th>
            <th width="80">Кол-во</th>
        </tr>
        <? if ($products): ?>
            <? foreach ($products as $item): ?>
                <tr>
                    <td class="cat-data">    
                        <input type="radio"  name="app" app_id="<?=$item->id?>"/>
                    </td>
                    <td style="text-align: center;"><? echo $number_position++; ?></td>
                  <!--
  <td style="text-align: center;">
                        <a href="/data?id=<?//=$item->detail_id?>&equipment=<?//=$item->equipment?>"><?//=$item->code?></a>
                    </td>
-->
                    <td style="padding-left: 5px;">
                        <a href="/software/product?app_id=<?=$app->id?>&product_id=<?=$item->id?>"><?=$item->name?></a>
                    </td>
                    <td style="text-align: center;">
                        <?=$item->count?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
        <tr>
            <td colspan="6" style="text-align: center; height: 25px; color: red; font-size: 1.2em;">В заявке ничего не заказано</td>
        </tr>
        <? endif; ?>
    </table>
    <!-- end list item box -->
    
    <!-- start app info box -->
    <form action="/software/applicationcontent/updateapp" method="post" id="form_update_app">
        <table id="app_info_box" style="display: none;">
            <tr>
                <td width="30">
                    <input type="radio" name="item" />
                    <input type="hidden" name="app_id" value="<?=$app->id?>" />
                </td>
                <th width="150">Наименование</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="item"/>
                </td>
                <td style="padding-left: 5px;">Служба цеха</td>
                <td style="padding-left: 5px;">
                    <span><?=$app->service?></span>
                    <!-- service -->
                    <select name="service" style="display: none;" >
                        <option value="<?=$app->service?>">Не выбрана</option>
                        <option>Механики</option>  
                        <option>Технологи</option>
                        <option>Электирики</option> 
                        <option >Энергетики</option> 
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="item"/>
                </td>
                <td style="padding-left: 5px;">Год приобретения</td>
                <td style="padding-left: 5px;">
                    <span><?=$app->year?></span>
                    <!-- year -->
                    <select name="year" style="display: none;">
                        <option value="<?=$app->year?>">Не выбран</option>
                        <option>2015</option>  
                        <option>2016</option> 
                        <option>2017</option> 
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="item"/>
                </td>
                <td style="padding-left: 5px;">Название</td>
                <td style="padding-left: 5px;">
                    <span><?=$app->title?></span>
                    <!-- title -->
                    <textarea name="title" style="display: none;" ><?=$app->title?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="item"/>
                </td>
                <td style="padding-left: 5px;">Вид ремонта</td>
                <td style="padding-left: 5px;">
                    <span><?=$app->type_repair?></span>
                    <!-- type_repair -->
                    <select name="type_repair" style="display: none;">
                        <option value="<?=$app->type_repair?>">Не выбран</option> 
                        <option>Текущий</option>  
                        <option>Капитальный</option>  
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="item"/>
                </td>
                <td style="padding-left: 5px;">№ ЕНС</td>
                <td style="padding-left: 5px;">
                    <span><?=$app->number_ens?></span>
                    <!-- ens -->
                    <input type="text" value="<?=$app->number_ens?>" name="number_ens" style="display: none;" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="item"/>
                </td>
                <td style="padding-left: 5px;">Исх №</td>
                <td style="padding-left: 5px;">
                    <span><?=$app->outbound?></span>
                    <!-- outbound -->
                    <input type="text" value="<?=$app->outbound?>" name="outbound" style="display: none;" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="item"/>
                </td>
                <td style="padding-left: 5px;">Статус</td>
                <td style="padding-left: 5px;">
                    <span><?=$app->status?></span>
                    <!-- status -->
                    <input type="text" value="<?=$app->status?>" name="status" style="display: none;" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="item"/>
                </td>
                <td style="padding-left: 5px;">Оборудование</td>
                <td style="padding-left: 5px;">
                    <span><?=$app->equipment?></span>
                    <!-- equipment -->
                    <select name="equipment" style="display: none;">
                        <option value="<?=$app->equipment?>">Не выбрано</option> 
                        <option  value="danieli">Danieli</option>  
                        <option value="sundbirsta">Sundbirsta</option>  
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="item"/>
                </td>
                <td style="padding-left: 5px;">Кто приобретает</td>
                <td style="padding-left: 5px;">
                    <span><?=$app->department?></span>
                    <!-- department -->
                    <select name="department" style="display: none;">
                        <option value="<?=$app->department?>">Не выбрано</option>
                        <option value="ОМТС">ОМТС</option>
                        <option  value="OO">Отдел оборудования</option>
                        <option  value="OСиТ">Отдел сырья и топлива</option>  
                        <option  value="not">Не определен</option>  
                    </select>
                </td>
            </tr>
             <tr>
                <td>
                    <input type="radio" name="item"/>
                </td>
                <td style="padding-left: 5px;">Исполнитель</td>
                <td style="padding-left: 5px;">
                    <span><?=$app->executor?></span>
                    <!-- executor -->
                   <select name="executor" style="display: none;">
                        <option value="<?=$app->executor?>">Не выбран</option>
                        <option  value="Лесная">Лесная</option>  
                        <option value="Одут">Одут</option>  
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="item"/>
                </td>
                <td style="padding-left: 5px;">Заказал</td>
                <td style="padding-left: 5px;">
                    <span><?=$app->customer?></span>
                    <!-- customer -->
                    <select name="customer" style="display: none;">
                        <option value="<?=$app->customer?>">Не выбран</option>
                        <option value="Лисецкий">Лисецкий</option>
                        <option  value="Костырко">Костырко</option>  
                        <option value="Саенко">Саенко</option>
                        <option value="Саенко">Саенко</option> 
                        <option value="Станиславский">Станиславский</option> 
                        <option value="Коваль">Коваль</option> 
                        <option value="Пасюк">Пасюк</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="item"/>
                </td>
                <td style="padding-left: 5px;">Составил</td>
                <td style="padding-left: 5px;">
                    <span><?=$app->created?></span>
                    <!-- created -->
                     <select name="created" style="display: none;">
                        <option value="<?=$app->created?>">Не выбран</option>
                        <option value="Меркулова">Меркулова</option>
                        <option  value="Битюква">Битюква</option>  
                        <option value="Приймак">Приймак</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="item"/>
                </td>
                <td style="padding-left: 5px;">Дата создания</td>
                <td style="padding-left: 5px;">
                    <span><?=$app->date_transform?></span>
                    <!-- created date -->
                    <input type="text" value="<? echo date('d.m.y', $app->date); ?>" name="date" style="display: none;"/>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="item"/>
                </td>
                <td style="padding-left: 5px;">Период выполнения</td>
                <td style="padding-left: 5px;">
                    <span><?=$app->period?></span>
                    <select name="period" style="display: none;" >
                        <option value="<?=$app->period?>">Не выбран</option> 
                        <option>Год</option>  
                        <option>Месяц</option>  
                    </select>
                    <!-- period -->
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="item"/>
                </td>
                <td style="padding-left: 5px;">Количество позиций</td>
                <td style="padding-left: 5px;">
                    <span><?=$app->count_item?></span>
                    <!-- count_item -->
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="item"/>
                </td>
                <td style="padding-left: 5px;">Примечание</td>
                <td style="padding-left: 5px;">
                    <span><?=$app->note?></span>
                    <!-- note -->
                </td>
            </tr>
        </table>
    </form>
    <!-- end app info box>
</div>