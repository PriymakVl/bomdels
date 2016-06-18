$(document).ready(function() {
    $('#delete_draw').click(function() {
        $(':radio:checked').each(function() {
            var draw_id = $(this).attr('draw_id');
            location.href = '/drawings/delete?draw_id=' + draw_id;
        });
    });
});