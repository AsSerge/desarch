<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
			<span style="margin-right: 10px"><i class="fas fa-swatchbook" style="font-size: 2.5rem;"></i></span>
			<div class="lh-100">
				<h6 class="mb-0 text-white lh-100">Редактор библиотеки дизайнов</h6>
				<small><?php echo $user_name." " .$user_surname. " [".$user_role_description."]";?></small>
			</div>
</div>
<div class="my-3 p-3 bg-white rounded box-shadow">
<?php
include_once($_SERVER['DOCUMENT_ROOT']."/Layout/settings.php"); // Функции сайта
// Получаем ID креатива для редактирования 
$creative_id = $_GET['creative_id'];
echo "<script>var c_Id = {$creative_id};</script>\n\r";

$stmt = $pdo->prepare("SELECT * FROM designes WHERE creative_id = ?");
$stmt->execute(array($creative_id));
$designes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// print_r($designes);
// echo "</pre>";
?>
<!-- Библиотека -->
<style>
	/* .creative_library{
	}
	.library_preview{
		display: flex;
		flex-direction: column;
		justify-content: center;
	}
	.library_preview img{
		width: 100%;
	} */
</style>
	<div class="row mt-3">
			<div class="col">
				<div class="alert alert-primary" role="alert">
				<i class="fas fa-info-circle"></i> После утверждения креатива ВСЕМИ участниками приемной комиссии и принятия решения о преобретении креатива - необходимо загрузить преобретенные изображения в библиотеку. При узке необходимо определить Preview файл (jpg или png). Затем, в каталог библиотеки загружаются все файла, составляющие преобретенный дизайн. Дизайну присваивается название направление и произвольное имя.
				</div>
			</div>
	</div>

	<?php if (count($designes) > 0){?>

		

		
		




	<?}?>

	<div class="row mt-3">
			<div class="col">
				<h6 class="border-bottom border-gray pb-3 mb-2"><i class="far fa-images"></i> Библиотека</h6>
				<div class="row">
					<div class="col-md-2 library_preview">
						<!-- Загрузка Preview файла -->
						<form id="PreviewFileLoad" enctype="multipart/form-data">
							<input id="PreviewFile" type="file" name="file" style='display: none;'>
							<button type="button" class="btn btn-primary btn-sm" id="FilesDN"><i class="fas fa-file-upload"></i> Загрузить Preview</button>
						</form>
						<!-- Загрузка Preview файла -->
						<!-- required -->
					</div>


					<div class="col-md-10">
						<form id="DesignSendInfo" enctype="multipart/form-data">
							<input type="hidden" name="user_id" value="<?=$user_id?>"> 
							<div class="form-group">
								<label for="design_source_url">Путь к странице исходника в Internet</label>
								<input type="text" class="form-control form-control-sm myRQ" id="design_source_url" aria-describedby="emailHelp" name="design_source_url">
							</div>
							<div class="row">
								<div class="col-md-6">
									<label for="design_name">Введите название</label>
									<input type="text" class="form-control form-control-sm myRQ" id="design_name" aria-describedby="emailHelp" name="design_name">
								</div>
								<div class="col-md-6">
									<label for="design_creative_style">Введите направление дизайна</label>
									<select class="form-control form-control-sm myRQ" id="design_creative_style" name = "design_creative_style">
										<?php
											echo "<option value=''>Выберете...</option>";
										foreach($array_creative_style as $acs){
											echo "<option value='{$acs}'>{$acs}</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div style = "text-align: center" class = "mt-3">
								<div class="custom-file mb-3">
									<input type="file" class="custom-file-input myRQ" id="customFile1" lang="ru" name="file[]" multiple>
									<label class="custom-file-label" for="customFile">Выбрать файл</label>
								</div>
								<button class="btn btn-primary" type="button" id="BtnSendFilesToLibrary"><i class="far fa-save"></i> Сохранить изменения</button>
							</div>
						</form>	
					</div>
				</div>
			</div>
	</div>
</div>
<!-- 
<hr>
<div>
	<table class="table table-striped table-sm">
		<tbody >
			<tr><td><i class="far fa-file-image"></i></td><td><a href = "#">depositphotos_1289716-Teddy-bear.jpg</a></td><td>2021-09-28 13:00:53</td><td>12M</td></tr>
			<tr><td><i class="far fa-file-archive"></i></td><td><a href = "#">Depositphotos_1290116_original_vect.zip</a></td><td>2021-09-28 13:00:53</td><td>14M</td></tr>
			<tr><td><i class="far fa-file-image"></i></td><td><a href = "#">Coroana cu trandafiri 1046.ai</a></td><td>2021-09-28 13:00:53</td><td>8M</td></tr>
			<tr><td><i class="far fa-file-image"></i></td><td><a href = "#">Coroana cu trandafiri 1046.eps</a></td><td>2021-09-28 13:00:53</td><td>16M</td></tr>
		</tbody>	
	</table>
</div>
-->
