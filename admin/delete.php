<?php
	require  'database.php';
if (!empty($_GET['id']))//si la merhode get est vide car pas de valeurs entrées
	{
		$id=checkInput($_GET['id']);
	}
if (!empty($_POST))//si la merhode post est vide
	{
		$id= checkInput($_POST['id']);
		$db=Database::connect();
		$statement=$db->prepare("DELETE FROM items WHERE id= ?");
		$statement->execute(array($id));
		Database::disconnect();
		header("Location: index.php");
	}
	
function checkInput($data)// pour la sécurité des données si kelkun ve y mettre du mal
	{
		$data=trim($data);
		$data=stripcslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title> Burger Code</title>
	<meta charset="utf-8">
	<meta name="viewpot" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Holtwoud+One+SC">
	<link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
	<h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger Code<span class="glyphicon glyphicon-cutlery"></span></h1> 
	<div class="container admin">
		<div class="row">
			<h1> <strong>Suprimer  un  item </strong></h1>
		</br>
			<form class="form" role="form" action="delete.php" method="post">
				<input type="hidden" name="id" value="<?php echo $id;?>">
				<p class="alert alert-warning"> Etes vous sur de vouloir suprimer?</p>
				<div class="form-actions">
					<button type="submit" class="btn btn-warning"> Oui</button>
					<a href="index.php" class="btn btn-default" > Non</a>
				</div>
			</form>
		</div>
	</div>
</body>

</html>