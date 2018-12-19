// This script evaluates clicks for a link anchor,
// and triggers warning modal if anchor is not whitelisted.
;( function( $ ) {
    
    'use strict';
    var speedbump = function() {

        // Get whitelist domains from speedbump.php
        // speedbump.php returns an array of objects from ACF global options
        // Like this [{"domain":"google.com"},{"domain":"facebook.com"}
        var whitelist_domains = window.whitelist_domains;

        // New array
        var domains_array = new Array;

        // Push domains to 'domains_array'
        // We get an array like this ["google.com", "facebook.com"]
        for ( var i in whitelist_domains ) {
            domains_array.push( whitelist_domains[i].domain );
        }

        // Push host domain to domains_array
        domains_array.push( location.host );


        // Check for anchor in clicked node
        function isInsideA(node) {
            var parent = node.parentNode;
            while (parent != null) {
                if (parent.nodeName == 'A') {
                    return true;
                }
                parent = parent.parentNode;
            }
            return false;
        }

        // Get anchor in clicked node
        function getNodeA(node) {
            var parent = node.parentNode;
            while (parent != null) {
                if (parent.nodeName == 'A') {
                    return parent;
                }
                parent = parent.parentNode;
            }
            return false;
        }

        // Evaluate click, determine if a link was clicked
        // If a link was clicked, get the link
        // If link is not whitelisted, show warning popup
        document.addEventListener('click', function(event) {
            if ( event.target.nodeName == 'A' || isInsideA(event.target) ) {
                var nodeA = getNodeA(event.target) || event.target;

                var safe = false;
                for (var key in domains_array) {

                    if ( nodeA.href.indexOf(domains_array[key]) > 0
                        || nodeA.href === domains_array[key] ) {
                        safe = true;
                        break;
                    }
                }

                if (nodeA.href === "") {
                    safe = true;
                    
                }

                if ( !safe ) {
                    event.preventDefault();

                    // Open speedbump modal with Foundation
                    // $('#modal-speedbump').foundation('open');
                    $('#modal-speedbump')
                    .animate({width:'show'}, 'fast').addClass('is-active')
                    .focus();
                    $('.js-modal-overlay').addClass('is-visible');
                    $('body').addClass('no-scroll');
                    
                    window.targetURL = nodeA.href;
                }

            }

            if ( event.target.nodeName == 'BUTTON' && event.target.id == 'continue' ) {
                window.open(window.targetURL);
            }
        });
    };

    let $el = $('#modal-speedbump'); 

    // Initializer function
    var init = function() {

        if ($el) {
            speedbump();
            console.info('Initialized speedbump.');
        }
    };

    init();

} )( jQuery );