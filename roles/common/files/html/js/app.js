$(function() {

	var get_uptime = function() {
		jQuery.ajax('/uptime.php', {
			error: function() {
				console.log('Failed to get uptime');
				$('#uptime .card-text').html("Unable to get uptime.");
			},
			success: function(data) {
				$('#uptime .card-title').html(data.uptime);
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
        var tpl = _.template($('#temps-template').html());
        $('#temps .card-text').html(tpl(data));
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
        var tpl = _.template($('#hashrate-template').html());
				$('#hashrate .card-text').html(tpl(data));
			},
			timeout: 5000
		});
	};

  get_stats = function() {
    get_uptime();
    get_temperatures();
    get_hashrate();

    setTimeout(function() {
      get_stats();
    }, 5000);
  };

  get_stats();
});

