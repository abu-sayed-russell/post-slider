( function( $ ) {
/**
  * Save Slider
  * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
  * Date       : 11.04.2020
  */
 jQuery(document).ready(function ($) {
  $('#slider_form').on('submit', function (e) {
    e.preventDefault();
    $('.has-error').removeClass('has-error');

    var form = $(this),
      req = form.find('.required').val(),
      ajaxurl = form.data('url');
      if (req === '') {
       $('.required').parent().addClass('has-error');
       notifyMessage('Field is required', 'warning', 'fa fa-warning');
      return;
      }
    var nonce = $('#security').val();
    var save_form_data = "action=mmwps_slider_action&param=save_slider&nonce="+ nonce +"&" + jQuery("#slider_form").serialize();
    
    $.ajax({
      url: ajaxurl,
      type: 'post',
      data: save_form_data,
      success: function (response) {
        
        var data = jQuery.parseJSON(response);
        var html = '';
        if (data.status == 1) {
          html =  data.msg;
          notifyMessage(html, 'success', 'fa fa-check');
          jQuery("#slider_form")[0].reset();
        } else if (data.error == 2) {
            html = data.error;
            notifyMessage(html, 'warning', 'fa fa-warning');
          } else if (data.status == -1 || data.status == 3) {
            html = data.error;
          notifyMessage(html, 'warning', 'fa fa-warning');
          }
      }
    });

  });
});
 jQuery(document).ready(function ($) {
  $('#update_slider_form').on('submit', function (e) {
    e.preventDefault();
    $('.has-error').removeClass('has-error');

    var form = $(this),
      req = form.find('.required').val(),
      ajaxurl = form.data('url');
      if (req === '') {
       $('.required').parent().addClass('has-error');
       notifyMessage('Field is required', 'warning', 'fa fa-warning');
      return;
      }
    var nonce = $('#update_security').val();
    var update_slider_data = "action=mmwps_slider_action&param=update_slider&nonce="+ nonce +"&" + jQuery("#update_slider_form").serialize();
    $.ajax({
      url: ajaxurl,
      type: 'post',
      data: update_slider_data,
      success: function (response) {
        console.log(response);
        var data = jQuery.parseJSON(response);
        var html = '';
        if (data.status == 1) {
          html =  data.msg;
          notifyMessage(html, 'success', 'fa fa-check');
        } else if (data.error == 2) {
            html = data.error;
            notifyMessage(html, 'warning', 'fa fa-warning');
          } else if (data.status == -1 || data.status == 3) {
            html = data.error;
          notifyMessage(html, 'warning', 'fa fa-warning');
          }
      }
    });

  });
});

/**
  * Delete Slider
  * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
  * Date       : 11.04.2020
  */
  jQuery(document).on("click", ".slider_delete", function () {
      var tr = $(this).closest('tr');
      var slider_id = jQuery(this).attr("data-id");
      var nonce = jQuery(this).attr("data-nonce");
      var delete_slider = "action=mmwps_slider_action&param=delete_slider&nonce="+ nonce +"&id=" + slider_id;
      $.confirm({
          title: 'Confirm!',
          content: 'Are you sure to delete this?',
          buttons: {
              confirm: function () {
                  $.ajax({
                    url: ajaxurl,
                    type: 'post',
                    nonce: nonce,
                    data: delete_slider,
                    success: function (response) {
                      var data = jQuery.parseJSON(response);
                      var html = '';
                      if (data.status == 1) {
                        html =  data.msg;
                        notifyMessage(html, 'success', 'fa fa-check');
                        tr.css('background-color', '#f05463');
                        tr.fadeOut('slow');
                      } else if (data.error == 2) {
                        html = 'Something wrong, try again!';
                        notifyMessage(html, 'warning', 'fa fa-warning');
                      } else if (data.status == 2) {
                        html = data.error;
                        mnotifyMessage(html, 'warning', 'fa fa-warning');
                      }else if (data.status == -1) {
                        html = data.msg;
                        notifyMessage(html, 'danger', 'fa fa-times-circle');
                      }
                    }
                  });
      },
      cancel: function () {
          html = 'Slider did not delete!';
          notifyMessage(html, 'warning', 'fa fa-warning');
      },
          }
      });
  });
  /**
  * Slider Deactive
  * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
  * Date       : 11.04.2020
  */
  jQuery(document).on("click", ".slider_deactive", function () {
    var changeClass = $(this).closest('.onoffswitch-checkbox');
    var slider_id = jQuery(this).attr("data-id");
    var nonce = jQuery(this).attr("data-nonce");
    var status_slider = "action=mmwps_slider_action&param=status_slider_deactive&nonce="+ nonce +"&id=" + slider_id;
   $.ajax({
        url: ajaxurl,
        type: 'post',
        nonce: nonce,
        data: status_slider,
        success: function (response) {
          var data = jQuery.parseJSON(response);
          var html = '';
          if (data.status == 1) {
            html =  data.msg;
            notifyMessage(html, 'success', 'fa fa-check');
            changeClass.addClass('slider_active');
            changeClass.removeClass('slider_deactive');
          } else if (data.error == 2) {
            html = 'Something wrong, try again!';
            notifyMessage(html, 'warning', 'fa fa-warning');
          } else if (data.status == 2) {
            html = data.error;
            notifyMessage(html, 'warning', 'fa fa-warning');
          }else if (data.status == -1) {
            html = data.msg;
            notifyMessage(html, 'danger', 'fa fa-times-circle');
          }
        }
      });
});
  /**
  * Slider Active
  * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
  * Date       : 11.04.2020
  */
  jQuery(document).on("click", ".slider_active", function () {
    var changeClass = $(this).closest('.onoffswitch-checkbox');
    var opt_id = jQuery(this).attr("data-id");
    var nonce = jQuery(this).attr("data-nonce");
    var status_opt_field = "action=mmwps_slider_action&param=status_slider_active&nonce="+ nonce +"&id=" + opt_id;
   $.ajax({
        url: ajaxurl,
        type: 'post',
        nonce: nonce,
        data: status_opt_field,
        success: function (response) {
          var data = jQuery.parseJSON(response);
          var html = '';
          if (data.status == 1) {
            html =  data.msg;
            notifyMessage(html, 'success', 'fa fa-check');
            changeClass.addClass('slider_deactive');
            changeClass.removeClass('slider_active');
          } else if (data.error == 2) {
            html = 'Something wrong, try again!';
            notifyMessage(html, 'warning', 'fa fa-warning');
          } else if (data.status == 2) {
            html = data.error;
            notifyMessage(html, 'warning', 'fa fa-warning');
          }else if (data.status == -1) {
            html = data.msg;
            notifyMessage(html, 'danger', 'fa fa-times-circle');
          }
        }
      });
});
} )( jQuery );
