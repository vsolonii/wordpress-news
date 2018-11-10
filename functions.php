<?php
/**
 * Function to display news feed like on news portals
 *
 * @param int $number - number of news to show
 * @param null $highlight - ID of a tag. If post has this tag, it's title will be highlighted
 * @param bool $time - to show or not to show time before title
 * @param null $exclude - ids of excluding categories. Example: '-2, -3'
 */
function get_articles_feed( $number = 20, $highlight = null, $time = true, $exclude = null ) {
	date_default_timezone_set( 'Europe/Kiev' );

	$args = array(
		'posts_per_page'      => $number,
		'ignore_sticky_posts' => 1,
		'cat'                 => $exclude
	);

	$query        = new WP_Query( $args );
	$checked      = true; // trigger 'checked' is on
	$now          = date( 'd.m.Y', time() ); // today's date
	$compare_date = $now; // set current date to compare with
	$yesterday    = false;

	while ( $query->have_posts() ) {
		$query->the_post();
		$class   = '';
		$the_id  = get_the_ID();
		$posted  = get_the_time( 'd.m.Y', $the_id );

		if ( strtotime( $posted ) < strtotime( $compare_date ) ) {
			$yesterday = true;
			$checked = false;
		} else {
			$checked = true;
		}

		if ( $yesterday && !$checked ) { ?>
			</ul>
			<div><strong><?php echo get_the_time( 'd.m.Y', $theid ); ?></strong></div>
			<ul>
		<?php }

		$tag_ids = wp_get_post_tags( $the_id, array( 'fields' => 'ids' ) ); // get all tag IDs of post
		$class   = ( !empty( $highlight ) && in_array( $highlight, $tag_ids ) ) ? ' class="important"' : ''; ?>
		<li<?php echo $class ?>>
			<?php if ( $time ) { ?>
				<time datetime="<?php the_time( 'Y-m-d' ) ?>">
					<?php echo get_the_time( 'G:i', $the_id ) ?>
				</time>
			<?php } ?>
				<a href="<?php echo get_permalink( $the_id ) ?>"
				   title="Read: <?php the_title_attribute(); ?>">
					<?php the_title(); ?>
				</a>
		</li>
		<?php $compare_date = $posted;
	};
	wp_reset_postdata();
}
