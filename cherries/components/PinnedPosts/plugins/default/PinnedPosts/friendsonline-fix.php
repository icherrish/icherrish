$(document).ready(function() {
	if (window.innerWidth > 991) {
		$('.newsfeed-middle-top .friendsonline-widget').remove();
	}
	if (! $('.newsfeed-middle-top').children().length) {
		$('.newsfeed-middle-top').hide();
	}
});