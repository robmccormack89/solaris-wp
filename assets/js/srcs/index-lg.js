// require jquery, jquery is made available globally in webpack.config using expose-loader under jQuery
require('jquery');

// import lightgallery
require('lightgallery');
require('lg-thumbnail');
// require('lg-fullscreen');
// require('lg-zoom');
// require('lg-share');
// require('lg-hash');

// import uikit
import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';

// loads the Icon plugin
UIkit.use(Icons);

// The following line makes it finally work:
window.UIkit = UIkit;

// rmcc-loader for when the bundle is loading in body or deferred
// jQuery(document).ready(function(){
//   jQuery('.rmcc-load').removeClass('rmcc-load');
// });

// require jquery cookie
// require('jquery.cookie');

// jquery cookie based quikc enquiry for mobile 
// jQuery(document).ready(function(){  
//   jQuery('#QuickCallEnquiryContainer a.close').click(function(){
//       jQuery('#QuickCallEnquiryContainer').fadeOut();
//   });
// 
//   var visits = jQuery.cookie('visits') || 0;
//   visits++;
// 
//   jQuery.cookie('visits', visits, { expires: 1, path: '/' });
// 
//   console.debug(jQuery.cookie('visits'));
// 
//   if ( jQuery.cookie('visits') > 1 ) {
//     jQuery('#active-popup').hide();
//     jQuery('#QuickCallEnquiryContainer').hide();
//   } else {
//       jQuery('#QuickCallEnquiryContainer').show();
//   }
// 
//   if (jQuery.cookie('noShowWelcome')) { jQuery('#QuickCallEnquiryContainer').hide(); }
// }); 
// 
// jQuery(document).mouseup(function(e){
//   var container = jQuery('#QuickCallEnquiryContainer');
// 
//   if( !container.is(e.target)&& container.has(e.target).length === 0)
//   {
//     container.fadeOut();
//   }
// 
// });

jQuery(document).on('submit', '#AjaxSearchForm form', function() {

    function checkWhitespace(inputString) {

        let stringArray = inputString.split(' ');
        let output = true;
        for (let el of stringArray) {
            if (el != '') {
                output = false;
            }
        }
        return output;
    }

    var query = jQuery('#Search').val();
    var len = query.length;
    var $content = jQuery('#content')
    var $results = jQuery('#results')
    var $quicklinks = jQuery('#quicklinks')

    jQuery.ajax({
        type: 'post',
        url: myAjax.ajaxurl,
        data: {
            action: 'load_search_results',
            query: query
        },
        beforeSend: function() {
            // $input.prop('disabled', true);
            $content.addClass('loading');
            // $content.addClass('loaded');
        },
        success: function(response) {
            // $input.prop('disabled', false);
            $content.removeClass('loading');
            $results.html(response);

        }
    });

    if (checkWhitespace(query)) {

        $results.addClass('uk-hidden');

        $quicklinks.removeClass('uk-hidden');

    } else {

        $quicklinks.addClass('uk-hidden');

        $results.removeClass('uk-hidden');

    }

    return false;

});