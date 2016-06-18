<div class="form-wrp">
    <h2>Форма добавления чертежа</h2>
    <? if(isset($message)): ?>
        <div class="admin-message-box">
            <?=$message?>
        </div>
    <? endif; ?>
    <form id="form-drawing" method="post" action="/admin/adddrawing">
        <div class="input-wrp">
            <label for="drawing">Изображение:</label>
            <input type="text" name="drawing" value="<? if(isset($draw['drawing'])) echo $draw['drawing']?>" />
        </div>
        <div class="input-wrp">
        	<label for="code">Код:</label>
            <input type="text" name="code" value="<? if(isset($draw['code'])) echo $draw['code']?>" />
         </div>
         <div class="input-wrp">
            <label for="rus">Русское название:</label>
            <input type="text" name="rus" value="<? if(isset($draw['rus'])) echo $draw['rus']?>" />
         </div>
         <div class="input-wrp">
            <label for="eng">Анг название:</label>
            <input type="text" name="eng" value="<? if(isset($draw['eng'])) echo $draw['eng']?>" />
         </div>
         <div class="input-wrp">
        	<label for="code_parent">Код родителя:</label>
            <input type="text" name="code_parent" value="<? if(isset($draw['code_parent'])) echo $draw['code_parent']?>"/>
         </div>
         <div class="input-wrp">
        	<label for="item">Позиция:</label>
            <input type="text" name="item" value="<? if(isset($draw['item'])) echo $draw['item']?>" />
         </div>
         <div class="input-wrp">
        	<label for="sheets">Количество листов:</label>
            <input type="text" name="sheets" value="<? if(isset($draw['sheets'])) echo $draw['sheets']?>" />
         </div>
         <div class="input-wrp">
            <label>Категория:</label>
            <select name="category">
                <option value="1">Механика</option>
                <option value="2">Гидравлика</option>
                <option value="3">Смазка</option>
                <option value="4">Узлы</option>
            </select>
         </div>
         <div class="input-wrp">
            <label>Тип:</label>
            <select name="type">
                <option value="1">Деталь</option>
                <option value="2">Стандартные изделия</option>
                <option value="3">Сборочный чертеж</option>
            </select>
         </div>
    	<input type="submit" value="Добавить" />
    </form>
</div>