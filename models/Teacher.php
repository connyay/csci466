<?php
/********************************************************************
CSCI 466 - Assignment 9 - Semester Spring 2013

Progammer: Group 5
Date Due:  May 5th, 2013

Purpose: Gets data from database about teachers.
*********************************************************************/

class Teacher extends Model
{
	private $_name;

	private $_discipline;

	public function setName( $name ) {
		$this->_name = $name;
	}

	public function setDiscipline( $discipline ) {
		$this->_discipline = $discipline;
	}
	public function getTeachers() {
		$sql = "SELECT
					t.id,
					t.name,
					t.discipline_id,
					d.discipline
				FROM
					teacher t
				LEFT JOIN
					discipline d on d.id = t.discipline_id
				ORDER BY d.discipline DESC, t.name ASC;";

		$this->_setSql( $sql );
		$teachers = $this->getAll();

		if ( empty( $teachers ) ) {
			return false;
		}

		foreach ( $teachers as &$teacher ) {
			// Find classes for teacher
			$class = new Course;
			$teacher["classes"] = $class->getClassesForTeacher( $teacher['id'] );
		}

		return $teachers;
	}
	public function getTeacherForClass( $id ) {
		$sql = "SELECT
					t.id,
					t.name,
					t.discipline_id,
					d.discipline
				FROM
					teacher t
				LEFT JOIN
					discipline d on d.id = t.discipline_id
				WHERE
					t.id = ?";

		$this->_setSql( $sql );
		$teacherDetails = $this->getRow( array( $id ) );


		return $teacherDetails;
	}
	public function getDisciplines() {
		$sql = "SELECT
					*
				FROM
					discipline d;";

		$this->_setSql( $sql );
		$disciplines = $this->getAll();

		return $disciplines;
	}
	public function getTeacherById( $id ) {
		$sql = "SELECT
					t.id,
					t.name,
					t.discipline_id,
					d.discipline
				FROM
					teacher t
				LEFT JOIN
					discipline d on d.id = t.discipline_id
				WHERE
					t.id = ?";

		$this->_setSql( $sql );
		$teacherDetails = $this->getRow( array( $id ) );

		if ( empty( $teacherDetails ) ) {
			return false;
		}
		$class = new Course;
		$teacherDetails["classes"] = $class->getClassesForTeacher( $teacherDetails['id'] );

		return $teacherDetails;
	}

	public function store() {
		$sql = "INSERT INTO teacher
					(name,discipline_id)
 				VALUES
 					(?,?)";

		$data = array(
			$this->_name,
			$this->_discipline
		);

		$sth = $this->_db->prepare( $sql );
		$sth->execute( $data );
		return $this->_db->lastInsertId(); 
	}
	public function update() {
		$sql = "UPDATE teacher
					SET name=?, discipline_id=?
 				WHERE
 					id=?";

		$data = array(
			$this->_name,
			$this->_discipline,
			$this->_id
		);

		$sth = $this->_db->prepare( $sql );
		return $sth->execute( $data );
	}
	public function delete() {
		$sql = "DELETE FROM teacher
 				WHERE
 					id=?";

		$data = array(
			$this->_id
		);

		$sth = $this->_db->prepare( $sql );
		$sth->execute( $data );

		header( 'Location: index.php?r=teacher' );
	}

}
