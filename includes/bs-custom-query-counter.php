<?php

/**
 * Create a globally accessible counter for all queries
 * Even custom new WP_Query!
 */

// Initialize your variables
add_action('init', function(){
  global $bs_query_counter;
  $cqc = -1;
});

// At loop start, always make sure the counter is -1
// This is because WP_Query calls "next_post" for each post,
// even for the first one, which increments by 1
// (meaning the first post is going to be 0 as expected)
add_action('loop_start', function($q){
  global $bs_query_counter;
  $bs_query_counter = -1;
}, 100, 1);

// At each iteration of a loop, this hook is called
// We store the current instance's counter in our global variable
add_action('the_post', function($p, $q){
  global $bs_query_counter;
  $bs_query_counter = $q->current_post;
}, 100, 2);

// At each end of the query, we clean up by setting the counter to
// the global query's counter. This allows the custom $cqc variable
// to be set correctly in the main page, post or query, even after
// having executed a custom WP_Query.
add_action( 'loop_end', function($q){
  global $wp_query, $bs_query_counter;
  $bs_query_counter = $wp_query->current_post;
}, 100, 1);
