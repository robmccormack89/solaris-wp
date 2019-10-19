// require jquery, jquery is made available globally in webpack.config using expose-loader under jQuery
require('jquery');

window._ = require('debounce');

// import lightgallery
require('lightgallery');
require('lg-thumbnail');

// import uikit
import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';

// loads the Icon plugin
UIkit.use(Icons);

// The following line makes it finally work:
window.UIkit = UIkit;

require ('./ajax-search.js');

require ('./load-more.js');