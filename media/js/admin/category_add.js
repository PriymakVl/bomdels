$(document).ready(function() {
    var cat_id, title, code, parent, rating;
    
	$('#add_cat').click(function() {
        var cat_id = $(':radio:checked').attr('cat_id');
        if(cat_id) parent = cat_id; //create of subcategory
        else parent = $('input[name="parent"]').val();
        console.log(cat_id, parent);
        title = $('input[name="title"]').val();
        alias = $('input[name="alias"]').val();
        rating = $('input[name="rating"]').val();
        equipment = $('input[name="equipment"]').val();
        if(title) $.post('/admin/category/add', {parent_id: parent, title: title, alias: alias, rating: rating, equipment: equipment}, addCategory);
        else alert('Введите название категории');
	});
    
});


function addCategory(data) {
    if(data == '1') {
        alert('Категория успешно добавлена');
        location.reload();
    }
    else alert('Ошибка при добавлении категории');
}