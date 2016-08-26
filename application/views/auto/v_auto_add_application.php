<div class="content">
    <div class="auto_add_table_box" id="application_form_box">
        <? if($files): ?>
            <p style="margin-left: 30px;">Список добавленных файлов</p>
            <ul style="margin-left: 50px;">
                <? foreach($files as $file): ?>
                    <li><?=$file?></li>
                <? endforeach; ?>
            </ul>
            <a href="/auto/data/deletelistfiles" style="margin-left: 50px;">удалить список файлов</a>
        <? endif; ?>
        <br /><br /><hr color="#B49A6A" size="1"/>
        <form action="/auto/application/add" method="post" enctype="multipart/form-data" id="form_add_app">
            <p>выберите файл exel с данными заявки</p>
            <input type="file" name="table"/>
        
            <p>
                <label>Оборудование:</label>
                <select name="equipment">
                    <option value="">Не выбрано</option> 
                    <option  value="danieli">Danieli</option>  
                    <option value="sundbirsta">Sundbirsta</option>  
                </select>
            </p>
            
    
            
            <p>
                <label>Вид ремонта:</label>
                <select name="type_repair">
                    <option value="">Не выбран</option> 
                    <option>Текущий</option>  
                    <option>Капитальный</option>  
                </select>
            </p>
            <p>
                <label>Период выполнения:</label>
                <select name="period">
                    <option value="">Не выбран</option> 
                    <option selected="selected">Год</option>  
                    <option>Месяц</option>  
                </select>
            </p>
            <p>
                <label>Служба цеха:</label>
                <select name="service">
                    <option value="">Не выбрана</option>
                    <option selected="selected">Механики</option>  
                    <option>Технологи</option>
                    <option>Электирики</option> 
                    <option>Энергетики</option> 
                </select>
            </p>
            
             <p>
                <label>Кто заказал:</label>
                <select name="customer">
                    <option value="">Не выбран</option>
                    <option value="Лисецкий">Лисецкий</option>
                    <option  value="Костырко">Костырко</option>  
                    <option value="Саенко">Саенко</option>
                    <option value="Саенко">Саенко</option> 
                    <option value="Станиславский">Станиславский</option> 
                    <option value="Коваль">Коваль</option> 
                    <option value="Пасюк">Пасюк</option>
                </select>
            </p>
            
            <p>
                <label>Кто выдал заявку:</label>
                <select name="created">
                    <option value="">Не выбран</option>
                    <option value="Меркулова">Меркулова</option>
                    <option  value="Битюква">Битюква</option>  
                    <option value="Приймак">Приймак</option>
                </select>
            </p>
            
            <p>
                <label>Кто приобретает:</label>
                <select name="department">
                    <option value="">Не выбрано</option>
                    <option value="ОМТС">ОМТС</option>
                    <option  value="OO">Отдел оборудования</option>
                    <option  value="OСиТ">Отдел сырья и топлива</option>  
                    <option  value="not">Не определен</option>  
                </select>
            </p>
            
            <p>
                 <label>Исполнитель:</label>
                 <select name="executor">
                    <option value="">Не выбран</option>
                    <option  value="Лесная">Лесная</option>  
                    <option value="Одут">Одут</option>  
                </select>
             </p>
            
             <p>
                 <label>Год приобретения:</label>
                 <select name="year">
                    <option value="">Не выбран</option>
                    <option>2015</option>  
                    <option selected="selected">2016</option> 
                    <option>2017</option> 
                </select>
             </p>
            <p>
                <label>Номер в ЕНС:</label>
                <input type="text" name="number_ens"/>   
            </p>

             <p>
                <label>Исходящий №:</label>
                <input type="text" name="outbound"/>   
            </p>
            <p>
                <label>Название заявки:</label>
                <textarea name="title" style="width: 450px;"></textarea>
            </p>
          <!--
  <input type="submit" value="добавить данные" id="add_application"/>-->
            <input type="submit" name="check" value="показать данные"/>

        </form>
    </div>
</div>