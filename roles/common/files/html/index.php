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

<div id="hashrate" class="card text-white bg-secondary" style="width: 18rem;">
<div class="card-body">
<h3 class="card-title">Hashrate </h3>
</div>
<p class="card-text"></p>
</div>

<div id="temps" class="card text-white bg-secondary" style="width: 18rem;">
<div class="card-body">
<h3 class="card-title">Temperatures</h3>
</div>
<p class="card-text">
</p>
</div>

<div id="uptime" class="card text-white bg-secondary" style="width: 18rem;">
<div class="card-body">
<h3 class="card-title">Uptime </h3>
</div>
<p class="card-text"></p>
</div>

</div>

<script id="hashrate-template" type="x-underscore-template">
  <h4>Total: <%= hashrate.total[0] %></h4>
  <table class="table table-sm">
	  <tr>
		  <th>Thread</th>
		  <th>Hash Rate</th>
	  </tr>
    <% _.each(hashrate.threads, function(thread, idx) { %>
      <tr>
        <td><%= idx %></td>
        <td><%= thread[0] %></td>
      </tr>
    <% }) %>
</script>

<script id="temps-template" type="x-underscore-template">
  <table class="table table-sm">
    <tr>
    <td><h4>Avg GPU: <%= _.reduce(gpu.temps, (memo, num) => memo + parseFloat(num), 0) / _.size(gpu.temps) %> &deg;C</h4></td>
    <td><h4>Avg CPU: <%= _.reduce(cpu.temps, (memo, num) => memo + parseFloat(num), 0) / _.size(cpu.temps) %> &deg;C</h4></td>
    </tr>
  </table>
  <table class="table table-sm">
	  <tr>
		  <th>Core #</th>
		  <th>Temp</th>
	  </tr>
    <% _.each(cpu.temps, function(val, key) { %>
      <tr>
        <td>CPU Core <%= key %></td>
        <td><%= val %> &deg;C</td>
      </tr>
    <% }) %>
    <% _.each(gpu.temps, function(val, key) { %>
      <tr>
        <td>GPU <%= key %></td>
        <td><%= val %> &deg;C</td>
      </tr>
    <% }) %>
  </table>
</script>

<script src="/js/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="/js/popper-1.12.9.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="/js/bootstrap-4.0.0.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="/js/underscore-1.8.3.min.js"></script>
<script src="/js/app.js"></script>
</body>
</html>
