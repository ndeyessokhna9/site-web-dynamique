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
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
	<div class="container site">
		<h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger Code<span class="glyphicon glyphicon-cutlery"></span></h1>

		<?php
		//on rend le site dynamique mntna cad si on supprime un item  ,il n'est plus affiché sur la page du site
		require 'admin/database.php'; 
		echo'<nav>
			<ul class=" nav nav-pills">';
			$db=Database::connect();
			$statement=$db->query("SELECT * FROM categories");
			$categories=$statement->fetchALL();
			foreach ($categories as $category)
			 {
			 	if ($category['id']=='1') //on passe sur chacune des categories
			 		echo'<li role="presentation"class="active" ><a href="#'. $category['id'] .'" data-toggle="tab">'.$category['name'].'</a></li>';
			 	else
			 		echo'<li role="presentation"><a href="#'. $category['id'] .'" data-toggle="tab">'.$category['name'].'</a></li>';	
			}
			echo '</ul>
				</nav> ';
			echo '	<div class="tab-content">';
				foreach ($categories as $category)
				{
					if ($category['id']=='1') //on passe sur chacune des items de chak categorie
			 			echo'<div class="tab-pane active" id="'. $category['id'].'">';
			 		else
			 			echo'<div class="tab-pane " id="'. $category['id'].'">';
			 			echo '<div class="row">';
			 				$statement=$db->prepare("SELECT * FROM items WHERE items.category = ?");
							$statement->execute(array($category['id']));
							while ($item = $statement->fetch())
								 {
								 	echo'<div class="col-sm-6 col-md-4">
											<div class="thumbnail">
												<img src="images/' . $item['image'] . '" alt="...">
												<div class="price">'.number_format($item['price'],2,'.','') .'€ </div>
												<div class="caption">
												<h4>' .$item['name']. '</h4>
												<p>' . $item['description']. '</p>
												<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
													</div>
												</div>	
											</div>';
								}
							echo '	</div>	
								</div>';	

				}
				Database::disconnect();
		echo '</div>';

		?>
	</div>
