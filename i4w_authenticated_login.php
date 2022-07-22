<?php
function my_i4w_authenticated_login($wp_user, $contact) {
  // Sending an Email to logged in user
	$to = $wp_user->email;

	$subject = 'Login Notification';

	$body = 'Dear ' . $wp_user->user_niceaname . '.\n';
	$body .= 'You are logged in successfully.\n';

	$headers = array('Content-Type: text/html; charset=UTF-8');
	 
	wp_mail( $to, $subject, $body, $headers );

	// Updating contact record to reflect the login
	$contact->i4w_db_LastUpdated = date('Y-m-d H:i:s');
}
add_action('i4w_authenticated_login', 'my_i4w_authenticated_login',10,2);