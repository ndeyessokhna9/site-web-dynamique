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
		<h1><strong>Liste des items</strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span>Ajouter </a></h1>
		<table class="table table-striped table-bordered">
			<thead>
			<tr>
				<th> Nom </th>
				<th> Description </th>
				<th> Prix </th>
				<th> Catégorie </th>
				<th> Actions </th>
			</tr> 

			</thead>
			<tbody>
				<?php

				require'database.php';//on l'inclure pour pouvoir l'utiliser(cad les éléments de cette page statique proviennent de la base de donnees Burger_code avec les tables name et categories)
				$db=Database::connect();//retour la connection de la base
				$statement=$db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category FROM items LEFT JOIN categories ON items.category=categories.id
					ORDER BY items.id DESC '); 
					//sélectionner les éléments de la table items les joindre à gauche de la table categories si les élément du champ category= aux id de la table categories

				while ($item=$statement->fetch())//affiche les items ligne àpres ligne
				 {
				 	echo '<tr>';
					echo '<td>' .$item['name'].'</td>';
					echo '<td>' .$item['description']. '</td>';
					echo '<td>' .number_format((float)$item['price'],2,'.','').'</td>';// s'il n'est pas un float on l'affiche par 2 chiffres aprés  séparer par un point 
					echo '<td>' .$item['category']. '</td>';
					echo '<td width=300>';
					echo '<a class="btn btn-default" href="view.php?id='. $item['id'] .'"><span class="glyphicon glyphicon-eye-open"></span> Voir </a>';
					echo ' ';
					echo '<a class="btn btn-primary" href="updat.php?id='. $item['id'] .'"><span class="glyphicon glyphicon-pencil"></span> Modifier </a>';
					echo ' ';
					echo '<a class="btn btn-danger" href="delete.php?id='. $item['id'] .'"><span class="glyphicon glyphicon-remove"></span> Supprimer </a>';
					echo '</td>';
					echo '</tr>';
					
				}
				Database::disconnect();


				 ?>
				
				<!-- <tr>
					<td> Item1 </td>
					<td> Description1 </td>
					<td> Prix1 </td>
					<td> Catégorie1</td>
					<td width="300">
					<a class="btn btn-default" href="view.php?id=1"><span class="glyphicon glyphicon-eye-open"></span> Voir </a>
					<a class="btn btn-primary" href="updat.php?id=1"><span class="glyphicon glyphicon-pencil"></span> Modifier </a>
					<a class="btn btn-danger" href="delete.php?id=1"><span class="glyphicon glyphicon-remove"></span> Supprimer </a>
					</td>
				</tr> -->
				
			</tbody>
		</table>
	</div>
</div>

</body>
</html>
<!-- création statique de la page index.php et on l'a dynamiser mtna par utilisation du php -->