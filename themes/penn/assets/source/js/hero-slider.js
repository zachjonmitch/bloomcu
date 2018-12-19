//--------------------------------------------------------------
// Hero Slider
//--------------------------------------------------------------
class HeroSlider {
	constructor(slideSelector, slideDelay) {
		this.slideSelector = slideSelector;
		this.slideDelay = slideDelay || 4000; // Defaults to 4000ms
		this.slides = this.collectSlides();
		this.currentSlideIndex = 0;
		this.currentSlideElement;
		this._slideLoop;
		this._isRunning;

		// Init
		this.main();
	}

	/**
	 * Main
	 */
	main() {
		// Bail if 1 or less slides are found.
		if (this.slides <= 1) return;

		// Set the initial slide.
		this.currentSlideElement = this.activateSlide(this.currentSlideIndex);

		// Start looping over the slides.
		this.startLoop();
	}

	/**
	 * Start Loop
	 */
	startLoop() {
		this._isRunning = true;

		this._slideLoop = setInterval(() => {
			this.nextSlide();
		}, this.slideDelay);
	}

	/**
	 * Stop Loop
	 */
	stopLoop() {
		this._isRunning = false;

		clearInterval(this._slideLoop);
	}

	/**
	 * Toggle Loop
	 */
	toggleLoop() {
		this._isRunning ? this.stopLoop() : this.startLoop();
	}

	/**
	 * Next Slide
	 */
	nextSlide() {
		// Deactivate current slide.
		this.deactivateSlide(this.currentSlideIndex);

		// Go back to the beginning of the slide array if on last item,
		// otherwise increment the slide index.
		if ( this.currentSlideIndex === (this.slides.length - 1) ) {
			this.currentSlideIndex = 0;
		} else {
			this.currentSlideIndex++;
		}

		this.currentSlideElement = this.activateSlide(this.currentSlideIndex);
	}

	/**
	 * Activate Slide
	 */
	activateSlide(slideNumber) {
		const newActiveSlide = this.slides[slideNumber]
		newActiveSlide.classList.add('is-active-slide');

		return newActiveSlide;
	}

	/**
	 * Deactivate Slide
	 */
	deactivateSlide(slideNumber) {
		this.slides[slideNumber].classList.remove('is-active-slide');
	}

	/**
	 * Collect Slides
	 */
	collectSlides() {
		return Array.from(document.querySelectorAll(this.slideSelector));
	}
}

window.heroSlider = new HeroSlider('.js-homepage-slide', 4000);

//------------------------------
// Home Page Hero Controls
//------------------------------
const heroSliderPausePlay = document.querySelector('.js-hero-slider-control');

if (heroSliderPausePlay) {
	const buttonText = document.querySelector('.js-hero-slider-control__text');

	heroSliderPausePlay.addEventListener('click', e => {
		window.heroSlider.toggleLoop(); // Call slider's toggle method

		heroSliderPausePlay.classList.toggle('is-playing');

		buttonText.textContent = buttonText.textContent === 'Pause' ? 'Play' : 'Pause';
	});
}
