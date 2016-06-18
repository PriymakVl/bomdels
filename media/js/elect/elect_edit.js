$(document).ready(function() {
    $('#save_elem').click(function(event) {  
        event.preventDefault();
        $('#form_elem').submit();   
    });
    
    //insert data in input of form
    $('#elect_box :radio').change(function() {
        $('#element_form_box').slideDown();
        
        var type_elem = $(this).attr('type_list');
        if(type_elem == 'category') var name = $(this).attr('name_cat');
        else var name = $(this).attr('name_det');
        
        var rating = $(this).attr('rating');
        var description = $(this).attr('description');
        var elect_id = $(this).attr('elect_id');
        console.log(name); return;
        $('#form_element input[name="elect_id"]').val(elect_id);
        $('#form_element input[name="title"]').val(name);
        $('#form_element input[name="rating"]').val(rating);
        $('#form_element textarea').text(description);
    })
});