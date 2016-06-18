$(document).ready(function() {
    
   	$('#edit_cat').click(function() { 
        cat_id = $(':radio:checked').attr('cat_id');                      
        title = $('input[name="title"]').val();
        alias = $('input[name="alias"]').val();
        rating = $('input[name="rating"]').val();

        if(title && cat_id) $.post('/admin/category/edit', {id: cat_id, title: title,  rating: rating, alias: alias}, editCategory);
        else alert('Введите название категории');    
    });
});

function editCategory(data) {
    if(data = '1') {
        alert('Категория успешно отредактирована');
        location.reload();
    }
    else alert('Ошибка при редактировании категории');
}