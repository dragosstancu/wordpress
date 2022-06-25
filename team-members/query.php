<?php
/**
Template Name:  Team Members
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

get_header();
if (have_posts()) {
    while (have_posts()) {
        the_post();
        $query_members = new WP_Query(array('post_type' => 'team_member', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'member_group', 'field' => 'slug', 'terms' => 'mhhefa-team')), 'orderby' => 'name', 'order' => 'ASC'));
        if ($query_members->have_posts()) {
            echo '<div class="pt-3"><ul class="block pl-2 pb-3 columns x3 members">';
            while ($query_members->have_posts()) {
                echo '<li class="p-1 w-33"><div class="p-2">';
                $query_members->the_post();
                $post_id = get_the_ID();
                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
                $featured_image = $featured_image[0];
                echo '<div class="member-photo" style="background-image:url(' . $featured_image . ');"></div>';
                echo '<div class="pt-2 clearfix pb-2"><h3 class="center-text p-0">' . get_the_title() . '</h3></div><div class=" clearfix small-text">';
                the_content();
                echo '</div>';
                echo '</div></li>';
            }
            echo '</ul></div>';
        }
        wp_reset_postdata();
    }
}
get_footer();
