/*
Author: Rashaan Thompson 
Application: Smart App Banner
Dependencies: ClientJS (clientjs.org) - client.min.js
*/
// console.log('appbanner');
var client = new ClientJS();

var showSAB = true;

$(document).ready(function() {
    
    var isMobile = client.isMobile(); 

    var sessStorage = client.isSessionStorage();

    if(sessStorage) {
        showSAB = JSON.parse(sessionStorage.getItem('persona-sab'));
    }else{        
        showSAB = JSON.parse(getCookie('persona-sab'));           
    }
    if(showSAB == null ) {
        showSAB = true;
    }
    if(showSAB) {
       showBanner();
    }
    $('#app-banner .close a, #app-banner a.view-app').click( function(e){
        e.preventDefault();
        showSAB = false;
        removeAppBanner();

        var date = new Date();
        var minutes = 30;
        if(sessStorage) {
            sessionStorage.setItem('persona-sab', false);
        }else{
            
            date.setTime(date.getTime() + (minutes * 60 * 1000));

            document.cookie="persona-sab="+ showSAB +";expires="+ date.toUTCString();
        }
        $('.mega-wrapper').css('margin-top', 0);        
        $('#masthead').css('height', 'auto');
        $('#masthead').css('top', 0);
        $('.header').css('top', 0);
        $('.home .page-content').css('margin-top','0');
    });

    //check scrolling when banner active
    if(showSAB) {
        
        
        
        // var sab_Height = $('#app-banner').height();

        if ($('body').hasClass('home')){
            if( !$('#app-banner').hasClass('hide')) {   
                $('#app-banner').addClass('scrolled');
                $('#masthead').css('top', '100px');
                $('.header').css('top', '20px');
                $('#app-banner').css('height', '120px');
                $('.home .page-content').css('margin-top','99px');
            }
        } else {
            
            $(window).on('scroll',function() {           

                if ($('body').scrollTop() <= 150) {
                        $('#app-banner').removeClass('scrolled');

                } else if($('body').scrollTop() > 50) {                
                        $('#app-banner').addClass('scrolled');
                    
                }      

            });
            // $(window).on('resize',function() {  
            //     sab_Height = $('#app-banner').height();
            //     $('#masthead').css('top', sab_Height);
            // });
        }
        if( !$('#app-banner').hasClass('hide')) {        
            $('.mega-wrapper').css('margin-top', '100px');
            $('#masthead').css('height', '70px');
        }
    } else {
        // $('.mega-wrapper').css('margin-top', 0);
        
        // $('#masthead').css('top', 0);
    }

});
function removeAppBanner() {
    $('#app-banner').addClass('hide');    
}

function showBanner() {
    
    if(client.isMobileIOS() ) {
        $('#app-banner').removeClass('hide');
        $("#ios_tmp").removeClass('hide');
        // if(client.isIpad()) {
            // $("#ios_tmp a.view-app").attr('href','https://itunes.apple.com/us/app/united-texas-mobile/id567526388?ls=1&mt=8');
        // }else{
        //     $("#ios_tmp a.view-app").attr('href','https://itunes.apple.com/us/app/united-sa-mobile/id567526388?mt=8');
        // }

    } else if(client.isMobileAndroid()) {
        $('#app-banner').removeClass('hide');
        $("#ndrd_tmp").removeClass('hide');
        var scrnWidth = $(window).width();
        // if(scrnWidth >= 600 ) {
        //     $("#ndrd_tmp a.view-app").attr('href','https://play.google.com/store/apps/details?id=com.cmcflex.ftmobile.usa&hl=en');
        // }else{
            // $("#ndrd_tmp a.view-app").attr('href','https://play.google.com/store/apps/details?id=com.cmcflex.ftmobile.usa&hl=en');
        // }
        
    }
}
/*end smart mobileapp banner*/ 

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return;
}

/* Template to add to header

<div id="app-banner" class="hide" >
    <div id="ndrd_tmp" class="row hide">
        <div class="medium-3 small-1 columns close">
            <a href="#">&times;</a>
            </div>
            <div class="medium-6 small-7 columns app-details">
                <img class="app-image" src="<?php echo get_template_directory_uri();?>/assets/images/app-banner.jpg" alt="cover-art"/>
                <p style="padding: 0px 0 10px;">
                    <strong>Yolo FCU Mobile</strong>
                </p>
                <p style="padding: 0px 0 10px;">
                    Finance
                </p>
                <p style="padding: 0 0 10px 90px;">
                    Free - On the App Store
                </p>
            </div>
            <div class="medium-3 small-1 columns">
            <a href="https://play.google.com/store/apps/#" class="view-app" target="_blank">View</a>
            </div>
    </div>
    <div id="ios_tmp" class="hide row">
        <div class="medium-3 small-1 columns close">
        <a href="#">&times;</a>
        </div>
        <div class="medium-6 small-7 columns app-details">
            <img class="app-image" src="<?php echo get_template_directory_uri();?>/assets/images/app-banner.jpg" alt="cover-art"/>
            <p style="padding: 0px 0 10px;">
            <strong>Yolo FCU Mobile</strong>
            </p>
            <p style="padding: 0px 0 10px;">
                Finance
            </p>
            <p style="padding: 0 0 10px 90px;">
                Free - On the App Store
            </p>
        </div>
        <div class="medium-3 small-1 columns">
        <a href="https://itunes.apple.com/#" class="view-app" target="_blank">View</a>
        </div>
    </div>
</div>

*/