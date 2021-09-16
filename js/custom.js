$(document).ready(function () {
	"use strict";

	// Рaзворачивание меню
	$('[data-toggle="offcanvas"]').on('click', function () {
		$('.offcanvas-collapse').toggleClass('open')
	});



	// Всплывающие подсказки
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	});


});