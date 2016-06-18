$(document).ready(function() {
    $('#sort-details-sundbirsta  input:checkbox').removeAttr('checked');
    
    $('#select_all').change(function() {
        var checked = $(this).attr('checked');
        if(checked == true) {
            $('#sort-details-sundbirsta  input:checkbox').each(function() {
                $(this).attr('checked', true);    
            });
        }
        else {
            $('#sort-details-sundbirsta  input:checkbox').each(function() {
                $(this).attr('checked', false);    
            });    
        }
    });
});