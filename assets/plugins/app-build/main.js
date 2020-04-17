( function( $ ) {
  $(window).on('load', function() {
      init_main_body_class();
      init_body_class();
      init_page_name_as_class();
      init_table_class();
  });
  $(window).on('load resize', function() {
      set_body_small();
  });
  /**
    * Detect Mobile Devide
    * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
    * Date       : 06.04.2020
    */
  function is_mobile() {
       if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
           return true;
       }
       return false;
  }
  /**
    * Body Class
    * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
    * Date       : 06.04.2020
    */
  function init_main_body_class(){
      $('body').addClass('mmwps');
      $('body').addClass('mmwps-desktop-device');
      
  }
  /**
    * Body Class Mobile
    * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
    * Date       : 06.04.2020
    */
  function init_body_class(){
      if(is_mobile() == true){
          $('body').addClass('mmwps-mobile-device');
      }
  }
    /**
    * Mobile Class
    * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
    * Date       : 06.04.2020
    */
  function set_body_small() {
      if ($(this).width() < 769) {
          $(".mmwps-mobile-device .mmwps-wrapper").addClass('mmwps-mobile-small-page');
      } else {
          $(".mmwps-desktop-device .mmwps-wrapper").removeClass('mmwps-mobile-small-page');
      }
  }
    /**
    * Page Name
    * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
    * Date       : 06.04.2020
    */
  function init_page_name_as_class() {
      var pageCurrentUrl = window.location.href;
      var removeDomainSegment = pageCurrentUrl.substr(pageCurrentUrl.lastIndexOf('/') + 1);
      var lastSegment = removeDomainSegment.split('.').slice(0, -1).join('.')
      $('.mmwps-wrapper').addClass('mmwps-page-'+lastSegment);
  }
   /**
    * Datatables class
    * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
    * Date       : 06.04.2020
    */
  function init_table_class() {
      var pageCurrentUrl = window.location.href;
      var removeDomainSegment = pageCurrentUrl.substr(pageCurrentUrl.lastIndexOf('/') + 1);
      var lastSegment = removeDomainSegment.split('.').slice(0, -1).join('.')
      $('table').addClass('mmwps-'+lastSegment);
  } 

    /**
      * Init bootstrap select picker
      * Dependencies   : jquery, bootstrap select2
      * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
      * Date       : 06.04.2020
      */
  function init_selectpicker() {
      var select_pickers = $("body").find('select.selectpicker');
      if (select_pickers.length) {
          select_pickers.selectpicker({
            liveSearch: true,
          });
      }
  }
  init_selectpicker();

    /**
    * Datatables inline/offline lazy load images
    * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
    * Date       : 06.04.2020
    */
  function DataTablesOfflineLazyLoadImages(nRow, aData, iDisplayIndex) {
      var img = $('img.img-table-loading', nRow);
      img.attr('src', img.data('orig'));
      img.prev('div').addClass('hide');
      return nRow;
  }
    /**
      * DataTable
      * Dependencies   : jquery, bootstrap
      * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
      * Date       : 06.04.2020
      */
  function initDataTableInline() {
    $("#mmwpsTable").DataTable(
      {
       "ordering": false,
        "processing": true,
        'paginate': true,
        "responsive": true,
        "autoWidth": false,
        "order": [0, 'DESC'],
        "fnRowCallback": DataTablesOfflineLazyLoadImages,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
            "lengthMenu": "_MENU_",
            "emptyTable": "Hooray, no data here!",
            "zeroRecords": "No matching records found",
            "info": "_START_-_END_/_TOTAL_",
            "infoEmpty": "",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "loadingRecords" : 'Loading...',
            "search" : '<div class="input-group float-right"><span class="input-group-addon"><span class="fa fa-search"></span></span>',
            "searchPlaceholder" : "Search...",
            "processing" : '<div class="dt-loader"></div>',
            paginate: {
                next: '<span class="pagination-default">&#x276f;</span>',
                previous: '<span class="pagination-default">&#x276e;</span>'
            },

        }
      }

    );
  }
  initDataTableInline();
    /**
    * Init tooltips
    * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
    * Date       : 06.04.2020
    */
  $("body").tooltip({
      selector: '[data-toggle="tooltip"]'
  });

    /**
    * Init popovers
    * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
    * Date       : 06.04.2020
    */
  $("body").popover({
      selector: '[data-toggle="popover"]',
  });
      /**
      * Alpha Color Picker
      * Dependencies   : jquery, wp-color-picker
      * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
      * Date       : 06.04.2020
      */
  function init_alpha_color_picker() {
      var color_picker = $("body").find('.mmwps-color-picker');
      if (color_picker.length) {
          color_picker.alphaColorPicker();
      }
  }
  init_alpha_color_picker();
      /**
      * JQuery UI Slider function
      * Dependencies   : jquery, jquery-ui-slider
      * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
      * Date       : 06.04.2020
      */
    jQuery('.mmwps_sliderui').each(function() {
      
      var obj   = jQuery(this);
      var sId   = "#" + obj.data('id');
      var val   = parseInt(obj.data('val'));
      var min   = parseInt(obj.data('min'));
      var max   = parseInt(obj.data('max'));
      var step  = parseInt(obj.data('step'));
      
      //slider init
      obj.slider({
        value: val,
        min: min,
        max: max,
        step: step,
        range: "min",
        slide: function( event, ui ) {
          jQuery(sId).val( ui.value );
        }
      });
  });
   /**
    * JQuery UI Slider function
    * Dependencies   : jquery, jquery-ui-slider
    * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
    * Date       : 06.04.2020
    */
  /*function slidedownUp(el) {
    var panel_span = $("body").find('.panel-span');
    panel_span.on('click', function(el){
    var form_body = $("body").find('.form-body');
    $(this).siblings('.form-body').slideToggle("fast");
  });   
  }
  slidedownUp();*/
  /**
    * JQuery CollapseIcon Function
    * Dependencies   : jquery
    * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
    * Date       : 06.04.2020
    */
function collapseIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".click-change-icon")
        .toggleClass('fa fa-caret-right fa fa-caret-down');
    }
    $('.panel-group').on('hidden.bs.collapse', collapseIcon);
    $('.panel-group').on('shown.bs.collapse', collapseIcon);
    
    /**
    * JQuery CollapseIcon Function
    * Dependencies   : jquery
    * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
    * Date       : 06.04.2020
    */
    function showPostsBySelect() {
       jQuery(".show_posts").change(function(){
        jQuery(this).find("option:selected").each(function(){
            var optionValue = jQuery(this).attr("value");
            if(optionValue == 'by_id'){
                jQuery(".select_posts").show();
            } else{
                jQuery(".select_posts").hide();
            }
        });
    }).change();   
      }
      showPostsBySelect();
} )( jQuery );
  /**
  * Notify Message Show Function
  * Dependencies   : jquery
  * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
  * Date       : 06.04.2020
  */
function notifyMessage(message,messageType,icon) {
  jQuery.notify(
    {
      // options
      title: messageType.charAt(0).toUpperCase() + messageType.slice(1),
      message: "<br>" + message,
      icon: icon,
      target: "_blank",

    },
    {
      // settings
      element: "body",
      type: messageType,
      showProgressbar: false,
      placement: {
        from: "top",
        align: "right"
      },
      offset: {
        x:25,
        y:50
      },
      spacing: 10,
      z_index: 1031,
      delay: 3300,
      timer: 1000,
      allow_dismiss: true,
      newest_on_top: false,
      mouse_over: 'pause',
      url_target: "_blank",
      mouse_over: null,
      animate: {
        enter: "animated fadeInDown",
        exit: "animated lightSpeedOut"
      },
      onShow: null,
      onShown: null,
      onClose: null,
      onClosed: null,
      icon_type: "class",
      beforeOpen : function() {
        alert('A notice will be presented.');
      },
    }
  );
};
