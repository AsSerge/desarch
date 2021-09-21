<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
			<span style="margin-right: 10px"><i class="fas fa-tools" style="font-size: 2.5rem;"></i></span>
			<div class="lh-100">
				<h6 class="mb-0 text-white lh-100">Редактор креатива</h6>
				<small><?php echo $user_name." " .$user_surname. " [".$user_role_description."]";?></small>
			</div>
</div>
<?php
	include_once($_SERVER['DOCUMENT_ROOT']."/Layout/settings.php"); // Функции сайта
	// Получаем ID креатива для редактирования 
	$creative_id = $_GET['creative_id'];
	echo "<script>var c_Id = {$creative_id};</script>\n\r";

	// Получаем информацию для редактирования креатива
	$stmt = $pdo->prepare("SELECT * FROM сreatives as C LEFT JOIN tasks AS T ON (C.task_id = T.task_id) WHERE C.creative_id = ?");
	$stmt->execute(array($creative_id));
	$creative = $stmt->fetch(PDO::FETCH_ASSOC);

	// echo "<pre>";
	// print_r($creative);
	// echo "</pre>";

	// Функция определения параметров заказчика
	function Customer($pdo, $customer_id){
		$stmt = $pdo->prepare("SELECT customer_name, customer_type FROM customers WHERE customer_id = ?");
		$stmt->execute(array($customer_id));
		$customer = $stmt->fetch(PDO::FETCH_ASSOC);
		return $customer;
	}

?>
<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
		<div class="col-lg-2 col-md-4">
			<div class="task_card shadow p-3 mb-5 rounded">
				<div class="task_card_title lh-100 rounded">
					<h6 class = 'p-2 text-white lh-100'><i class="fas fa-tasks"></i> Задача [<?=$creative['task_number']?>]</h6>
				</div>
				<div class="task_card_body m-2 pb-2" style = 'font-size: 0.8rem'>
					<table class='table table-sm table-light-header'>
						<tr><td class='span_bolder'>Название:</td><td><?=$creative['task_name']?></td></tr>
						<tr><td class='span_bolder'>Заказчик:</td><td><?=Customer($pdo, $creative['customer_id'])['customer_name']?><t/></tr>
						<tr><td class='span_bolder'>Канал:</td><td><?=Customer($pdo, $creative['customer_id'])['customer_type']?></td></tr>
						<tr><td class='span_bolder'>Дата постановки:</td><td><?=mysql_to_date($creative['task_setdatetime'])?></td></tr>
						<tr><td class='span_bolder'>Крайний срок:</td><td><?=mysql_to_date($creative['task_deadline'])?></td></tr>
						<tr><td colspan="2"><span class='span_bolder'>Описание задачи: </span><?=$creative['task_description']?></td></tr>
					</table>
				</div>
			</div>
		</div>



								<style>
									.ImageSet{
										border: 1px dotted var(--gray);
										border-radius: 8px;
									}
									.ImageSet img{
										padding: 5px;
									}
								</style>



		<div class="col-lg-10 col-md-8">
			<div class="row">

				<div class="col-md-8">
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<h6 class="border-bottom border-gray pb-3 mb-2"><i class="far fa-images"></i> Креатив</h6>

								<div class="alert alert-warning" role="alert" id = "PreviewImageNoN">
									Изображения отсутствуют
								</div>	
								<div class="ImageSet mb-3" id="PreviewImages"></div>
								<div class="custom-file mb-2">
									<div class="col" style="text-align: center;">
										<form id="PreviewFileLoad" enctype="multipart/form-data">
											<!-- <input id="PreviewFile" type="file" name="file[]" multiple style='display: none;'> -->
											<input id="PreviewFile" type="file" name="file" style='display: none;'>
											<button type="button" class="btn btn-primary btn-sm" id="FilesDN"><i class="fas fa-file-upload"></i> Загрузить Preview</button>
										</form>
									</div>

								</div>
								<div id="resultPreview"></div>

							</div>
						</div>

						
						<div class="col-6">

							<div class="form-group">
								<h6 class="border-bottom border-gray pb-3 mb-2"><i class="far fa-images"></i> Источник</h6>

								<div class="alert alert-warning" role="alert" id = "BaseImageNoN">
									Изображения отсутствуют
								</div>	
								<div class="ImageSet mb-3" id="BaseImages"></div>
								<div class="custom-file mb-2">
									<div class="col" style="text-align: center;">
										<form id="BaseFileLoad" enctype="multipart/form-data">
											<input id="BaseFile" type="file" name="file[]" multiple style='display: none;'>
											<button type="button" class="btn btn-primary btn-sm" id="BaseFilesDN"><i class="fas fa-file-upload"></i> Загрузить Base</button>
										</form>
									</div>

								</div>
								<div id="resultBase"></div>
									
							</div>
						</div>	

					</div>

								<!-- 
								<div class="col" style="text-align: center;">
									<button type="button" class="btn btn-primary" id="FilesDN"><i class="fas fa-file-upload"></i> Загрузить</button>
									<button type="button" class="btn btn-warning" id="FilesDN"><i class="fas fa-trash-alt"></i> Удалить</button>
								</div> -->

				</div>




				<div class="col-md-4">
					<form>
						<div class="form-group">
							<div class="col-sm-12 mb-2">
								<label for="creative_name">Название креатива [<?=$creative_id?>]</label>
								<input type="text" class="form-control" id="creative_name" value="<?=$creative['creative_name']?>">
							</div>
							<div class="col-sm-12 mb-2">
									<label for="creative_style">Стиль креатива</label>
									<select class="custom-select" id="creative_style" >
										<option value="">Выберете...</option>
										<?php
										foreach($array_creative_style as $c_style){
											$sel_lable = ($c_style == $creative['creative_style'])? 'selected':'';
											echo"<option value='{$c_style}' {$sel_lable}>{$c_style}</option>";
										}
										?>
									</select>
							</div>
							<div class="col-sm-12 mb-2">
								<div class="row">
									<div class="col-sm-6 mb-2">
										<label for="creative_development_type">Тип креатива</label>
										<select class="custom-select" id="development_type" >
										<option value="">Выберете...</option>
											<?php
											foreach($array_creative_development_type as $c_type){
												$sel_lable = ($c_type == $creative['creative_development_type'])? 'selected':'';
												echo"<option value='{$c_type}' {$sel_lable}>{$c_type}</option>";
											}
											?>
										</select>
									</div>
									<div class="col-sm-6 mb-2">
									<label for="creative_magnitude">Заимствование</label>
										<select class="custom-select" id="creative_magnitude" >
										<option value="">Выберете...</option>
											<?php
											foreach($array_creative_magnitude as $c_mag){
												$sel_lable = ($c_mag == $creative['creative_magnitude'])? 'selected':'';
												echo"<option value='{$c_mag}' {$sel_lable}>{$c_mag}</option>";
											}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-12 mb-2">
								<label for="creative_source">Источник вдохновения</label>
									<select class="custom-select" id="creative_source" >
										<option value="">Выберете...</option>
										<?php
										foreach($array_creative_source as $c_source){
											$sel_lable = ($c_source == $creative['creative_source'])? 'selected':'';
											echo"<option value='{$c_source}' {$sel_lable}>{$c_source}</option>";
										}
										?>
									</select>

							</div>

							<div class="col-sm-12 mb-2">
								<label for="creative_description">Описание креатива</label>
								<textarea class="form-control mb-2" name="creative_description" id="creative_description" cols="3" rows="3"><?=$creative['creative_description']?></textarea>


							</div>




						</div>
					</form>	
				</div>
			</div>
		</div>
	</div>
	
</div>
