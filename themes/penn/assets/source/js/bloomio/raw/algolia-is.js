/**
@package Algolia Instant Search
@author  Rashaan Thompson
@version 2.4.1 //algolia version

*/
$(document).ready( function() {
    
    const appID = 'XA10UKG343';
    const apiKey = '69d6d8a3b57e60118154f9121587e93a';
    const container = '#search';
    const placeholder = 'Type anything you want to know...';        


    var search = instantsearch({
        // Replace with your own values
        appId: appID,
        apiKey: apiKey, // search only API key, no ADMIN key
        indexName: 'preffix_searchable_posts',
        routing: false,
        searchParameters: {
            hitsPerPage: 7
        }
    });

    
    // Bind search to input field
    search.addWidget(
        instantsearch.widgets.searchBox({
        container: container,
        autofocus: true, 
        magnifier: false,
        reset: false,
        wrapInput: true,
        placeholder: placeholder
        })
    );

    // Display results
    search.addWidget(
        instantsearch.widgets.hits({
        container: '#hits__posts',
        templates: {
            item: document.getElementById('template-hits__posts').innerHTML,
            empty: "We didn't find any results for the search <em>\"{{query}}\"</em>"
        }
        })
    );
    //pagination
    // search.addWidget(
    //     instantsearch.widgets.pagination({
    //     container: '#pagination'
    //     })
    // );

    //activate instant search
    // search.start();
    $('#modal-search-results').addClass('hide');
    var query = null;
    var activeSearch = false; 
    //stop form submit
    $('#search').on('keyup keypress', function(e) {
       
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) { 
            e.preventDefault();
            return false;
        }
        query = $('#search').val(); 

        if( query.length >= 1 ) {
            if( !activeSearch ) {
                //activate instant search
                search.start();
            }
            activeSearch = true;
            $('#modal-search-results').removeClass('hide');

        } else {
            $('#modal-search-results').addClass('hide');
        }
    });

    $('.secondary-navigation__search').click( function(e){
        setTimeout(() => {
            $('#search').focus();        
        }, 20);    
    });
});