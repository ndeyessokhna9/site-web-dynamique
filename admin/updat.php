<?php
	require  'database.php';
if (!empty($_GET['id']))//si la merhode get est vide car pas de valeurs entrées
	{
		$id=checkInput($_GET['id']);//on récupère l'id et le mettre ds une variable $id
	 }
	$nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $dexcription = $price = $category = $image ="";
if (!empty($_POST))//si la merhode post est vide
	{
		$name=         checkInput($_POST['name']);
		$description=   checkInput($_POST['description']);
		$price=         checkInput($_POST['price']);
		$category =    checkInput($_POST['category']);
		$image =       checkInput($_FILES['image']['name']); // récupèrer l'image et son nom(mais ici si l'image est sélectionnée on v modifier les 'FILES') 

		$imagePath =   '../images/'.basename($image); //récupèrer le chemin de l'image 
		$imageExtension= pathinfo($imagePath,PATHINFO_EXTENSION); //récupèrer l'extension de l'image(png ou jpg... ) 
		$isSuccess=true;

		if(empty($name))
			{
			$nameError='ce champ ne peut pas  etre vide';
			$isSuccess=false;
			// si le nom est vide on affiche ce message d'erreur et cela n'est pas un succes, on passe	
		}

		if(empty($description))
		{
			$descriptionError = 'ce champ ne peut pas etre vide';
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
			$isImadeUpdared=false;
		}
		else
		{
			$isImadeUpdared=true;
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
					$isUploadSuccess=false;
				}
			}

		}
if (($isSuccess && $isImadeUpdared && $isUploadSuccess) ||($isSuccess && !$isImadeUpdared))//oui tous les paramettres du formulaires sont bons,oui l'image est uploader et oui l'upload l'image est un success
		//ou on a un success et l'image n'est pas uploader
		 {
			$db=Database::connect();
			if ($isImadeUpdared)
			 {
			 	$statement=$db->prepare("UPDATE items set name = ?, description = ?,price = ?,category = ?,image = ? WHERE id = ?");
				$statement->execute(array($name,$description,$price,$category,$image,$id));
				
			}
			else
			{
				$statement=$db->prepare("UPDATE items set name = ?, description = ?,price = ?,category = ? WHERE id = ?");
				$statement->execute(array($name,$description,$price,$category,$id));

			}

			Database::disconnect();
			header("Localisation: index.php");// aprés retourner à la page index.php et voir l'élément modifier  ds la liste
		}

else if ($isImadeUpdared && !$isUploadSuccess)
		 {
		 	$db=Database::connect();
			$statement=$db->prepare("SELECT image  FROM items WHERE id = ?");
			$statement->execute(array($id));
			$item = $statement->fetch();
			$image=$item['image'];
			Database::disconnect();
		}
	}

else
	{
			$db=Database::connect();
			$statement=$db->prepare("SELECT * FROM items WHERE id = ?");
			$statement->execute(array($id));
			$item = $statement->fetch();
			$name= $item['name'];
			$description= $item['description'];
			$price= $item['price'];
			$category= $item['category'];
			$image=$item['image'];
			Database::disconnect();
			header("Localisation: index.php");
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
		<div class="col-sm-6 site">
			<h1> <strong>Modifier  un  item </strong></h1>
		</br>
		<form class="form" role="form" action="<?php echo 'updat.php?id='. $id;?>" method="post" enctype="multipart/form-data">
			<!-- action d'afficher les éléments sur la mm page insert.php en utilisant post et aussi uploter une  typeimage -->
			<div class="form-group">
				<label for="name">Nom:</label>
				<input type="text" name="name" class="form-control" id="name" placeholder="Nom" value="<?php echo $name;?>">
				<span class="help-inline"> <?php echo $nameError;?></span>
			</div>
			<div class="form-group">
				<label for="description">Description:</label>
				<input type="text" name="description" class="form-control" id="description" placeholder="Description" value="<?php echo $description;?>">
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
					 	if ($row['id']==$category)
					 	 
					 	 	echo '<option  selected="selected" value=" ' .$row['id'] .' ">' .$row['name'].'</option>';	
					 	
					 	else
					 		echo '<option  value=" ' .$row['id'] .' ">' .$row['name'].'</option>';	
					 }
					 	
						Database::disconnect();

					?>
					
				</select>
				<!-- crée une liste déroulante avec select -->
				<span class="help-inline"><?php echo $categoryError;?></span>
			</div>
			<!-- <div class="form-group"> -->
				<label>Image:</label>
				<p><?php echo " $image";?></p>
				<label for="image">Sélectionner une image</label>
                <input type="file" name="image" id="image">
				<span class="help-inline"><?php echo $imageError;?></span>
			<!-- </div> -->
		
		</br>
		<div class="form-actions">
			<button type="submit"span class="btn btn-success">
                <span class="glyphicon glyphicon-pencil">
                    Modifier
                </span>>
            </button>
			<a href="index.php" class="btn btn-primary" >
                <span class="glyphicon glyphicon-arrow-left">
                    Retour
                </span>
            </a>
		</div>
		</form>
			
		</div>
		<div class="col-sm-6 site ">
			<div class="thumbnail">
				
				<img src="<?php echo '../images/' .$image; ?>" alt="...">
				<div class="price"><?php echo number_format((float)$price,2,'.','').'€';?></div>
				<div class="caption">
					<h4><?php echo $name;?></h4>
					<p><?php echo  $description;?></p>
					<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
				
				</div>	
			</div>
		</div>
		
	</div>
</div>

</body>
</html>