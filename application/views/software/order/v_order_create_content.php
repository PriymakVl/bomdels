<div class="content-create-order-wrp">
    <div class="menu-create-order-wrp">
        <ul>
            <li class="menu-create-order-active" id="show_info_create_order_box">Информация</li>
            <li id="show_content_create_order_box">Содержимое</li>
            <li id="show_add_element_create_order_box">Добавить позицию</li>
            <li id="show_nature_work_create_order_box">Характер работы</li>
        </ul>
    </div>

        <form method="post" action="/software/ordercreate/add" id="form_add_order">
            <!-- start info box -->
            <div id="create_order_info_box" style="display: none;">
                <label id="field_date">Дата: <input type="text" name="date" value="<?=$date?>"/></label>
                <label id="field_number">Номер заказа: <input type="text" name="number" value="<?=$number_next?>"/></label>
                <label id="field_weight">Обший вес заказа: <input type="text" name="weight_order" /></label><span style="font-size: 1.7em; margin-left: -17px;">кг</span>
                 <br />
                 <label id="field_title">Название заказа: <input type="text" name="title" /></label>
                <div class="create-repair-type-wrp">
                    <label>Вид ремонта:</label>
                    <select name="type_repair" id="type_repair">
                        <option value="">Не выбран</option>
                        <option>текущий</option>
                        <option>капитальный</option>
                        <option>сменка</option>
                    </select>
                </div>
                 <div class="create-order-type-wrp">
                    <label>Тип заказа:</label>
                    <select name="type_order" id="type_order">
                        <option value="">Не выбран</option>
                        <option>изготовление</option>
                        <option>ремонт</option>
                        <option>изготовление и ремонт</option>
                    </select>
                </div>
                <div class="create-order-equipment-wrp">
                    <label>Тип оборудования:</label>
                    <select name="equipment" id="type_equipment">
                        <option value="">Не выбран</option>
                        <option>danieli</option>
                        <option>sundbirsta</option>
                        <option>краны</option>
                    </select>
                </div>
                <div class="create-order-service-wrp">
                    <label>Служба цеха:</label>
                    <select name="service" id="service_workshop">
                        <option>не выбрана</option>
                        <option>механики</option>
                        <option>электрики</option>
                        <option>энергетики</option>
                        <option>технологи</option>
                    </select>
                </div>
                
                <!-- start box service workshop -->
                <div class="create-order-responsible-wrp" id="service_mehanic_box">
                    <label>Ответственный руководитель:</label>
                    <input name="responsible" type="text"/>
                    <select  id="responsible_mehanic">
                        <option>Не выбран</option>
                        <option>Костырко</option>
                        <option>Саенко</option>
                        <option>Волковский</option>
                        <option>Пасюк</option>
                    </select>
                    <br />
                    <label>Лицо выдавшее заказ:</label>
                    <input name="eployee_created_order" type="text"/>
                    <select  id="employee_mehanic">
                        <option>Не выбран</option>
                        <option>Приймак</option>
                        <option>Меркулова</option>
                        <option>Битюкова</option>
                        <option>Немер</option>
                    </select>
                </div>
                <!-- end box service workshop -->
            </div>
            <!-- end info box -->
            
        <!-- start content box -->
        <div id="create_order_content_box" style="display: none;">
            <table >
                <tr>
                    <td width="30"><input type="radio" disabled="disabled" /></td>
                    <th width="100">Чертеж</th>
                    <th width="60">Лист</th>
                    <th width="40">Поз.</th>
                    <th width="385">Наименование</th>
                    <th width="60">Кол-во</th>
                    <th width="80">Вес 1шт.</th>
                    <th width="80">Вес всех</th>
                    <th width="90">Материал</th>
                </tr>
            </table>
        </div>
        <!-- end content box -->
        <input type="button" value="добавить заказ" id="save_new_order" />
    </form>

        <!-- start add element box -->
        <div id="create_order_add_element_box" style="display: none;">
             <div id="create_order_add_element_search_box">
                <label>Поиск детали(узла): <input type="text" name="code" placeholder="Введите код" /></label>
                <input type="button" value="Найти" id="search_detail_equipment_database"/>
                <label>Базы оборудоваиния: </label>
                <select id="database_equipment">
                    <option value="">Не выбрано</option>
                    <option value="danieli">danieli</option>
                    <option value="sundbirsta">sundbirsta</option>
                </select>
               <!-- <hr color="#B49A6A" size="1"/>
                <label>Поиск по базе заказов: <input type="text" name="code" placeholder="Введите код" /></label>
                <input type="button" value="Найти" id="search_detail_order_database"/>-->
            </div>
            <label>Код: <input type="text" name="code_elem" /></label>
            
            <label>Вариант: <input type="text" name="variant_elem" /></label>
            <label>Позиция: <input type="text" name="item_elem" /></label>
            <hr color="#B49A6A" size="1"/>

            <label>Файл чертежа: <input type="text" name="drawing_elem" /></label>
            <a id="link_image_add_elem" href="#">Посмотреть изображение</a>
            <hr color="#B49A6A" size="1"/>
            
            <label>Ширина: <input type="text" name="width_det"/></label>
            <label>Длина: <input type="text" name="length_det"/></label>
            <label>Толщина: <input type="text" name="thickness_det"/></label>
            <hr color="#B49A6A" size="1"/>
            
            <label>Наруж. диаметр: <input type="text" name="diametr_out_det"/></label>
            <label>Внутр. диаметр: <input type="text" name="diametr_inner_det"/></label>
            <label>Высота: <input type="text" name="height_det"/></label>
            <hr color="#B49A6A" size="1"/>

            <label>Название детали(узла): <input type="text" name="title_elem" /></label>
            <hr color="#B49A6A" size="1"/>
            
            <label>Количество штук: <input type="text" name="count_elem" /></label>
            <label>Вес 1шт.: <input type="text" name="weight_one_elem" /></label>
            <label>Вес всех: <input type="text" name="weight_all_elem" /></label>
            <input type="button" value="Посчитать вес" id="count_weight_elem" />
            <hr color="#B49A6A" size="1"/>
            
            <label>Материал: <input type="text" name="material_elem" /></label>
            <select id="add_elect_material">
                <option value="">Не выбран</option>
                <option>Сборочный</option>
                <option>CrNiMo4</option>
            </select>
            <label>Аналог: <input type="text" name="analog_elem" /></label>
            <select id="add_elect_analog">
                <option>Не выбран</option>
                <option>Ст 40Х</option>
                <option>Ст 45</option>
                <option>Ст 3</option>
            </select>
             <!--<a id="find_analog_material" href="#">Найти аналог материала</a>
           
<hr color="#B49A6A" size="1"/>
-->
            
        </div>
        <input type="button" value="Добавить в содержимое" id="add_element_to_content" style="display: none;" />
        <!-- end add element box -->
        
        <!-- start nature of work box -->
            <div id="create_order_nature_work_box">
                <ol>
                    <li>Введите текст в полеddddd ddddddddddd ddddddddddd dddddddddddd
                        <a href="#" onclick="return false" class="delete_item_nature_work">Удалить</a>
                        <a href="#" onclick="return false" class="edit_item_nature_work">Редактировать</a>
                    </li>
                    <li>Второй пункт
                        <a href="#" onclick="return false" class="delete_item_nature_work">Удалить</a>
                        <a href="#" onclick="return false" class="edit_item_nature_work">Редактировать</a>
                    </li>
                </ol>
                <textarea id="field_write_work"></textarea>
                <br />
                <input type="button" id="add_item_nature_work" value="добавить пункт"/>
            </div>
        <!-- end nature of work box -->
</div>




















