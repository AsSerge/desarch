$(document).ready(function () {
	"use strict";

	// Настройка кнопки загрузки файлов в библиотеку
	$('#customFile1').on('change', function (e) {
		var files = [];
		for (var i = 0; i < $(this)[0].files.length; i++) {
			files.push($(this)[0].files[i].name);
		}
		$(this).next('.custom-file-label').html(files.join(', '));
	});


	function CheckFormFilelds() {
		let design_source_url = $('#design_source_url').val();
		let design_name = $('#design_name').val();
		let design_creative_style = $('#design_creative_style').val();
		let customFile1 = $('#customFile1').val();
		if (design_source_url == "" || design_name == "" || design_creative_style == "" || customFile1 == "") {
			// console.log("False");
			return false
		} else {
			// console.log("True");
			return true
		}
	}

	// CheckFormFilelds();

	$('#BtnSendFilesToLibrary').on("click", function () {
		$('#DesignSendInfo').ajaxSubmit({
			url: '/Modules/LibraryEdit/library_updateinfo.php',
			type: 'post',
			data: {
				creative_id: c_Id
			},
			success: function (data) {
				console.log(data);
				$('#DesignSendInfo')[0].reset(); // Сбрасываем поля формы
				// $('#customFile1').find('.custom-file-label').html(''); // Сбрасываем поле выбора файла
			}
		});
	});




	// Сокрытие поля загрузки файлов preview и base (настройка кнопок)
	$('#FilesDN').on('click', function () {
		$('#PreviewFile').click();
		return false;
	});

	// Загрузка Preview файла для дизайна
	$('#PreviewFile').on("change", function () {
		$('#PreviewFileLoad').ajaxSubmit({
			url: '/Modules/LibraryEdit/PreviewFileLoad.php',
			type: 'post',
			// target: '#resultPreview',
			data: {
				creative_id: c_Id
			},
			success: function () {
				$('#PreviewFileLoad')[0].reset();
			}
		});
	});
});