<?php
/********************************************************************
CSCI 466 - Assignment 9 - Semester Spring 2013

Progammer: Group 5
Date Due:  April 26th, 2013

Purpose: Gets data from database about enrollments.
*********************************************************************/

class Enrollment extends Model
{
	private $_student;
	private $_class;
	private $_date;
	private $_status;

	public function setStudent( $student ) {
		$this->_student = $student;
	}
	public function setClass( $class ) {
		$this->_class = $class;
	}
	public function setDate( $date ) {
		$this->_date = $date;
	}
	public function setStatus( $status ) {
		$this->_status = $status;
	}
	public function getStudents() {
		$student = new Student;
		return $student->getStudents();
	}
	public function getClasses() {
		$class = new Course;
		return $class->getClasses( true );
	}
	public function getEnrollments() {

		$sql = "SELECT
				    e.id,
				    e.student_id,
				    e.class_id,
				    e.enroll_date,
				    e.status_id,
				    s.name as student_name,
				    c.name as class_name,
				    c.cost,
					e2.status
				FROM
				    enrollment e
				        JOIN
				    student s ON e.student_id = s.id
				        JOIN
				    class c ON e.class_id = c.id
						LEFT JOIN
					enrollment_status e2 ON e.status_id = e2.id
				ORDER BY e.class_id, s.name;";

		$this->_setSql( $sql );
		$enrollments = $this->getAll();

		if ( empty( $enrollments ) ) {
			return false;
		}

		return $enrollments;
	}
	public function getStatuses() {

		$sql = "SELECT * FROM enrollment_status e;";

		$this->_setSql( $sql );
		$statuses = $this->getAll();

		if ( empty( $statuses ) ) {
			return false;
		}
		return $statuses;
	}
	public function getEnrollmentsForClass( $id ) {

		$sql = "SELECT
					e.id,
				    e.student_id,
				    e.class_id,
				    e.enroll_date,
				    e.status_id,
				    s.name as student_name,
				    c.name as class_name,
				    c.cost,
					e2.status
				FROM
				   enrollment e
				   JOIN
				   student s ON e.student_id = s.id
				   JOIN
				   class c ON e.class_id = c.id
				   LEFT JOIN
					enrollment_status e2 ON e.status_id = e2.id
				   WHERE
				   e.class_id = ?;";

		$this->_setSql( $sql );
		$data = array(
			$id
		);
		$enrollments = $this->getAll( $data );

		if ( empty( $enrollments ) ) {
			return false;
		}

		return $enrollments;
	}
	public function getEnrollmentsForStudent( $id ) {

		$sql = "SELECT
					e.id,
				    e.student_id,
				    e.class_id,
				    e.enroll_date,
				    e.status_id,
				    s.name as student_name,
				    c.name as class_name,
				    c.cost,
					e2.status
				FROM
				   enrollment e
				   JOIN
				   student s ON e.student_id = s.id
				   JOIN
				   class c ON e.class_id = c.id
				   LEFT JOIN
					enrollment_status e2 ON e.status_id = e2.id
				   WHERE
				   e.student_id = ?;";

		$this->_setSql( $sql );
		$data = array(
			$id
		);
		$enrollments = $this->getAll( $data );

		if ( empty( $enrollments ) ) {
			return false;
		}

		return $enrollments;
	}
	public function getEnrollmentById( $id ) {
		$sql = "SELECT
					e.id,
				    e.student_id,
				    e.class_id,
				    e.enroll_date,
				    e.status_id,
				    s.name as student_name,
				    c.name as class_name,
				    c.cost,
					e2.status
				FROM
				   enrollment e
				        JOIN
				   student s ON e.student_id = s.id
				        JOIN
				   class c ON e.class_id = c.id
				   LEFT JOIN
					enrollment_status e2 ON e.status_id = e2.id
				   WHERE e.id = ?;";

		$this->_setSql( $sql );
		$enrollmentDetails = $this->getRow( array( $id ) );

		if ( empty( $enrollmentDetails ) ) {
			return false;
		}

		return $enrollmentDetails;
	}
	public function delete() {
		$sql = "DELETE FROM enrollment
 				WHERE
 					id=?";

		$data = array(
			$this->_id
		);

		$sth = $this->_db->prepare( $sql );
		$sth->execute( $data );

		header( 'Location: index.php?r=enrollment' );
	}
	public function store() {
		$sql = "INSERT INTO enrollment
					(student_id, class_id, enroll_date, status_id)
 				VALUES
 					(?, ?, ?, ?)";

		$data = array(
			$this->_student,
			$this->_class,
			$this->_date,
			$this->_status
		);

		$sth = $this->_db->prepare( $sql );
		return $sth->execute( $data );
	}
	public function update() {
		$sql = "UPDATE enrollment
					SET student_id=?, class_id=?, status_id=?
 				WHERE
 					id=?";

		$data = array(
			$this->_student,
			$this->_class,
			$this->_status,
			$this->_id
		);

		$sth = $this->_db->prepare( $sql );
		return $sth->execute( $data );
	}
}
