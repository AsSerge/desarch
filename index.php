<?php include($_SERVER['DOCUMENT_ROOT']."/Login/baselogin/line_check.php");?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/Layout/header.php')?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/Layout/mainmenu.php')?>
<!------------------------------------------------- Основной контент ------------------------------------------------->

	<main role="main" class="container-fluid">
		<?php

			if($user_role == 'adm'){
				$module = $_GET['module'];
				switch($module){
					case 'UserList':
							$link = '/Modules/UserList/user_list.php';
							$js_local_source = '/Modules/UserList/user_list.js';
							break;
					case 'UserRegistration':
							$link = '/Modules/UserRegistration/user_registeration.php';
							$js_local_source = '/Modules/UserRegistration/user_registeration.js';
							break;
					case 'TaskList':
							$link = '/Modules/TaskList/task_list.php';
							$js_local_source = '/Modules/TaskList/task_list.js';
							break;
					case 'CustomerList':
							$link = '/Modules/СustomerList/customer_list.php';
							$js_local_source = '/Modules/СustomerList/customer_list.js';
							break;
					case 'TaskEdit':
							$link = '/Modules/TaskEdit/task_edit.php';
							$js_local_source = '/Modules/TaskEdit/task_edit.js';
							break;	
					default:
							$link = '/Modules/UserList/user_list.php';
							$js_local_source = '/Modules/UserList/user_list.js';	
				}
			}elseif ($user_role == 'mgr'){
				$module = $_GET['module'];
				switch($module){
					case 'TaskList':
							$link = '/Modules/TaskList/task_list.php';
							$js_local_source = '/Modules/TaskList/task_list.js';
							break;
					case 'CustomerList':
							$link = '/Modules/СustomerList/customer_list.php';
							$js_local_source = '/Modules/СustomerList/customer_list.js';
							break;
					case 'TaskEdit':
							$link = '/Modules/TaskEdit/task_edit.php';
							$js_local_source = '/Modules/TaskEdit/task_edit.js';
							break;
					case 'RatingEdit':
							$link = '/Modules/RatingEdit/rating_edit.php';
							$js_local_source = '/Modules/RatingEdit/rating_edit.js';
							break;
					case 'RatingList':
							$link = '/Modules/RatingList/rating_list.php';
							$js_local_source = '/Modules/RatingList/rating_list.js';
							break;
					default:
							$link = '/Modules/TaskList/task_list.php';
							$js_local_source = '/Modules/TaskList/task_list.js';
				}
			}elseif ($user_role == 'ctr'){
				$module = $_GET['module'];
				switch($module){
					case 'RatingEdit':
							$link = '/Modules/RatingEdit/rating_edit.php';
							$js_local_source = '/Modules/RatingEdit/rating_edit.js';
							break;
					case 'RatingList':
							$link = '/Modules/RatingList/rating_list.php';
							$js_local_source = '/Modules/RatingList/rating_list.js';
							break;
					default:
						$link = '/Modules/RatingList/rating_list.php';
						$js_local_source = '/Modules/RatingList/rating_list.js';
				}
			}elseif ($user_role == 'dgr'){
				$module = $_GET['module'];
				switch($module){
					case 'CreativeEdit':
							$link = '/Modules/CreativeEdit/сreative_edit.php';
							$js_local_source = '/Modules/CreativeEdit/creative_edit.js';
							break;
					case 'CreativeList':
							$link = '/Modules/CreativeList/сreative_list.php';
							$js_local_source = '/Modules/CreativeList/сreative_list.js';
							break;
					default:
							$link = '/Modules/CreativeList/сreative_list.php';
							$js_local_source = '/Modules/CreativeList/сreative_list.js';

			}
		}
			// Подключение контента (скрипты в футер грузим по необходимости)
			include($_SERVER['DOCUMENT_ROOT'].$link);
		?>
	</main>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/Layout/footer.php')?>