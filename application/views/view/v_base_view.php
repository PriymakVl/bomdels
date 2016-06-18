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
            
            <? if(isset($block_header)): ?>
                    <?=$block_header?>
            <? endif; ?>
            
            <div class="content-wp">
                <? if(isset($block_full_drawing)): ?>
                        <?=$block_full_drawing?>
                <? endif; ?>
            
                <? if(isset($block_specification)): ?>
                        <?=$block_specification?>
                <? endif; ?>
                
                <? if(isset($block_list)): ?>
                        <?=$block_list?>
                <? endif; ?>
            </div>
            
            <? if(isset($block_footer)): ?>
                    <?=$block_footer?>
            <? endif; ?>            
        </div>
    </body>
</html>