var xhr;
      
jQuery(document).on('keyup', '#AjaxSearchForm form', _.debounce(function(){
  
  var $form = jQuery(this);
  var $input = $form.find('input[name="s"]');
  var query = jQuery('#Search').val();
  var $content = jQuery('#content');
  var $results = jQuery('#results');
  var $loader = jQuery('#loader');
  var $quicklinks = jQuery('#quicklinks');
  
  if(query.length > 3) {
  
    if(xhr) {
     xhr.abort();
     xhr = null;
    }

    jQuery.ajax({
       type: 'post',
       url: myAjax.ajaxurl,
       data: {
           action: 'solaris_load_search_results',
           query: query
       },
       beforeSend: function() {
        $quicklinks.addClass('uk-hidden');
        $loader.removeClass('uk-hidden');
        $results.addClass('uk-hidden');
       },
       success: function(response) {
        $loader.addClass('uk-hidden');
        $results.removeClass('uk-hidden');
        $results.html(response);
       },
    });
  }

  function rmccString(inputString) {
  
      let stringArray = inputString.split(' ');
      let output = true;
      for (let el of stringArray) {
          if (el != '') {
              output = false;
          }
      }
      return output;
  };
  
  if (rmccString(query)) {
    $quicklinks.removeClass('uk-hidden');
    $loader.addClass('uk-hidden');
    $results.addClass('uk-hidden');
  } else {
  };

  return false;

},500));