$(document).ready(function() {
    
    $('#edit_list_elect').click(function() { 
        
        if (!$('#edit_list_box :radio').is(':checked')) {alert('Вы не выбрали список'); return false;}
        
        $('#edit_list').show();
        $('#add_list').hide();
        $('#list_form_box').slideDown(300);  
        
        var checked = $('#edit_list_box :radio:checked');
        var rating = checked.attr('rating');
        var description = checked.attr('description');
        var listname = checked.attr('listname');
        var list_id = checked.attr('list_id');
        var typelist = checked.attr('typelist'); 

        $('#form_list input[name="list_id"]').val(list_id);
        $('#form_list input[name="listname"]').val(listname);
        $('#form_list input[name="rating"]').val(rating);
        $('#form_list textarea').text(description); 
        $('#form_list select [value="' + typelist + '"]').attr('selected', 'selected');   
    });
    
      $('#edit_list').click(function(event) {  
            event.preventDefault();
            
            var listname = $('#form_list input[name="listname"]').val();
            if (!listname) {alert('Вы не указали название списка'); return;}
            
            $('#form_list').attr('action', '/elect/updatelist').submit();
            
    });
    
    
//    $('#save_list').click(function(event) {  
//        event.preventDefault();
//        var listname = $('#form_list input[name="listname"]').val();
//        if(!listname) {alert('Вы не указали имя списка'); return;}
//        $('#form_list').attr('action', '/elect/updatelist').submit();   
//    });
    
    //insert data in input of form
//    $('#edit_list_box :radio').change(function() {
//        $('#save_list').show();
//        $('#delete_list').show();
//        $('#add_list').hide();
//        $('#list_form_box').slideDown();
//        
//        var listname = $(this).attr('listname');
//        var rating = $(this).attr('rating');
//        var description = $(this).attr('description');
//        var list_id = $(this).attr('list_id');
//        
//        $('#form_list input[name="list_id"]').val(list_id);
//        $('#form_list input[name="listname"]').val(listname);
//        $('#form_list input[name="rating"]').val(rating);
//        $('#form_list textarea').text(description);
//    })
});