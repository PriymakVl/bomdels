$(document).ready(function() {
    $('#delete_draw').click(function() {
        var draw_id = $(':radio:checked').attr('draw_id');
        if(draw_id) {
            var agree = confirm("Вы действительно хотите удалить чертеж?");
            if(agree) location.href = '/drawings/delete?draw_id=' + draw_id;
            else return;   
        }   
        else alert('Вы не выбрали чертеж');
    });
});