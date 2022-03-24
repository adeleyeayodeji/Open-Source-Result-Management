<?php

?>
<!DOCTYPE html>
<html>
<head>
	<title>Notify</title>
	<script
			  src="https://code.jquery.com/jquery-3.4.1.js"
			  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
			  crossorigin="anonymous"></script>	
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"></script>
</head>
<body>
	<script type="text/javascript">
		$(document).ready(function () {
			$.notify("BOOM!");
		})
	</script>
</body>
</html>