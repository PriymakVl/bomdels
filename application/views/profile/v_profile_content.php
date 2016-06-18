<div class="content">
    <div class="info-menu-box">
        Личный кабинет
        <a id="history-back-link" href="javascript:history.back();">назад</a>
    </div>
    
    <!-- start form box -->
    <div id="employee_edit_box" style="display: none;">
        <form id="form_employee" method="post" action="profile/editdata">
            <label>Имя: <input type="text" value="<?=$employee->firstname?>" name="firstname" /></label>
            <br />
            <label>Отчество: <input type="text" value="<?=$employee->patronymic?>" name="patronymic" /></label>
            <br />
            <label>Email: <input type="email" value="<?=$employee->email?>" name="email" /></label>
            <input type="hidden" value="<?=$employee->id?>" name="employee_id" />
            <br />
            <input type="submit" value="Сохранить" id="save_profile"/>
            <input type="button" value="Отменить" id="profile_cancel"/>
        </form>
    </div>
    <!-- end form box -->
    
    <table id="employee_data_box">
        <tr>
            <th >Наименование</th>
            <th width="190">Значение</th>
        </tr>
        <tr>
            <td>Имя</td>
            <td><?=$employee->firstname?></td>
        </tr>
        <tr>
            <td>Отчество</td>
            <td><?=$employee->patronymic?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?=$employee->email?></td>
        </tr>
        <tr>
            <td>Обязанности</td>
            <td><?=$employee->role?></td>
        </tr>
    </table>
</div>