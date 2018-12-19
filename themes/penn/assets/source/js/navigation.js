//--------------------------------------------------------------
// NAVIGATION
//--------------------------------------------------------------

import verge from 'verge';
import { mobileWidth,debounce, triggerUpdateText } from './utilities';
import { DetectEdge } from './detect-edge'

// Set up edge detection for sub menus
window.navEdgeDetect = new DetectEdge('.sub-menu-level-1', 15);
const navEdgeDetect = window.navEdgeDetect;

//-----------------------------------------
// Declare Variables
//-----------------------------------------
const navigation = $('.navigation');
const navMain = $('#nav-main');
const isParentTrigger = $('.is-parent-trigger');
const subMenu = $('.sub-menu');
const mobileBackButton = $('.js-menu-back');
const mobileTrigger = $('.js-menu-trigger');
const triggerText = $('.c-trigger__text');
const modalTrigger = $('.js-modal-trigger');
const modal = $('.js-modal');
const body = $('body');
const $window = $(window);
const windowWidth = $window.width();
let currentNavDepth = 0;

//-----------------------------------------
// Aria Functions
//-----------------------------------------

/**
 * Set Mobile Aria
 */
function mobileTriggerAria(hidden = true, expanded = true, haspopup = true) {
	mobileTrigger.attr({
		'aria-hidden': hidden,
		'aria-expanded': expanded,
		'aria-haspopup': haspopup,
	});
}

/**
 * Add Aria Attributes
 * This is run on page load to setup aria.
 */
function addAria() {
	// Button
	mobileTriggerAria(true, false, true);

	// Navigation
	navigation.ariaHiddenFalse();
}

/**
 * Add Aria on Mobile
 * This is run on page load when on mobile view.
 */
function addMobileAria() {
	// Button
	mobileTriggerAria(false, false, true);

	// Navigation
	navigation.ariaHiddenTrue();
}

/**
 * Toggle Aria Attributes
 * This is run when menu button is clicked.
 */
function toggleMobileAria() {
	// Button
	mobileTriggerAria(false, true, false);

	// Navigation
	navigation.ariaHiddenFalse();
}

/**
 * Open Aria states to sub-menu and parent
 */
function openSubMenuAria(trigger) {
	trigger.attr('aria-expanded', true);
	trigger.next('.sub-menu').attr('aria-hidden', false);
}

/**
 * Closed Aria states to sub-menu and parent
 */
function closeSubMenuAria(parentTrigger = isParentTrigger, menu = subMenu) {
	parentTrigger.attr('aria-expanded', false);
	menu.attr('aria-hidden', true);
}

//-----------------------------------------
// Event Functions
//-----------------------------------------

/**
 * Close Main Nav Menus
 */
function closeMenus(parentTrigger = isParentTrigger, menu = $('.navigation .sub-menu')) {
	parentTrigger.removeClass('is-active');
	parentTrigger.parent().removeClass('is-active');
	menu.removeClass('is-active');
	closeSubMenuAria(parentTrigger, menu);
}

/**
 * Close Sibling Modals
 */
function closeSiblingModals(thisTrigger, thisModal) {
	modal.not(thisModal).removeClass('is-active');
	modalTrigger.not(thisTrigger).removeClass('is-active');
	modal.not(thisModal).attr('aria-hidden', true);
	modalTrigger.not(thisTrigger).attr('aria-expanded', false);
}

/**
 * Close All Modals
 */
function closeModals() {
	modalTrigger.removeClass('is-active');
	modal.removeClass('is-active');
	closeSubMenuAria(modalTrigger, modal);
}

/**
 * Close Mobile Nav
 */
function closeMobileNav() {
	if (windowWidth < mobileWidth) {
		mobileTrigger.removeClass('is-active');
		navigation.removeClass('is-active');
		addMobileAria();
		currentNavDepth = 0;
		slideNav(currentNavDepth);
	}
}

/**
 * Main toggle for all reveals
 */
