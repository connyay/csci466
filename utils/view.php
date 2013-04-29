∏<?php
/********************************************************************
CSCI 466 - Assignment 9 - Semester Spring 2013

Progammer: Group 5
Date Due:  April 26th, 2013

Purpose: Sets data for view file, and includes requested view.
*********************************************************************/

class View {
	protected $_file;
	protected $_data = array();

	public function __construct( $file ) {
		$this->_file = $file;
	}

	public function set( $key, $value ) {
		$this->_data[$key] = $value;
	}

	public function get( $key ) {
		return $this->_data[$key];
	}

	public function output() {
		if ( !file_exists( $this->_file ) ) {
			throw new Exception( "View " . $this->_file . " doesn't exist." );
		}

		extract( $this->_data );
		include $this->_file;
	}
}
