<!DOCTYPE html>

<?php include("db.php")?>

<html>
<table width="500" border="2" style = "background-color=#F9F9F9">
		<tr>
			<th>Codi Propietari</th>
			<th>Propietari</th>
			<th>Numero d'hospitals</th>
		</tr>
<?php
	$consulta="SELECT id_owner, owner_info, count(*) as num_hosp 
				FROM propietaris
				join hospitals on owner_code = id_owner
				group by id_owner;";
	$executar=mysqli_query($con,$consulta);

	while($fila=mysqli_fetch_array($executar))
	{
		$id_owner = $fila['id_owner'];
		$owner_info = $fila['owner_info'];
		$num_hosp = $fila['num_hosp'];
?>
		<tr align="center">
			<td><?php echo $id_owner; ?></td>
			<td><?php echo $owner_info; ?></td>
			<td><?php echo $num_hosp; ?></td>
		</tr>
	<?php
	} 
	?>
	</table>

<br>
<br>
<strong>Nombre d'Hospitals agrupant per categoria</strong>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gráfico con Chart.js</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<canvas id="myChart" width="900" height="900"></canvas>

<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Government', 'Voluntary', 'Propietary', 'Tribal', 'Physician'],
      datasets: [{
        label: 'Nombre de Hospitals',
		data: [
		<?php 
			$consulta1="SELECT count(*) as hosp_govern
						FROM propietaris
						join hospitals on owner_code = id_owner
						where owner_info like 'Government%';";
			$executar=mysqli_query($con,$consulta1);
			if($fila=mysqli_fetch_array($executar))
				echo $fila['hosp_govern'];
		?>,
		<?php
			$consulta2="SELECT count(*) as hosp_voluntary
						FROM propietaris
						join hospitals on owner_code = id_owner
						where owner_info like 'Voluntary%';";
			$executar=mysqli_query($con,$consulta2);
			if($fila=mysqli_fetch_array($executar))
				echo $fila['hosp_voluntary'];
		?>,
		<?php
			$consulta3="SELECT count(*) as hosp_propietary
						FROM propietaris
						join hospitals on owner_code = id_owner
						where id_owner = 3;";
			$executar=mysqli_query($con,$consulta3);
			if($fila=mysqli_fetch_array($executar))
				echo $fila['hosp_propietary'];
		?>,
		<?php
			$consulta4="SELECT count(*) as hosp_tribal
						FROM propietaris
						join hospitals on owner_code = id_owner
						where id_owner = 9;";
			$executar=mysqli_query($con,$consulta4);
			if($fila=mysqli_fetch_array($executar))
				echo $fila['hosp_tribal'];
		?>,
		<?php
			$consulta5="SELECT count(*) as hosp_physician
						FROM propietaris
						join hospitals on owner_code = id_owner
						where id_owner = 10;";
			$executar=mysqli_query($con,$consulta5);
			if($fila=mysqli_fetch_array($executar))
				echo $fila['hosp_physician'];
		?>
		],		
        backgroundColor: 'rgba(75, 192, 192, 0.4)',
        borderColor: 'rgba(75, 200, 200, 3)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

</body>
</html>








