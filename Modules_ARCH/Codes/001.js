	// Заполнение сессионного массива ХЭШ НЕИСПОЛЬЗОВАННЫХ тегов	
	// $.ajax({
	// 	url: '/Modules/CreativeEdit/get_all_hash.php',
	// 	type: 'post',
	// 	datatype: 'html',
	// 	data: {
	// 		creative_id: c_Id
	// 	},
	// 	success: function (data) {
	// 		var LongLine = "";
	// 		var hash_arr = jQuery.parseJSON(data);
	// 		var hash_array = Object.entries(hash_arr); // Преобразуем Объект в массив для перебора
	// 		if (hash_array.length > 0) {
	// 			hash_array.forEach(function (item) {
	// 				LongLine += "<div class='OneTag OneTagUnSelected' hid='" + item[0] + "'>" + item[1] + "</div>";
	// 			});
	// 		}
	// 		$('#HashTagsUnUsed').html(LongLine); //Заполняем тегами варианты
	// 		$('.OneTagUnSelected').on("click", function () {
	// 			var hash_id = $(this).attr('hid');
	// 			console.log('Нажал на тег ' + hash_id);
	// 		});
	// 	}
	// });
	// Заполнение сессионного массива ХЭШ ИСПОЛЬЗОВАННЫХ тегов
	// $.ajax({
	// 	url: '/Modules/CreativeEdit/get_used_hash.php',
	// 	type: 'post',
	// 	datatype: 'html',
	// 	data: {
	// 		creative_id: c_Id
	// 	},
	// 	success: function (data) {
	// 		var LongLine = "";
	// 		var hash_arr = jQuery.parseJSON(data);
	// 		var hash_array = Object.entries(hash_arr); // Преобразуем Объект в массив для перебора
	// 		if (hash_array.length > 0) {
	// 			hash_array.forEach(function (item) {
	// 				LongLine += "<div class='OneTag OneTagSelected' hid='" + item[0] + "'>" + item[1] + "</div>";
	// 			});
	// 		}
	// 		$('#HashTagsUsed').html(LongLine); //Заполняем тегами варианты
	// 		$('.OneTagSelected').on("click", function () {
	// 			var hash_id = $(this).attr('hid');
	// 			console.log('Нажал на тег ' + hash_id);
	// 		});
	// 	}
	// });