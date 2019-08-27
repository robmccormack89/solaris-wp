// import uikit
import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';

// loads the Icon plugin
UIkit.use(Icons);

// make uikit available in the window / globally
window.UIkit = UIkit;

// require jquery, jquery is made available globally in webpack.config using expose-loader under jQuery
// require('jquery');

// require jquery cookie
// require('jquery.cookie');

// rmcc-loader for when the bundle is loading in body or deferred
// jQuery(document).ready(function(){
//   jQuery('.rmcc-load').removeClass('rmcc-load');
// });

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