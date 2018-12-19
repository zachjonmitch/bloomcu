console.log('alertjs');

function bloomio_set_alert_cookie_js(this_alert_scope, this_alert_id) {
    // console.log('close', this_alert_scope, this_alert_id);
    var date = new Date(),
      y = date.getFullYear(),
      m = date.getMonth();

    var current_day = date.getDate();
    var last_day_raw = new Date(y, m + 1, 0);
    var last_day = last_day_raw.getDate();
    var open_on = last_day - current_day;

    var cookie_data = {
      status: "block",
      alert_id: this_alert_id
    };

    Cookies.set(this_alert_scope, cookie_data, {
      expires: open_on
    });
  }

  function bloomio_open_alert() {
    var alert_height = $('.bloomio-alert-wrap').outerHeight();
    $('.bloomio-alert-wrap').show().animate({
      bottom: '0'
    }, "slow");
  }

  $(window).on('load', function() {

    // console.log(document.cookie);
    try {  
      if ($('body').hasClass('home')) {
        var alert_scope = "homepage";
        var alert_status = Cookies.getJSON('homepage');
      } else {
        var alert_scope = "subpages";
        var alert_status = Cookies.getJSON('subpages');
      }
      // console.log(alert_status);
      
      if (alert_status.status != "block") {
        if (alert_scope == 'homepage') {
          if (typeof(alert_status) == 'undefined') {
            bloomio_open_alert();
          } else if (typeof(alert_status) == 'object' && (latest_homepage_alert > alert_status.alert_id)) {
            bloomio_open_alert();
          } else {
            //nothing will happen
          }
        } else if (alert_scope == 'subpages') {
          if (typeof(alert_status) == 'undefined') {
            bloomio_open_alert();
          } else if (typeof(alert_status) == 'object' && (latest_subpages_alert > alert_status.alert_id)) {
            bloomio_open_alert();
          } else {
            //nothing will happen
          }
        }
      } 
    }catch(e) {
      //do nothing
      // console.log('alert do nothing');
      bloomio_open_alert();
    }
    

  $('.btn-alert-close').click( function(e) {

    var this_alert_id = $(this).data('alert');
    var this_alert_scope = $(this).data('scope');
    var alert_height = $('.bloomio-alert-wrap').outerHeight();

    $(this).parents('.bloomio-alert-wrap').animate({
      bottom: '-' + alert_height + 'px'
    }, "fast");
    $('footer').animate({
      'padding-bottom': 0
    }, "fast");
    bloomio_set_alert_cookie_js(this_alert_scope, this_alert_id);

    $(this).parents('.bloomio-alert-wrap').hide();
  });
});
