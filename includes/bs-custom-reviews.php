<?php

	/*
	 * Displays Custom Product Reviews
	 */

function bs_custom_reviews_slider() {
	global $product;
	$id = $product->id;
	
	echo $id.",";
	$args = array ('post_type' => 'product', 'post_id' => $id, 'number' => 10, 'order_by' => 'comment_date');
	$comments = get_comments( $args );
	//$comment_meta = get_comment_meta($comments[1]->comment_ID);
  //echo '<pre>' . var_dump($comments[2]) . '</pre>';
	//echo '<pre>' . var_dump($comment_meta) . '</pre>';
//	$comment_rating = wp_star_rating(array(
//		'rating' => 3.5,
//		'echo' => false,
//		'type'   => 'rating',
//		'number' => 1234
//	));
	//echo var_dump($comment_rating) . ' ' . $comment_meta["rating"][0] / 10;
	
	$reviews_slider = '';
	
	foreach ($comments as $comment) {
		$reviews_slider .= '<div class="bs_review_item"><p class="review_text">' . $comment->comment_content . '</p><div class="bs_author_details"><span class="author_avatar"><img src="https://i.imgur.com/7Dhen2V.png" /></span><p class="author_name">' . $comment->comment_author . '</p></div></div>';
	}
	return '<div class="bs_custom_reviews">' . $reviews_slider . '</div>';
}

add_shortcode('bs_custom_reviews', 'bs_custom_reviews_slider');
