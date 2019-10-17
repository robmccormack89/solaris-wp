// function delay(callback, ms) {
//   var timer = 0;
//   return function() {
//     var context = this, args = arguments;
//     clearTimeout(timer);
//     timer = setTimeout(function () {
//       callback.apply(context, args);
//     }, ms || 0);
//   };
// }


      
jQuery(document).on('keyup', '#AjaxSearchForm form', function explode(){
       // clearTimeout(timer); 
       // timer = setTimeout(ajax, 2000);

       var $form = jQuery(this);
       var $input = $form.find('input[name="s"]');
       var query = jQuery('#Search').val();
       var len = query.length;
       var $content = jQuery('#content')
       var $results = jQuery('#results')
       var $quicklinks = jQuery('#quicklinks')
       
       jQuery.ajax({
           type: 'post',
           url: myAjax.ajaxurl,
           data: {
               action: 'solaris_load_search_results',
               query: query
           },
           beforeSend: function() {
               // $input.prop('disabled', true);
               $content.addClass('loading');
               $content.addClass('loaded');
           },
           success: function(response) {
            $content.removeClass('loading');
            $results.html(response);

           },
           // timeout: 3000 // sets timeout to 3 seconds
       });


       return false;
       
});
setTimeout(explode, 2000);










// jQuery(function($){ 
// 
//   var timer = null;
//   $('#Search').on('keyup', function(){
//          clearTimeout(timer); 
//          timer = setTimeout(doStuff, 1000);
// 
//          function doStuff() {
//              alert('do stuff');
//          }
// 
//   });
// 
// });







// var timer = null;
// jQuery(document).on('keyup', '#AjaxSearchForm form', function(){
//        clearTimeout(timer); 
//        timer = setTimeout(ajax, 2000);
// 
//        var $form = jQuery(this);
//        var $input = $form.find('input[name="s"]');
//        var query = jQuery('#Search').val();
//        var len = query.length;
//        var $content = jQuery('#content')
//        var $results = jQuery('#results')
//        var $quicklinks = jQuery('#quicklinks')
// 
//        jQuery.ajax({
//            type: 'post',
//            url: myAjax.ajaxurl,
//            data: {
//                action: 'solaris_load_search_results',
//                query: query
//            },
//            beforeSend: function() {
//                // $input.prop('disabled', true);
//                $content.addClass('loading');
//                $content.addClass('loaded');
//            },
//            success: function(response) {
//              // timer = setTimeout(function(){
//                // $input.prop('disabled', false);
//                $content.removeClass('loading');
//                $results.html(response);
//              // },1000);
// 
//            }
//        });
// 
//       function doStuff() {
//           alert('do stuff');
//       }
// 
// 
// 
// 
//        // function checkWhitespace(inputString) {
//        // 
//        //     let stringArray = inputString.split(' ');
//        //     let output = true;
//        //     for (let el of stringArray) {
//        //         if (el != '') {
//        //             output = false;
//        //         }
//        //     }
//        //     return output;
//        // }
//        // 
//        // 
//        // 
//        // if (checkWhitespace(query)) {
//        // 
//        //     $results.addClass('uk-hidden');
//        // 
//        //     $quicklinks.removeClass('uk-hidden');
//        // 
//        // } else {
//        // 
//        //     $quicklinks.addClass('uk-hidden');
//        // 
//        //     $results.removeClass('uk-hidden');
//        // 
//        // }
// 
// 
// 
//        return false;
// 
// });
  

  





// jQuery(document).on('keydown', '#AjaxSearchForm form', function() {
// 
//     function checkWhitespace(inputString) {
// 
//         let stringArray = inputString.split(' ');
//         let output = true;
//         for (let el of stringArray) {
//             if (el != '') {
//                 output = false;
//             }
//         }
//         return output;
//     }
// 
//     var query = jQuery('#Search').val();
//     var len = query.length;
//     var $content = jQuery('#content')
//     var $results = jQuery('#results')
//     var $quicklinks = jQuery('#quicklinks')
// 
//     jQuery.ajax({
//         type: 'post',
//         url: myAjax.ajaxurl,
//         data: {
//             action: 'solaris_load_search_results',
//             query: query
//         },
//         beforeSend: function() {
//             // $input.prop('disabled', true);
//             $content.addClass('loading');
//             // $content.addClass('loaded');
//         },
//         success: function(response) {
//             // $input.prop('disabled', false);
//             $content.removeClass('loading');
//             $results.html(response);
// 
//         }
//     });
// 
//     if (checkWhitespace(query)) {
// 
//         $results.addClass('uk-hidden');
// 
//         $quicklinks.removeClass('uk-hidden');
// 
//     } else {
// 
//         $quicklinks.addClass('uk-hidden');
// 
//         $results.removeClass('uk-hidden');
// 
//     }
// 
//     return false;
// 
// });





