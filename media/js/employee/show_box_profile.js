$(document).ready(function() {
	$('#profile_edit').click(function() {
	   $('#employee_data_box').hide();
       $('#employee_edit_box').slideDown(300);
	});
    
    $('#profile_cancel').click(function() {
	   $('#employee_edit_box').hide();
       $('#employee_data_box').slideDown(300);
	});
});