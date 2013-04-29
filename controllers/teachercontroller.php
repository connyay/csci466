<?php
/********************************************************************
CSCI 466 - Assignment 9 - Semester Spring 2013

Progammer: Group 5
Date Due:  April 26th, 2013

Purpose: Routes teacher actions.
*********************************************************************/

class TeacherController extends Controller
{
	public function __construct( $model, $action ) {
		parent::__construct( $model, $action );
		$this->_setModel( $model );
	}

	public function index() {
		try {
			$teachers = $this->_model->getTeachers();
			$this->_view->set( 'teachers', $teachers );
			$this->_view->set( 'title', 'Teachers' );

			return $this->_view->output();

		} catch ( Exception $e ) {
			echo '<h1>Application error:</h1>' . $e->getMessage();
		}
	}
	public function create() {
		$disciplines = $this->_model->getDisciplines();
		$this->_view->set( 'newRecord', true );
		$this->_view->set( 'disciplines', $disciplines );
		$this->_view->set( 'title', 'Teacher Create Form' );
		return $this->_view->output();
	}

	public function update( $teacherID ) {
		$teacher = $this->_model->getTeacherById( (int)$teacherID );
		if ( $teacher ) {
			$disciplines = $this->_model->getDisciplines();
			$this->_view->set( 'disciplines', $disciplines );
			$this->_view->set( 'newRecord', false );
			$this->_view->set( 'formData', $teacher );
			$this->_view->set( 'title', 'Teacher Update Form' );
			return $this->_view->output();
		}
	}
	public function delete( $teacherID ) {
		$teacher = new Teacher();
		$teacher->setId( $teacherID );
		$teacher->delete();

	}
	public function view( $teacherID ) {
		// No ID provided... Display index
		if ( !$teacherID ) {
			header( 'Location: index.php?r=teacher/index' );
		}
		try {

			$teacher = $this->_model->getTeacherById( (int)$teacherID );

			if ( $teacher ) {
				$this->_view->set( 'teacher', $teacher );
				$this->_view->set( 'title', $teacher['name'] );
				$this->_view->set( 'classes', $teacher['classes'] );
			}
			else {
				$this->_view->set( 'title', 'Invalid teacher ID' );
				$this->_view->set( 'noTeacher', true );
			}

			return $this->_view->output();

		} catch ( Exception $e ) {
			echo '<h1>Application error:</h1>' . $e->getMessage();
		}
	}
	public function save( $teacherID ) {
		if ( !isset( $_POST['teacherFormSubmit'] ) ) {
			header( 'Location: index.php?r=teacher/create' );
		}

		$errors = array();
		$check = true;

		$name = isset( $_POST['name'] ) ? trim( $_POST['name'] ) : NULL;
		$discipline = isset( $_POST['discipline'] ) ? trim( $_POST['discipline'] ) : NULL;
		if ( empty( $name ) ) {
			$check = false;
			array_push( $errors, "Name is required!" );
		}

		if ( !$check ) {
			$this->_setView( 'create' );
			$this->_view->set( 'title', 'Invalid form data!' );
			$this->_view->set( 'errors', $errors );
			if ( $teacherID ) {
				$this->_view->set( 'newRecord', false );
				$_POST['id'] = $teacherID;
			} else {
				$this->_view->set( 'newRecord', true );
			}
			$this->_view->set( 'formData', $_POST );
			return $this->_view->output();
		}

		try {

			$teacher = new Teacher();
			$teacher->setName( $name );
			$teacher->setDiscipline( $discipline );

			// We are updating a teacher
			if ( $teacherID ) {
				$teacher->setId( $teacherID );
				$teacher->update();
				header( 'Location: index.php?r=teacher/view/' . $teacherID );
			}
			// We are making a new teacher
			else {
				$teacher->store();
				$this->_setView( 'success' );
				$this->_view->set( 'title', 'Store success!' );
				$data = array(
					'name' => $name
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
