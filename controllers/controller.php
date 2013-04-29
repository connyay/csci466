<?php
/********************************************************************
CSCI 466 - Assignment 9 - Semester Spring 2013

Progammer: Group 5
Date Due:  April 26th, 2013

Purpose: Base controller class. Used to connect model and view to
		 controller.
*********************************************************************/

class Controller {
	protected $_model;
	protected $_controller;
	protected $_action;
	protected $_view;
	protected $_modelBaseName;

	public function __construct( $model, $action ) {
		$this->_controller = ucwords( __CLASS__ );
		$this->_action = $action;
		$this->_modelBaseName = $model;

		$this->_view = new View( HOME . DS . 'views' . DS . strtolower( $this->_modelBaseName ) . DS . $action . '.php' );
	}

	protected function _setModel( $modelName ) {
		$this->_model = new $modelName();
	}

	protected function _setView( $viewName ) {
		$this->_view = new View( HOME . DS . 'views' . DS . strtolower( $this->_modelBaseName ) . DS . $viewName . '.php' );
	}

	public function model() {
		return $this->_model;
	}
}
