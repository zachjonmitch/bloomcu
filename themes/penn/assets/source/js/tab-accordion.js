//--------------------------------------------------------------
// TAB ACCORDION CLASS
//--------------------------------------------------------------
import verge from 'verge';
import {
	mobileWidth,
	debounce
} from './utilities';

/**
 * Creates an instance of TabAccordion.
 *
 * Finds triggers and content within container
 * Add event listener to triggers
 * Trigger will find content element based on 'href="<#content>"' and add '.is-active'
 * Content element must have an ID that matches ID found in it's trigger's href
 *
 * @param {String} containerClass // tab accordion container's class e.i. '.tab-accordion-container'
 * @param {String} triggerClass // triggers' class , triggers must be <a> tag with href to corresponding content's ID
 * @param {String} contentClass // content class
 * @param {Boolean} closeOnClick // tabs will always close when clicked, otherwise they will only close when clicked on mobile
 * @param {Boolean} autoOpenOnDesktop // first tab will be opened when resizing to desktop if none are active
 * @param {Boolean} openFirstTabOnDesktop // first tab will be open on desktop
 * @param {Boolean} deepLinking
 */
class TabAccordion {
	constructor(
		containerClass,
		triggerClass,
		contentClass,
		closeOnClick,
		autoOpenOnDesktop,
		openFirstTabOnDesktop,
		deepLinking
	) {
		this._selectors = {
			containerClass,
			triggerClass,
			contentClass,
		};
		this._autoOpenOnDesktop = autoOpenOnDesktop || false;
		this._closeOnClick = closeOnClick || false;
		this._openFirstTabOnDesktop = openFirstTabOnDesktop || false;
		this._deepLinking = deepLinking || false;
		this._init();
	}

	_init() {
		const container = $(this._selectors.containerClass);

		// bail if container is not present
		if (container.length < 1) {
			return;
		}

		const triggers = container.find(this._selectors.triggerClass);
		const contents = container.find(this._selectors.contentClass);
		const locationHash = window.location.hash;

		triggers.on(
			'click', {
				allTriggers: triggers,
				allContent: contents,
				closeOnClick: this._closeOnClick,
				deepLinking: this._deepLinking,
			},
			openTab
		);

		if (this._autoOpenOnDesktop) {
			autoOpenOnDesktop(triggers);
		}

		if (this._openFirstTabOnDesktop && mobileWidth < verge.viewportW() && !locationHash) {
			setTimeout(() => {
				triggers.eq(0).trigger('click');
			}, 200);
		}

		if (this._deepLinking) {
			openDeepLinkedTab(triggers);
		}
	}
}

//------------------------------
// Events
//------------------------------

// Open a single tab, close others
function openTab(e) {
	if (e) {
		e.preventDefault();
	}

	const $this = $(this);
	const id = $this.attr('href');
	const target = $(id);
	const buttons = $(`*[href="${id}"]`); //Update desktop and mobile tab accordion buttons
	const allTriggers = e.data.allTriggers;
	const allContent = e.data.allContent;
	const closeOnClick = e.data.closeOnClick;
	const buttonActive = buttons.hasClass('is-active');

	if ((buttonActive && closeOnClick) || (buttonActive && verge.viewportW() < mobileWidth)) {
		closeAllTabs(allTriggers, allContent);
		return;
	}

	closeAllTabs(allTriggers, allContent);

	buttons.addClass('is-active').ariaExpanded();

	openContent(target);

	if (e.data.deepLinking) {
		if (history.pushState) {
			history.pushState(null, null, id);
		} else {
			window.location.hash = id;
		}
	}
}

// Close all tabs
function closeAllTabs(triggers, content) {
	triggers.removeClass('is-active').ariaNotExpanded();
	content.removeClass('is-active');
}

// Open tab's content
function openContent(content) {
	content.addClass('is-active').focus();
}

// If no accordion are open on resize to desktop, open the first one
function autoOpenOnDesktop(triggers) {
	window.addEventListener(
		'resize',
		debounce(() => {
			if (verge.viewportW() >= mobileWidth && !triggers.hasClass('is-active')) {
				const firstTrigger = triggers.eq(0);
				firstTrigger.trigger('click');
			}
		}, 500)
	);
}

// Open deeplinked tab if hash is present
function openDeepLinkedTab(triggers) {
	window.addEventListener('load', () => {
		const locationHash = window.location.hash;
		let activeTriggerIndex;

		if (!locationHash) return;

		$.each(triggers, function (index) {
			const href = this.getAttribute('href');

			if (href === locationHash) {
				activeTriggerIndex = index;
			};
		});

		const activeTrigger = triggers.eq(activeTriggerIndex);
		activeTrigger.trigger('click');
		$('html, body').animate({
			scrollTop: activeTrigger.offset().top
		});
	});
}

export {
	TabAccordion
};
