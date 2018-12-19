//--------------------------------------------------------------
// Modals
// Author: Paul Allen
//--------------------------------------------------------------
import {extend} from './utilities';

export const Modals = (function(options) {
	const defaults = {
		modalDataAttr: 'data-modal',
		addBodyClass: true
	}

	function BuildModals(options) {
		let publicAPIs = {};
		let settings;
		const body = document.querySelector('body');

		/**
		 * Private Methods
		 */
		function runModals() {
			const modals = [...document.querySelectorAll(`[${settings.modalDataAttr}]`)];

			if (modals.length <= 0) return false; // No modals found

			modals.forEach(modal => {
				const modalId = modal.getAttribute(settings.modalDataAttr);
				publicAPIs.modals[modalId] = modal
			});

			// Handle click events
			document.addEventListener('click', e => {
				handleClose(e);
				handleOpen(e);
			});

			document.addEventListener('keydown', e => {
				if (e.which === 27) {
					if (settings.addBodyClass) body.classList.remove('modal-active');
					publicAPIs.closeAllModals();
				}
			});
		}

		/**
		 * Handle Open
		 */
		function handleOpen(e) {
			// First, check for an anchor tag
			const anchor = e.target.closest('a');
			if (!anchor) return;

			// .href is needed for <a> tags inside an SVG.
			// Check if we can get one or the other.
			const anchorHash = anchor.hash || anchor.href.baseVal;

			// Bail if the hash is not formatted correctly
			if(!isTargetUrl(anchorHash)) return;

			// Prepare the hash to be checked
			const hashTarget = (anchorHash).replace('#', '');

			if(checkForModalId(hashTarget)) {
				e.preventDefault();
				publicAPIs.openModal(hashTarget);
				if (settings.addBodyClass) body.classList.add('modal-active');
			}
		}

		/**
		 * Handle Close
		 */
		function handleClose(e) {
			if (!publicAPIs.activeModal) return; // Return if there is not an active modal

			if (
				e.target.hasAttribute('data-close-modal') || // click on close trigger
				!e.target.closest(`[${settings.modalDataAttr}]`) // clicks off modal
			) {
				if (settings.addBodyClass) body.classList.remove('modal-active');
				publicAPIs.closeAllModals();
			}
		}

		/**
		 * Check if url is a target url with the #
		 */
		function isTargetUrl(url) {
			const test = new RegExp(/^#/gm);
			return test.test(url);
		}

		/**
		 * Check if Modal is in the list of registered Modals
		 */
		function checkForModalId(id) {
			return publicAPIs.modals.hasOwnProperty(id);
		}

		/**
		 * Public APIs
		 */
		publicAPIs.modals = {};

		publicAPIs.activeModal = null;

		publicAPIs.openModal = function(modalId) {
			publicAPIs.modals[modalId].classList.add('is-active');
			publicAPIs.modals[modalId].setAttribute('aria-hidden', 'false');

			publicAPIs.activeModal = publicAPIs.modals[modalId];
		}

		publicAPIs.closeAllModals = function() {
			for (let modal in publicAPIs.modals) {
				publicAPIs.modals[modal].classList.remove('is-active');
				publicAPIs.modals[modal].setAttribute('aria-hidden', 'false');
			}

			publicAPIs.activeModal = null;
		}

		publicAPIs.init = function(options) {
			settings = extend(defaults, options || {});
			runModals();
		}

		publicAPIs.init(options);

		return publicAPIs;
	}

	return BuildModals;

})(window, document);

window.baseModals = new Modals();
