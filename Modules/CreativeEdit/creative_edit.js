$(document).ready(function () {
	"use strict";
	// Начальная настройка
	$('#PreviewImageNoN').show();
	$('#BaseImageNoN').show();
	$('#PreviewImages').hide();
	$('#BaseImages').hide();

	// Получение preview картинки креатива
	GetPreviewImage(c_Id);
	GetBaseImage(c_Id);

	// Сокрытиt поля загрузки файлов preview и base (настройка кнопок)
	$('#FilesDN').on('click', function () {
		$('#PreviewFile').click();
		return false;
	});

	$('#BaseFilesDN').on('click', function () {
		$('#BaseFile').click();
		return false;
	});

	// Функция первоначальной проверки наличия файла preview.jpg
	function GetPreviewImage(CreativeId) {
		var creative_id = CreativeId;
		$.ajax({
			url: '/Modules/CreativeEdit/check_preview_file.php',
			type: 'post',
			datatype: 'html',
			data: {
				creative_id: c_Id,
				preview_file: 'preview.jpg'
			},
			success: function (data) {
				var check_result = data;
				if (check_result == "YES") {
					$('#PreviewImageNoN').hide();
					$('#PreviewImages').show();
					$('#PreviewImages').html("<img src = '/Creatives/" + creative_id + "/preview.jpg' width = '100%'>");
				} else {
					$('#PreviewImageNoN').show();
					$('#PreviewImages').hide();
				}
			}
		});
	}

	// Загрузка Preview файла
	$('#PreviewFile').on("change", function () {
		$('#PreviewFileLoad').ajaxSubmit({
			url: '/Modules/CreativeEdit/PreviewFileLoad.php',
			type: 'post',
			target: '#resultPreview',
			data: {
				creative_id: c_Id
			},
			success: function () {
				$('#PreviewFileLoad')[0].reset();
				$('#resultPreview').show();
				$('#resultPreview').fadeOut(2000);
				GetPreviewImage(c_Id);
			}
		});
	});

	// Функция проверки Base файлов в каталоге 
	function GetBaseImage(CreativeId) {
		var creative_id = CreativeId;

		

	}


	// Загрузка базовых файлов
	$('').on("change", function () {
		console.log("any");
		$('#BaseFileLoad').ajaxSubmit({
			url: '/Modules/CreativeEdit/BaseFileLoad.php',
			type: 'post',
			target: '#resultBase',
			data: {
				creative_id: c_Id
			},
			success: function () {
				$('#BaseFileLoad')[0].reset();
				$('#resultBase').show();
				$('#resultBase').fadeOut(2000);
				GetPreviewImage(c_Id);
			}

		});
	});

});