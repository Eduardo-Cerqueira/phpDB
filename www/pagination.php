<?php

require_once __DIR__ . '/../src/partials/header.php'; ?>
<body>
	<?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
	<?php
	if ($errors !== false) {
		echo '<p>'.$errors.'</p>';
	} ?>
	<form action="/actions/pagination.php" method="post">
		<button type="previous" name="previous">previous</button>
        <button type="reset">reset</button>
        <button type="next">next</button>
	</form>
    
    

	<?php require_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>
</html>
?>