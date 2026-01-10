//<script>
Ossn.register_callback('ossn', 'init', 'wall_paste_image');
function wall_paste_image() {
	$(document).ready(function () {
		$('.ossn-wall-container textarea').on('paste', function (event) {
			let items = (event.originalEvent.clipboardData || event.originalEvent).items;

			$.each(items, function (index, item) {
				if (item.type.startsWith("image")) {
					event.preventDefault();
					let blob = item.getAsFile();
					let reader = new FileReader();

					reader.onload = function (e) {
						let img = new Image();
						img.src = e.target.result;

						img.onload = function () {
							let canvas = document.createElement("canvas");
							let ctx = canvas.getContext("2d");

							canvas.width = img.width;
							canvas.height = img.height;

							ctx.drawImage(img, 0, 0);

							canvas.toBlob(function (jpegBlob) {
								let file = new File([jpegBlob], "wallimage.jpg", {
									type: "image/jpeg"
								});

								let dataTransfer = new DataTransfer();
								dataTransfer.items.add(file);
								$("#ossn-wall-form").find("input[type='file']")[0].files = dataTransfer.files;
								$('.ossn-wall-photo').trigger('click');

							}, "image/jpeg", 0.9);
						};
					};
					reader.readAsDataURL(blob);
				}
			});
		});
	});
}