// JavaScript Document
$(document).ready(function() {
	$('.icyEditable').each(function() {
		var $this = $(this), off = $this.offset();
		var $bubble = $('<div>Editable</div>');
		$bubble.css({padding:3, background: 'red', position: 'absolute', left: off.left + $this.width() + 20, top: off.top});
		$bubble.appendTo('body');
	});


});