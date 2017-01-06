<?php

$statement = array(
	'post_type'				=> 'post', 
    'orderby'				=> "date",
    'order'					=> "DESC",	    
	'posts_per_page'		=> $numberpost
);

$query = new WP_Query($statement);

echo "<div class='blog-latest-post'>";

if ( $query->have_posts() ) 
{
	while ( $query->have_posts() ) 
	{
		$query->the_post();
				
		$catlink = array();
		
		foreach(get_the_category() as $category) { $catlink[] = $category->name ; }
		$featured = jeg_get_featured_heading(get_the_ID(), 800, 400);
		$featuredhtml = '';
		if($featured !== '') {
			$featuredhtml = "<div class='article-image'>" . $featured . "</div>"; 
		}

        echo "
        <div class='article-sidebar'>
            {$featuredhtml}
            <div class='article-category'>
                " . implode(" ,", $catlink) . "
            </div>
            <h2><a href='"  . get_permalink(get_the_ID()) . "'>" . get_the_title()  . "</a></h2>
            <div class='clearfix article-meta'>
                " . get_the_date()  . "
            </div>
        </div>";

	}
} 

echo "</div>";

wp_reset_postdata();