</body>
</html>
		<!-- <nav>
			<ul class=" nav nav-pills">
				<li role="presentation"class="active" ><a href="#1" data-toggle="tab">Menus</a></li>
				<li role="presentation" ><a href="#2" data-toggle="tab">Burgers</a></li>
				<li role="presentation" ><a href="#3" data-toggle="tab">Snacks</a></li>
				<li role="presentation"><a href="#4" data-toggle="tab">Salades</a></li>
				<li role="presentation" ><a href="#5" data-toggle="tab">Boissons</a></li>
				<li role="presentation" ><a href="#6" data-toggle="tab">Desserts</a></li>
			</ul>
		</nav> -->
		<!-- <div class="tab-content">
			<div class="tab-pane active" id="1">
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/m1.png" alt="...">
							<div class="price">8.90 €</div>
							<div class="caption">
								<h4>Menu Classic</h4>
								<p>Sandwich:Burger,Salade,Tomate,Conichon + Frite + Boisson</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>	
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/m1.png" alt="...">
							<div class="price">9.50 €</div>
							<div class="caption">
								<h4>Menu Bacon</h4>
								<p>Sandwich:Burger,Salade,Tomate,Conichon + Frite + Boisson</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/m1.png" alt="...">
							<div class="price">10.90 €</div>
							<div class="caption">
								<h4>Menu Big</h4>
								<p>Sandwich:Burger,Salade,Tomate,Conichon + Frite + Boisson</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/m1.png" alt="...">
							<div class="price">9.90 €</div>
							<div class="caption">
								<h4>Menu Chiken</h4>
								<p>Sandwich:Burger,Salade,Tomate,Conichon + Frite + Boisson</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/m1.png" alt="...">
							<div class="price">10.90 €</div>
							<div class="caption">
								<h4>Menu Fish</h4>
								<p>Sandwich:Burger,Salade,Tomate,Conichon + Frite + Boisson</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/m1.png" alt="...">
							<div class="price">11.90 €</div>
							<div class="caption">
								<h4>Menu Double Stack</h4>
								<p>Sandwich:Burger,Salade,Tomate,Conichon + Frite + Boisson</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
				</div>
			</div>
		<div class="tab-pane " id="2">
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/b1.png" alt="...">
							<div class="price">5.90 €</div>
							<div class="caption">
								<h4> Classic</h4>
								<p>Sandwich:Burger,Salade,Tomate,Conichon + Frite + Boisson</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/b2.png" alt="...">
							<div class="price">6.50 €</div>
							<div class="caption">
								<h4> Bacon</h4>
								<p>Sandwich:Burger,Salade,Tomate,Conichon + Frite + Boisson</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/b3.png" alt="...">
							<div class="price">5.90 €</div>
							<div class="caption">
								<h4> Big</h4>
								<p>Sandwich:Burger,Salade,Tomate,Conichon + Frite + Boisson</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/b4.png" alt="...">
							<div class="price">6.90 €</div>
							<div class="caption">
								<h4>Chiken</h4>
								<p>Sandwich:Burger,Salade,Tomate,Conichon + Frite + Boisson</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/m1.png" alt="...">
							<div class="price">6.50 €</div>
							<div class="caption">
								<h4> Fish</h4>
								<p>Sandwich:Burger,Salade,Tomate,Conichon + Frite + Boisson</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/m1.png" alt="...">
							<div class="price">7.50 €</div>
							<div class="caption">
								<h4>Double Stack</h4>
								<p>Sandwich:Burger,Salade,Tomate,Conichon + Frite + Boisson</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
				</div>
			</div>
			<div class="tab-pane " id="3">
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/s1.png" alt="...">
							<div class="price">3.90 €</div>
							<div class="caption">
								<h4>Frites</h4>
								<p>pommes de terre frites</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/s2.png" alt="...">
							<div class="price">3.40 €</div>
							<div class="caption">
								<h4>onions reings</h4>
								<p>rondelles d'onions frits</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/s3.png" alt="...">
							<div class="price">5.90 €</div>
							<div class="caption">
								<h4>nuggets</h4>
								<p>nuggets de poulets frits</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/s4.png" alt="...">
							<div class="price">3.90 €</div>
							<div class="caption">
								<h4>nuggets fromage</h4>
								<p>nuggets et fromage frits</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/s5.png" alt="...">
							<div class="price">5.90 €</div>
							<div class="caption">
								<h4>ailles de poulets</h4>
								<p>alles de poulets barnecve</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
		
				</div>
			</div>
			<div class="tab-pane " id="4">
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/sa1.png" alt="...">
							<div class="price">8.90 €</div>
							<div class="caption">
								<h4>sesar poulet pané</h4>
								<p>poulet pané,salade,tomate et la rameuse sauce sesar</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/sa2.png" alt="...">
							<div class="price">8.90 €</div>
							<div class="caption">
								<h4>sesar poulet grillé</h4>
								<p>poulet grillé,salade,tomate et la rameuse sauce sesar</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/sa3.png" alt="...">
							<div class="price">5.90 €</div>
							<div class="caption">
								<h4>Salade light</h4>
								<p>salade,tomate,comcombre,mais et vinaigre balzamique</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/sa4.png" alt="...">
							<div class="price">7.90 €</div>
							<div class="caption">
								<h4>poulet pané</h4>
								<p>poulet pané,salade,tomate et la rameuse sauce de votre choix</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/sa5.png" alt="...">
							<div class="price">7.90 €</div>
							<div class="caption">
								<h4>poulet pané</h4>
								<p>poulet pané,salade,tomate et la rameuse sauce de votre choix</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					
				</div>
			</div>
			<div class="tab-pane " id="5">
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/bo1.png" alt="...">
							<div class="price">1.90 €</div>
							<div class="caption">
								<h4>coca-cola </h4>
								<p>Au choix:petit,moyen ou grand</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/bo2.png" alt="...">
							<div class="price">1.90 €</div>
							<div class="caption">
								<h4>coca-cola light</h4>
								<p>Au choix:petit,moyen ou grand</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/bo3.png" alt="...">
							<div class="price">1.90 €</div>
							<div class="caption">
								<h4>coca-cola zéro</h4>
								<p>Au choix:petit,moyen ou grand</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/bo4.png" alt="...">
							<div class="price">1.90 €</div>
							<div class="caption">
								
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/bo5.png" alt="...">
							<div class="price">1.90 €</div>
							<div class="caption">
								
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/bo6.png" alt="...">
							<div class="price">1.90 €</div>
							<div class="caption">
							
							</div>
							
						</div>
						
					</div>
					
				</div>
			</div>
			<div class="tab-pane " id="6">
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/d1.png" alt="...">
							<div class="price">8.90 €</div>
							<div class="caption">
								<h4>Fondation au Chocolat</h4>
								<p>Au choix:Chocolat blan ou lait</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/d2.png" alt="...">
							<div class="price">9.50 €</div>
							<div class="caption">
								<h4>Muffin</h4>
								<p>Au choix:Au fruit ou au chocolat</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/d3.png" alt="...">
							<div class="price">10.90 €</div>
							<div class="caption">
								<h4>Beigner</h4>
								<p>Au choix:au chocolat ou à la vanille</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/d4.png" alt="...">
							<div class="price">9.90 €</div>
							<div class="caption">
								<h4>Milshack</h4>
								<p>Au choix:fraise,vanilleou chocolat</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="images/d5.png" alt="...">
							<div class="price">10.90 €</div>
							<div class="caption">
								<h4>Sundat</h4>
								<p>Au choix:fraise,caramelou chocolat</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Commender </a>
							</div>
							
						</div>
						
					</div>
			
				</div>
			</div>
		</div> -->
