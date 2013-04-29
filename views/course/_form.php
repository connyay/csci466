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
	<form action="index.php?r=course/save<?php if ( isset( $formData ) && isset( $formData['id'] ) ) echo '/'.$formData['id']; ?>" method="post">
		<label for="name">Name:</label>
		<input value="<?php if ( isset( $formData ) ) echo $formData['name']; ?>" type="text" id="name" name="name" />

		<label for="name">Teacher:</label>
		<select name="teacher_id">
		  <?php
if ( isset( $formData ) )
	$teacherID = $formData['teacher_id'];
if ( isset( $teacher_id ) )
	$teacherID = $teacher_id;
foreach ( $teachers as $t ) {
	echo ( ( $t["id"] == $teacherID ) ? '<option selected ' : '<option ' )
		. 'value="' . $t["id"] . '">' . $t["name"] . ' (' . $t["discipline"] . ') </option>';
} ?>
		</select>
		<label for="name">Description:</label>
		<input value="<?php if ( isset( $formData ) ) echo $formData['description']; ?>" type="text" id="description" name="description" />
		<label for="name">Enrollment Cap:</label>
		<input value="<?php if ( isset( $formData ) ) echo $formData['enrollment_cap']; ?>" type="text" id="enrollment_cap" name="enrollment_cap" />
		<label for="name">Duration:</label>
		<input value="<?php if ( isset( $formData ) ) echo $formData['duration']; ?>" type="text" id="duration" name="duration" />
		<label for="name">Meeting Days:</label>
		<input value="<?php if ( isset( $formData ) ) echo $formData['meetingdays']; ?>" type="text" id="meetingdays" name="meetingdays" />
		<label for="name">Cost:</label>
		<input value="<?php if ( isset( $formData ) ) echo $formData['cost']; ?>" type="text" id="cost" name="cost" />
		<label for="name">Room:</label>
		<input value="<?php if ( isset( $formData ) ) echo $formData['room']; ?>" type="text" id="room" name="room" />
		<input type="submit" name="classFormSubmit" value="<?php echo ( $newRecord ) ? 'Create' : 'Update'; ?>" />
	</form>
