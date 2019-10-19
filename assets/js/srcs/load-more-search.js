jQuery(function($){ // use jQuery code inside this to avoid "$ is not defined" error
	$('.solaris_loadmore').click(function(){
 
		var button = $(this),
		    data = {
			'action': 'loadmoresearch',
			'query': solaris_loadmore_search_params.posts, // that's how we get params from wp_localize_script() function
			'page' : solaris_loadmore_search_params.current_page
		};
 
		$.ajax({ // you can also use $.post here
			url : solaris_loadmore_search_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) { 
					button.text( 'load more posts' );
					$( ".archive-posts" ).append(data);
					// $( ".archive-posts" ).before(data);
					solaris_loadmore_search_params.current_page++;
 
					if ( solaris_loadmore_search_params.current_page == solaris_loadmore_search_params.max_page ) 
						button.remove(); // if last page, remove the button
 
					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					button.remove(); // if no data, remove the button as well
				}
			}
		});
	});
});