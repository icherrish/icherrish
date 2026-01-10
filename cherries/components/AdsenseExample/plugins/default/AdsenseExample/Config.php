//<script>


window.googletag = window.googletag || {cmd: []};

// define type and dimensions of the ad 
// and an unique id (here: example-ad-location) of a placeholder (here: a <div> tag)
googletag.cmd.push(function() {
	googletag
		.defineSlot(
			'/6355419/Travel/Europe/France/Paris', [300, 250], 'example-ad-location')
		.addService(googletag.pubads());
	googletag.enableServices();
});

$(document).ready(function() {
	// use your browser's developer console to find an already existing Ossn anchor
	// here: the class 'user-activity' inside of the newsfeed
	// and call jquery to prepend or append the <div> with the id defined above
	$('.user-activity').prepend('<div id="example-ad-location"></div>');
	// call Google to display the ad at the just inserted anchor
	googletag.cmd.push(function() {
		googletag.display('example-ad-location');
	});
});