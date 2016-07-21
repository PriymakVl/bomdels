$(document).ready(function() {
   //start edit    
   $('#edit_item').click(function() {
        var name = $(':radio:checked').attr('name');
        if(name) {
            $(':radio:checked').parent().parent().find('span').hide();
            $(':radio:checked').parent().parent().find(':text').show(); 
            $('#save_edit').show();
            $('#cancel_edit').show();
            $(this).hide();    
        }
        else alert('Не выбрано поле для редактирования');
        
   }); 
   //cansel edit
   $('#cancel_edit').click(function() {
        $(':radio:checked').parent().parent().find('span').show(); 
        $(':radio:checked').parent().parent().find(':text').hide();
        $('#save_edit').hide();
        $(this).hide();
        $('#edit_item').show();
   });
   
   $('#save_edit').click(function() {
        var equipment = $('#equipment').val();
        var detail_id = $('#detail_id').val(); 
        var rus = $('#rus').val(); 
        var weight = $('#weight').val();
        var qty = $('#qty').val();
        var material = $('#material').val();
        var analog = $('#analog').val();
        $.post('/data/edit', {equipment: equipment, id: detail_id, rus: rus, weight: weight, qty: qty, material: material, analog: analog}, resultEdit);   
   });
});


function resultEdit(data) {
    if(data == 1) location.reload();
    else alert('Ошибка при редактировании');
}







