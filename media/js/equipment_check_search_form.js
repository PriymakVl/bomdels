$(document).ready(function() {
	$('input[name="search_detail"]').click(function(event) {
	   event.preventDefault();
       var search = $('input[name="search"]').val();
       if(!search) alert('Вы не указали что искать');
       else {
            $('#form_search_detail').submit();
       }   
	})
});