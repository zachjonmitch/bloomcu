<?php
function custom_layout_generator() {
    if ( have_rows( 'row' ) ) :
        while ( have_rows( 'row' ) ) :
            the_row();
            ?>
            <div class="row custom-layout wysiwyg-content">
                <?php
                if ( have_rows( 'columns' ) ) :
                    while ( have_rows( 'columns' ) ) :
                        the_row();

                        $layout  = get_sub_field( 'layout_selector' );
                        $center  = get_sub_field( 'center_column' );
                        $content = get_sub_field( 'content' );
                        $content_double = get_sub_field( 'extra_content' );
                        $double_column = get_sub_field( 'double_column' );
                        $custom_css = get_sub_field( 'custom_css' );
                        // Add centered class.
                        $center  = $center ? 'full-centered' : '';
                        if (!$double_column) {
                        ?>
                        <div class="small-12 large-<?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $center ); ?> <?php echo $custom_css; ?> columns custom-layout-columns">
                            <?php echo $content; ?>
                        </div>
                        <?php
                        } else { ?> 
                            <div class="row <?php echo $custom_css; ?>">
                                <div class="small-12 large-6 columns col-1 custom-layout-columns">
                                    <?php echo $content; ?>
                                </div>
                                <div class="small-12 large-6 columns col-2 custom-layout-columns">
                                    <?php echo $content_double; ?>
                                </div>
                            </div>
                        <?php }

                    endwhile;
                endif;
                ?>
            </div>
            <?php
        endwhile;
    endif;
}
?>