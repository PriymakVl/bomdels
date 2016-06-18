$(document).ready(function() {
        
    $('#show_add_box').click(function() {
        $('#edit_content_cat').hide();
        $('#add_content_cat').show();
        $('#cat_content_content_box').hide();
        $('#cat_content_data_box').slideDown(500);
        $(this).hide();
    });
    
    $('#show_edit_box').click(function() {
        rating = $(':radio:checked').attr('rating');
        code = $(':radio:checked').attr('code');
        if (!code) {alert('Выберите узел'); return;}
        //show box data
        $('#add_content_cat').hide();
        $('#edit_content_cat').show();
        $('#cat_content_content_box').hide();
        $('#cat_content_data_box').slideDown(500);
        $(this).hide();
        
        $('input[name="code"]').val(code);
        $('input[name="code_new"]').val(code);
        $('input[name="rating"]').val(rating);
    });
    
    $('#cancel').click(function() {
        $('#cat_content_data_box').hide();
        $('#cat_content_content_box').slideDown(500);
        $('#show_edit_box, #show_add_box').show();
    });
})