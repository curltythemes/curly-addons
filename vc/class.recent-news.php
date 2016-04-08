<?php 
	
	class CurlyVCRecentNews{
		
		function __construct(){
			
			/** Construct Polaroids */
			add_action( 'vc_before_init', array( $this, 'vc_recent_news' ) );
			add_shortcode( 'curly_recent_news', array( $this, 'recent_news' ) );
			
		}
		
		
		
		function vc_recent_news(){
			
			$filter_categories = array();
			$categories = get_terms( 'category' );
			
			foreach( $categories as $cat ){
				$filter_categories["$cat->name"] = $cat->term_id;
			} 
			
			$filter_tags = array();
			$tags = get_terms( 'post_tag' );
			
			foreach( $tags as $tag ){
				$filter_tags["$tag->name"] = $tag->slug;
			} 
			
			
			
			/** Carousel Container */
			vc_map( array(
				"name" => __("Recent News", "CURLYTHEME"),
				"base" => "curly_recent_news",
				"content_element" => true,
				"show_settings_on_create" => false,
				"admin_enqueue_css" => array( CURLY_ADDONS_URL.'/framework/css/vc-icon.css' ),
				"icon" => "curly_icon",
				"class" => "",
				"category" => __('Curly Addons', "CURLYTHEME"),
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => __("Widget Title", "CURLYTHEME"),
						"param_name" => "title",
						"value" => null,
						"description" => __("Enter widget title", "CURLYTHEME"),
						'group' => __( 'General', 'CURLYTHEME' )
					),
					array(
						"type" => "textarea",
						"heading" => __("Before Posts", "CURLYTHEME"),
						"param_name" => "before_posts",
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'group' => __( 'General', 'CURLYTHEME' )
					),
					array(
						"type" => "textarea",
						"heading" => __("After Posts", "CURLYTHEME"),
						"param_name" => "after_posts",
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'group' => __( 'General', 'CURLYTHEME' )
					),
					array(
						"type" => "textfield",
						"heading" => __("Number of Posts", "CURLYTHEME"),
						"param_name" => "display_posts",
						'edit_field_class' => 'vc_col-sm-6',
						"value" => 5,
						'group' => __( 'Display', 'CURLYTHEME' )
					),
					array(
						"type" => "checkbox",
						"heading" => __("Show Post Title", "CURLYTHEME"),
						"param_name" => "display_title",
						'value' => 'true',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'group' => __( 'Display', 'CURLYTHEME' )
					),
					array(
						"type" => "checkbox",
						"heading" => __("Show Post Author", "CURLYTHEME"),
						"param_name" => "display_author",
						'value' => 'true',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'group' => __( 'Display', 'CURLYTHEME' )
					),
					array(
						"type" => "checkbox",
						"heading" => __("Show Post Image", "CURLYTHEME"),
						"param_name" => "display_image",
						'value' => 'true',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'group' => __( 'Display', 'CURLYTHEME' )
					),
					array(
						"type" => "checkbox",
						"heading" => __("Show Published Date", "CURLYTHEME"),
						"param_name" => "display_date",
						'value' => 'true',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'value' => 'true',
						'group' => __( 'Display', 'CURLYTHEME' )
					),
					array(
						"type" => "checkbox",
						"heading" => __("Show Post Excerpt", "CURLYTHEME"),
						"param_name" => "display_excerpt",
						'value' => 'true',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'group' => __( 'Display', 'CURLYTHEME' )
					),
					array(
						"type" => "textfield",
						"heading" => __("Published Date Format", "CURLYTHEME"),
						"param_name" => "display_date_format",
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						"value" => 'F j, Y',
						"description" => __("Enter date format", "CURLYTHEME"),
						'group' => __( 'Display', 'CURLYTHEME' ),
						'dependency' => array(
							'element' => 'display_date',
							'value' => array( true, 'true' )
						)
					),
					array(
						"type" => "checkbox",
						"heading" => __("Filter by category", "CURLYTHEME"),
						"param_name" => "filter_category",
						'edit_field_class' => 'vc_col-sm-6',
						'group' => __( 'Filter', 'CURLYTHEME' )
					),
					array(
						"type" => "checkbox",
						"heading" => __("Filter by tag", "CURLYTHEME"),
						"param_name" => "filter_tag",
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'group' => __( 'Filter', 'CURLYTHEME' )
					),
					array(
						"type" => "checkbox",
						"heading" => __("Select Categories", "CURLYTHEME"),
						"param_name" => "filter_categories",
						'edit_field_class' => 'vc_col-sm-12 vc_column',
						'value' => $filter_categories,
						'dependency' => array(
							'element' => 'filter_category',
							'value' => array( true, 'true' )
						),
						'group' => __( 'Filter', 'CURLYTHEME' )
					),
					
					array(
						"type" => "checkbox",
						"heading" => __("Select Tags", "CURLYTHEME"),
						"param_name" => "filter_tags",
						'value' => $filter_tags,
						'edit_field_class' => 'vc_col-sm-12 vc_column',
						'dependency' => array(
							'element' => 'filter_tag',
							'value' => array( true, 'true' )
						),
						'group' => __( 'Filter', 'CURLYTHEME' )
					),
					array(
						"type" => "dropdown",
						"heading" => __("Sticky Posts", "CURLYTHEME"),
						"param_name" => "filter_sticky",
						'edit_field_class' => 'vc_col-sm-12 vc_column',
						'value' => array(
							__( 'Show All Posts', 'CURLYTHEME' ) => 'all',
							__( 'Show Sticky Posts Only', 'CURLYTHEME' ) => 'sticky_only',
							__( 'Hide Sticky Posts', 'CURLYTHEME' ) => 'sticky_hide',
						),
						'group' => __( 'Filter', 'CURLYTHEME' )
					),
					array(
						"type" => "dropdown",
						"heading" => __("Order by", "CURLYTHEME"),
						"param_name" => "order_by",
						'value' => array(
							__( 'Published Date', 'CURLYTHEME' ) => 'date',
							__( 'Post Title', 'CURLYTHEME' ) => 'title',
							__( 'Random', 'CURLYTHEME' ) => 'random',
							__( 'Menu Order', 'CURLYTHEME' ) => 'menu_order',
						),
						'group' => __( 'Order', 'CURLYTHEME' )
					),
					array(
						"type" => "dropdown",
						"heading" => __("Order", "CURLYTHEME"),
						"param_name" => "order_way",
						'value' => array(
							__( 'Ascending', 'CURLYTHEME' ) => 'asc',
							__( 'Descending', 'CURLYTHEME' ) => 'desc'
						),
						'group' => __( 'Order', 'CURLYTHEME' )
					),
				)
			) );
			
		}
		
		/** Recent News Shortcode */
		public function recent_news( $atts, $content = null ) {
			
			$atts = shortcode_atts( array(
				'title' => null,
				'before_posts'	=> null,
				'after_posts'	=> null,
				'display_posts' => 5,
				'display_title' => false,
				'display_author' => false,
				'display_image'  => false,
				'display_date'	=> false,
				'display_date_format' => 'F j, Y',
				'display_excerpt' => false,
				'filter_category' => false,
				'filter_tag' => false,
				'filter_categories' => '',
				'filter_tags' => '',
				'filter_sticky' => 'all',
				'order_by' => 'date',
				'order' => 'asc'
				
			), $atts, 'curly_recent_news' );
			
			extract( $atts );
			
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $display_posts,
				'orderby' => $order_by,
				'order' => ucwords( $order )
			);
			
			if( filter_var( $filter_category, FILTER_VALIDATE_BOOLEAN ) && ! empty( $filter_categories ) )
				$args['cat'] = $filter_categories;
			
			if( filter_var( $filter_tag, FILTER_VALIDATE_BOOLEAN ) && ! empty( $filter_tags ) )
				$args['cat'] = $filter_tags;
			
			switch( $filter_sticky ){
				
				case 'sticky_only' : $args['post__in'] = get_option( 'sticky_posts' );
				case 'sticky_hide' : $args['post__not_in'] = get_option( 'sticky_posts' );
				
			}	
			
			
			$recent_posts = new WP_Query( $args);
			
			ob_start();
			
			if ( $recent_posts->have_posts() ) {
				
				if( ! is_null( $title ) ) 
					echo "<h2>$title</h2>";
				
				if( ! is_null( $before_posts ) ) 
					echo "<p>$before_posts</p>";
					
				echo '<ul class="ct-vc-recent-news">';
				
				while ( $recent_posts->have_posts() ) {
					
					$recent_posts->the_post();
					
					?>
					
					<li <?php post_class( 'ct-vc-recent-news-post' ); ?>>
						<?php if( filter_var( $display_image, FILTER_VALIDATE_BOOLEAN ) ) : ?><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_post_thumbnail( 'thumbnail' ) ?></a><?php endif; ?>
						<div class="ct-vc-recent-news-post__title-meta">
							<?php if( filter_var( $display_title, FILTER_VALIDATE_BOOLEAN ) ) : ?><?php the_title( '<h3 class="ct-vc-recent-news-post__title"><a href="'.get_the_permalink().'" title="'. get_the_title().'">', '</a></h3>' ); ?><?php endif; ?>
							<div class="ct-vc-recent-news-post__meta">
								<?php if( filter_var( $display_date, FILTER_VALIDATE_BOOLEAN ) ) : ?><span class="ct-vc-recent-news-post__date"><i class="ti-time"></i><?php echo get_the_date( $display_date_format, get_the_id() ) ?></span><?php endif; ?>
								<?php if( filter_var( $display_author, FILTER_VALIDATE_BOOLEAN ) ) : ?><span class="ct-vc-recent-news-post__author"><?php _e( 'Author: ', 'CURLYADDONS' ); echo get_the_author() ?></span><?php endif; ?>
							</div>
						</div>
						<?php if( filter_var( $display_excerpt, FILTER_VALIDATE_BOOLEAN ) ) : ?><div class="ct-vc-recent-news-post__excerpt"><?php the_excerpt() ?></div><?php endif; ?>
					</li>
					
					<?php
					
				}
				
				echo '</ul>';
				
				if( ! is_null( $after_posts ) ) 
					echo "<p>$after_posts</p>";
				
			} else {
				
				// no posts found
				
			}
			
			/* Restore original Post Data */
			wp_reset_postdata();
			
			return ob_get_clean();
			
			
			/*
			if( ! wp_script_is( 'curly-polaroids', 'enqueued' ) )
				wp_enqueue_script( 'curly-polaroids' );
			
				
			
			$atts = shortcode_atts( array(
				'title' => null,
				'images'=> null
			), $atts, 'curly_polaroids' );
			
			$html = null;
			
			if( $atts['images'] ){
				$html .= "<section id='photostack-1' class='photostack photostack-perspective photostack-transition'><div>";
				
				$images = explode( ',', $atts['images'] );
				
				foreach( $images as $image ){
					$html .= "<figure data-dummy>";
					$html .= "<a href='#' class='photostack-img'>" . wp_get_attachment_image( $image, 'medium' ) . '</a>';
					$html .= "<figcaption><h2 class='photostack-title'>" . get_the_title( $image ) . "</h2></figcaption>";
					$html .= "</figure>";
				}
				
				$html .= do_shortcode( $content );
				$html .= "</div></section>";	
			}
			
			return $html;*/
		}
		
		
	}
	
	new CurlyVCRecentNews();
	
?>