<?php
/********************************************************************
CSCI 466 - Assignment 9 - Semester Spring 2013

Progammer: Group 5
Date Due:  April 26th, 2013

Purpose: Base model class. Inits database and used to set queries.
*********************************************************************/

class Model {
	protected $_db;
	protected $_sql;
	protected $_id;

	public function __construct() {
		$this->_db = Db::init();
	}

	protected function _setSql( $sql ) {
		$this->_sql = $sql;
	}
	public function setId( $id ) {
		$this->_id = $id;
	}

	public function getAll( $data = null ) {
		if ( !$this->_sql ) {
			throw new Exception( "No SQL query!" );
		}

		$sth = $this->_db->prepare( $this->_sql );
		$sth->execute( $data );
		return $sth->fetchAll();
	}

	public function getRow( $data = null ) {
		if ( !$this->_sql ) {
			throw new Exception( "No SQL query!" );
		}

		$sth = $this->_db->prepare( $this->_sql );
		$sth->execute( $data );
		return $sth->fetch();
	}
}
