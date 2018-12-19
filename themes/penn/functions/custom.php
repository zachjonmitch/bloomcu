<?php
/**
 * Custom
 *
 * @package Base
 */

/**
 * SMTP
 *
 * Overrides PHP mailer to send through SMTP.
 * Currently using MailGun.
 *
 * @author Rich Edmunds
 * @see    https://codex.wordpress.org/Plugin_API/Action_Reference/phpmailer_init
 * @see    https://www.mailgun.com/
 * @param  PHPMailer $phpmailer Object to set values.
 */
function base_phpmailer_smtp( PHPMailer $phpmailer ) {
	$phpmailer->isSMTP();
	$phpmailer->Host       = 'smtp.mailgun.org';
	$phpmailer->SMTPAuth   = true;
	$phpmailer->Port       = 465;
	$phpmailer->Username   = '{websitename}@mg.tenthmusedesign.com';
	$phpmailer->Password   = '{password}';
	$phpmailer->SMTPSecure = 'ssl'; // SSL or TLS.
	$phpmailer->From       = 'no-reply@' . $_SERVER['HTTP_HOST'];
	// $phpmailer->FromName   = '{Full Name}'; // Optional.
}

// add_action( 'phpmailer_init', 'base_phpmailer_smtp' );


/**
* Check for Empty Array, returns true if the array is not empty
* @author Paul Allen
* @see https://stackoverflow.com/questions/8328983/check-whether-an-array-is-empty
* @param Array
* @return boolean
*/

function base_check_for_empty_array( $array ) {
	if ( 'array' !== gettype( $array ) ) {
		return;
	}

	$filtered_array = array_filter( $array );

	if ( ! empty( $filtered_array ) ) {
		return true;
	}

	return false;
}


/**
 * Allowed HTML Tags
 * The html tags allowed from a wysiwyg editor.
 *
 * @example wp_kses( $content, base_allowed_tags() )
 * @author Rich Edmunds
 * @return array Array of allowed tags.
 */
function base_allowed_tags() {
	return array(
		'a' => array(
			'class' => array(),
			'href'  => array(),
			'rel'   => array(),
			'title' => array(),
		),
		'abbr' => array(
			'title' => array(),
		),
		'b' => array(),
		'blockquote' => array(
			'cite'  => array(),
		),
		'cite' => array(
			'title' => array(),
		),
		'code' => array(),
		'del' => array(
			'datetime' => array(),
			'title' => array(),
		),
		'dd' => array(),
		'div' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'dl' => array(),
		'dt' => array(),
		'em' => array(),
		'h1' => array(),
		'h2' => array(),
		'h3' => array(),
		'h4' => array(),
		'h5' => array(),
		'h6' => array(),
		'i' => array(),
		'iframe' => array(
			'src'             => array(),
			'height'          => array(),
			'width'           => array(),
			'frameborder'     => array(),
			'allowfullscreen' => array(),
		),
		'img' => array(
			'alt'    => array(),
			'class'  => array(),
			'height' => array(),
			'src'    => array(),
			'width'  => array(),
		),
		'li' => array(
			'class' => array(),
		),
		'ol' => array(
			'class' => array(),
		),
		'p' => array(
			'class' => array(),
		),
		'q' => array(
			'cite' => array(),
			'title' => array(),
		),
		'span' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'strike' => array(),
		'strong' => array(),
		'ul' => array(
			'class' => array(),
		),
	);
}
