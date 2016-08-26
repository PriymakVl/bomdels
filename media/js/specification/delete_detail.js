$(document).ready(function() {
	$('#delete_detail').click(function() {
	   var agree = confirm('Вы действительно холите удалить деталь (узел)');
       if(!agree) return;
	   var detail_id = $('.cat-data :radio:checked').attr('detail_id');
	   var parent_code = $('.cat-data :radio:checked').attr('parent_code');
       var equipment = $('.cat-data :radio:checked').attr('equipment');
 
       $.post('/data/deletedetail', {detail_id: detail_id, parent_code: parent_code, equipment: equipment}, resultDeleteDetail);
	});
});


function resultDeleteDetail(data) {
    if(data) {
        alert('Деталь (узел) успешно удален');
        location.relod();
    }
    else alert('Ошибка при удалении детали (узла)');
}