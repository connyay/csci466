<?php
/********************************************************************
CSCI 466 - Assignment 9 - Semester Spring 2013

Progammer: Group 5
Date Due:  April 26th, 2013

Purpose: Routes enrollment actions.
*********************************************************************/

class EnrollmentController extends Controller
{
	public function __construct( $model, $action ) {
		parent::__construct( $model, $action );
		$this->_setModel( $model );
	}

	public function index() {
		try {

			$enrollments = $this->_model->getEnrollments();
			$this->_view->set( 'enrollments', $enrollments );
			$this->_view->set( 'title', 'Enrollments' );

			return $this->_view->output();

		} catch ( Exception $e ) {
			echo '<h1>Application error:</h1>' . $e->getMessage();
		}
	}
	public function forclass( $classID ) {
		try {

			$enrollments = $this->_model->getEnrollmentsForClass( (int)$classID );
			$this->_view->set( 'enrollments', $enrollments );

			return $this->_view->output();

		} catch ( Exception $e ) {
			echo '<h1>Application error:</h1>' . $e->getMessage();
		}
	}
	public function forstudent( $studentID ) {
		try {

			$enrollments = $this->_model->getEnrollmentsForStudent( (int)$studentID );
			$this->_view->set( 'enrollments', $enrollments );

			return $this->_view->output();

		} catch ( Exception $e ) {
			echo '<h1>Application error:</h1>' . $e->getMessage();
		}
	}
	public function create() {
		$students = $this->_model->getStudents();
		$classes = $this->_model->getClasses();
		$statuses = $this->_model->getStatuses();

		$this->_view->set( 'title', 'New Enrollment' );
		$this->_view->set( 'students', $students );
		$this->_view->set( 'classes', $classes );
		$this->_view->set( 'statuses', $statuses );
		$this->_view->set( 'newRecord', true );

		if ( isset( $_GET['class'] ) ) {
			$this->_view->set( 'class_id', $_GET['class'] );
		}
		if ( isset( $_GET['student'] ) ) {
			$this->_view->set( 'student_id', $_GET['student'] );
		}
		return $this->_view->output();
	}

	public function update( $enrollmentID ) {
		$enrollment = $this->_model->getEnrollmentById( (int)$enrollmentID );

		if ( $enrollment ) {
			$students = $this->_model->getStudents();
			$classes = $this->_model->getClasses();
			$statuses = $this->_model->getStatuses();

			// Terrible, terrible hack.
			// The getClasses() only gets open classes... so, if the student is enrolled in a individual class
			// it will not be displayed. If that is the case, this will force the currently enrolled class into the list
			$currentClass = false;
			foreach ( $classes as $c ) {
				if ( $c["id"] == $enrollment["class_id"] )
					$currentClass = true;
			}
			if ( $currentClass == false )
				array_unshift( $classes, array( "id"=>$enrollment['class_id'], "name"=>$enrollment['class_name'] ) );


			$this->_view->set( 'students', $students );
			$this->_view->set( 'classes', $classes );
			$this->_view->set( 'statuses', $statuses );

			$this->_view->set( 'newRecord', false );
			$this->_view->set( 'formData', $enrollment );
			$this->_view->set( 'title', 'Enrollment Update Form' );
			return $this->_view->output();
		}
	}
	public function delete( $enrollmentID ) {
		$enrollment = new Enrollment();
		$enrollment->setId( $enrollmentID );
		$enrollment->delete();
	}
	public function details( $studentID ) {
		try {

			$student = $this->_model->getStudentById( (int)$studentID );

			if ( $student ) {
				$this->_view->set( 'title', $student['name'] );
				$this->_view->set( 'id', $student['id'] );
				$this->_view->set( 'name', $student['name'] );
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
	public function save( $enrollmentID ) {
		if ( !isset( $_POST['enrollmentFormSubmit'] ) ) {
			header( 'Location: index.php?r=enrollment/create' );
		}

		$errors = array();
		$check = true;
		$student_id = isset( $_POST['student_id'] ) ? trim( $_POST['student_id'] ) : NULL;
		$class_id = isset( $_POST['class_id'] ) ? trim( $_POST['class_id'] ) : NULL;
		$status_id = isset( $_POST['status_id'] ) ? trim( $_POST['status_id'] ) : NULL;

		if ( empty( $student_id ) ) {
			$check = false;
			array_push( $errors, "Name is required!" );
		}

		if ( !$check ) {
			$this->_setView( 'index' );
			$this->_view->set( 'title', 'Invalid form data!' );
			$this->_view->set( 'errors', $errors );
			if ( $enrollmentID ) {
				$this->_view->set( 'newRecord', false );
				$_POST['id'] = $enrollmentID;
			} else {
				$this->_view->set( 'newRecord', true );
			}
			$this->_view->set( 'formData', $_POST );
			return $this->_view->output();
		}

		try {

			$enrollment = new Enrollment();
			$enrollment->setStudent( $student_id );
			$enrollment->setClass( $class_id );
			$enrollment->setDate( date( 'Y-m-d H:i:s' ) );
			$enrollment->setStatus( $status_id );

			// We are updating a enrollment
			if ( $enrollmentID ) {
				$enrollment->setId( $enrollmentID );
				$enrollment->update();
				header( 'Location: index.php?r=enrollment' );
			}
			// We are making a new enrollment
			else {
				$enrollment->store();
				$this->_setView( 'success' );
				$this->_view->set( 'title', 'Store success!' );
				$data = array(
					'student_id' => $student_id,
					'class_id' => $class_id,
					'status_id' => $status_id
				);
				$this->_view->set( 'userData', $data );
			}

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
