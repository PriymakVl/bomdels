$(document).ready(function() {
    //controller electlist
    $('#show_box_sort_list').click(function() {
        $('#menu_elect_main_box').hide();
        $('#sort_list_box').show();
    });
   
   //controller electlist
    $('#cancel_sort_box').click(function() {
        $('#sort_list_box').hide();
        $('#menu_elect_main_box').show();
    });
});