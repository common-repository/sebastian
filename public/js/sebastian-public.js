(function($) {
	var step = 1;
	var delay = 50;
	var height = 0;
	var Hoffset = 0;
	var Woffset = 0;
	var yon = 0;
	var xon = 0;
	var xPos = 20;
	var pause = true;
	var interval;
	var yPos = $(window).innerHeight();
	var sebastian = $("#sebastian");
	
	function sebastianTimer(){
		width = $(window).width();
		height = $(window).height();
		Hoffset = sebastian.height();
		Woffset = sebastian.width();
		var b = xPos + $(window).scrollLeft();
		var a = yPos + $(window).scrollTop();
		$("#sebastian").css("left", b);
		$("#sebastian").css("top", a);

		if (yon) {
			yPos = yPos + step
		} else {
			yPos = yPos - step
		}
		if (yPos < 0) {
			yon = 1;
			yPos = 0
		}
		if (yPos >= (height - Hoffset)) {
			yon = 0;
			yPos = (height - Hoffset)
		}
		if (xon) {
			xPos = xPos + step
		} else {
			xPos = xPos - step
		}
		if (xPos < 0) {
			xon = 1;
			xPos = 0
		}
		if (xPos >= (width - Woffset)) {
			xon = 0;
			xPos = (width - Woffset)
		}
	}
	
	function sebastianStart() {
		$("#sebastian").show();
		interval = setInterval(sebastianTimer, delay)
	}
	
	function sebastianPause(){
		if (pause) {
			clearInterval(interval);
			pause = false
		} else {
			interval = setInterval(sebastianTimer, delay);
			pause = true
		}
	}
	
	if($(window).width() > 1000){
		sebastianStart();
	}

	$(document).ready(function(){
		$("#sebastian").mousedown(function() {
			sebastianPause();
		});
	});
	
})( jQuery );