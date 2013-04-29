<?php
/********************************************************************
CSCI 466 - Assignment 9 - Semester Spring 2013

Progammer: Group 5
Date Due:  April 26th, 2013

Purpose: Gets data from database about students.
*********************************************************************/

class Student extends Model
{
	private $_name;
	public function setName( $name ) {
		$this->_name = $name;
	}
	public function getStudents() {
		$sql = "SELECT
					s.id,
					s.name
				FROM
					student s
				ORDER BY s.name ASC;";

		$this->_setSql( $sql );
		$students = $this->getAll();

		if ( empty( $students ) ) {
			return false;
		}

		return $students;
	}

	public function getStudentById( $id ) {
		$sql = "SELECT
					s.id,
					s.name
				FROM
					student s
				WHERE
					s.id = ?";

		$this->_setSql( $sql );
		$studentDetails = $this->getRow( array( $id ) );

		if ( empty( $studentDetails ) ) {
			return false;
		}

		return $studentDetails;
	}

	public function store() {
		$sql = "INSERT INTO student
					(name)
 				VALUES
 					(?)";

		$data = array(
			$this->_name
		);

		$sth = $this->_db->prepare( $sql );
		return $sth->execute( $data );
	}
	public function update() {
		$sql = "UPDATE student
					SET name=?
 				WHERE
 					id=?";

		$data = array(
			$this->_name,
			$this->_id
		);

		$sth = $this->_db->prepare( $sql );
		return $sth->execute( $data );
	}
	public function delete() {
		$sql = "DELETE FROM student
 				WHERE
 					id=?";

		$data = array(
			$this->_id
		);
		$sth = $this->_db->prepare( $sql );
		$sth->execute( $data );

		header( 'Location: index.php?r=student' );
	}
}
