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

<form action="index.php?r=student/save<?php if ( isset( $formData ) && isset( $formData['id'] ) ) echo '/'.$formData['id']; ?>" method="post">

	<p>
		<label for="name">Student Name:</label>
		<input value="<?php if ( isset( $formData ) ) echo $formData['name']; ?>" type="text" id="name" name="name" />
	</p>


	<input type="submit" name="studentFormSubmit" value="<?php echo ( $newRecord ) ? 'Create' : 'Update'; ?>" />
</form>
