//--------------------------------------------------------------
// Button Effects
//--------------------------------------------------------------
[...document.querySelectorAll('.button')]
	.forEach(button => button.addEventListener('mousemove', hoverEffect));

function hoverEffect(e) {
	const x = e.pageX - $(e.target).offset().left;
	const y = e.pageY - $(e.target).offset().top;

	e.target.style.setProperty('--x', `${x}px`);
	e.target.style.setProperty('--y', `${y}px`);
}
