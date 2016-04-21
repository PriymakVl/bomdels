<div class="content">
    <? if(isset($draw)): ?>
    <h2><?=$info?></h2>
    <table class="draw-info">
        <tr>
            <th >Наименование</th>
            <th >Значение</th>
        </tr>
        <tr>
            <td>Код</td>
            <td><?=$draw['code']?></td>
        </tr>
        <tr>
            <td>Название</td>
            <td><?=$draw['rus']?></td>
        </tr>
        <tr>
            <td>Title</td>
            <td><?=$draw['eng']?></td>
        </tr>
        <tr>
            <td>Родитель</td>
            <td><?=$draw['parent_code']?></td>
        </tr>
        <tr>
            <td>Вес</td>
            <td><?=$draw['weight']?></td>
        </tr>
        <tr>
            <td>Тип</td>
            <td>???</td>
        </tr>
        <tr>
            <td>Заказ</td>
            <td>27.345.1</td>
        </tr>
        <tr>
            <td>Заявка</td>
            <td>834 от 2.05.15</td>
        </tr>
        <tr>
            <td>Дата последней замены</td>
            <td>5.</td>
        </tr>
        <tr>
            <td>Запас</td>
            <td>5</td>
        </tr>
        <tr>
            <td>Пометки</td>
            </td><?=$draw['note']?></td>
        </tr>
    </table>
    <? else: ?>
    <p>Ничего не найдено</p>
    <? endif; ?>
</div>