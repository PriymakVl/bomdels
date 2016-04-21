<!Doctype html>
<html>
    <head>
        <meta charset="utf8" />
        <? foreach ($styles as $style): ?>
            <?=HTML::css($style)?>
        <? endforeach; ?>
        
        <? foreach ($scripts as $script): ?>
            <?=HTML::js($script)?>
        <? endforeach; ?>
        <title><?=$title?></title>
    </head>
    <body>
        <div class="conteiner">
            
            <? if(isset($block_topnav)): ?>
                    <?=$block_topnav?>
            <? endif; ?>
            
            <div class="content-wp">
                <? if(isset($block_right)): ?>
                        <?=$block_right?>
                <? endif; ?>
            
                <? if(isset($block_center)): ?>
                        <?=$block_center?>
                <? endif; ?>
            </div>
            
            <? if(isset($block_footer)): ?>
                    <?=$block_footer?>
            <? endif; ?>            
        </div>
    </body>
</html>