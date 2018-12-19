//--------------------------------------------------------------
// INDEX
//
// Entry point file for webpack.
//--------------------------------------------------------------

// SCSS
import '../scss/app.scss';

// Lazysizes
require('lazysizes/lazysizes'); // @see https://github.com/aFarkas/lazysizes
require('lazysizes/plugins/parent-fit/ls.parent-fit'); // @see https://github.com/aFarkas/lazysizes#parent-fit-extension
require('lazysizes/plugins/bgset/ls.bgset'); // @see https://github.com/aFarkas/lazysizes#bgset-plugin---lazy-responsive-background-image
require('lazysizes/plugins/unveilhooks/ls.unveilhooks'); // @see https://github.com/aFarkas/lazysizes/tree/gh-pages/plugins/unveilhooks
require('lazysizes/plugins/respimg/ls.respimg'); // IE 11. Only uncomment and use for support in IE.

// jQuery Extend
import './extend';

// Modals
import './modal';

// Buttons
import './button';

// Homepage Hero Slider
import './hero-slider';

// Detect Edge Util
import './detect-edge';

// Polyfills
import './polyfill/box-decoration-break';

import './custom';

// Navigation
import './navigation';
import './skip-nav';

// Tab accordion
import './init-accordion';