<?php
/********************************************************************
CSCI 466 - Assignment 9 - Semester Spring 2013

Progammer: Group 5
Date Due:  May 5th, 2013

Purpose: Routes course actions.
*********************************************************************/

class CourseController extends Controller
{
	public function __construct( $model, $action ) {
		parent::__construct( $model, $action );
		$this->_setModel( $model );
	}
	// displays the list of classes 
	public function index() {
		try {

			$classes = $this->_model->getClasses();
			$this->_view->set( 'classes', $classes );
			$this->_view->set( 'title', 'Available Classes' );

			return $this->_view->output();

		} catch ( Exception $e ) {
			echo '<h1>Application error:</h1>' . $e->getMessage();
		}
	}
	// Used to create a new class
	public function create() {

		$teachers = $this->_model->getTeachers();
		$this->_view->set( 'newRecord', true );
		$this->_view->set( 'title', 'Class Create Form' );
		$this->_view->set( 'teachers', $teachers );
		if ( isset( $_GET['teacher'] ) ) {
			$this->_view->set( 'teacher_id', $_GET['teacher'] );
		}
		return $this->_view->output();
	}
	// Update the given class
	public function update( $classID ) {
		$class = $this->_model->getClassById( (int)$classID );

		if ( $class ) {
			$teachers = $this->_model->getTeachers();
			$this->_view->set( 'newRecord', false );
			$this->_view->set( 'formData', $class );
			$this->_view->set( 'title', 'Class Update Form' );
			$this->_view->set( 'teachers', $teachers );
			return $this->_view->output();
		}
	}
	// Deletes given class
	public function delete( $classID ) {
		$teacher = new Course();
		$teacher->setId( $classID );
		$teacher->delete();
	}
	// Views the given class
	public function view( $classID ) {
		// No ID provided... Display index
		if ( !$classID ) {
			header( 'Location: index.php?r=course/index' );
		}
		try {

			$class = $this->_model->getClassById( (int)$classID );

			if ( $class ) {
				$this->_view->set( 'title', $class['name'] );
				$this->_view->set( 'id', $class['id'] );
				$this->_view->set( 'name', $class['name'] );
				$this->_view->set( 'class', $class );
			}
			else {
				$this->_view->set( 'title', 'Invalid class ID' );
				$this->_view->set( 'noclass', true );
			}

			return $this->_view->output();

		} catch ( Exception $e ) {
			echo '<h1>Application error:</h1>' . $e->getMessage();
		}
	}
	// Saves the newly created or updated class
	public function save( $classID ) {
		if ( !isset( $_POST['classFormSubmit'] ) ) {
			header( 'Location: index.php?r=course/create' );
		}

		$errors = array();
		$check = true;

		$name = isset( $_POST['name'] ) ? trim( $_POST['name'] ) : NULL;
		$teacher_id = isset( $_POST['teacher_id'] ) ? trim( $_POST['teacher_id'] ) : NULL;
		$desc = isset( $_POST['description'] ) ? trim( $_POST['description'] ) : NULL;
		$enrollment_cap = isset( $_POST['enrollment_cap'] ) ? trim( $_POST['enrollment_cap'] ) : NULL;
		$meetingdays = isset( $_POST['meetingdays'] ) ? trim( $_POST['meetingdays'] ) : NULL;
		$cost = ( isset( $_POST['cost'] ) &&  ( strlen( trim( $_POST['cost'] ) ) > 0 ) ) ? trim( $_POST['cost'] ) : "Free";
		$room = isset( $_POST['room'] ) ? trim( $_POST['room'] ) : NULL;
		$duration = isset( $_POST['duration'] ) ? trim( $_POST['duration'] ) : NULL;
		if ( empty( $name ) ) {
			$check = false;
			array_push( $errors, "Name is required!" );
		}
		if ( empty( $room ) ) {
			$check = false;
			array_push( $errors, "Room is required!" );
		}
		if ( empty( $enrollment_cap ) ) {
			$check = false;
			array_push( $errors, "Enrollment Cap is required!" );
		}

		if ( !$check ) {
			$this->_setView( 'create' );
			$teachers = $this->_model->getTeachers();
			$this->_view->set( 'title', 'Invalid form data!' );
			$this->_view->set( 'errors', $errors );
			$this->_view->set( 'teachers', $teachers );
			if ( $classID ) {
				$this->_view->set( 'newRecord', false );
				$_POST['id'] = $classID;
			} else {
				$this->_view->set( 'newRecord', true );
			}
			$this->_view->set( 'formData', $_POST );
			return $this->_view->output();
		}

		try {
			$class = new Course();
			$class->setName( $name );
			$class->setTeacherID( $teacher_id );
			$class->setEnrollmentCap( $enrollment_cap );
			$class->setDesc( $desc );
			$class->setCost( $cost );
			$class->setRoom( $room );
			$class->setDuration( $duration );
			$class->setMeetingDays( $meetingdays );

			// We are updating a class
			if ( $classID ) {
				$class->setId( $classID );
				$class->update();
			}
			// We are making a new class
			else {
				$classID = $class->store();
			}
			header( 'Location: index.php?r=course/view/' . $classID );
		} catch ( Exception $e ) {
			echo $e->getMessage();
			die();
			$this->_setView( 'index' );
			$this->_view->set( 'title', 'There was an error saving the data!' );
			$this->_view->set( 'formData', $_POST );
			$this->_view->set( 'saveError', $e->getMessage() );
		}
		return $this->_view->output();
	}
}
