$(document).ready(function() {
    
   	$('#edit_content_cat').click(function() { 
        cat_id = $('input[name="cat_id"]').val()                      
        code = $('input[name="code"]').val();
        code_new = $('input[name="code_new"]').val();
        rating = $('input[name="rating"]').val();

        if(code && cat_id) $.post('/admin/categorycontent/edit', {cat_id: cat_id, code: code, code_new: code_new, rating: rating}, editNodeCategory);
        else alert('Введите название категории');    
    });
});

function editNodeCategory(data) {
    if(data == '1') {
        alert('Узел успешно отредактирован');
        location.reload();
    }
    else alert('Ошибка при редактировании узла');
}