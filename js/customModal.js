$(document).ready(function () {
	"use strict";

	var c_Id = "003"; // Код задачи

	// Формирование страницы  (Функция)
	function ImgWork(TaskId) {
		// Модальное окно для работы с изображением		
		var SetFilling = ""; // Строка для заполнения
		var TaskID = TaskId; // ID Редактируемого креатива
		var Designes = [];

		// Первоначальная загрузка данных из PHP в формате JSON 

		$.ajax({
			url: '/Assets/setImagesArr.php',
			type: 'GET',
			dataType: 'json',
			data: {
				TaskID: TaskID
			},
			success: function (data_recuest) {
				if (data_recuest) {
					data_recuest.forEach(element => {
						Designes.push(element);
					});
				}
				// Функция формирования блока базовых изображений
				function GetDesignList(Designes) {
					SetFilling = "";
					for (var item in Designes) {
						SetFilling += '<div><button class="EditDesign" data-toggle="modal" data-target="#EditDesign" data-whatever="' + Designes[item] + '"><img src="' + Designes[item] + '" class="img-thumbnail"></button></div>';
					}
					return SetFilling
				}

				// Проверка наличия базовых изображений
				if (Designes.length != 0) {
					$('#BaseImagesNoN').hide();
					$('#thumb-img-set').show();
					$('#thumb-img-set').html(GetDesignList(Designes)); // Получаем все базовые изображения, для выбранного задания
				} else {
					$('#BaseImagesNoN').show();
					$('#thumb-img-set').hide();
				}

				$('#EditDesign').on('shown.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var recipient = button.data('whatever');
					var modal = $(this);
					modal.find('.modal-title').text(recipient);
					modal.find('.modal-body').html('<img src="' + recipient + '" class="img-thumbnail" alt="Желание заказчика">');
				});
			},
			error: function (e) {
				alert(e.message);
			}
		});

	}
	// Удаление элемента (Функция)
	function DelImageFromDir(imgToDel) {

		var ImgToDel = imgToDel;
		$.ajax({
			url: '/Assets/delOneImage.php',
			type: 'GET',
			data: {
				ImgToDel: ImgToDel
			},
			success: function () {
				ImgWork(c_Id);
			}
		});
	}

	// Базовое формирование страницы
	ImgWork(c_Id);
	$('#result').hide();
	// Трюк с сокрытием поля
	$('#FilesDN').on('click', function () {
		$('#js-file').click();
		return false;
	});
	$('#c_Id').text(c_Id);

	// Кнопка удаления изображения в модальном окне 
	$('#ClearImage').on("click", function () {
		var imgToDel = $(this).parent().parent().find("h5").text();
		setTimeout(DelImageFromDir(imgToDel), 10000);
		ImgWork(c_Id);
	});


	// Загрузка файлов
	$('#js-file').on("change", function () {
		console.log("Загрузка в папку " + c_Id);
		$('#js-form').ajaxSubmit({
			url: '/Assets/LoadImages.php',
			type: 'POST',
			target: '#result',
			data: {
				TaskID: c_Id
			},
			success: function () {
				// После загрузки файла очистим форму.
				$('#js-form')[0].reset();
				ImgWork(c_Id);
				$('#result').show();
				$('#result').fadeOut(2000);
			}
		});
	});
});