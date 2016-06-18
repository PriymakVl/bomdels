$(document).ready(function() {
	$('#delete_node').click(function() {
        var res = confirm('Вы действительно хотите удалить узел?');
        if(!res) {return;}
	    var code = $(':radio:checked').attr('code');
        var cat_id = $('input[name="cat_id"]').val();
        //console.log(cat_id, code); return;
        if(code && cat_id) $.post('/admin/categorycontent/delete', {cat_id: cat_id, code: code}, deleteNodeCategory);
        else alert('Error');
	});
    
});


function deleteNodeCategory(data) {
    if(data == '1') {
        alert('Узел успешно удален');
        location.reload();   
    }
    else alert('Ошибка при удалении узда');
}