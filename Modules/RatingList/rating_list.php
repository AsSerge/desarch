<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
			<span style="margin-right: 10px"><i class="fas fa-poll" style="font-size: 2.5rem;"></i></span>
			<div class="lh-100">
				<h6 class="mb-0 text-white lh-100">Дизайны для голосования</h6>
				<small><?php echo $user_name." " .$user_surname. " [".$user_role_description."]";?></small>
			</div>
</div>
<div class="my-3 p-3 bg-white rounded box-shadow">

<?php
include_once($_SERVER['DOCUMENT_ROOT']."/Layout/settings.php"); // Функции сайта
// Получаем Креативов, готовый к утверждению
	$stmt = $pdo->prepare("SELECT * FROM сreatives as C LEFT JOIN users AS U ON (C.user_id = U.user_id) WHERE C.creative_status = ?");
	$stmt->execute(array("На утверждении"));
	$creatives = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// Функция определения параметров задачи и заказчика по ID задачи
	function Customer($pdo, $task_id){
		$stmt = $pdo->prepare("SELECT * FROM tasks as T LEFT JOIN customers AS C ON (T.customer_id = C.customer_id) WHERE T.task_id = ?");
		$stmt->execute(array($task_id));
		$customer = $stmt->fetch(PDO::FETCH_ASSOC);
		return $customer;
	}
?>
<style>
	.MyCardDesk{
		display: flex;
		justify-content: flex-start;
		flex-wrap: wrap;
		font-size: 0.7rem;
	}
	.MyCardDesk > div{
		width: 15rem;
	}
	#ComissionGrades{
		position: relative;
		width: 100%;
		height: 3px;
		background-color: var(--purple);
		margin: 5px 0;
		display: flex;
	}
	#ComissionGrades > div{
		background-color: var(--yellow);
		width: 25%;
		height: 3px;
	}
</style>

	<div class="MyCardDesk">
	<?php
	// Настройка отображения карточек !!!! НАстроить потом
	$w='3';
	switch($w){
		case '1':
			$color_scheme = 'text-white bg-warning';
			$vote_btn = 'disabled';
			break;
		case '2':
			$color_scheme = '';
			$vote_btn = '';
			break;
		case '2':
			$color_scheme = '';
			$vote_btn = '';
			break;
		default:
			$color_scheme = 'bg-light';
			$vote_btn = '';
	}
	foreach($creatives as $cr){
		echo "<div class='card m-2 {$color_scheme}'>";
		echo "	<img class='card-img-top' src='/Creatives/{$cr['creative_id']}/preview.jpg' alt=''>";
		echo "	<div class='card-body'>";
		echo "		<p class='card-text'><strong>Дизайн: </strong>[{$cr['creative_id']}] {$cr['creative_name']}</p>";
		echo "		<p class='card-text'><strong>Дизайнер: </strong>{$cr['user_surname']} {$cr['user_name']}</p>";
		echo "		<p class='card-text'><strong>Заказчик: </strong>".Customer($pdo, $cr['task_id'])['customer_name']."</p>";
		echo "		<p class='card-text'><strong>Канал: </strong>".Customer($pdo, $cr['task_id'])['customer_type']."</p>";
		echo "	</div>";
		echo "<div id='ComissionGrades'><div></div><div></div></div>";
		echo "	<div class='card-footer text-center'>";
		echo "		<button type='button' onclick='window.location.href=`/index.php?module=RatingEdit&creative_id={$cr['creative_id']}`' class='btn btn-primary btn-sm' {$vote_btn}><i class='fas fa-balance-scale-right'></i> Оценка</button>";
		echo "	</div>";
		echo "</div>";
	}	
	?>
	</div>
</div>

<?php
	// echo "<pre>";
	// print_r($creatives);
	// echo "</pre>";
?>