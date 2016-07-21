$(document).ready(function() {
    //add item in list ol
	$('#add_item_nature_work').click(function() {
 	  var item_content = $('#field_write_work').val();
      var item_li = '<li>' + item_content + '<a href="#" onclick="return false" class="delete_item_nature_work">Удалить</a><a href="#" onclick="return false" class="edit_item_nature_work">Редактировать</a></li>';
      $('#create_order_nature_work_box ol').append(item_li);
    });
    
    //delete item from list ol
    $('.delete_item_nature_work').click(function() {
        $(this).parent().hide();
    });
});