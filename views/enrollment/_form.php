<?php
if ( isset( $errors ) ) {
	echo '<ul>';
	foreach ( $errors as $e ) {
		echo '<li>' . $e . '</li>';
	}
	echo '</ul>';
}

if ( isset( $saveError ) ) {
	echo "<h2>Error saving data. Please try again.</h2>" . $saveError;
}
?>

<form action="index.php?r=enrollment/save<?php if ( isset( $formData ) && isset( $formData['id'] ) ) echo '/'.$formData['id']; ?>" method="post">

	<label for="student_id">Student:</label>
	<select name="student_id">
	<?php
if ( isset( $formData ) )
	$studentID = $formData['student_id'];
if ( isset( $student_id ) )
	$studentID = $student_id;
foreach ( $students as $s ) {
	echo ( ( $s["id"] == $studentID ) ? '<option selected ' : '<option ' )
		. 'value="'.$s["id"].'">'.$s["name"].'</option>';
} ?>
	</select>

	<label for="class_id">Class:</label>
	<select name="class_id">
	<?php
if ( isset( $formData ) )
	$classID = $formData['class_id'];
if ( isset( $class_id ) )
	$classID = $class_id;
foreach ( $classes as $c ) {
	echo ( ( $c["id"] == $classID ) ? '<option selected ' : '<option ' )
		. 'value="'.$c["id"].'">'.$c["name"].'</option>';
} ?>
	</select>

	<label for="status_id">Status:</label>
	<select name="status_id">
	<?php
if ( isset( $formData ) )
	$statusID = $formData['status_id'];
foreach ( $statuses as $st ) {
	echo ( ( $st["id"] == $statusID ) ? '<option selected ' : '<option ' )
		. 'value="'.$st["id"].'">'.$st["status"].'</option>';
} ?>
	</select>

	<input type="submit" name="enrollmentFormSubmit" value="<?php echo ( $newRecord ) ? 'Create' : 'Update'; ?>" />
</form>
