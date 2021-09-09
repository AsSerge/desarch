<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
			<span style="margin-right: 10px"><i class="fas fa-tasks" style="font-size: 2.5rem;"></i></span>
			<div class="lh-100">
				<h6 class="mb-0 text-white lh-100">Список задач</h6>
				<small><?php echo $user_name." " .$user_surname. " [".$user_role_description."]";?></small>
			</div>
</div>

<div class="my-3 p-3 bg-white rounded box-shadow">
			<!-- <h6 class="border-bottom border-gray pb-2 mb-0">Спсисок задач</h6> -->
	<table id="ex2" class="table table-sm table-light-header" width="100%">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Заказчик</th>
				<th scope="col">Тип</th>
				<th scope="col">Название задачи</th>
				<th scope="col">Крайний срок</th>
				<th scope="col">Дизайн</th>
				<th scope="col">Принято</th>
				<th scope="col">В работе</th>
				<th scope="col">Статус</th>
				<th scope="col">Действие</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>1</td>
				<td>ООО "Три поросенка"</td>
				<td>Сети</td>
				<td><a href="#">Синяя пелена</a></td>
				<td>23-09-2021</td>
				<td>10</td>
				<td>8</td>
				<td>2</td>
				<td>Выполняется</td>
				<!-- <td><button type="button" class="btn btn-outline-danger btn-sm" disabled><i class="fas fa-window-close"></i> Удалить</button></td>	 -->
			</tr>
			<tr>
				<td>2</td>
				<td>ООО "Три поросенка"</td> 
				<td>Сети</td>
				<td><a href="#">Красное настроение</a></td>
				<td>21-12-2021</td>
				<td>10</td>
				<td>0</td>
				<td>0</td>
				<td>Исполнено</td>
				<td><button type="button" class="btn btn-outline-info btn-sm"><i class="fas fa-archive"></i> В архив</button></td>	
			</tr>
		</tbody>
	</table>
	<div class="row">
		<div class="col" style="text-align: center;">
			<button class="btn btn-outline-success" type="submit">Добавить задачу</button>
		</div>
	</div>
</div>
