$(function() {
  var get_metrics = function(callback) {
    jQuery.ajax('/metrics.php', {
      error: function() {
        callback(false, 'Failed to get metrics');
      },
      success: function(data) {
        callback(true, data);
      },
      timeout: 5000
    });
  };

  var display_metrics = function(metrics) {
    var uptime = document.createElement('h4');
    uptime.textContent = metrics.uptime["0"];
    $('#uptime .card-text').html(uptime);

    var temps_tpl = _.template($('#temps-template').html());
    $('#temps .card-text').html(temps_tpl(metrics));

    var hashrate_tpl = _.template($('#hashrate-template').html());
    $('#hashrate .card-text').html(hashrate_tpl(metrics.hashrate));
  };

  var display_error = function() {
    $('.card-text').html("Unable to get uptime.");
  };

  show_stats = function() {
    get_metrics(function(success, metrics) {
      if (success) {
        display_metrics(metrics);
      } else {
        display_error();
      }
    });

    setTimeout(function() {
      show_stats();
    }, 5000);
  };

  show_stats();
});
