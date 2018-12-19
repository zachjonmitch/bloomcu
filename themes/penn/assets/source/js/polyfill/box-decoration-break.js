/**
 * CSS3 Box Decoration Break
 * Polyfill for IE and EDGE
 */

/**
 * Box Decoration Break
 * Function will split inner text into span tags, separated by <br>.
 * Used by the 'c-quote' block.
 * @param Node el HTML element with text to be processed.
 */
function boxDecorationBreak(el) {
	const $el = $(el);
	const $parent = $el.parent();
	const strings = $(el).html().split('<br>');

	$el.remove();

	$.each(strings, (i, string) => {
		// Remove breaks
		string = string.replace(/\n/, '');
		$parent.append($('<span>').text(string));

		// Readd the <br> tags
		if (i < strings.length -1) {
			$parent.append('<br>');
		}
	});

}

/**
 * Has Box Decoration Break
 */
function hasBoxDecorationBreak() {
	// We have to use this, because IE doesn't understand 'CSS.supports'
	if (window.navigator.userAgent.match(/Trident/g)) {
		return false;
	}
	return CSS.supports('( box-decoration-break: clone ) or ( -webkit-box-decoration-break: clone )');
};

if (!hasBoxDecorationBreak()) {
	boxDecorationBreak(document.querySelector('.js-box-deco'));
}
