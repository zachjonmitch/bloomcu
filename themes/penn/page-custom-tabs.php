<?php
/**
 * Template Name: Custom Tabs
 *
 * @package Base
 */

get_header();

//Configurations
$showHero = get_field('show_hero');
$enableTabs = get_field('enable_tabs');
$tabs = get_field('tabs');
$tab_count = 1;
$tab_nav = false;

display_custom_default_hero(); 

    while ( have_posts() ) : the_post(); 
?>

<article id="page-<?php the_ID(); ?>">
<?php if ( sizeof($tabs) > 1 ) { 
        $tab_nav = true; 
}
?>
<?php if ( !empty( get_the_content() )): ?>

<div class="g-l-wrapper full-width-comp <?php echo ( $tab_nav ? ' g-page-content' : ''); ?>">
    <div id="default-content" <?php post_class( 'wysiwyg-content' ); ?>>
        <?php the_content(); ?>
    </div>
</div>

<?php endif; ?>

<?php if( $enableTabs ): ?>
    <div class="c-tab-accordion <?php echo ( $tab_nav ? 'js-custom-tabs':'' );?>"> 
  
    <?php if( $tab_nav ): ?>
		
        <nav class="c-tab-accordion__tab-menu">
			<ul class="c-tab-accordion__tab-menu-list">
				<?php
					while ( have_rows('tabs') ) : the_row();
					
					// Create variables.
					$active = '';
					$aria   = '';
                    $hasPopup = '';

					// Assign the first tab values.
					if ( $tab_count === 1 ) {
						// $active = 'is-active';
                        $aria   = '';
                        $hasPopup = '';
					}
                    $tab_title = get_sub_field('tab_name');
                    $tab_title_link = strtolower(str_replace(' ', '-', $tab_title)); 
				?>
				<li id="panel-nav-<?php echo $tab_count; ?>" class="c-tab-accordion__tab-menu-item">
					<a href="#panel-<?php echo $tab_count; ?>" class="c-tab-accordion__button js-tab-trigger" aria-haspopup="true"><?php esc_html_e( $tab_title, 'base' ); ?></a>
				</li>
				<?php $tab_count++; ?>
				<?php endwhile;?>
				<?php wp_reset_postdata(); ?>				
			</ul>
		</nav>
    <?php endif; //show desktop nav ?>
        
        <ul id="tabs-body">
        <?php 
            $content = get_field('tabs');
            $tab_count = 1;		
            while ( have_rows('tabs') ) : the_row();
            
            $tab_title = get_sub_field('tab_name');
            $tab_content = get_sub_field( 'tab_content_row' );
            $tab_page_builder = get_sub_field( 'content_builder' );
            $tab_title_link = strtolower(str_replace(' ', '-', $tab_title));

            if ( $tab_content || $tab_page_builder ) :
                // Create variables.
                    $active = '';
                    $aria   = 'false';
                    $hasPopup = 'true';
                // Assign the first tab values.
                    if ( $tab_count === 1 ) {
                        $active = 'is-active';
                        $aria   = 'true';
                        $hasPopup = 'false';
                    } 
                ?>
                	<?php if( $tab_nav ): ?>
                    <li class="c-tab-accordion__item">   
                    					
                        <a href="#panel-<?php echo $tab_count; ?>" class="c-tab-accordion__button c-tab-accordion__button--accordion js-tab-accordion-button js-tab-trigger" aria-haspopup="true">
                            <?php esc_html_e( $tab_title, 'base' ); ?>
                            <!-- <span class="" aria-hidden="true"></span> -->
                            <span class="c-accordion__icon far fa-angle-right c-tab-accordion__trigger"></span> 
                        </a>
                        
                        <?php endif; //show mobile nav ?>
                        <div id="panel-<?php echo $tab_count; ?>" class="<?php echo $tab_nav ? 'c-tab-accordion__content js-tab-content':''; ?>">
                            
                            <?php

                            if ( get_sub_field('content_builder') ) :
                    
                                while ( have_rows('content_builder') ) : the_row();
                                    
                                    $panel = get_sub_field('panel_choice');

                                    switch ( $panel['value'] ) {
							
                                        case 'clayout':
                                                custom_layout_generator();
                                                break;
                                                
                                        case 'rtp':
                                                table_picker(get_sub_field( 'tables_picker' ));
                                                break;
                                        
                                        case 'acc':
                                                base_accordion_cloneupdated();	//accordion
                                                break;
                                                
                                        
                                        case 'table':
                                                base_table( get_sub_field('table') );
                                                break;

                                        case 'cout': 
                                                base_callout_group( get_sub_field('call_out') );
                                                break;          
                                                
                                        case 'lr': 
                                                base_display_left_right_repeater_clone();
                                                break;          
                                        
                                        case 'default': 
                                                echo '<div class="full-width-comp g-page-content g-l-wrapper wysiwyg-content">';
                                                the_sub_field('full_width_content');				//full wizzy
                                                echo '</div>';
                                                break;
                                    }
                                    
                                   ?>                       	                           
                                <?php endwhile; ?>                                
                            <?php endif; //End Content Builder ?>    
                        </div> <!-- .c-tab-accordion__content -->
                	<?php if( $tab_nav ): ?>
                    </li> <!-- .c-tab-accordion__item -->
                    <?php endif; ?>
                <?php endif; //End check if tab content exist?>
                <?php $tab_count++; ?>
            <?php endwhile; //End while have tabs ?>
        </ul> <!-- #tabs-body -->
    </div> <!-- .c-tab-accordion -->
    <?php
    //if enabled tabs == false
     else:  
        
        ?>

         <div class="c-single__content">
            <?php
            while ( have_rows('tabs') ) : the_row();

            if ( get_sub_field('content_builder') ) :
    
                while ( have_rows('content_builder') ) : the_row();
                    
                    $panel = get_sub_field('panel_choice');

                    switch ( $panel['value'] ) {
            
                        case 'clayout':
                                custom_layout_generator();
                                break;
                                
                        case 'rtp':
                                table_picker(get_sub_field( 'tables_picker' ));
                                break;
                        
                        case 'acc':
                                base_accordion_cloneupdated();	//accordion
                                break;
                                
                        
                        case 'table':
                                base_table( get_sub_field('table') );;
                                break;

                        case 'cout': 
                                base_callout_group( get_sub_field('call_out') );
                                break;          
                                
                        case 'lr': 
                                base_display_left_right_repeater_clone();
                                break;          
                        
                        case 'default': 
                                echo '<div class="full-width-comp g-page-content g-l-wrapper wysiwyg-content">';
                                the_sub_field('full_width_content');				//full wizzy
                                echo '</div>';
                                break;
                    }
                    
                    ?>                       	                           
                <?php endwhile; ?>                                
            <?php endif; //End Content Builder ?>    
            <?php endwhile; ?>                                
        </div> <!-- .c-single__content -->
    <?php endif; ?>
</article> <!--end of page-->
<?php
endwhile;
get_footer(); ?>