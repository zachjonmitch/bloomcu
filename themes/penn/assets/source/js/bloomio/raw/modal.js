//--------------------------------------------------------------
// MODAL
//--------------------------------------------------------------
const openModalTriggers = $('.js-open-modal');
const openReviewModal = $('.js-open-review');
const closeModalTriggers = $('.js-close-modal');
const allModals = $('.js-modal');
const modalOverlay = $('.js-modal-overlay');
const body = $('body');

function open_cta_modal() {
	const $this = $(this);
	// const modal = $this.next('.js-modal');
	const modal = $('#modal-cta');

	// Bail if modal is not found
	if (!modal.length) {
		console.log('Modal needs to be sibling to trigger.');
		return
	}

	modal
		// .addClass('is-active')
		.animate({width:'show'}, 'fast').addClass('is-active')
		.focus();

	modalOverlay.addClass('is-visible');
	body.addClass('no-scroll');
}

function closeModals() {
	allModals.animate({height:'hide'}, 'fast').removeClass('is-active');
	body.removeClass('no-scroll');
	modalOverlay.removeClass('is-visible');
}
function openReviewsModal() {
	const $this = $(this);
	// const modal = $this.next('.js-modal');
	const modal = $('#toggle-review-form');

	// Bail if modal is not found
	if (!modal.length) {
		console.log('Modal needs to be sibling to trigger.');
		return
	}

	modal
		// .addClass('is-active')
		.animate({width:'show'}, 'fast').addClass('is-active')
		.focus();

	modalOverlay.addClass('is-visible');
	body.addClass('no-scroll');
}

function closeModals() {
	allModals.animate({height:'hide'}, 'fast').removeClass('is-active');
	body.removeClass('no-scroll');
	modalOverlay.removeClass('is-visible');
}

openModalTriggers.on('click', open_cta_modal);
openReviewModal.on('click', openReviewsModal);
closeModalTriggers.on('click', closeModals);

