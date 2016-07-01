<?php

$response = array();
$date_format = 'Y-m-d H:i:s';

$taxonomies = get_taxonomies();

if (have_posts()) {
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

        $post_thumbnail_id = get_post_thumbnail_id();

        if ($post_thumbnail_id && '' != $post_thumbnail_id) {
            if ($post_thumbnail_info = headless_return_media_info($post_thumbnail_id)) {
                $post_array['featuredMedia'] = $post_thumbnail_info;
            }
        }

        $attached_media = get_attached_media('');

        if ($attached_media && count($attached_media)) {
            $media_array = array();

            foreach ($attached_media as $media) {
                if (strpos($media->post_mime_type, 'image') !== false) {
                    if ($media = headless_return_media_info($media->ID)) {
                        $media_array[] = $media;
                    }
                }
            }

            if (count($media_array)) {
                $post_array['attachedMedia'] = $media_array;
            }
        }

        if (is_sticky()) {
            $post_array['sticky'] = true;
        }

        $terms = headless_get_post_terms($post->ID, $taxonomies);

        if ($terms && count($terms)) {
            $post_array['terms'] = $terms;
        }

        $meta = get_post_meta($post_id);

        if ($meta && count($meta)) {
            $post_array['meta'] = $meta;
        }

        $response[] = $post_array;
    }

    $response['pagination'] = array();

    $prev = get_previous_posts_page_link();

    if ($prev && '' != $prev) {
        $response['pagination']['prev'] = $prev;
    }

    $next = get_next_posts_page_link();

    if ($next && '' != $next) {
        $response['pagination']['next'] = $next;
    }
} else {
    $response = array(
        'status' => 'no-more-posts',
    );
}

echo json_encode($response);
