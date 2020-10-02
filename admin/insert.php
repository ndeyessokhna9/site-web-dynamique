<?php
	require  'database.php';
	$nameError = $descriptionError =$priceError =$categoryError =$imageError = $name = $dexcription = $price = $category = $image ="";
	if (!empty($_POST))
	{
		$name=         checkInput($_POST['name']);
		$description=   checkInput($_POST['description']);
		$price=         checkInput($_POST['price']);
		$category =    checkInput($_POST['category']);
		$image =       checkInput($_FILES['image']['name']); // récupèrer l'image et son nom
		echo($image); 
		$imagePath =   '../images/'.basename($image); 
		//récupèrer le chemin de l'image 
		$imageExtension= pathinfo($imagePath,PATHINFO_EXTENSION); //récupèrer l'extension de l'image(png ou jpg... ) 
		$isSuccess=true;
		$isUploadSuccess=false;

		if(empty($name))
		{
			$nameError='ce champ ne peut pas  etre vide';
			$isSuccess=false;
			// si le nom est vide on affiche ce message d'erreur et cela n'est pas un succes, on passe	
		}

		if(empty($description))
		{
			$descriptionError='ce champ ne peut pas etre vide';
			$isSuccess=false;
			// si la description est vide on affiche ce message d'erreur et cela n'est pas un succes, on passe	
		}

		if(empty($price))
		{
			$priceError='ce champ ne peut pas etre vide';
			$isSuccess=false;
			// si le prix est vide on affiche ce message d'erreur et cela n'est pas un succes, on passe
			
		}

		if(empty($category))
		{
			$categoryError='ce champ ne peut pas  etre vide';
			$isSuccess=false;
			 // si la catégorie  est vide on affiche ce message d'erreur et cela n'est pas un succes, on passe
			
		}

		if(empty($image))
		{
			$imageError='ce champ ne peut pas etre vide';
			$isSuccess=false;
			//si l' image est vide on affiche ce message d'erreur et cela n'est pas un succes, on passe
 
		}
		else
		{
			$isUploadSuccess=true;
			if($imageExtension != "jpg" && $imageExtension != "png"&& $imageExtension != "jpeg" && $imageExtension != "jif")
			{
				$imageError='les fichiers autorisés sont: .jpg, .png, .jpeg, .jif ';
				$isUploadSuccess=false;
			}
			if (file_exists($imagePath))
			 {
				$imageError="le fichier existe déjà";
				$isUploadSuccess=false;
			}
			if ($_FILES["image"]["size"] > 500000)
			 {
				$imageError=" le fichier ne doit pas dépasser 500KB";
				$isUploadSuccess=false;
			}
			if ($isUploadSuccess) 
			{
				if (!move_uploaded_file($_FILES["image"]["tmp_name"],$imagePath)) 
				{
					$imageError ="il a eu un erreur lors de l'upload";
					$isUploadSuccess=false;// aprés retourner à la page index.php et voir l'élément ajouté ds la liste
				}
			}

		}
		if ($isSuccess && $isUploadSuccess)//s'li n'ya pas de message d'erreurs tout est ok
		 {
			$db=Database::connect();
			$statement=$db->prepare("INSERT INTO items( name,description,price,category,image) values( ?,?,?,?,?)");
			$statement->execute(array($name,$description,$price,$category,$image));
			Database::disconnect();
			header("Localisation: index.php");

		}

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
			<h1> <strong>Ajouter  un  item </strong></h1>
		</br>
		<form class="form" role="form" action="insert.php" method="post" enctype="multipart/form-data">
			<!-- action d'afficher les éléments sur la mm page insert.php en utilisant post et aussi uploter une  typeimage -->
			<div class="form-group">
				<label for="name">Nom:</label>
				<input type="text" name="name" class="form-control" id="name" placeholder="Nom" value="<?php echo $name;?>">
				<span class="help-inline"> <?php echo $nameError;?></span>
			</div>
			<div class="form-group">
				<label for="description">Description:</label>
				<input type="text" name="description" class="form-control" id="description" placeholder="Description" value="">
				<span class="help-inline"><?php echo $descriptionError;?></span>
			</div>
			<div class="form-group">
				<label for="price">Prix: (en €)</label>
				<input type="number" step="0.01" name="price" class="form-control" id="price" placeholder="Prix" value="<?php echo $price;?>">
				<!-- step pour inclure des valeurs à chak fois  -->
				<span class="help-inline"><?php echo $priceError;?></span>
			</div>
			<div class="form-group">
				<label for="category">Catégorie:</label>
				<select class="form-control" name="category" id="category">
					<?php
					$db=Database::connect();
					foreach($db->query('SELECT * FROM categories') as $row)
					 {
					 	echo '<option value=" ' .$row['id'] .' ">' .$row['name'].'</option>';

					}
					Database::disconnect();

					?>
					
				</select>
				<!-- crée une liste déroulante avec select -->
				<span class="help-inline"><?php echo $categoryError;?></span>
			</div>
			<div class="form-group">
				<label>Image:</label>
				<p><?php echo " $image";?></p>
				<label for="image">Sélectionner une image</label>
                <input type="file" name="image" id="image">
				<span class="help-inline"><?php echo $imageError;?></span>
				<!-- <label for="image">Sélectionner une  nouvelle image</label>
				<input type="file " name="image"  id="image">
				<span class="help-inline"><?php echo $imageError;?></span> -->
			</div>
		
		</br>
		<div class="form-actions">
			<button type="submit"<span class="btn btn-success"><span class="glyphicon glyphicon-pencil">Ajouter</span>></button>
			<a href="index.php" class="btn btn-primary" ><span class="glyphicon glyphicon-arrow-left"> Retour</span></a>
		</div>
		</form>
		</div>
		
	</div>

</body>
</html>