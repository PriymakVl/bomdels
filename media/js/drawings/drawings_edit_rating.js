$(document).ready(function() {
   //start edit    
   $('#edit_rating').click(function() {
        draw_id = $('#drawings_main_box :radio:checked').attr('draw_id');
        
        if(draw_id) {
            $('#drawings_main_box :radio:checked').parent().parent().find('.draw_rating span').hide();
            $('#drawings_main_box :radio:checked').parent().parent().find('.draw_rating :text').show();
            $('#save_rating').show();
            $('#cancel_edit_rating').show();
            $(this).hide();    
        }
        else alert('Не выбран чертеж');
        
   }); 
   //cansel edit
   $('#cancel_edit_rating').click(function() {
        $('#drawings_main_box :radio:checked').parent().parent().find('.draw_rating span').show();
        $('#drawings_main_box :radio:checked').parent().parent().find('.draw_rating :text').hide();
        $('#save_rating').hide();
        $(this).hide();
        $('#edit_rating').show();
   });
   
   $('#save_rating').click(function() {
        var rating = $('#drawings_main_box :radio:checked').parent().parent().find('.draw_rating :text').val(); 
        $.post('/drawings/updaterating', {draw_id: draw_id, rating: rating}, resultEditRating);   
   });
});


function resultEditRating(data) {
    if(data == 1) {
        alert('Рейтинг отредактирован');
        location.reload();
    }
    else alert('Ошибка при редактировании рейтинга');
}







