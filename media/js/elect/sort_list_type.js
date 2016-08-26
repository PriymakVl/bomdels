$(document).ready(function() {
	$('#sort_list_box [name="typelist"]').change(function() {
	   var type = $(this).val();
       var user_id = gets().user_id;

       if (user_id) {
            alert('Отсортировать возможно только все списки');
            return;
       }
       else location.href = '/electlist?type=' + type;
	});
    
    var gets = function() {
        var search = window.location.search;
        var obj = {};
        search = search.substr(1).split('&');
        for (var i = 0; i < search.length; i++) {
            substr = search[i].split('=');
            obj[substr[0]] = substr[1];
        }
        return obj;
    }
});