let sessionSecElements = document.querySelectorAll(".session-sec");
function updateSeconds(element) {
	let initialSeconds = parseInt(element.textContent, 10);
	initialSeconds++;
	element.textContent = initialSeconds;
}

sessionSecElements.forEach(function (element) {
	setInterval(function () {
		updateSeconds(element);
	}, 1000);
});
