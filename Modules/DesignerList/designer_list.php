<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
			<span style="margin-right: 10px"><i class="fas fa-drafting-compass" style="font-size: 2.5rem;"></i></span>
			<div class="lh-100">
				<h6 class="mb-0 text-white lh-100">Список дизайнеров</h6>
				<small><?php echo $user_name." " .$user_surname. " [".$user_role_description."]";?></small>
			</div>
</div>

<div class="my-3 p-3 bg-white rounded box-shadow">
<?php

$stmt = $pdo->prepare("SELECT * FROM users WHERE user_role = 'dgr'");
$stmt->execute();
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

function CheckDesigner($pdo, $customer_id){
	$stmt = $pdo->prepare("SELECT * FROM tasks WHERE customer_id = ?");
	$stmt->execute(array($customer_id));
	return $stmt->rowCount();
}

echo "<pre>";
print_r($customers);
echo "</pre>";

?>

</div>