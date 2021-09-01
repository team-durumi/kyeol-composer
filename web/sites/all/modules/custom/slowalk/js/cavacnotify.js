var jquery_cavacnotify_count = 0;

function isMobile() {
  return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

(function ($) {
  $.fn.cavacnotify = function (options) {
    return this.each(function () {
      var obj = $(this);
      $(this).attr("tabIndex", "0");
      var popuptitle = $(this).attr("popuptitle");
      var popuptext = $(this).attr("popuptext");
      popuptext = popuptext.replace(/#BR#/gm, "<br/>");
      var url = $(this).data('url');

      var dialogid = 'cavacnotify' + jquery_cavacnotify_count;
      jquery_cavacnotify_count = jquery_cavacnotify_count + 1;

      $("<div id='" + dialogid + "' title='" + popuptitle + "'><p>" + popuptext + "</p></div>").insertAfter(obj);
      $('#' + dialogid).dialog({
        autoOpen: false,
        resizable: false,
        modal: true,
        buttons: {
          "더 보기": function() {
            window.location.href = url;
          }
        }
      });
      $(obj).on({
        click: function(e) {
          if (isMobile()) {
            $('#' + dialogid).dialog("option", "position", {
              my: "center",
              at: "center",
              of: window
            });
          } else {
            $('#' + dialogid).dialog("option", "position", {
              my: "left top",
              at: "left bottom",
              of: e,
              offset: "5 30"
            });
          }
          // console.log(e);
          $('#' + dialogid).dialog('open');
          //return false;
        },
        keypress: function(e) {
          if (e.keyCode === 13) {
            $('#' + dialogid).dialog("option", "position", {
              my: "center",
              at: "center",
              of: window
            });
            $('#' + dialogid).dialog('open');
          }
        }
      });
      /*
      $(obj).on('click keyup',function (e) {
        if (isMobile()) {
          $('#' + dialogid).dialog("option", "position", {
            my: "center",
            at: "center",
            of: window
          });
        } else {
          $('#' + dialogid).dialog("option", "position", {
            my: "left top",
            at: "left bottom",
            of: e,
            offset: "5 30"
          });
        }
        // console.log(e);
        $('#' + dialogid).dialog('open');
        //return false;
      });
      */
    });
  };
})(jQuery);
