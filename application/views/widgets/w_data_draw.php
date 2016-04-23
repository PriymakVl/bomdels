<div class="content">
    <? if(isset($draw)): ?>
    <h2><span style="color: green;">Основная</span><a href="#">Дополнительная</a><a href="#">Обеспечение</a><a href="#">Чертеж</a></h2>
    <table class="draw-info">
        <tr>
            <thead>
                <td width="30"><input type="checkbox" /></td>
                <th >Наименование</th>
                <th width="300">Значение</th>
            </thead>
        </tr>
        <tr>
            <td><input type="checkbox" /></td>
            <td>Название</td>
            <td>
                <? if ($draw->sub_id): ?>
                    <a href="/list?id=<?=$draw->id?>"><?=$draw->rus?></a>
                <? else: ?>
                    <?=$draw->rus?>
                <? endif; ?>
            </td>
        </tr>
        <tr>
            <td><input type="checkbox" /></td>
            <td>Код</td>
            <td>
                <? if ($draw->image): ?>
                        <a href="/view?id=<?=$draw->id?>"><?=$draw->code?></a>
                    <? else: ?>
                        <?=$draw->code?>
                <? endif; ?>
            </td>
        </tr>
        <? if($draw->variant): ?>
            <tr>
                <td><input type="checkbox" /></td>
                <td>Вариант</td>
                <td><?=$draw->variant?></td>
            </tr>
        <? endif; ?>
        <tr>
            <td><input type="checkbox" /></td>
            <td>Сборочный узел</td>
            <td><a href="/specification?id=<?=$draw->parent['id']?>"><?=$draw->parent['rus']?></td>
        </tr>
        <tr>
            <td><input type="checkbox" /></td>
            <td>Количество деталей в узле</td>
            <td>1</td>
        </tr>
        <tr>
            <td><input type="checkbox" /></td>
            <td>Материал</td>
            <td><?=$draw->material?></td>
        </tr>
        <tr>
            <td><input type="checkbox" /></td>
            <td>Аналог</td>
            <td><a href="#"><?=$draw->analog?></a></td>
        </tr>
        <tr>
            <td><input type="checkbox" /></td>
            <td>Вес</td>
            <td><?=$draw->weight?></td>
        </tr>
        <tr>
            <td><input type="checkbox" /></td>
            <td>Тип</td>
            <td>Стандартное изделие</td>
        </tr>
        <tr>
    </table>
    <? endif; ?>
</div>