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
						break;
					case 'UserRegistration':
						$link = '/Modules/UserRegistration/user_registeration.php';
						break;
					case 'TaskList':
							$link = '/Modules/TaskList/task_list.php';
							break;		
					default:
						$link = '/Modules/UserList/user_list.php';	
				}
			}elseif ($user_role == 'mgr'){
				$module = $_GET['module'];
				switch($module){
					case 'TaskList':
						$link = '/Modules/TaskList/task_list.php';
						break;
					default:
						$link = '/Modules/TaskList/task_list.php';	
				}
			}
			
			// Подключение контента
			include($_SERVER['DOCUMENT_ROOT'].$link);


			// include($_SERVER['DOCUMENT_ROOT'].'/Modules/UserList/user_list.php');
			// include($_SERVER['DOCUMENT_ROOT'].'/Modules/UserRegistration/user_registeration.php');
		?>
	</main>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/Layout/footer.php')?>