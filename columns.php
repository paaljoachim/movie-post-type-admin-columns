<?php

/* manage the columns of the `page` post type
function manage_columns_for_page($columns){
    //remove columns
    unset($columns['date']);
    unset($columns['comments']);
    unset($columns['author']);

    //add new columns
    $columns['page_featured_image'] = 'Page Featured Image';
    $columns['page_template'] = 'Page Template'; 
    $columns['page_content']    = 'Page Content';

    return $columns;
}
add_action('manage_movie_posts_columns','manage_columns_for_page');
*/

// manage the columns of the post post type
function manage_columns_for_post($columns){
    //remove columns
    unset($columns['title']);
    unset($columns['categories']);
    unset($columns['tags']);
    unset($columns['date']);
    unset($columns['comments']);
    unset($columns['author']);

    //add new columns
     $columns['title'] = 'Title';
    $columns['post_featured_image'] = 'Featured Image';
    $columns['post_content']    = 'Content';
    $columns['categories']    = 'Categories';
    $columns['tags']    = 'Tags';
    $columns['date']    = 'Date';   
    $columns['author']    = 'Author';
    return $columns;
}

add_action('manage_post_posts_columns','manage_columns_for_post');




// Populate custom columns for post type
function populate_post_columns($column,$post_id){

    //featured image column
    if($column == 'post_featured_image'){
        //if this post has a featured image
        if(has_post_thumbnail($post_id)){
            // Original: $post_featured_image = get_the_post_thumbnail($post_id,'thumbnail');
            echo the_post_thumbnail( array(100,100) );
        }else{
            echo 'This post has no featured image'; 
        }
    }

    
    //post content column
    if($column == 'post_content'){

        //get the page based on its post_id
        $post = get_post($post_id);
        if($post){
            //get the main content area
            $post_content = apply_filters('the_content', $post->post_content); 
            // Original: echo $post_content;  
            echo wp_trim_words(get_the_content(), 10);
        }
    }
}
add_action('manage_post_posts_custom_column','populate_post_columns',10,2);




// Page columns
//manage_page_posts_columns

// Post columns
// manage_post_posts_columns

// Custom Post columns
// manage_movie_posts_columns


// manage the columns of the movie custom post type
function manage_columns_for_movie($columns){
    //remove columns
    //unset($columns['title']);
      unset($columns['taxonomy-movie-years']);
	  unset($columns['gadwp_stats']);
      unset($columns['tags']);
      unset($columns['taxonomy-movie-type']);
      unset($columns['date']);
      unset($columns['comments']);
      unset($columns['author']);

    //add new columns
      $columns['page_featured_image'] 	= 'Featured Image';
      $columns['title'] 					= 'Movie Title';	
      $columns['page_content']    		= 'Movie Content';
      $columns['taxonomy-movie-years'] 	= 'Year Screened';			
      $columns['taxonomy-movie-type'] 	= 'Movie Category';
      $columns['date']    				= 'Date';
   // $columns['Author']    = 'Author';
   // $columns['gadwp_stats'] = 'Stats';  - a plugin that adds a column. I removed it above and did not add it back in.
    return $columns;
}
add_action('manage_movie_posts_columns','manage_columns_for_movie'); 


//Populate custom columns for the movie custom post type
function populate_movie_columns($column,$post_id){

    //featured image column
    if($column == 'page_featured_image'){
        //if this page has a featured image
        if(has_post_thumbnail($post_id)){
            $post_featured_image = get_the_post_thumbnail($post_id,'thumbnail');
            // echo $post_featured_image;
             echo the_post_thumbnail( array(140,100) );
        }else{
            echo 'This custom post has no featured image'; 
        }
    }

    //page content column
    if($column == 'page_content'){
        //get the page based on its post_id
        $page = get_post($post_id);
        if($page){
            //get the main content area
            $page_content = apply_filters('the_content', $page->post_content); 
            echo wp_trim_words( get_the_content(), 10);
        }
    }
}

add_action('manage_movie_posts_custom_column','populate_movie_columns',10,2); 

/*
Add to movie custom post list screen:
manage_movie_posts_custom_column

Add to all list screens:
manage_posts_custom_column

Add to post list screen:
manage_post_posts_custom_column

Add to page list screen:
manage_page_posts_custom_column

https://www.sitepoint.com/extending-post-columns-admin-areas/
https://www.smashingmagazine.com/2013/12/modifying-admin-post-lists-in-wordpress/
https://code.tutsplus.com/articles/add-a-custom-column-in-posts-and-custom-post-types-admin-screen--wp-24934
http://mekshq.com/change-wordpress-date-format-to-time-ago/

Plugins:
https://wordpress.org/plugins/codepress-admin-columns/

*/