$(document).ready(function() {
	$('#delete_cat').click(function() {
	    var cat_id = $(':radio:checked').attr('cat_id');
        if(cat_id) $.post('/admin/category/delete', {cat_id: cat_id}, deleteCategory);
        else alert('Выберите категрию');
	});
    
});


function deleteCategory(data) {
    if(data == '1') {
        alert('Категрия успешно удалена');
        location.reload();   
    }
    else if(data == 'not empty') alert('Невозможно удалить категорию она не пустая');
    else alert('Ошибка при удалении категории');
}