$(document).ready(function() {
	$('#add_content').click(function() {
	   var cat_id = $(':radio:checked').attr('cat_id');
       if(cat_id) location.href = '/admin/categorycontent?cat_id=' + cat_id;
       else alert('Выберите категорию');
	});
});