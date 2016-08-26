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
        var item = $('#item').val();
        var material = $('#material').val();
        var analog = $('#analog').val();
        var variant = $('#variant').val();
        var ens = $('#ens').val();// код ЕНС в программе снабжения
        var parent = $('#parent').val();//parent code
        $.post('/data/edit', {parent: parent, equipment: equipment, id: detail_id, rus: rus, weight: weight, item: item, qty: qty, material: material, analog: analog, variant: variant, ens: ens}, resultEdit);   
   });
});


function resultEdit(data) {
    if(data == 1) location.reload();
    else alert('Ошибка при редактировании');
}







