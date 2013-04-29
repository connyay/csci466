<?php
/********************************************************************
CSCI 466 - Assignment 9 - Semester Spring 2013

Progammer: Group 5
Date Due:  April 26th, 2013

Purpose: Gets data from database about courses.
*********************************************************************/

class Course extends Model
{
	private $_name;
	private $_teacher_id;
	private $_desc;
	private $_enrollment_cap;
	private $_meeting_days;
	private $_cost;
	private $_room;
	private $_duration;

	public function setName( $name ) {
		$this->_name = $name;
	}
	public function setTeacherID( $teacher_id ) {
		$this->_teacher_id = $teacher_id;
	}
	public function setDesc( $desc ) {
		$this->_desc = $desc;
	}
	public function setEnrollmentCap( $enrollment_cap ) {
		$this->_enrollment_cap = $enrollment_cap;
	}
	public function setMeetingDays( $meetingdays ) {
		$this->_meeting_days = $meetingdays;
	}
	public function setCost( $cost ) {
		$this->_cost = $cost;
	}
	public function setRoom( $room ) {
		$this->_room = $room;
	}
	public function setDuration( $duration ) {
		$this->_duration = $duration;
	}
	public function getTeachers() {
		$teacher = new Teacher;
		return $teacher->getTeachers();
	}
	public function getClasses( $onlyOpen = false ) {
		$sql = "SELECT *,
				(SELECT COUNT(*)
				FROM
				    enrollment e
				WHERE
				    e.class_id = c.id and e.status_id <> 2) as curr_enroll
				FROM class c
				ORDER BY c.name ASC;";
		if ( $onlyOpen ) {
			$sql .= " HAVING curr_enroll < enrollment_cap;";
		} else {
			$sql .= ";";
		}

		$this->_setSql( $sql );
		$classes = $this->getAll();

		if ( empty( $classes ) ) {
			return false;
		}

		foreach ( $classes as &$class ) {
			// Find teacher for each class
			$teacher = new Teacher;
			$class["teacher"] = $teacher->getTeacherForClass( $class['teacher_id'] );
		}
		return $classes;
	}
	public function getClassesForTeacher( $teacherID ) {
		$sql = "SELECT *,
				(SELECT COUNT(*)
				FROM
				    enrollment e
				WHERE
				    e.class_id = c.id and e.status_id <> 2) as curr_enroll
				FROM class c
				WHERE c.teacher_id = $teacherID
				ORDER BY c.name ASC;";

		$this->_setSql( $sql );
		$classes = $this->getAll();

		return $classes;
	}
	public function getClassById( $id ) {
		$sql = "SELECT *,
				(SELECT COUNT(*)
				FROM
				    enrollment e
				WHERE
				    e.class_id = c.id and e.status_id <> 2) as curr_enroll
				FROM class c
				WHERE
					c.id = ?";

		$this->_setSql( $sql );
		$classDetails = $this->getRow( array( $id ) );

		if ( empty( $classDetails ) ) {
			return false;
		}
		$teacher = new Teacher;
		$classDetails["teacher"] = $teacher->getTeacherForClass( $classDetails['teacher_id'] );

		return $classDetails;
	}

	public function store() {
		$sql = "INSERT INTO class
					(name,teacher_id, description, enrollment_cap, meetingdays, cost, room, duration)
 				VALUES
 					(?,?,?,?,?,?,?,?)";

		$data = array(
			$this->_name,
			$this->_teacher_id,
			$this->_desc,
			$this->_enrollment_cap,
			$this->_meeting_days,
			$this->_cost,
			$this->_room,
			$this->_duration
		);

		$sth = $this->_db->prepare( $sql );
		return $sth->execute( $data );
	}
	public function update() {
		$sql = "UPDATE class
					SET name=?, teacher_id=?, description=?, enrollment_cap=?, meetingdays=?, cost=?, room=?, duration=?
 				WHERE
 					id=?";

		$data = array(
			$this->_name,
			$this->_teacher_id,
			$this->_desc,
			$this->_enrollment_cap,
			$this->_meeting_days,
			$this->_cost,
			$this->_room,
			$this->_duration,
			$this->_id
		);

		$sth = $this->_db->prepare( $sql );
		return $sth->execute( $data );
	}
	public function delete() {
		$sql = "DELETE FROM class
 				WHERE
 					id=?";

		$data = array(
			$this->_id
		);

		$sth = $this->_db->prepare( $sql );
		$sth->execute( $data );

		header( 'Location: index.php?r=course' );
	}

}
