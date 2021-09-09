$(document).ready(function () {
	"use strict";

	// http: //design-archive/admin_panel.html#
	let mykey = "/datafiles/test.json";
	// let mykey = "http://127.0.0.1:5500/datafiles/test.json";

	$('#ex').DataTable({

		// "ajax": mykey,

		"processing": false,
		"serverSide": false,
		// "ajax": "server_processing.php",
		// "ajax": "/datafiles/test.json",
		"ajax": mykey,

		"paging": true,
		"ordering": true,
		"info": false,

		"stateSave": false,

		"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "Все"]
		],


		"language": {
			"url": "/datafiles/dataTables.russian.json"
		}
	});


	// Рaзворачивание меню
	$('[data-toggle="offcanvas"]').on('click', function () {
		$('.offcanvas-collapse').toggleClass('open')
	});

	// Настройки DatePicker
	// Руссиффикация
	$.fn.datepicker.dates['ru'] = {
		days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
		daysShort: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
		daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
		months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
		monthsShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
		today: "Today",
		clear: "Clear",
		format: "mm/dd/yyyy",
		titleFormat: "MM yyyy",
		weekStart: 1
	};
	$('.datepicker').datepicker({
		weekStart: 1,
		daysOfWeekHighlighted: "6,0",
		autoclose: true,
		todayHighlight: true,
		language: 'ru'
	});
	// Начало задачи
	$('#datepicker_start').datepicker("setDate", new Date());
	// Крайний срок
	$('#datepicker_end').datepicker("setDate", new Date());
	// table.drow();

	// Всплывающие подсказки
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	});


});

// Подгрузка контента
// $('#st_menu').on("click", function (evt) {
// 	evt.preventDefault();
// 	$("#main").load("/Modules/UserRegistration/user_registeration.php");

// });