function toggleNavElement (menuTrigger = isParentTrigger, menu = '.sub-menu') {
	menuTrigger.on('click', function(event){
		const currentTrigger = $(event.currentTarget);
		const currentMenu = currentTrigger.next(menu);
		const siblings = currentTrigger.parent().siblings();
		const siblingTriggers = currentTrigger.parent().siblings().children('.is-parent-trigger');
		const siblingMenus = siblingTriggers.next(menu);
		const depth = currentTrigger.data('level');

		// Open, Close trigger and menu.
		if (verge.viewportW() < mobileWidth) {
			if (currentTrigger.hasClass('js-modal-trigger')) {
				currentTrigger.toggleClass('is-active');

				// Open mega nav modals from floating nav
				if ((currentTrigger.attr('data-main-nav-trigger'))) {
					closeSiblingModals(currentTrigger, currentMenu);

					const navModal = $(`[data-main-nav-modal="${currentTrigger.attr('data-main-nav-trigger')}"]`);

					navModal
						.toggleClass('is-active')
						.toggleAriaHidden();
				}
			} else {
				// fix bug when clicking forward, back and then same trigger
				// is-active was being removed and closing the menu.
				currentTrigger.addClass('is-active');
				currentMenu.addClass('is-active');
			}
		} else { // desktop triggers and menus.
			currentTrigger.toggleClass('is-active');
			currentMenu.toggleClass('is-active');
		}

		// Conditional to target events
		if (currentTrigger.hasClass('js-modal-trigger')) {
			if (!currentTrigger.hasClass('is-active') || verge.viewportW() > mobileWidth) {
				closeSiblingModals(currentTrigger, currentMenu);
			}

			closeMenus();
			closeMobileNav();
		} else {
			closeModals();
			closeSubMenuAria(siblingTriggers, siblingMenus);
			siblings.removeClass('is-active');
			siblingTriggers.removeClass('is-active');
			siblingMenus.removeClass('is-active');
			currentTrigger.parent().toggleClass('is-active');
		}

		// Slide Mobile Nav
		if (depth && verge.viewportW() < mobileWidth) {
			currentNavDepth = depth;
			slideNav(currentNavDepth);
		}

		// Conditional for body classes
		if (currentTrigger.hasClass('is-active')) {
			body.addClass('nav-active');
		} else {
			body.removeClass('nav-active');
		}

		// Conditional for aria attr
		if (currentTrigger.hasClass('is-active')) {
			openSubMenuAria(currentTrigger);
		} else {
			closeSubMenuAria(currentTrigger);
		}

		// Scroll Top
		navigation.scrollTop(0);

		// Call Edge Detector.
		navEdgeDetect.checkElements();
	});
}

/**
 * Slide Utilities
 */

 // Slide nav by given depth
function slideNav(depth) {
	navMain.css( 'transform', `translateX(${depth * -100}%)` );
	displayBackButton();
}

// Show or Hide Back Button based on depth
function displayBackButton() {
	if (currentNavDepth > 0) {
		mobileBackButton.show();
	} else {
		mobileBackButton.hide();
	}
}

/**
 * Close All Utility
 */
function closeAll() {
	currentNavDepth = 0;
	slideNav(currentNavDepth);
	closeMenus();
	closeModals();
	body.removeClass('nav-active');
	mobileTrigger.removeClass('is-active');
	navigation.removeClass('is-active');
}

/**
 * Close everything when click is off nav elements
 */
function outsideClick() {
	document.addEventListener('click', e => (!e.target.closest('.js-nav')) ? closeAll() : null);
}

// Close menu if Esc key is pushed
function closeMenusOnEsc() {
	body.on('keydown', function (e) {
		if (e.which === 27) {
			if (body.hasClass('nav-active')) {
				closeAll();
			}
		}
	});
}

/**
 * Watch for clicks
 */
function runEventWatchers() {
	toggleNavElement();
	toggleNavElement(modalTrigger, '.js-modal');
	outsideClick();
}

//-----------------------------------------
// Mobile specific functions
//-----------------------------------------

/**
 * Toggle Mobile Nav
 *
 * @param {object} event Event object.
 */
function toggleMobileNavigation(event) {
	event.preventDefault();

	mobileTrigger.toggleClass('is-active');
	navigation.toggleClass('is-active');

	if (mobileTrigger.hasClass('is-active')) {
		toggleMobileAria();
		closeModals();
		body.addClass('nav-active');
	} else {
		addMobileAria();
		closeAll();
	}

	triggerUpdateText(triggerText);
}

// Toggle mobile nav event
mobileTrigger.on('click', toggleMobileNavigation);

/**
 * Back button event
 */
function backButton() {
	mobileBackButton.on('click', function() {
		// Make sure the current sub level is deactivated
		// toggleNavElement will toggle the is-active class.
		$(`.sub-menu-level-${currentNavDepth}`).removeClass('is-active');

		currentNavDepth--;
		slideNav(currentNavDepth);
	})
}

//-----------------------------------------
// Run Functions
//-----------------------------------------
addAria();
runEventWatchers();
backButton();
closeMenusOnEsc();

// If mobile update aria.
if (verge.viewportW() < mobileWidth) {
	addMobileAria();
}

// Check for resize to update aria.
$window.on(
	'resize',
	debounce(function() {
		if (verge.viewportW() >= mobileWidth) {
			addMobileAria();
			triggerUpdateText(triggerText);
			closeAll();
		}
	}, 500)
);

// Add function to window for use from other scripts.
window.navCloseAll = function() {
	closeAll();
}
