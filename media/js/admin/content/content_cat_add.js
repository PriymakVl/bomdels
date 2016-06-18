$(document).ready(function() {
    var cat_id, code, rating;
    
	$('#add_content_cat').click(function() {
        cat_id = $('input[name="cat_id"]').val();
        code = $('input[name="code_new"]').val();
        rating = $('input[name="rating"]').val();
        if(code) $.post('/admin/categorycontent/add', {cat_id: cat_id, code: code, rating: rating}, addNodeCategory);
        else alert('Введите код');
	});
    
});


function addNodeCategory(data) {
    if(data == '1') {
        alert('Узел успешно добавлен');
        location.reload();
    }
    else if (data == 'not empty') alert('Невозможно добавить узел категория не пустая');
    else alert('Ошибка при добавлении узла');
}