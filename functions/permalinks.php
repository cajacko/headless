<?php

function headless_permalinks()
{
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
}
