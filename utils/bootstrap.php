<?php
/********************************************************************
CSCI 466 - Assignment 9 - Semester Spring 2013

Progammer: Group 5
Date Due:  April 26th, 2013

Purpose: Routes to appropriate controller based on provided get
		 parameters.
*********************************************************************/

// Set default controller an action. Will be used if nothing is 
// provided in the query.
$controller = "course";
$action = "index";
$query = null;

if ( isset( $_GET['r'] ) ) {
	$params = array();
	$params = explode( "/", $_GET['r'] );

	$controller = ucwords( $params[0] );
	if ( isset( $params[1] ) && !empty( $params[1] ) ) {
		$action = $params[1];
	}
	if ( isset( $params[2] ) && !empty( $params[2] ) ) {
		$query = $params[2];
	}
}

$modelName = $controller;
$controller .= 'Controller';
$load = new $controller( $modelName, $action );

if ( method_exists( $load, $action ) ) {
	$load->{$action}( $query );
}
else {
	die( 'Invalid method. Please check the URL.' );
}
