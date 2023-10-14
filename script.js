function updateSeconds(element) {
	let initialSeconds = parseInt(element.textContent, 10);
	initialSeconds++;
	element.textContent = initialSeconds;
}
