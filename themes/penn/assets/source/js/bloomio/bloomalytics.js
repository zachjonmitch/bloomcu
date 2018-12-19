/**
 * Persona Analytics Retriever
 * * 
 * @author Rashaan Thompson
 * 
 * Dependencies:
 * Persona container header.personalized
 * CTA marker .cta
 * 
 */

var api_url = "https://script.google.com/macros/s/AKfycbxs3KXZC3D3UmLWsZllNM0htINZ2SkiEG7iBMo0TPqPduYhkoY/exec";
var clicks = 0;
var imp_count = 0;
var pageview = 0;
var datafile = null;
var pageState = getCookie('blm_user');
const path = location.pathname;
var pageName = path.split('/').reverse()[1];  



var personalized = $('*').hasClass('personalized');

function blm_init() {
    if (pageState == null) {
        
        pageState = getCookie('blm_loginer');
        
    }
    
    if( pageState != null) {
        imp_count = 1;
        pageview = 1;
        sendData('impressions');
    } else {
        imp_count = 0;
        pageview = 1;
        sendData('pageviews');
    }
}

function sendData(event) {

    setTimeout(function() {   
        // testingPageID = pageState;
        var isPersona = false;
       
        personalized = $('*').hasClass('personalized');
        var isLogin = $('*').hasClass('personalized-form-login');

        if(pageState == true) {
            // isPersona = true;
            pageState = "login";
        } else if (pageState == null) {
            pageState = pageName;
        } else {
            // isPersona = true;
        }
       
        if(personalized && !isLogin) {
            isPersona = true;
        } else {
           
            if(event == 'impressions' && !isLogin) {
                imp_count = 0;
                pageState = pageName;
            } else{

                if(personalized && isLogin) {
                    pageState = "login";
                    isPersona = true;
                }
            }
        }

        //replace spaces in persona variable set name
        pageState = pageState.replace(/\s/g, "-");
        
        //normalize string data
        pageState= pageState.toLowerCase();

        var domain = location.host
       
        domain = domain.replace("www.","");
        
        var data_port = domain.split(".")[0];
        
        if(pageState == '') {
            pageState = 'homepage';
        }
        var pageID = domain +'-'+ pageState; 

        datafile = {
            
            'page-id': pageID,
            'client': domain,
            'clicks': clicks,
            'event': event,
            'pageviews': pageview,
            'impressions':imp_count,
            'url': path,
            'persona':isPersona,
            // 'is-mobile': isMob,


            //settings
            'port': data_port,
            'state': 'v1' //data-version
        } 
        
        //reset data;
        clicks = 0;
        imp_count = 0;
        
        // if (localStorage) {
        //     // LocalStorage is supported!
        //     localStorage.setItem("personaData", JSON.stringify(datafile));
        //     } else {
        //     // No support. Use a fallback such as browser cookies or store on the server.
            
        //     document.cookie="personaData="+ JSON.stringify(datafile);
        //     }
            $.ajax({    
                url: api_url,
                data: datafile,
                dataType: 'json',
                type: 'POST',
                // headers: 'Access-Control-Allow-Origin: *',

                // place for handling successful response
                success: function(el) {
                   if (blm_debug){
                        console.log("sendData func: ", el.result);      
                   }   

                },

                // handling error response
                error: function(el) {  
                    if (blm_debug){                      
                    console.log("sendData func err: ", el);
                    }
                }
            }).done(function(e) {
                console.log('done', e);
                
            });//end ajax

            if (blm_debug){ console.log("id set: ", pageState);}
            if (blm_debug){ console.log("Data: ", datafile);}
        
        }, 0); 
    
    // }

    
}//end sendData

//analytics-events 
$('.blm_cta').on('click', function(e){
    // e.preventDefault();
    clicks = 1;
    // heroClick = true;
    //null all other events
    pageview = 0;
    imp_count = 0;

    // var gotourl = $(this).attr('href');
    
    //send data
    sendData('clicks');

    // setTimeout(function(){
    //     if(gotourl!=undefined || gotourl != null) {
    //         window.location.href = gotourl;
    //     }
    // }, 400);
});

blm_init();