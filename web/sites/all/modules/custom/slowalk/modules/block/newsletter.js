(function ($) {
    $(document).ready(function () {
        $('#newsletter-form').ajaxForm({
           beforeSubmit: showRequest,
           success: showResponse
        });
        $('#newsletter-form .btn.form-submit').click(function(e){
          $('#newsletter-privacy-notice').show();
        });
        $('#newsletter-privacy-notice .btn-l.btn1').click(function(e){
          if($('input[name=agree]:checked').val() == 'Y') {
            $('#agreed').val('Y');
            $('#newsletter-privacy-notice').hide();
            $('#newsletter-form').submit();
          }
        });
    });

    function showRequest(formData, jqForm, options) {
        let form = jqForm[0];
        return $(form).valid();
    }

    function showResponse(response, statusText, xhr, $form) {
        let newsletterDiv = $('<div />');
        if (response.status == 'success') {
          newsletterDiv.append(response.message);
        }
        if (response.status == 'failed') {
          let errors = response.errors.map(a => a.message);
          newsletterDiv.append(errors.join('<br/>'));
        }
        newsletterDiv.dialog({
            modal: true,
            title:"뉴스레터 신청",
            width: 'auto', // overcomes width:'auto' and maxWidth bug
            maxWidth: 600,
            height: 'auto',
            modal: true,
            clickOut: true,
            fluid: true, //new option
            position: { my: "center", at: "center", of: window },
            close: function(event, ui) {
                $('#newsletter-form input[type=text]').val('');
            }
        });
    }
})(jQuery);
