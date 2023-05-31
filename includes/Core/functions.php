<?php

function filter( $data ) {
	return htmlspecialchars( $data, ENT_QUOTES, 'UTF-8' );
}

function loggedIn() {
	if ( isset( $_SESSION[ 'id' ] ) ) {
		return true;
	}
	return false;
}

function processForms() {
	global $conn;
	// Login
	$error = false;
	$_SESSION[ 'error' ] = $error;

	if ( ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) && ( isset( $_POST[ 'login' ] ) ) ) {
		if ( !empty( $_POST[ 'Username' ] ) ) {
			if ( !empty( $_POST[ 'Password' ] ) ) {
				ambientUser::login( $_POST[ 'Username' ], $_POST[ 'Password' ] );
				if ( loggedIn() )header( 'Location: /me' );
			} else {
				$error = true;
				$emessage = '%empty_pass%';
				$_SESSION[ 'error' ] = $error;
				$_SESSION[ 'emessage' ] = $emessage;

			}
		} else {
			$error = true;
			$emessage = '%empty_user%';
			$_SESSION[ 'error' ] = $error;
			$_SESSION[ 'emessage' ] = $emessage;
		}
	} else {
		$error = false;
		$_SESSION[ 'error' ] = $error;
	}

}
