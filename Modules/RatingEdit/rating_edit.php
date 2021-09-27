<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
			<span style="margin-right: 10px"><i class="fas fa-balance-scale-right" style="font-size: 2.5rem;"></i></span>
			<div class="lh-100">
				<h6 class="mb-0 text-white lh-100">Дизайн для голосования</h6>
				<small><?php echo $user_name." " .$user_surname. " [".$user_role_description."]";?></small>
			</div>
</div>
<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/Layout/settings.php");
// Получаем ID креатива
$creative_id = $_GET['creative_id'];

// Функция получения массива файлов-изображений из заданной папки
function GetImagesArr($dir, $id){
	$file = [];
	$sc_dir = $dir.$id;
	$files = scandir($sc_dir);
	foreach ($files as $values){
		// Выводим только файлы-изображения JPEG кроме preview.jpg
		if($values != "." AND $values != ".." AND $values != "preview.jpg"){
			if(exif_imagetype($sc_dir."/".$values) == IMAGETYPE_JPEG){
				$file[] = "/Creatives/".$id."/".$values;
			}
		}
	}
	return $file; 
}
// Формируем массив базовых исзобажений для задачи
$cr_files = GetImagesArr(CREATIVE_FOLDER, $creative_id);
?>

<style>
	.preview_img{
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.preview_img img{
		width: 100%;
	}
	.base_img{
		display: flex;
		align-items: center;
		justify-content: center;
		justify-content: space-around;
		flex-wrap: wrap;
		background-color: var(--light);
	}
	.base_img img{
		width: 200px;
		margin: 2px;
		padding: 5px;
	}
	
	/*Стилизация переключателя*/
	.form_toggle {
		display: inline-block;
		overflow: hidden;	
	}
	.form_toggle-item {
		float: left;
		display: inline-block;
	}
	.form_toggle-item input[type=radio] {
		display: none;
	}
	.form_toggle-item label {
		display: inline-block;
		padding: 0px 15px;
		line-height: 34px;
		border: 1px solid #999;
		border-right: none;
		cursor: pointer;
		user-select: none;
	}

	.form_toggle .item-1 label {
		border-radius: 3px 0 0 3px;
	}
	.form_toggle .item-2 label {
		border-radius: 0 3px 3px 0;
		border-right: 1px solid #999;
	}

/* Checked */
	.form_toggle .item-1 input[type=radio]:checked + label {
		background: var(--orange);
	}
	.form_toggle .item-2 input[type=radio]:checked + label {
		background: var(--teal);
	}
	.MyRadio{		
		display: flex;
		align-items: center;
		justify-content: center;
	}

/* Комментарии к дизайну */	
	
	.MyComment{
	}


</style>

<div class="my-3 p-3 bg-white rounded box-shadow">	
<div class="row">
	<div class="col-md-4 mb-2">
		<h6 class="border-bottom border-gray pb-3 mb-2"><i class="far fa-images"></i> Креатив</h6>
		<div class=' preview_img'>
			<div class='oneimage' big-image='/Creatives/<?=$creative_id?>/preview.jpg'><img src='/Creatives/<?=$creative_id?>/preview.jpg' alt = ''></div>
		</div>
	</div>
	<div class="col-md-4 mb-2">
		<h6 class="border-bottom border-gray pb-3 mb-2"><i class="far fa-images"></i> Исходник</h6>
		<div class='base_img'>
			<?php
			foreach($cr_files as $crf){
				echo "<span class='oneimage' big-image='{$crf}'><img src='{$crf}' alt = ''></span>";
			}
			?>
		</div>
	</div>
	<div class="col-md-4 mb-2">
		<h6 class="border-bottom border-gray pb-3 mb-2"><i class="far fa-images"></i> Блок голосования</h6>
		<div class="alert alert-warning" id = "FTMyRadio" role="alert">Для оценки дизайна (креатива) необходимо кликнуть на переключателе. Если вы ходтите оставить комметнарий для дизайнера - впишите его в поле комментариев.</div>
		<form action="#">
			<div class="MyRadio">
				<div class="form_toggle">
					<div class="form_toggle-item item-1">
						<input id="fid-1" type="radio" name="radio" value="off" checked>
						<label for="fid-1"><i class="far fa-thumbs-down"></i> Не принято</label>
					</div>
					<div class="form_toggle-item item-2">
						<input id="fid-2" type="radio" name="radio" value="on">
						<label for="fid-2"><i class="far fa-thumbs-up"></i> Принято</label>
					</div>
				</div>
			</div>
			<div class='MyComment'>
				<textarea class="form-control mb-2" name="creative_description" id="creative_description" cols="3" rows="3"></textarea>
				<div style = "text-align: center;">
					<button type="button" class="btn btn-primary">Оставить комметнарий</button>
				</div>
			</div>
		</form>
	</div>
</div>

</div>
<!-- Отображение картинок в полный экран -->
<div id="popup" class="popup">
		<div class="popup__body">
			<div class="popup__content">
				<div class="popup__dnload"></div>
				<div class="popup__close"></div>
				<div class="popup__image"></div>
			</div>
		</div>
</div>