# WP-iMember360-Login

This repo introduces the hooks to login/logout in iMember360 Wordpress plugin.

## i4w_authenticated_login

### Usage:
This hook allows you to run your own code immediately after a user (either a local or an Infusionsoft-based subscriber) has authenticated during the login process.

### Parameters:
iMember360 will pass the following parameters to your action function:

#### $wp_user
is the standard WordPress user object for the person who just logged in.
#### $contact
is an array containing the contact record fields for the person who just logged in.


```bash
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
}
```