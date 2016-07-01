<?php

add_action('after_setup_theme', 'headless_setup');
add_action('admin_enqueue_scripts', 'headless_enqueue_js');
add_action('init', 'headless_init');
add_action('template_redirect', 'headless_template_redirect');
