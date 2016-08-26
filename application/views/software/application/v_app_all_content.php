<div class="content">
    <!-- start info box -->
    <div class="info-menu-box">
        <span>Перечень заявок</span>
        <label>год:</label> 
        <select id="active_year">
            <option <? if($active_year == '2015') echo 'selected'; ?>>2015</option>
            <option <? if($active_year == '2016') echo 'selected'; ?>>2016</option>
            <option <? if($active_year == '2017') echo 'selected'; ?>>2017</option>
        </select>
        <label>служба:</label> 
        <select id="active_service">
            <option <? if($active_service == 'Механики') echo 'selected'; ?>>Механики</option>
            <option <? if($active_service == 'Технологи') echo 'selected'; ?>>Технологи</option>
            <option <? if($active_service == 'Электрики') echo 'selected'; ?>>Электрики</option>
        </select>
        <label>отдел:</label> 
        <select id="active_department">
            <option <? if($active_department == 'all') echo 'selected'; ?> value="all">Все</option>
            <option <? if($active_department == 'ОМТС') echo 'selected'; ?>>ОМТС</option>
            <option <? if($active_department == 'ОО') echo 'selected'; ?>>ОО</option>
            <option <? if($active_department == 'ОСиТ') echo 'selected'; ?>>ОСиТ</option>
            <option <? if($active_department == '') echo 'selected'; ?> value="">Не указан</option>
        </select>
    </div>
    <!-- end info box -->
    
    <!-- start content box -->
    <table>
        <tr>
            <th width="30"><input type="radio" disabled="disabled" /></th>
            <th width="60">№ ЕНС</th>
            <th width="60">Исх. №</th>
            <th >Наименование</th>
            <th width="80">Служба</th>
        </tr>
        <? if ($apps): ?>
            <? foreach ($apps as $app): ?>
                <tr>
                    <td class="cat-data">    
                        <input type="radio"  name="app" app_id="<?=$app['id']?>"/>
                    </td>
                    <td style="text-align: center;"><?=$app['number_ens']?></td>
                    <td style="text-align: center;"><?=$app['outbound']?></td>
                    <td style="padding-left: 5px;">
                        <a href="/software/applicationcontent?app_id=<?=$app['id']?>"><?=$app['title']?></a>
                    </td>
                    <td style="text-align: center;"><?=$app['department']?></td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
        <tr>
            <td colspan="6" style="text-align: center; height: 25px; color: red; font-size: 1.2em;">Таких заявок нет</td>
        </tr>
        <? endif; ?>
    </table>
    <!-- end content box -->
</div>