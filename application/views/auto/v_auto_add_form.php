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
            <a href="/auto/data/deletelistfiles" style="margin-left: 50px;">удлить список файлов</a>
        <? endif; ?>
        <form action="/auto/danieli/add" method="post" enctype="multipart/form-data">
            <p>выберите файл с данными Danieli</p>
            <input type="file" name="table"/>
            <br />
            <input type="submit" value="добавить данные"/>
            <input type="submit" name="check" value="показать данные"/>
        </form>
    </div>
</div>