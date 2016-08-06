<div class="content">
    <div class="info-menu-box">
        Личный кабинет
        <a id="history-back-link" href="javascript:history.back();">назад</a>
    </div>
    
    <!-- start form box -->
    <div id="user_edit_box" style="display: none;">
        <form id="form_user" method="post" action="profile/editdata">
            <label>Имя: <input type="text" value="<?=$user->firstname?>" name="firstname" /></label>
            <br />
            <label>Отчество: <input type="text" value="<?=$user->patronymic?>" name="patronymic" /></label>
            <br />
            <label>Email: <input type="email" value="<?=$user->email?>" name="email" /></label>
            <br />
            <input type="submit" value="Сохранить" id="save_profile"/>
            <input type="button" value="Отменить" id="profile_cancel"/>
        </form>
    </div>
    <!-- end form box -->
    
    <table id="user_data_box">
        <tr>
            <th >Наименование</th>
            <th width="190">Значение</th>
        </tr>
        <tr>
            <td>Имя</td>
            <td><?=$user->firstname?></td>
        </tr>
        <tr>
            <td>Отчество</td>
            <td><?=$user->patronymic?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?=$user->email?></td>
        </tr>
    </table>
</div>