<?php

function does_term_exist($taxonomies, $term_id)
{
    $exist = false;

    foreach ($taxonomies as $taxonomy) {
        foreach ($taxonomy as $term) {
            if ($term->term_id == $term_id) {
                $exist = true;
            }
        }
    }

    return $exist;
}

function headless_get_post_terms($post_id, $taxonomies)
{
    $terms = wp_get_post_terms($post_id, $taxonomies);
    $terms_array = array();

    foreach ($terms as $term) {
        if (does_term_exist($terms_array, $term->term_id)) {
            continue;
        }

        if (!isset($terms_array[$term->taxonomy])) {
            $terms_array[$term->taxonomy] = array();
        }

        $terms_array[$term->taxonomy][] = $term;

        if ('0' == $term->parent) {
            continue;
        }

        $ancestors = get_ancestors($term->term_id, $term->taxonomy);

        foreach ($ancestors as $ancestor_id) {
            if (does_term_exist($terms_array, $ancestor_id)) {
                continue;
            }

            if (!isset($terms_array[$term->taxonomy])) {
                $terms_array[$term->taxonomy] = array();
            }

            $term = get_term($ancestor_id);
            $terms_array[$term->taxonomy][] = $term;
        }
    }

    return $terms_array;
}
