<div class="content">
    <div class="info-menu-box">
        Популярное - список: <span><?=$list['name']?></span>
        <? if($employee_lists): ?>
            <ul class="elect-lists employee-elect-lists">
                <li>Мои списки
                    <ul id="elect_lists_employee">
                        <? foreach($employee_lists as $list): ?>
                            <li>
                                <a href="/elect/changeemployeelist?list_id=<?=$list['id']?>"><?=$list['name']?></a>
                            </li>
                        <? endforeach; ?>
                    </ul>
                </li>
            </ul>
        <? endif; ?>
        <ul class="elect-lists default-elect-lists">
            <li>Списки
                <ul id="elect_lists_default">
                    <? foreach($default_lists as $list): ?>
                        <li>
                            <a href="/elect/changedefaultlist?list_id=<?=$list['id']?>"><?=$list['name']?></a>
                        </li>
                    <? endforeach; ?>
                </ul>
            </li>
        </ul>
    </div>
    
     <!-- start element form box -->
    <div id="element_form_box" style="display: none;">
        <form id="form_element" method="post" action="/elect/update">
            <label>Название</label>
            <input type="text" name="elementname" disabled="disabled" /> <br />
            <label>Рейтинг</label>
            <input type="text" name="rating" />
            <div class="textarea-wrp">
                <label>Описание</label>
                <textarea name="description"></textarea>
            </div>
            <input type="hidden" name="employee_id" value="<?=$employee->id?>" />
            <input type="hidden" name="elem_id" /> 
            <input type="submit" value="Сохранить" id="save_elem" /> 
        </form>
    </div>
    <!-- end element form box -->
    
    <!-- start box elect -->
    <table id="elect_box">
        <tr>
            <td width="30"><input type="radio" disabled="disabled" /></td>
            <th width="70">Тип</th>
            <th >Наименование</th>
            <th width="150">Описание</th>
            <th width="100">Код</th>
        </tr>
        <? if (isset($elements)): ?>
            <? foreach ($elements as $element): ?>
                <tr>
                    <td>
                        <input type="radio" name="element" name_det="<?=$element->rus?>" name_cat="<?=$element->title?>" elect_id="<?=$element->elect_id?>" type_list="<?=$type_list?>" role="<?=$role?>" description="<?=$element->description_elect?>" rating="<?=$element->rating_elect?>" />
                    </td>
                    <td style="text-align: center;">
                        <span style="text-transform: capitalize;"><?=$element->kind?></span>
                    </td>
                    <td style="padding-left: 5px;">
                        <? if ($element->kind == 'category'): ?>
                            <a href="/category?cat_id=<?=$element->id?>"><?=$element->title?></a>
                        <? elseif(!$element->sub_id): ?>
                            <a href="/data?id=<?=$element->id?>&equipment=<?=$element->equipment?>" title="<?=$element->eng?>"><?=$element->rus?></a>
                        <? else: ?>
                            <a href="/specification?id=<?=$element->id?>&equipment=<?=$element->equipment?>" title="<?=$element->eng?>"><?=$element->rus?></a>
                        <? endif; ?>
                    </td>
                    <td>                       
                        <a href="#" onclick="return false;" id="elect_description"><?=$element->description?></a>
                    </td>
                    <td style="text-align: center !important;">
                        <? if($element->kind == 'category'): ?>
                        <span>нет</span>
                        <? elseif(!$element->drawings): ?>
                            <?=$element->code?>
                        <? else: ?>
                            <a href="/drawings?id=<?=$element->id?>&equipment=<?=$element->equipment?>" title="Переход на страницу с чертежами"><?=$element->code?></a>
                        <? endif; ?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? endif; ?>
    </table>
    <!-- end box elect -->
    
    <!-- start list form box -->
    <div id="list_form_box" style="display: none;">
        <form id="form_list" method="post">
            <label>Название списка</label>
            <input type="text" name="listname" /> <br />
            <label>Рейтинг списка</label>
            <input type="text" name="rating" />
            <div class="textarea-wrp">
                <label>Описание списка</label>
                <textarea name="description"></textarea>
            </div>
            <input type="hidden" name="employee_id" value="<?=$employee->id?>" />
            <input type="hidden" name="list_id" />
            <input type="submit" value="Добавить список" id="add_list" style="display: none;" /> 
            <input type="submit" value="Удалить список" id="delete_list" style="display: none;" /> 
            <input type="submit" value="Сохранить список" id="save_list" style="display: none;" /> 
        </form>
    </div>
    <!-- end list form box -->
    
    <!-- start list box -->
    <table id="edit_list_box" style="width: 100%; display: none;">
        <caption>Редактирование списков</caption>
        <tr>
            <th width="30">
                <input type="radio" disabled="disabled" />
            </th>
            <th width="290">Наименование</th>
            <th width="290">Описание</th>
            <th width="90">Рейтинг</th>
        </tr>
        <? if ($lists_edit): ?>
            <? foreach ($lists_edit as $list): ?>
                <tr>
                    <td>
                        <input type="radio" name="element" list_id="<?=$list['id']?>" rating="<?=$list['rating']?>" listname="<?=$list['name']?>" description="<?=$list['description']?>" />
                    </td>
                    <td style="padding-left: 5px;">
                       <?=$list['name']?>
                    </td>
                    <td style="padding-left: 5px;">
                       <?=$list['description']?>
                    </td>
                    <td style="text-align: center;">
                       <?=$list['rating']?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? endif; ?>
    </table>
    <!-- end list box -->
    
    <!-- start registr box -->
        <div id="registr_box" style="display: none;">
            <h2>Регистрация</h2>
            <form method="post" action="employee/registr" id="form_registr">
                <label>Логин: <input type="text" name="login" /></label><br />
                <label>Пароль: <input type="text" name="password" /></label><br />
                <input type="button" value="Зарегистрироваться" id="registr_employee"/>
                <input type="button" value="Отменить" id="registr_cancel"/>
            </form>
        </div>
    <!-- end regist box -->
    
</div>















