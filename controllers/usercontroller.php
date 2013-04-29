<?php
/********************************************************************
CSCI 466 - Assignment 9 - Semester Spring 2013

Progammer: Group 5
Date Due:  April 26th, 2013

Purpose: Routes user actions.
*********************************************************************/

class UserController extends Controller
{
	// Some quality security right here... /sarcasm
	private $_userName = "admin";
	private $_password = "password";

	public function __construct( $model, $action ) {
		parent::__construct( $model, $action );
	}
	
	// Displays a login form, or sets the user to logged in
	public function login() {

		if ( !isset( $_POST['loginForm'] ) ) {
			$this->_view->set( 'title', 'Login' );
			return $this->_view->output();
		}

		if ( $_POST["username"] == $this->_userName && $_POST["password"] == $this->_password ) {
			setcookie( "loggedin", 'true', time()+43200, "/" );
			header( 'Location: index.php' );
		} else {
			$errors = array();
			array_push( $errors, "Username or Password did not match" );
			$this->_view->set( 'title', 'Login' );
			$this->_view->set( 'errors', $errors );
			return $this->_view->output();
		}
	}
	// Clears the loggedin cookie
	public function logout() {
		setcookie( "loggedin", 'false', 1, "/" );
		header( 'Location: index.php' );
	}
}
