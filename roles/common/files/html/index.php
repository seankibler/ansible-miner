<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<title>Miner Status</title>
</head>
<body>
<h1>Miner Status</h1>

<div class="card-group">
<div id="uptime" class="card text-white bg-secondary" style="width: 18rem;">
<div class="card-body">
<h5 class="card-title">Uptime </h5>
</div>
<p class="card-text"></p>
</div>

<div id="hashrate" class="card text-white bg-secondary" style="width: 18rem;">
<div class="card-body">
<h5 class="card-title">Current Hash Rate </h5>
</div>
<p class="card-text"></p>
</div>

<div id="temps" class="card text-white bg-secondary" style="width: 18rem;">
<div class="card-body">
<h5 class="card-title">Temperatures</h5>
<table class="table table-sm">
	<tr>
		<th>Core #</th>
		<th>Temp (C)</th>
	</tr>
</table>
</div>
<p class="card-text">
</p>
</div>
</div>

<script src="/js/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="/js/popper-1.12.9.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="/js/bootstrap-4.0.0.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
$(function() {

	var get_uptime = function() {
		jQuery.ajax('/uptime.php', {
			error: function() {
				console.log('Failed to get uptime');
				$('#uptime .card-text').html("Unable to get uptime.");
			},
			success: function(data) {
				$('#uptime .card-title').append(data.uptime);
			},
			timeout: 5000
		});
	};

	var get_temperatures = function() {
		jQuery.ajax('/temperatures.php', {
			error: function() {
				console.log('Failed to get temperatures');
				$('#temps .card-text').html("Unable to get temperatures.");
			},
			success: function(data) {
				$.each(data.cpu.cores, function(idx, core_temp) {
					var tr = document.createElement('tr');
					$(tr).append('<td>Core ' + idx + '</td>'); 
					$(tr).append('<td>' + core_temp + '</td>');
					$('#temps table').append(tr);
				});
				$.each(data.gpu, function(idx, temp) {
					var tr = document.createElement('tr');
					$(tr).append('<td>GPU ' + idx + '</td>'); 
					$(tr).append('<td>' + temp + '</td>');
					$('#temps table').append(tr);
				});
			},
			timeout: 5000
		});
	};

	var get_hashrate = function() {
		jQuery.ajax('/hashrate.php', {
			error: function(err) {
				console.log("Failed to get hash rate: \n" + err);
				$('#hashrate .card-body').html("Unable to get hash rate.");
			},
			success: function(data) {
				$('#hashrate .card-title').append(data.hashrate.total[0]);
			},
			timeout: 5000
		});
	};

	get_uptime();
	get_temperatures();
	get_hashrate();

	//setInterval(function() {
		//get_temperatures();
		//get_hashrate();
	//}, 3000);
});
</script>
</body>
</html>
