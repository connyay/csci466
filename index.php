<?php
/********************************************************************
CSCI 466 - Assignment 9 - Semester Spring 2013

Progammer: Group 5
Date Due:  April 26th, 2013

Purpose: Responsible for starting the bootstrap, and automatically
		 loading all classes as needed.
*********************************************************************/

define( 'DS', DIRECTORY_SEPARATOR );
define( 'HOME', dirname( __FILE__ ) );

require_once HOME . DS . 'utils' . DS . 'bootstrap.php';

function __autoload( $class ) {
	if ( file_exists( HOME . DS . 'utils' . DS . strtolower( $class ) . '.php' ) ) {
		require_once HOME . DS . 'utils' . DS . strtolower( $class ) . '.php';
	}
	else if ( file_exists( HOME . DS . 'models' . DS . ucwords( $class ) . '.php' ) ) {
			require_once HOME . DS . 'models' . DS . ucwords( $class ) . '.php';
		}
	else if ( file_exists( HOME . DS . 'controllers' . DS . strtolower( $class ) . '.php' ) ) {
			require_once HOME . DS . 'controllers'  . DS . strtolower( $class ) . '.php';
		}
}
