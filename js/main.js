jQuery(document).ready(function($) {
    $('#remove_logo').css('display', 'none');
    if($('#image_preview').attr('src')){
        $('#remove_logo').css('display', 'block');
    }
    $('body').on('click', '#upload_button', function(e) {
        e.preventDefault();

        var frame = wp.media({
            title: 'Choose or Upload an Image',
            button: {
                text: 'Use this image',
            },
            multiple: false,
        });

        frame.open();

        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            $('#image_preview').attr('src', attachment.url);
            $('#ct_option_logo').attr('value', attachment.url);
            if($('#image_preview').attr('src')){
                $('#remove_logo').css('display', 'block');
            }
        });
    });

    $('body').on('click', '#remove_logo', function(e) {
        e.preventDefault();
        $('#ct_option_logo').attr('value', '');
        $('#image_preview').attr('src', '');  
        $('#remove_logo').css('display', 'none');      
    });
});
