<?php
/********************************************************************
CSCI 466 - Assignment 9 - Semester Spring 2013

Progammer: Group 5
Date Due:  May 5th, 2013

Purpose: Routes student actions.
*********************************************************************/

class StudentController extends Controller
{
	public function __construct( $model, $action ) {
		parent::__construct( $model, $action );
		$this->_setModel( $model );
	}

	public function index() {
		try {

			$students = $this->_model->getStudents();
			$this->_view->set( 'students', $students );
			$this->_view->set( 'title', 'Registered Students' );

			return $this->_view->output();

		} catch ( Exception $e ) {
			echo '<h1>Application error:</h1>' . $e->getMessage();
		}
	}
	public function create() {
		$this->_view->set( 'title', 'Student Create Form' );
		$this->_view->set( 'newRecord', true );
		return $this->_view->output();
	}
	public function delete( $studentID ) {
		$student = new Student();
		$student->setId( $studentID );
		$student->delete();
	}
	public function view( $studentID ) {
		// No ID provided... Display index
		if ( !$studentID ) {
			header( 'Location: index.php?r=student/index' );
		}
		try {

			$student = $this->_model->getStudentById( (int)$studentID );

			if ( $student ) {
				$this->_view->set( 'title', $student['name'] );
				$this->_view->set( 'student', $student );
			}
			else {
				$this->_view->set( 'title', 'Invalid student ID' );
				$this->_view->set( 'noStudent', true );
			}

			return $this->_view->output();

		} catch ( Exception $e ) {
			echo '<h1>Application error:</h1>' . $e->getMessage();
		}
	}
	public function update( $studentID ) {
		$student = $this->_model->getStudentById( (int)$studentID );
		if ( $student ) {
			$this->_view->set( 'newRecord', false );
			$this->_view->set( 'formData', $student );
			$this->_view->set( 'title', 'Student Update Form' );
			return $this->_view->output();
		}
	}
	public function save( $studentID ) {
		if ( !isset( $_POST['studentFormSubmit'] ) ) {
			header( 'Location: index.php?r=student/create' );
		}

		$errors = array();
		$check = true;

		$name = isset( $_POST['name'] ) ? trim( $_POST['name'] ) : NULL;

		if ( empty( $name ) ) {
			$check = false;
			array_push( $errors, "Name is required!" );
		}

		if ( !$check ) {
			$this->_setView( 'create' );
			$this->_view->set( 'title', 'Invalid form data!' );
			$this->_view->set( 'errors', $errors );
			if ( $studentID ) {
				$this->_view->set( 'newRecord', false );
				$_POST['id'] = $studentID;
			} else {
				$this->_view->set( 'newRecord', true );
			}
			$this->_view->set( 'formData', $_POST );
			return $this->_view->output();
		}

		try {

			$student = new Student();
			$student->setName( $name );

			// We are updating a student
			if ( $studentID ) {
				$student->setId( $studentID );
				$student->update();
			}
			// We are making a new student
			else {
				$studentID = $student->store();
			}
			header( 'Location: index.php?r=student/view/' . $studentID );

		} catch ( Exception $e ) {
			$this->_setView( 'index' );
			$this->_view->set( 'title', 'There was an error saving the data!' );
			$this->_view->set( 'formData', $_POST );
			$this->_view->set( 'saveError', $e->getMessage() );
		}

		return $this->_view->output();
	}
}
