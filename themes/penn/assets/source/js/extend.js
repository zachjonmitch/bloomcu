//--------------------------------------------------------------
// EXTEND
//--------------------------------------------------------------

/**
 * Accessibility
 */
jQuery.fn.extend({
	toggleAriaHidden: function() {
		if (!this.attr('aria-hidden')) {
			return;
		}

		let hidden = this.attr('aria-hidden') === 'true' || false;
		return this.attr('aria-hidden', !hidden);
	},
	ariaHiddenTrue: function() {
		return this.attr('aria-hidden', 'true');
	},
	ariaHiddenFalse: function() {
		return this.attr('aria-hidden', 'false');
	},
	toggleAriaExpanded: function() {
		if (!this.attr('aria-expanded')) {
			return;
		}

		let hidden = this.attr('aria-expanded') === 'true' || false;
		return this.attr('aria-expanded', !hidden);
	},
	ariaExpanded: function() {
		return this.attr('aria-expanded', 'true');
	},
	ariaNotExpanded: function() {
		return this.attr('aria-expanded', 'false');
	},
});
