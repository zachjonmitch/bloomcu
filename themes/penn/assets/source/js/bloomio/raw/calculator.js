( function( $, document ) {
	'use strict';

		// Savings Calculator
		var savingCalcInit = function() {

			var el = document.getElementsByClassName( 'savings-calculator' ),
			$el = $(el);

		var runCalculation = function(form) {

			var principalValue = form.savingsPrincipal.value,
				yearValue = form.savingsYears.value,
				interestValue = form.savingsInterestRate.value,
				timesValue = form.savingsCompounded.value;

			if ((principalValue.value === null || principalValue.length === 0) ||
				(yearValue === null || yearValue.length === 0) ||
				(interestValue === null || interestValue.length === 0) ||
				(timesValue === null || timesValue.length === 0)) {

				form.savingsResult.value = " ";

			} else {

				form.savingsResult.value = Math.round(principalValue * (Math.pow(1 + ((interestValue / 100) / timesValue), timesValue * yearValue)));
			}

		};

		var bindEvents = function(element) {
			element.addEventListener('input', function(e){
				runCalculation(this);
			});
		};

		var init = function() {
			for (var i = 0 ; i < el.length; i++) {
				bindEvents(el[i]);
				console.info('Initialized Savings Calculator');
			}
		};

		init();
	};

	savingCalcInit();

	// Loan Calculator
	var loanCalcInit = function() {
		var loanCalculator = $( '.loan-calculator' );

		( function() {
			if ( loanCalculator.length ) {
				loanCalculator.accrue();
				console.info( 'Initialized Loan Calculator' );
			}
		}() );
	};

	loanCalcInit();

	const calcText      = $( '#js-toggle-calculator' ).text();
	const formContainer = $( '#page-product-rates .side-form' );
	const tableRates    = $( '#page-product-rates .table-rates' );

	// Capture rate on click.
	$( '#js-toggle-calculator' ).on( 'click', function( event ) {
		event.preventDefault();

		const button = $( this );

		// Toggle text.
		button.text( function( i, text ) {
			return text === calcText ? 'Close Calculator' : calcText;
		});

		// Toggle loan form.
		formContainer.toggleClass( 'active' );
		try {
			//check if loan calc exist
			isLoanCalc = $('#loan-calculator');

			var rateAmt = tableRates.find( 'tbody > tr td:eq(1)' ).text();
			var monthAmt = tableRates.find( 'tbody > tr td:eq(2)' ).text();

			// Clean rate ranges into a single number/float/object
			rateAmt = rateAmt.replace(/[&\/\\#,+()$~'":*?<>{}%a-zA-Z]/g,'');
			monthAmt = monthAmt.replace(/[&\/\\#,+()$~'":*?<>{}%a-zA-Z]/g,'');

			// Create array
			rateAmt = '['+rateAmt.replace('-',',')+']';
			monthAmt = '['+monthAmt.replace('-',',')+']';

			// Save rates object
			var rates = JSON.parse( rateAmt );
			var months = JSON.parse( monthAmt );

			// Capture calculator field
			var calcAPR = $( '#loan-calculator .accrue-field-rate .rate' );
			var calcTerm = $( '#loan-calculator .accrue-field-term .term' );

			// Set the first/smallest rate by default
			calcAPR[0].value = rates[0];
			calcTerm[0].value = months[0];

			$( '.loan-calculator' ).accrue();
		} catch( e){
			// console.log('calculator init');
		}

		// Scroll up to form
		$('html, body').animate({
			scrollTop: ($('#page-product-rates').offset().top)
		},500);

	});

}( jQuery, document ) );
