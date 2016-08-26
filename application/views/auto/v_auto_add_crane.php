<div class="content">
    <div class="info-menu-box">
          Добавление детали в базу Краны
         <a id="history-back-link" href="javascript:history.back();">назад</a>
    </div>
    <div class="form-admin-add-wrp">
        <form action="/data/adddetail" method="post" enctype="multipart/form-data" >
            <label>Код детали:<input type="text" name="code" /></label>
            <br />
           <!--
 <label>Код родителя:<input type="text" name="parent" /></label>
            <br />
-->
            <label>Наименование:<input type="text" name="rus" /></label>
            <br />
            <label>Оборудование: <input type="text" name="equipment" value="crane" readonly="readonly" /></label>
            <br />
            <!--
<label>Кто начертил чертеж:</label>
            <select name="type" style="width: 150px; height: 26px;">
                <option value="">Не выбран</option>
                <option value="vender">Производитель</option>
                <option value="works">ПКО</option>
                <option value="draft">Цех - эскиз</option>
                <option value="standard">Стандарт</option>
                <option value="other">Другое</option>
            </select>
            <br />
            <label>Чертеж: <input type="file" name="draw"/></label>
            <br />
-->
            <input type="submit" value="добавить" />
        </form>
    </div>
</div>