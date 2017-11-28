<?php
//ini_set('display_errors', 0 );
//error_reporting(0);

$dia = $_GET['dia'];

$conexao = pg_connect("host=localhost dbname=sm port=5432 user=sm_user password=9090") or die ("Não foi possível conectar ao servidor PostGreSQL");
$result=pg_exec($conexao, "select * from measures where created_at between '" . $dia . " 00:00:00' and '" . $dia . " 23:59:59';");

while ($row = pg_fetch_array($result)) {
   $json = json_decode($row['data']);   
   $arrayValores[] = $json->value;
   $arrayCreated_at[] = substr($row['created_at'], -8); //pegando apenas a hora
}
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
		data.addColumn('string', 'Hora');
		data.addColumn('number', 'Ruídos');
		
		data.addRows([
			<?php
				for($i=0; $i< count($arrayValores); $i++){
					echo "['" . $arrayCreated_at[$i] . "'," . $arrayValores[$i] . "],";
				} 
			?>
		]);

        var options = {
          title: 'Histórico do dia Selecionado: <?php echo $dia ?>',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
      }
	  
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 100%; height: 100%"></div>
  </body>
</html>