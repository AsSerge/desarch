$(document).ready(function () {
	"use strict";
	// Устанвливаем дефолтное заначение OFF
	let VoteVal = "";
	// Формируем кнопку отправки голоса
	SetButtonLable(VoteVal);
	// Получаем значение кнопки для голосования

	// Кнопки принятия решения
	$('#BtnOff').on("click", function () {
		VoteVal = "off";
		$('#BtnOff').removeClass();
		$('#BtnOn').removeClass();
		$('#BtnOff').addClass('btn btn-danger');
		$('#BtnOn').addClass('btn btn-outline-success');
		CheckAlertStatus(VoteVal);
		console.log(VoteVal);
	});
	$('#BtnOn').on("click", function () {
		VoteVal = "on";
		$('#BtnOff').removeClass();
		$('#BtnOn').removeClass();
		$('#BtnOff').addClass('btn btn-outline-danger');
		$('#BtnOn').addClass('btn btn-success');
		CheckAlertStatus(VoteVal);
		console.log(VoteVal);
	});


	// Кнопка записи информации
	$('#SendVote').on("click", function () {
		var v_description = $('#v_description').val();
		$.ajax({
			url: '/Modules/RatingEdit/rating_update.php',
			datatype: 'html',
			type: 'post',
			data: {
				user_id: user_id,
				creative_id: creative_id,
				creative_grade_pos: VoteVal,
				creative_comment_content: v_description
			},
			success: function (data) {
				console.log(data);
				// Идем домой
				$(location).attr('href', '/')
			}
		});
	});

	// Кнопка, подменяющая клик на другую кнопку
	$('.SetComment').on('click', function () {
		$('#SetComment').click();
		return false;
	});

	// Функция настройеи панели Alert для кнопок принятия дизайна
	function CheckAlertStatus(VoteVal) {
		if (VoteVal == "off") {
			$('#FTMyRadio').removeClass();
			$('#FTMyRadio').addClass('alert alert-danger');
			$('#FTMyRadio').html('Вы не приняли дизайн! Вы можете оставить комметнарий <i class="far fa-comment-dots"></i> для дизайнера и продолжить голосование, нажав кнопку "Отклонить диизайн" этого дизайна <i class="far fa-thumbs-down"></i>');
			SetButtonLable(VoteVal);
		} else if (VoteVal == "on") {
			$('#FTMyRadio').removeClass();
			$('#FTMyRadio').addClass('alert alert-success');
			$('#FTMyRadio').html('Ура! Дизайн принят! Вы можете оставить комметнарий <i class="far fa-comment-dots"></i> для дизайнера и продолжить голосование, нажав кнопку "Принять дизайн" этот дизайн <i class="far fa-thumbs-down"></i>');
			SetButtonLable(VoteVal);
		}
	}


	// Функция формировния кнопки голосования
	function SetButtonLable(t) {
		if (t == "") {
			$('#SendVote').hide();
			$('#SendVote').prop("disabled", true);
			$('#SendVote').html('ГОЛОСОВАТЬ');
		} else if (t == "off") {
			$('#SendVote').show();
			$('#SendVote').html('Отклонить дизайн');
			$('#SendVote').prop("disabled", false);
		} else if (t == "on") {
			$('#SendVote').show();
			$('#SendVote').html('Принять дизайн');
			$('#SendVote').prop("disabled", false);
		}
	}
});