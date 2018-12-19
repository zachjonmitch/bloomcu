/*
* Persona
* Version: 0.3.0
*
* Changelog:
* 0.3.0:
* - Add function to track loginer persona
* - Update setCookie() to console.log unique cookie name
*
* Author: Ryan Harmon
*/

var blm_debug = true;

/*
* ------------------------------------------------------------------------------
* Identify Trigger Page
* ------------------------------------------------------------------------------
*
* These functions exist to identify trigger pages
* thisPage()s returns the naked page slug
* isTriggerPage() returns a persona if the page is a trigger page
*
*/

function thisPage() {
    var pathname = window.location.pathname;
    var splitReverse = pathname.split('/').reverse();
    return splitReverse[1];
}

function isTriggerPage() {

    // Checks if "thisPage()" page exists in provided array
    function isInGoalPageArray( array ) {
        return array === thisPage();
    };

    try{
         // Iterates over each array in goal pages
        for ( var key in blm_triggerPages ) {
            if ( key != 'login' ) { 
                if (blm_triggerPages.hasOwnProperty( key )) {
                    if ( blm_triggerPages[key].some( isInGoalPageArray ) ) {
                        return key;
                    }
                }
            }
        }

    }
    catch(e){
        //no match

    }

   
}

/*
* ------------------------------------------------------------------------------
* Set Persona
* ------------------------------------------------------------------------------
*
* Here we store the users persona in a cookie if we are on a trigger page
* Then we check if the user already has a persona for the page
* If blm_splitTest true, we run setRandomPersona()
* for a 50/50 chance for active or inactive
*
*/

function setPersona() {
    var page = isTriggerPage();

    if ( page ) {
        var persona = getCookie('blm_user');

        if ( persona != page && persona != page + "-inactive" ) {

            if ( blm_splitTest ) {
                setRandomPersona();
            } else {
                setCookie( "blm_user", page, 14 );
            }

        } else {

            if ( blm_debug ) {
                console.log('Persona is already set for this page');
            }
        }
    }
};

function setRandomPersona() {
    var page = isTriggerPage(),
        rand = Math.random() >= 0.5; // returns true/false

    if ( rand ) {
        setCookie( "blm_user", page + "-inactive", 14 );
    } else {
        setCookie( "blm_user", page, 14 );
    }
}

/*
* ------------------------------------------------------------------------------
* Track User Login
* ------------------------------------------------------------------------------
*
* Here we set a cookie when the user logs into online banking
* The login event listener is attached to an element by id
* This element is set in persona's config.js
* Right now we watch only one element
*
*/

function setLoginerPersona() {
    setCookie( "blm_loginer", true, 14 );
}


/*
* ------------------------------------------------------------------------------
* COOKIE HANDELERS
* ------------------------------------------------------------------------------
*/

function setCookie( name, value, days) {
	if ( days ) { //if have days and impressions is set to false
		var date = new Date();
		date.setTime( date.getTime() + ( days * 24 * 60 * 60 * 1000 ) );
		var expires = "; expires="+date.toGMTString();
	}
	else {
        var expires = "";
    }
    
    document.cookie = name + "=" + value + ";expires=" + expires + ";path=/";
    
    if(name != 'blm_loginer') {
        document.cookie ="blm_impressions=0; path=/";
    }
    if ( blm_debug ) {
        console.log( name, "set to", getCookie( name ) );
    }
}

function getCookie( name ) {
	var nameEQ = name + "=";
	var ca = document.cookie.split( ';' );
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while ( c.charAt(0)==' ' ) c = c.substring( 1, c.length );
		if ( c.indexOf( nameEQ ) == 0 ) return c.substring( nameEQ.length,c.length );
	}
	return null;
}

function eraseCookie( name ) {
	setCookie( name, "", -1);
}

/*
* ------------------------------------------------------------------------------
* Initialize Persona
* ------------------------------------------------------------------------------
*/

// Wait before attempting to set persona
try {
    // var blm_persona_status=false; //enable/disable persona
  
    if(blm_persona_status) {
        setTimeout( function(){
            setPersona();
        }, 2000);
        var seen = getCookie('blm_impressions');
        var max_imp = getCookie('blm_impressions');

        if($('body').hasClass('home') && blm_persona_status && getCookie('blm_user') != null && max_imp > seen ) {
            $('body').addClass('personalized');
            //clear inactive persona if a/b testing is off
            if( !blm_splitTest && getCookie('blm_user').includes('-inactive') ){
                eraseCookie( 'blm_user' );

            }
        } else if($('body').hasClass('home') && blm_persona_status && getCookie('blm_loginer') != null ) {
            $('body').addClass('personalized');
            //clear inactive persona if a/b testing is off
            if( !blm_splitTest && getCookie('blm_user').includes('-inactive') ){
                eraseCookie( 'blm_user' );

            }
        }
    } else {
        eraseCookie( 'blm_user' );
        eraseCookie( 'blm_loginer' );
        eraseCookie( 'blm_impressions' );
        
        if ( blm_debug ) {
            console.log('persona is off');
        }
    }
} catch(e){
    //error message
}

// Maker user's persona public
var blm_user_persona = getCookie('blm_user');

// What is the users current persona?
if ( blm_debug ) {
    console.log( 'blm_user is', blm_user_persona );
}

/*
* ------------------------------------------------------------------------------
* Initialize Loginer Persona
* ------------------------------------------------------------------------------
*/

// Get loginer triggers
var loginerTriggers = $('.login-trigger');

// Attach event listener to each
// for (var i = 0; i < loginerTriggers.length; i++) {
  loginerTriggers.on("click", function() {

      // Set loginer cookie
      setLoginerPersona();
  });
// }

// Maker user's loginer persona public
var blm_loginer = getCookie('blm_loginer');


// Is the user a loginer
if ( blm_debug ) {
    console.log( 'blm_loginer is', blm_loginer );
}

/*
* ------------------------------------------------------------------------------
* Initialize Clear Persona Button
* ------------------------------------------------------------------------------
*/

// Get loginer triggers
var clearPersonaTrigger = $( '.blm_clearPersonaTrigger' );

// Attach event listener
clearPersonaTrigger.on("click" ,function( event ) {
    event.preventDefault();

    if (confirm('Clear my persona?')) {
        // Erase cookies
        eraseCookie( 'blm_user' );
        eraseCookie( 'blm_loginer' );
        window.location.reload();
        // Log event
        if ( blm_debug ) {
            console.log( 'persona cleared');
        }
    } else {
        // Do nothing!
    }   
    
});