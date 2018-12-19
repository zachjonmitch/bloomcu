<?php
/*
* -----------------
* BloomCU Personalization
* Template: Homepage Hero
* -----------------
*/
if ( function_exists( 'acf_add_options_page' ) ) {

    acf_add_options_sub_page ( array (
        'page_title' 	=> 'Persona',
        'menu_title' 	=> 'Persona',
        'menu_slug' 	=> 'persona-settings',
        'parent_slug'	=> 'website-options',
	));
	

}


function get_Personas() {

    //Persona Status 
    $persona_status = get_field('enable_persona', 'options');
    echo '
    <script>var blm_persona_status='.($persona_status == true ?"true":"false").'</script>
    ';
    
	//Login trigger

	// $login_trigger = get_field('login_trigger', 'options');
	// if ($login_trigger) {
	// 	echo '<script> var loginerTriggers = document.getElementsByClassName("'.$login_trigger.'"); </script>';
	// } else {
	// 	echo '<script> var loginerTriggers = document.getElementsByClassName("login-trigger"); </script>';		
	// }

	/*
	* ------------------------------------------------------------------------------
	* Trigger Pages
	* ------------------------------------------------------------------------------
	*
	* Here we set the pages which trigger a users interest to be set
	* This array object is evaluated by isGoalPage() in persona.js
	* Each array key (e.g., autoLoan) holds trigger page slugs
	*
	*/
	
	// Get Persona Goals
	$personaSets = persona_Triggers();
	
	//render js variable for persona js
	echo '<script> var blm_triggerPages = '. json_encode($personaSets) .';
				//console.log(blm_triggerPages);
		</script>';

	/*
	* ------------------------------------------------------------------------------
	* Impressions: If a user viewed a persona
	* ------------------------------------------------------------------------------
	*/
	$impression_tracking = get_field('impression_tracking', 'options');

	if( $impression_tracking ) {
		echo '<script> var impressions = true; </script>';
	} else {
		echo '<script> var impressions = false; </script>';		
	}
	/*
	* ------------------------------------------------------------------------------
	* A/B Test
	* ------------------------------------------------------------------------------
	*
	* Here we enable/disable split testing for this client
	* If enabled, a 50/50 con flip determines if the
	* persona will be set as active, or inactive
	*
	*/
	
	// Persona split testing settings
	$split_testing = get_field('split_testing', 'options');

	if( $split_testing ) {
		
		echo '<script> var blm_splitTest = true; </script>';
	} else {
		echo '<script> var blm_splitTest = false; </script>';
	}
	
}

add_action('wp_footer', 'get_Personas');

if ( ! function_exists( 'persona_Triggers' ) ) {
	
	function persona_Triggers() {	
	
		$active_persona = (object)array();
		// Init persona content variables
		if ( have_rows( 'personas', 'options' ) ) {				
			
			// Loop through the rows of data
			while ( have_rows( 'personas', 'options' ) ) : the_row();

				//get persona variable set		
				$persona = get_sub_field( 'persona' );		

				if ( !empty($persona) ) {	

				//get trigger pages
				if ($persona === 'login') {
					//bypass loop error
					$trigger_pages = array(); 

				} else {				
					$trigger_pages = get_sub_field('trigger_pages');
				}

				//pages array
				$pages = null;

				foreach( $trigger_pages as $post) {
					
					$pages[] = $post->post_name;
				}

				$active_persona->$persona = $pages;
			}
				

			endwhile;
		}
		
		return $active_persona; 

	} // persona_Triggers()
} // function_exists()

if ( ! function_exists( 'personalization' ) ) {
	
		function personalization() {
	
			if ( is_front_page() ) {
				
				// Read user interest persona cookie
				$blm_user = getCookie("blm_user");
				
				//if blm_user is inactive set to nothing
				if (strpos($blm_user, 'inactive') !== false) {
					$blm_user = '';
				}
			
				// Read user loginer persona cookie
				$blm_loginer = getCookie("blm_loginer");

				
	
				// If user cookie exists, continue
				if ( isset( $blm_user ) || isset( $blm_loginer ) ) {
					// var_dump($blm_loginer);
					// Init persona content variables
					if ( have_rows( 'personas', 'options' ) ) {
						$count = 0;
	
						// Loop through the rows of data
						while ( have_rows( 'personas', 'options' ) ) : the_row();
	
							// Set row goal
							$persona = get_sub_field( 'persona' );

							if ($persona === 'login'){ 
								$login_props = array(
									'persona_name'      => get_sub_field( 'persona' ),
									'template'      	=> get_sub_field( 'template' ),
									'hero_image'        => get_sub_field( 'hero_image' ),  
									'message'           => get_sub_field( 'message' ),
									'persona_blog'        => get_sub_field( 'persona_blog' ),
								);
					
							}  
							 
							// If goal matches users persona
							if( $persona == $blm_user) {
								// Set personalization content properties
								$props = array(
									'persona_name'      => get_sub_field('persona' ),
									'template'      	=> get_sub_field('template' ),
									'hero_image'        => get_sub_field('hero_image' ),
									'message'           => get_sub_field('message' ),
									'message_attribute' => get_sub_field('message_attribute' ),
									'button_text'       => get_sub_field('button_text' ),
									'button_url'        => get_sub_field('button_url' ), 
								);

								$data_props['page'] = $props;

								if( !empty( $login_props ) ){

									$data_props['login'] = $login_props;
								}
								
								
								return $data_props;

							} elseif( empty($blm_user) && $blm_loginer ) { 
	
								// Set personalization content properties
															
								$props['login'] = array(
									'persona_name'      => get_sub_field( 'persona' ),
									'template'      	=> get_sub_field( 'template' ),
									'hero_image'        => get_sub_field( 'hero_image' ),  
									'message'           => get_sub_field( 'message' ),
									'persona_blog'        => get_sub_field( 'persona_blog' ),
								);
	
								// Return these properties to our template
								return $props;
							}
	
							$count++;
	
						endwhile;
					}
	
				} // if ( $blm_user != undefined )
			} // is_front_page()
		} // personalization()
	} // function_exists()
