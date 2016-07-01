<?php

$response = array();
$date_format = 'Y-m-d H:i:s';

if (have_posts()) {
    // Start the loop.
    while (have_posts()) {
        the_post();

        $post_array = array();

        if ($post_id = get_the_ID()) {
            $post_array['ID'] = $post_id;
        }

        if ($post_title = get_the_title()) {
            $post_array['title'] = $post_title;
        }

        $post_content = apply_filters('the_content', get_the_content());

        if ($post_content && '' != $post_content) {
            $post_array['content'] = $post_content;
        }

        if ($post_date = get_the_date($date_format)) {
            $post_array['date'] = $post_date;
        }

        if ($post_modified = get_the_modified_date($date_format)) {
            $post_array['modified'] = $post_modified;
        }

        if (isset($post->post_name) &&  $post->post_name) {
            $post_array['slug'] = $post->post_name;
        }

        if ($post_type = get_post_type()) {
            $post_array['type'] = $post_type;
        }

        $post_excerpt = get_the_excerpt();

        if ($post_excerpt && '' != $post_excerpt) {
            $post_array['excerpt'] = $post_excerpt;
        }

        $post_array['format'] = get_post_format() ? : 'standard';


        $response[] = $post_array;

        // twentyfifteen_post_thumbnail();

        // wp_link_pages(array(
        //     'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'twentyfifteen') . '</span>',
        //     'after'       => '</div>',
        //     'link_before' => '<span>',
        //     'link_after'  => '</span>',
        //     'pagelink'    => '<span class="screen-reader-text">' . __('Page', 'twentyfifteen') . ' </span>%',
        //     'separator'   => '<span class="screen-reader-text">, </span>',
        // ));


        // _e('Published by', 'twentyfifteen');
        // $author_bio_avatar_size = apply_filters('twentyfifteen_author_bio_avatar_size', 56);

        // echo get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size);
        // echo get_the_author();

        // the_author_meta('description');
        // echo esc_url(get_author_posts_url(get_the_author_meta('ID')));
        // printf(__('View all posts by %s', 'twentyfifteen'), get_the_author());

        // twentyfifteen_entry_meta();
    }

    // Previous/next page navigation.
    // the_posts_pagination(array(
    //     'prev_text'          => __('Previous page', 'twentyfifteen'),
    //     'next_text'          => __('Next page', 'twentyfifteen'),
    //     'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'twentyfifteen') . ' </span>',
    // ));

// If no content, include the "No posts found" template.
} else {
    // get_template_part('content', 'none');
}

echo json_encode($response);
