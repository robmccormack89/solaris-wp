// import uikit
import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';

// loads the Icon plugin
UIkit.use(Icons);

// load infinite scroll
var InfiniteScroll = require('infinite-scroll');

var infScroll = new InfiniteScroll( '.archive-posts', {
  path: '.next',
  append: '.search-result',
  button: '.view-more-button',
  // using button, disable loading on scroll 
  scrollThreshold: false,
  status: '.page-load-status',
  hideNav: '.pagi'
});