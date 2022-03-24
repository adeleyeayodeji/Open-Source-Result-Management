<?php
    $place = $_SERVER['REQUEST_URI'] == "/teacherlog.php" ? "fixed" : "static";
?>
<div class="credit" style="position: <?php echo $_SESSION ? "static" : $place; ?>;">
				   <?php
                            $stmt = $dbh->query("SELECT * FROM settings");
                            $rowwww = $stmt->fetch(PDO::FETCH_OBJ);
                            ?>
           Copyright &copy; <?php echo date("Y")." ". htmlentities($rowwww->title); ?> | Developed by <a href="https://adeleyeayodeji.com" target="_blank">Adeleye Ayodeji</a> | <?php 
           	if (!isset($_SESSION["alogin"])) {
			?>
			<a href="teacherlog.php" style="color: black;">Teacher's Panel <i class="fa fa-sign-in"></i></a>
			<?php
		}else{
		   	?>
		   	<a href="logout.php" style="color: red;">Logout <i class="fa fa-sign-out"></i></a>
		   	<?php
		}
            ?>
        </div>