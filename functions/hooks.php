<?php

// Setup the theme
function headless_setup()
{
    headless_setup_media();
}

function headless_enqueue_js()
{
    headless_js();
}

function headless_init()
{
    headless_permalinks();
    headless_media_ini();
}

function headless_template_redirect()
{
    headless_front_end_http_headers();
}
