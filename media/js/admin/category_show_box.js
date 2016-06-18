$(document).ready(function() {
    
    //var cat_id, title, code, parent, rating;
        
    $('#show_add_box').click(function() {
        $('#edit_cat').hide();
        $('#category_content_box').hide();
        $('#category_data_box').slideDown(500);
        $(this).hide();
    });
    
    $('#show_edit_box').click(function() {
        var check = $(':radio:checked');
        cat_id = check.attr('cat_id');
        if(!cat_id) { alert('Не выбрана категория для редактрования'); return;} 
        title = check.attr('title');
        rating = check.attr('rating');
        alias = check.attr('alias');
        //show box data
        $('#add_cat').hide();
        $('#category_content_box').hide();
        $('#category_data_box').slideDown(500);
        $(this).hide();
        
        $('input[name="title"]').val(title);
        $('input[name="alias"]').val(alias);
        $('input[name="rating"]').val(rating);
    });
    
    $('#cancel').click(function() {
        $('#category_data_box').hide();
        $('#category_content_box').slideDown(500);
        $('#show_edit_box, #show_add_box').show();
    });
})