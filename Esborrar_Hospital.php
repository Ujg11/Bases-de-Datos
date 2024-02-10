<?php
include("db.php");
	if(isset($_GET['borrar'])){
		$borrar_id=$_GET['borrar'];
		$consulta="DELETE FROM hospitals WHERE id_hospital=$borrar_id";
		$executar = mysqli_query($con, $consulta);
		if ($executar){
			echo"<script>alert('Dades esborrades!');</script>";
            echo"<script>window.open('index.php', '_self');</script>";
            //header("Location: index.php");
        }
        
	}
?>
