<?php

// Setup theme
function headless_setup_media()
{
    add_theme_support('post-thumbnails');
    
    /*
     * Add various image sizes so that images 
     * can be progressively loaded at higher 
     * resolutions.
     */
    for ($i = 600; $i > 300; $i = $i - 50) {
        add_image_size('width-' . $i, $i);
    }
}

function headless_media_ini()
{
    // Set upload size
    @ini_set('upload_max_size', '10G');
    @ini_set('upload_max_filesize', '10G');
    @ini_set('post_max_size', '10G');
    @ini_set('max_execution_time', '300');
}

function headless_return_media_info($media_id)
{
    $array = wp_get_attachment_metadata($media_id);

    if (is_array($array) && count($array)) {
        $array['ID'] = $media_id;
    }
    
    return $array;
}
