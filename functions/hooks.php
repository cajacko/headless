<?php

// Setup the theme
function wordpress_theme_setup()
{
    wordpress_theme_setup_media();
}

function wordpress_theme_enqueue_js()
{
    wordpress_theme_js();
}

function wordpress_theme_init()
{
    wordpress_theme_permalinks();
    wordpress_theme_media_ini();
}

function wordpress_theme_template_redirect()
{
    wordpress_theme_front_end_http_headers();
}
