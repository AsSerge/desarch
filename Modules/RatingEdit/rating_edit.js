$(document).ready(function () {
	"use strict";

	// Скрываем поле добавления комментария
	$('.MyComment').hide();
	// Получаем значение кнопки для голосования
	$('.form_toggle').on("change", function () {
		var VoteVal = $('input[name=radio]:radio:checked').val();
		console.log("смена лидера " + VoteVal);
		if (VoteVal == "off") {
			$('#FTMyRadio').removeClass();
			$('#FTMyRadio').addClass('alert alert-danger');
			$('#FTMyRadio').text('Вы не приняли дизайн!');
		} else if (VoteVal == "on") {
			$('#FTMyRadio').removeClass();
			$('#FTMyRadio').addClass('alert alert-success');
			$('#FTMyRadio').text('Ура! Дизайн принят!');
			$('.MyComment').show();
		}
	});
});