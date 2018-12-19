/**
 * Detect Edge
 */
import {debounce} from './utilities';

/**
 * Detect Edge
 * @param String selector
 * @param Integer buffer(optional) How close to edge can elements get before edge detector class is added.
 */
export class DetectEdge {
	constructor(selector, buffer) {
		this.buffer      = buffer || 0;
		this.elements    = this.getElements(selector);

		this.main();
	}

	/**
	 * Main
	 */
	main() {
		if (this.elements.length > 0) {
			this.checkElements();

			window.addEventListener('resize', e => {
				this.checkElements();
			});
		}
	}

	/**
	 * Check if elements are touching window's edge (minus buffer)
	 */
	checkElements() {
		this.removeEdgeClasses();

		const windowWidth = this.getWindowWidth();

		this.elements.forEach(el => {
			const rect = el.getBoundingClientRect();

			if ((rect.left + rect.width) + this.buffer > windowWidth) {
				// el is touching right edge
				el.classList.add('right-edge');
			}

			if (rect.left <= this.buffer) {
				// el is touching left edge
				el.classList.add('left-edge');
			}
		});
	}

	/**
	 * Remove Edge Classes
	 * Remove the classes added by checkElements.
	 */
	removeEdgeClasses() {
		this.elements.forEach(el => {
			el.classList.remove('right-edge');
			el.classList.remove('left-edge');
		});
	}

	/**
	 * Get Window Size
	 */
	getWindowWidth() {
		return window.innerWidth;
	}

	/**
	 * Get Elements
	 */
	getElements(selector) {
		return Array.from(document.querySelectorAll(selector));
	}
}
