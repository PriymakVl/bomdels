$(document).ready(function() {
	$('#elect_cut_description').click(function() {
	   var description = $(this).attr('full_description');
       $('#description_element_inner_box').html('<span>Описание элемента:<span>' + description);
       $('#description_element_box').show();
       $('#description_list_box').hide();
	});
    
    $('#close_box_description_element').click(function() {
       $('#description_element_inner_box').text('');
       $('#description_element_inner_box').hide();
       $('#description_list_box').show(); 
    });
});