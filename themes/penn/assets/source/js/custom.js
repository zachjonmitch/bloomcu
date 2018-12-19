//--------------------------------------------------------------
// CUSTOM
//--------------------------------------------------------------

// footer menus
const footTriggerOne = document.getElementById('footer-nav-1');
const footTriggerTwo = document.getElementById('footer-nav-2');
const footTriggerThree = document.getElementById('footer-nav-3');
const triggers = [footTriggerOne, footTriggerTwo, footTriggerThree];

triggers.forEach(trigger => {
	trigger.addEventListener('click', e => {
		if (trigger.classList.contains('is-active')) {
			trigger.classList.remove('is-active');
			return;
		}

		triggers.forEach(trigger => {
			trigger.classList.remove('is-active');
		});

		trigger.classList.add('is-active');
	});
});

// Product Page accordion Dropdown
const accordionTriggers = [...document.querySelectorAll('.js-disclosure-title')];

accordionTriggers.forEach(trigger => {
	trigger.addEventListener('click', e => {
		if (trigger.classList.contains('is-active')) {
			$(trigger).removeClass('is-active').ariaNotExpanded();
			return;
		}

		accordionTriggers.forEach(trigger => {
			$(trigger).removeClass('is-active').ariaNotExpanded();
		});

		$(trigger).addClass('is-active').toggleAriaExpanded();
	});
});