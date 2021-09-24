$(document).ready(function () {
	"use strict";
	// Начальная настройка
	$('#PreviewImageNoN').show();
	$('#BaseImageNoN').show();
	$('#PreviewImages').hide();
	$('#BaseImages').hide();

	// ОБЯЗАТЕЛЬНОЕ ОТКЛЮЧЕНИЕ КЭША ДЛЯ БРАУЗЕРА!!!!
	$.ajaxSetup({
		cache: false
	});

	// Установка значения коэффицианта заимстования
	var testCDT = $('#creative_development_type').val();
	if (testCDT == "Собственная разработка") {
		console.log(">>> " + testCDT);
		$('#creative_magnitude').val("до 50%");
		$('#creative_magnitude').prop('disabled', true);
	} else {
		$('#creative_magnitude').prop('disabled', false);
	}

	// Получение preview картинки креатива
	GetPreviewImage(c_Id);
	GetBaseImage(c_Id);

	// Сокрытие поля загрузки файлов preview и base (настройка кнопок)
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
			cache: false,
			data: {
				creative_id: c_Id,
				preview_file: 'preview.jpg'
			},
			success: function (data) {
				var check_result = data;
				if (check_result == "YES") {
					// Обманываем кэширование
					var dummy = new Date();
					$('#PreviewImageNoN').hide();
					$('#PreviewImages').show();
					$('#PreviewImages').html("<img src = '/Creatives/" + creative_id + "/preview.jpg?ver=" + dummy.getTime() + "' width = '100%'>");
					$('.OnePreviewImage').html("<img src = '/Creatives/" + creative_id + "/preview.jpg?ver=" + dummy.getTime() + "' width = '100%'>");
					$('#SendToApproval').attr('disabled', false); // При наличии Preview - кнопка Отправки креатива на утверждение разрешается
				} else {
					$('#PreviewImageNoN').show();
					$('#PreviewImages').hide();
					$('#SendToApproval').prop('disabled', true);
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
		var SetFilling = "";
		var creative_id = CreativeId;
		var Designes = [];
		$.ajax({
			url: '/Modules/CreativeEdit/setImagesArr.php',
			type: 'get',
			datatype: 'json',
			data: {
				creative_id: creative_id
			},
			success: function (data_recuest) {
				if (data_recuest) {
					var jfiles = JSON.parse(data_recuest);
					jfiles.forEach(el => Designes.push(el));
				}
				// Функция формирования блока базовых изображений
				function GetDesignList(Designes) {
					SetFilling = "";
					for (var item in Designes) {
						SetFilling += '<div><button class="EditDesign" data-toggle="modal" data-target="#EditBaseDesign" data-whatever="' + Designes[item] + '"><img src="' + Designes[item] + '" class="img-thumbnail"></button></div>';
					}
					return SetFilling
				}
				console.log(Designes.length);
				if (Designes.length != 0) {
					$('#BaseImageNoN').hide();
					$('#BaseImages').show();
					$('#BaseImages').html(GetDesignList(Designes));
					$('#SendToApproval').attr('disabled', false); // При наличии Base - кнопка Отправки креатива на утверждение разрешается
				} else {
					$('#BaseImageNoN').show();
					$('#BaseImages').hide();
					$('#SendToApproval').prop('disabled', true);
				}
				// Формирование модального окна
				$('#EditBaseDesign').on('shown.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var recipient = button.data('whatever');
					var modal = $(this);
					modal.find('.modal-title').text(recipient);
					modal.find('.modal-body').html('<img src="' + recipient + '" class="img-thumbnail" alt="Желание заказчика">');

					// Скачивание файла НЕ РАБОТАЕТ!!!!	
					var ImgToDownload = $(this).parent().parent().find("h5").text();
					// console.log("Загрузка файла" + ImgToDownload);
					$("#DownloadImage").attr("href", ImgToDownload);
				});

			},
			error: function (e) {

			}
		});
	}

	// Удаление элемента (Функция)
	function DelImageFromDir(imgToDel) {
		var ImgToDel = imgToDel;
		$.ajax({
			url: '/Modules/CreativeEdit/delOneImage.php',
			type: 'GET',
			data: {
				ImgToDel: ImgToDel
			},
			success: function () {
				GetBaseImage(c_Id);
			}
		});
	}

	// Кнопка удаления изображения в модальном окне 
	$('#ClearImage').on("click", function () {
		var imgToDel = $(this).parent().parent().find("h5").text();
		setTimeout(DelImageFromDir(imgToDel), 10000);
		GetBaseImage(c_Id);
	});


	// Загрузка базовых файлов
	$('#BaseFileLoad').on("change", function () {
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
				GetBaseImage(c_Id);
			}
		});
	});

	// function SetUpdate(CreativeId, Field, Content) {
	// 	$.ajax({
	// 		url: '/Modules/CreativeEdit/update_creative_info.php',
	// 		type: 'post',
	// 		datatype: 'html',
	// 		data: {
	// 			creative_id: CreativeId,
	// 			field: Field,
	// 			content: Content
	// 		},
	// 		success: function (data) {
	// 			console.log(data);
	// 		}
	// 	});
	// }

	// Проверка состояния Переключателя "Тип Креатива" -> Изменение коэффицианта заимстовавания
	$('#creative_development_type').on("change", function () {
		var testCDT = $('#creative_development_type').val();

		if (testCDT == "Собственная разработка") {
			console.log(">>> " + testCDT);
			$('#creative_magnitude').val("до 50%");
			$('#creative_magnitude').prop('disabled', true);
		} else {
			$('#creative_magnitude').prop('disabled', false);
		}
	})
	// Обновление информации в форме
	$('#CreativeInfoUpdate').on("click", function () {
		var creative_name = $('#creative_name').val();
		var creative_style = $('#creative_style').val();
		var creative_development_type = $('#creative_development_type').val();
		var creative_magnitude = $('#creative_magnitude').val();
		var creative_source = $('#creative_source').val();
		var creative_description = $('#creative_description').val();
		$.ajax({
			url: '/Modules/CreativeEdit/update_creative_info.php',
			type: 'POST',
			datatype: 'html',
			data: {
				creative_id: c_Id,
				creative_name: creative_name,
				creative_style: creative_style,
				creative_development_type: creative_development_type,
				creative_magnitude: creative_magnitude,
				creative_source: creative_source,
				creative_description: creative_description
			},
			success: function (data) {
				console.log(data);

				var ToasBodyText = "Информация о креативе обновлена";
				$('#liveToast').children(".toast-body").html("<p><i class='far fa-save'> " + ToasBodyText + "</p>");
				$('#liveToast').toast('show');

				// location.reload();
				$('#myTab a[href="#profile"]').tab('show')
			}
		});
	});

	// Кнопка отправки креатива на утверждение
	$('#SendToApproval').on("click", function () {
		$.ajax({
			url: '/Modules/CreativeEdit/creative_approval.php',
			type: 'post',
			data: {
				creative_id: c_Id
			},
			success: function (data) {
				console.log("Отправили на утверждение! " + data);
				location.href = '/index.php?module=CreativeList';
			}
		});
	});


});