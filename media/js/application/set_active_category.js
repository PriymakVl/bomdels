$(document).ready(function() {
	$('#active_year').change(function() {
	   var year = $(this).val();
       location.href = '/software/application/setactiveyear?active_year=' + year;
	});
    
    $('#active_service').change(function() {
	   var service = $(this).val();
       location.href = '/software/application/setactiveservice?active_service=' + service;
	});
    
      $('#active_department').change(function() {
	   var department = $(this).val();
       location.href = '/software/application/setactivedepartment?active_department=' + department;
	});
});