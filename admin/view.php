<?php
	require 'database.php';
	if (!empty($_GET['id']))//si le super global de l'id n'est pas vide 
	{
		$id=checkInput($_GET['id']);
		
	}
	$db=Database::connect();//on se connecte à notre base de données et stoque les éléments ds la variable $db
				$statement=$db->prepare('SELECT items.id, items.name, items.description, items.price,items.image, categories.name AS category FROM items LEFT JOIN categories ON items.category=categories.id
					WHERE items.id=? ');//on v afficher un seul item
				$statement->execute(array($id));
				$item=$statement->fetch();//on le stok ds la variable item en l'affiçant ligne apres ligne
				Database::disconnect();//c'est pour se déconnecter de la base apres

	function checkInput($data)//pour la sécurité des données
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
		<div class="col-sm-6 site">
			<h1> <strong>Voir un  item</strong></h1>
		</br>
		<form>
			<div class="form-group">
				<label>Nom:</label><?php echo ' ' .$item['name'] ;?>
			</div>
			<div class="form-group">
				<label>Description:</label><?php echo ' ' .$item['description'] ;?>
			</div>
			<div class="form-group">
				<label>Price:</label><?php echo ' ' .number_format((float)$item['price'],2,'.','').'€';?>
			</div>
			<div class="form-group">
				<label> Categorie:</label><?php echo ' ' .$item['category'] ;?>
			</div>
			<div class="form-group">
				<label>Image:</label><?php echo ' ' .$item['image'] ;?>
			</div>
		</form>
		</br>
		<div class="form-actions">
			<a href="index.php" class="btn btn-primary" ><span class="glyphicon glyphicon-arrow-left"> </span>Retour </a>
		</div>
			
		</div>
		<div class="col-sm-6">
			<div class="thumbnail">
							<img src="<?php echo '../images/'. $item['image'];?>" alt="...">
							<div class="price"><?php echo number_format((float)$item['price'],2,'.','').'€';?></div>
							<div class="caption">
								<h4><?php echo $item['name'] ;?></h4>
								<p><?php echo  $item['description'] ;?></p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
				</div>
		</div>
		
		
	</div>
</div>

</body>
</html>

