<?php 
if ($errors !== false) {
	echo '<p>'.$errors.'</p>';
} ?>
<form action="/actions/send_contact.php" method="post">
	Nom: 
	<input type="text" name="fullname"><br />
	email: 
	<input type="text" name="email"><br>
	Message:
	<textarea name="message" cols="30" rows="10"></textarea>
	<button type="submit" class="btn">Envoyer</button>
</form>