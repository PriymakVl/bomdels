$(document).ready(function() {
    $('#show_transtation_box').click(function() {
        $('#add_translation_box').show();
        $('#glossary_box').hide();
    });
    
      $('#hide_translation_box').click(function() {
        $('#add_translation_box').hide();
        $('#glossary_box').show();
    });
})