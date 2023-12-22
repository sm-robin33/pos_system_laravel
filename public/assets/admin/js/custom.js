(function($) {
  "use strict";
  $('.summernote').summernote({
    placeholder:'Write hear',
    tabSize : 2,
    height : 100
  });

  $('input[name="participate_type"]').autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: $('input[name="participate_type"]').data('url'),
        type: 'GET',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('input[name="participate_type"]').val(ui.item.label);
      return false;
    }
  });
})(jQuery);