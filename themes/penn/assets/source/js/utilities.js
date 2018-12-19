//--------------------------------------------------------------
// UTILITIES
//--------------------------------------------------------------

/**
 * Mobile Width
 * This number is the width in which mobile view kicks in.
 */
export const mobileWidth = 960;

/**
 * Debounce
 * For resize event so it doesn't fire too many times.
 */
export function debounce(func, wait, immediate) {
	let timeout;
	return function() {
		let context = this;
		let args = arguments;
		let later = function() {
			timeout = null;
			if (!immediate) {
				func.apply(context, args);
			}
		};
		const callNow = immediate && !timeout;

		clearTimeout(timeout);

		timeout = setTimeout(later, wait);

		if (callNow) {
			func.apply(context, args);
		}
	};
}

/**
 * Trigger Update Text
 * @param Object element Text in trigger element to update.
 */
export function triggerUpdateText(element) {
	const textOpen = element.data('open');
	const textClose = element.data('close');

	if (element.parent().hasClass('is-active')) {
		element.text(textClose);
	} else {
		element.text(textOpen);
	}
}

/**
 * Scroll To element
 *
 * @param Object jQuery
 * @author Paul Allen
 */
export function scrollToElement(element) {
	const elementOffsetTop = element.offset().top;

	$('html, body').animate({
		scrollTop: elementOffsetTop
	}, 500);
}

/**
 * Scroll to Element by ID
 *
 * @author Paul Allen
 * Intended to be used on anchor tag
 */
export function scrollToTarget(e) {
	e.preventDefault();
	const $this = $(this);
	const href = $this.attr('href');

	if(! href.includes('#')) return; // Bail if href is not a target

	const target = $(`${href}`);

	scrollToElement(target);
}

/**
 * Extend
 * Merge two objects
 */
export function extend() {
	// Variables
	var extended = {};
	var deep = false;
	var i = 0;
	var length = arguments.length;

	// Check if a deep merge
	if ( Object.prototype.toString.call( arguments[0] ) === '[object Boolean]' ) {
		deep = arguments[0];
		i++;
	}

	// Merge the object into the extended object
	var merge = function (obj) {
		for ( var prop in obj ) {
			if ( Object.prototype.hasOwnProperty.call( obj, prop ) ) {
				// If deep merge and property is an object, merge properties
				if ( deep && Object.prototype.toString.call(obj[prop]) === '[object Object]' ) {
					extended[prop] = extend( true, extended[prop], obj[prop] );
				} else {
					extended[prop] = obj[prop];
				}
			}
		}
	};

	// Loop through each object and conduct a merge
	for ( ; i < length; i++ ) {
		var obj = arguments[i];
		merge(obj);
	}

	return extended;
};
