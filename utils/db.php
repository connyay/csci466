<?php
/********************************************************************
CSCI 466 - Assignment 9 - Semester Spring 2013

Progammer: Group 5
Date Due:  April 26th, 2013

Purpose: Connects to the database.
*********************************************************************/

class Db {
	private static $db;

	public static function init() {
		if ( !self::$db ) {
			try {
				$dsn = 'mysql:host=courses;dbname=cs566105;charset=UTF-8';
				self::$db = new PDO( $dsn, 'cs566105', 'YNWLrDYdL' );
				self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				self::$db->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
			} catch ( PDOException $e ) {
				die( 'Connection error: ' . $e->getMessage() );
			}
		}
		return self::$db;
	}
}
