$(document).ready(function() {
	$('#profile_edit').click(function() {
	   $('#user_data_box').hide();
       $('#user_edit_box').slideDown(300);
	});
    
    $('#profile_cancel').click(function() {
	   $('#user_edit_box').hide();
       $('#user_data_box').slideDown(300);
	});
});