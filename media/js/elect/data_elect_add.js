$(document).ready(function() {
    $('#add_elect').click(function() {
        $(':radio:checked').each(function() {
            var elem_id = $(this).attr('det_id');
            var kind = $(this).attr('equipment');
            location.href = '/elect/add?elem_id=' + elem_id + '&kind=' + kind;
        });
    });
});