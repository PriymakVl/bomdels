<div class="content">
    <div id="change_equipment_box" style="display: none;">
        Выберите оборудование
    </div>
    <div class="auto_add_table_box" id="danieli_form_box">
        <? if($files): ?>
            <p style="margin-left: 30px;">Список добавленных файлов</p>
            <ul style="margin-left: 50px;">
                <? foreach($files as $file): ?>
                    <li><?=$file?></li>
                <? endforeach; ?>
            </ul>
            <a href="/auto/data/deletelistfiles" style="margin-left: 50px;">удалить список файлов</a>
        <? endif; ?>
        <form action="/auto/danieli/add" method="post" enctype="multipart/form-data">
            <p>выберите файл exel с данными Danieli</p>
            <input type="file" name="table"/>
            <br />
            <input type="submit" value="добавить данные"/>
            <input type="submit" name="check" value="показать данные"/>
        </form>
    </div>
    <div class="auto_add_table_box add_detail">
        <form action="/data/adddetail" method="post">
            <p>Добавление детали в базу Danieli</p>
            <label>Код детали:<input type="text" name="code" /></label>
            <br />
            <label>Код родителя:<input type="text" name="parent" /></label>
            <br />
            <label>Наименование:<input type="text" name="rus" /></label>
            <input type="hidden" name="equipment" value="danieli" />
            <input type="submit" value="добавить" />
        </form>
    </div>
</div>