$(document).ready(function() {
	$('.search-code :radio').change(function(){
	   var search = $(this).attr('type_search');
       if(search == 'code') $('input[name="code"]').attr('placeholder', 'Введите код (можно часть)');
       else $('input[name="code"]').attr('placeholder', 'Введите наименование (можно часть)');
	});
    
    $('input[name="code"]').focus(function() {
       $(this).attr('placeholder', ''); 
    });
});