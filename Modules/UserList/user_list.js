"use strict";
$(document).ready(function () {
	GetUserList(); // Подгрузка данных из таблицы
	// Реакция на кнопку удаления пользователя
	$(document).on("click", ".userDelBtn", function (e) {
		e.preventDefault();
		var userToDel = $(this).attr("data-user-id");
		// console.log("Нажали >> " + k);
		RemoveUser(userToDel);
		GetUserList();
	});
});

// Безвозвратное удаление пользователя из базы
function RemoveUser(userToDel) {

	$.ajax({
		url: '/Modules/UserList/removeUser.php',
		type: 'POST',
		data: {
			user_id: userToDel
		},
		dataType: 'html',
		success: function (data) {
			console.log(data);
		}
	});
}

// Выгрузка базы пользователей в виде таблицы
function GetUserList() {
	$.ajax({
		url: '/Modules/UserList/getdata.php',
		type: "GET",
		data: {
			id: "12345"
		},
		dataType: 'html',
		success: function (data) {
			var res = $.parseJSON(data);
			var text_table = "<table class='table table-striped table-sm'><thead>\
			<tr><th>#</th><th>Пользователь</th><th>Логин</th><th>Роль</th><th>Действие</th></tr>\
			</thead>";
			// Перебераем массив
			res.forEach(function (entry) {
				var user_role = "";
				switch (entry.user_role) {
					case "adm":
						user_role = "Администратор";
						break;
					case "mgr":
						user_role = "Постановщик задачи";
						break;
					case "dgr":
						user_role = "Дизайнер";
						break;
					case "ctr":
						$user_role_description = "Проверяющий";
						break;
				}
				text_table += `<tr>\
				<td>${entry.user_id}</td>\
				<td><a href = '#' data-user-id= "${entry.user_id}">${entry.user_name} ${entry.user_surname}</a></td>\
				<td>${entry.user_login}</td>\
				<td>${user_role}</td>\
				<td><button type="button" class="btn btn-danger userDelBtn" data-user-id= "${entry.user_id}"><i class="far fa-trash-alt"></i> Удалить</button></td>\
				</tr>`;
			})
			text_table += "</table>";
			$('#main').html(text_table);
		}
	});
}