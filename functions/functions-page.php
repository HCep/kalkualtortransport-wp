<?php 
function materialwp_widgets_init() {
	register_sidebar( array(
		'name'          => 'footer',
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget-sidebar %2$s"><div class="">',
		'after_widget'  => '</div></aside>',
	
	) );
}
add_action( 'widgets_init', 'materialwp_widgets_init' );


function webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');
//** * Enable preview / thumbnail for webp image files.*/
function webp_is_displayable($result, $path) {
    if ($result === false) {
        $displayable_image_types = array( IMAGETYPE_WEBP );
        $info = @getimagesize( $path );

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }

    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
	
	// loop
	foreach( $items as &$item ) {
		
		// vars
		$icon = get_field('menu_icon', $item);
		
		
		// append icon
		if( $icon ) {
			
			$item->title .= ' <img src="'.$icon['url'].'">';
			
		}
		
	}
	
	
	// return
	return $items;
	
}

function cptui_register_division() {

    $labels = [
        "name" => __( "Odziały firmy" ),
        "singular_name" => __( "oddzialy"),
    ];

    $args = [
        "label" => __( "Odziały firmy" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => "oddzial", "with_front" => true ],
        "query_var" => true,
        "supports" => [ 'title','thumbnail', 'editor', 'custom-fields'],
        "taxonomies" => [ "" ],
        "show_in_graphql" => false,
    ];

    register_post_type( "oddzial", $args );
}

add_action( 'init', 'cptui_register_division' );


function cptui_register_about_gallery() {

    $labels = [
        "name" => __( "Galeria - o firmie" ),
        "singular_name" => __( "about-gallery"),
    ];

    $args = [
        "label" => __( "Galeria - o firmie" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => "about-gallery", "with_front" => true ],
        "query_var" => true,
        "supports" => [ 'title','thumbnail'],
        "taxonomies" => [ "" ],
        "show_in_graphql" => false,
    ];

    register_post_type( "about-gallery", $args );
}

add_action( 'init', 'cptui_register_about_gallery' );

function cptui_register_crew() {

    $labels = [
        "name" => __( "Zespół" ),
        "singular_name" => __( "crew"),
    ];

    $args = [
        "label" => __( "Zespół" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => "crew", "with_front" => true ],
        "query_var" => true,
        "supports" => [ 'title','thumbnail', 'custom-fields'],
        "taxonomies" => [ "" ],
        "show_in_graphql" => false,
    ];

    register_post_type( "crew", $args );
}

add_action( 'init', 'cptui_register_crew' );


function cptui_register_career() {

    $labels = [
        "name" => __( "Kariera" ),
        "singular_name" => __( "career"),
    ];

    $args = [
        "label" => __( "Kariera" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => "career", "with_front" => true ],
        "query_var" => true,
        "supports" => [ 'title', 'custom-fields'],
        "taxonomies" => [ "" ],
        "show_in_graphql" => false,
    ];

    register_post_type( "career", $args );
}

add_action( 'init', 'cptui_register_career' );




add_shortcode( 'career', 'career_blocks' ); 

function career_blocks(){


	$result = '<section class="container py-5 px-0 mx-auto">';


	$result .= '<div class="d-flex flex-column">';
			
		$args = array(
			'post_type'      => 'career',
			'posts_per_page' => -1,
			'publish_status' => 'published',
			
		);
		
	
		$loop = new WP_Query( $args );
		if($loop->have_posts()) :
		
		while ( $loop->have_posts() ) : $loop->the_post();
			
	
		
			$result .= '<div class="w-100 relative career-cnt">';
      
            $result .= '<h3 class="career-position">'. get_field('career_position') .'</h3>';
         
			$result .=	'<p class="career-req">'. get_field('career_requirements').'</p>';
		
         
			
		
			$result .='</div>';
			
		endwhile;
	
		wp_reset_postdata();
	endif;
		
	
		$result .='</div>';
		$result .='</section>';
	
	return $result;
	}
    
	





    add_shortcode( 'slider-about-gallery', 'slider_about_gallery' ); 

    function slider_about_gallery(){
        if (get_locale() == 'en_GB') {
       
            $result = '<section id="about_us" class="splide about-us" >';
        
    } else{
        $result = '<section id="about" class="splide about" >';
       
    }
        $result .=	'<div class="splide__track">';
        $result .= '<ul class="splide__list">';

                 
             $args = array(
                 'post_type'      => 'about-gallery',
                 'posts_per_page' => -1,
                 'publish_status' => 'published',
                 
             );
    
             $loop = new WP_Query( $args );
             if($loop->have_posts()) :
             
             while ( $loop->have_posts() ) : $loop->the_post();
      
			$result .= '<li class="splide__slide"><div class="relative">';
         
        
            $result .= '<img class="" src="'. get_the_post_thumbnail_url() .'" /> </div></li>';
			
             endwhile;
         
             wp_reset_postdata();
         endif;
             
             $result .='</ul>';
         
             $result .='</div>';
             
         
             $result .='</section>';
         
         return $result;
         }
        




         
         add_shortcode( 'nasz-zespol', 'display_crew' ); 
function display_crew(){


	$result = '<section class="py-5 mx-auto crew-section">';


	$result .= '<div class="d-flex justify-content-between container mx-auto flex-wrap">';
			
		$args = array(
			'post_type'      => 'crew',
			'posts_per_page' => -1,
			'publish_status' => 'published',
			
		);
		
	
		$loop = new WP_Query( $args );
		if($loop->have_posts()) :
		
		while ( $loop->have_posts() ) : $loop->the_post();
			
        $result .= '<div class="crew-column">';
		
			$result .= '<div class="crew-cnt text-center">';
       
		
				$result .=	'<p class="crew-name">'. get_field('crew_name') .'</p>';
				$result .=	'<span class="crew-position">'. get_field('crew_position') .'</span>';
		
		
			
		
			$result .='</div>';
			$result .='</div>';
			
		endwhile;
	
		wp_reset_postdata();
	endif;
		
	
		$result .='</div>';
		$result .='</section>';
	
	return $result;
	}

    function firma_blocks(){


        $result = '<section class="container py-5 px-0 mx-auto">';
    
    
        $result .= '<div class="d-flex justify-content-between flex-wrap">';
                
            $args = array(
                'post_type'      => 'oddzial',
                'posts_per_page' => 4,
                'publish_status' => 'published',
                
            );
            
        
            $loop = new WP_Query( $args );
            if($loop->have_posts()) :
            
            while ( $loop->have_posts() ) : $loop->the_post();
                
        
            
                $result .= '<div class="relative orange-overlay">';
                $result .= '<a class="w-100 img-anchor" href="'. get_permalink() .'">';
                $result .= '<div class="division_overlay"></div>';
                $result .= '<img class="division_image" src="'. get_the_post_thumbnail_url() .'" />';
                
                
        
            
            
                    $result .=	'<p class="division_title">'. get_the_title() .'</p>';
            
            
                
            
                $result .='</a></div>';
                
            endwhile;
        
            wp_reset_postdata();
        endif;
            
        
            $result .='</div>';
            $result .='</section>';
        
        return $result;
        }
        add_shortcode( 'oddzialy-firmy', 'firma_blocks' ); 