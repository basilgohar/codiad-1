<?php

/*
*  Copyright (c) Codiad & Andr3as, distributed
*  as-is and without warranty under the MIT License. See
*  [root]/license.txt for more. This information must remain intact.
*/

require_once('../../common.php');
require_once('class.settings.php');

if ( ! isset( $_GET['action'] ) ) {
	
	die( formatJSEND( "error", "Missing parameter" ) );
}

//////////////////////////////////////////////////////////////////
// Verify Session or Key
//////////////////////////////////////////////////////////////////

checkSession();

$Settings = new Settings();

//////////////////////////////////////////////////////////////////
// Save User Settings
//////////////////////////////////////////////////////////////////

if ( $_GET['action'] == 'save') {
	
	if ( ! isset( $_POST['settings'] ) ) {
		
		die( formatJSEND( "error", "Missing settings" ) );
	}
	
	$Settings->username = $_SESSION['user'];
	$Settings->settings = json_decode( $_POST['settings'], true );
	$Settings->Save();
}
	
//////////////////////////////////////////////////////////////////
// Load User Settings
//////////////////////////////////////////////////////////////////

if ( $_GET['action'] == 'load' ) {
	
	$Settings->username = $_SESSION['user'];
	$Settings->Load();
}

if ( $_GET['action'] == 'get_option' ) {
	
	$Settings->username = $_SESSION['user'];
	$Settings->get_option( $_POST['option'], $_SESSION["user"], "exit" );
}

if ( $_GET['action'] == 'get_options' ) {
	
	$Settings->username = $_SESSION['user'];
	$Settings->get_options( "exit" );
}

if ( $_GET['action'] == 'update_option' ) {
	
	$Settings->username = $_SESSION['user'];
	$Settings->update_option( $_POST['option'], $_POST['value'], true );
}