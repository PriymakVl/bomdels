<? if (isset($draw)): ?>
<div class="form-wrp">
    <h2>Форма редактирования чертежа</h2>
    <form id="form-drawing" method="post" action="/admin/adddrawing">
        <div class="input-wrp">
            <label for="image">Изображение:</label>
            <input type="text" name="image" value="<?=$draw['image']?>" />
        </div>
        <div class="input-wrp">
        	<label for="code">Код:</label>
            <input type="text" name="code" value="<?=$draw['code']?>" />
         </div>
         <div class="input-wrp">
        	<label for="code_parent">Код родителя:</label>
            <input type="text" name="code_parent" value="<?=$draw['code_parent']?>" />
         </div>
         <div class="input-wrp">
        	<label for="item">Позиция:</label>
            <input type="text" name="item" value="<?=$draw['item']?>" />
         </div>
         <div class="input-wrp">
        	<label for="sheets">Количество листов:</label>
            <input type="text" name="sheets" value="<?=$draw['sheets']?>" />
         </div>
         <div class="input-wrp">
            <label for="rus">Русское название:</label>
            <input type="text" name="rus" value="<?=$draw['rus']?>" />
         </div>
         <div class="input-wrp">
            <label for="eng">Анг название:</label>
            <input type="text" name="eng" value="<?=$draw['eng']?>" />
         </div>
         <div class="input-wrp">
            <label>Категория:</label>
            <select name="category">
                <option value="1" <? if($draw['cat_id'] == 1) echo "selected" ?>>Механика</option>
                <option value="2" <? if($draw['cat_id'] == 2) echo "selected" ?>>Гидравлика</option>
                <option value="3" <? if($draw['cat_id'] == 3) echo "selected" ?>>Смазка</option>
                <option value="4" <? if($draw['cat_id'] == 4) echo "selected" ?>>Узлы</option>
            </select>
         </div>
         <div class="input-wrp">
            <label>Тип:</label>
            <select name="type">
                <option value="1" <? if($draw['type'] == 1) echo "selected" ?>>Нестандартные детали</option>
                <option value="2" <? if($draw['type'] == 2) echo "selected" ?>>Стандартные детали</option>
            </select>
         </div>
    	<input type="submit" value="Редактировать" />
    </form>
</div>
<? else: ?>
<div class="form-wrp">
    <h2>Найти чертеж</h2>
    <form id="form-drawing" method="post" action="">
        <div class="input-wrp">
            <label for="image">Code:</label>
            <input type="text" name="code" />
        </div>
        <input type="submit" value="Найти" />
    </form>   
</div>
<? endif; ?>











