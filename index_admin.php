<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once "class-users.php";
require_once "productclass.php";
$p = new Users("my_shop", "127.0.0.1", "jules", "juju");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="backup.css">

</head>
<body>
	<?php 
	if (isset($_POST["email"])) // when user click in add or edit button
	{

		// ------ Edit
		if(isset($_GET["ID_up"]) && !empty($_GET['ID_up']))
		{
			$id_upd = addslashes($_GET['ID_up']);

			$email = addslashes($_POST['email']);
			$password = addslashes($_POST['password']);
		

			if (!empty($email) && !empty($password)) {

			//Editar

			!$p->updateUser($id_upd, $email, $password);
			header("location: index_admin.php");

			} else {

				?>
					<div class="warning">
						<h4>Please complete all required fields!</h4>
					</div>
				    
				<?php

			}

		
			} //-----  Add
			else {


			
			$email = addslashes($_POST['email']);
			$password = addslashes($_POST['password']);
		

			if (!empty($email) && !empty($password)) {

				if(!$p->signUp($email, $password)){

					?>
					<div class="warning">
						<h4>Email already exists!</h4>
					</div>
				    
				<?php
					
				}

			} else {

				?>
					<div class="warning">
						<h4>Please complete all required fields!</h4>
					</div>
				    
				<?php
			}

		}

	}
	?>
	<?php 
		if (isset($_GET["ID_up"])) {
			
			$id_update = addslashes($_GET["ID_up"]);
			$res = $p->searchData($id_update);

		}
		?>
	<section id="left">
		<form method="POST" action="signup.php">
			<label>E-mail</label>
			<input for="email" type="text" name="email" id="email">
			<label>Password</label>
			<input for="password" type="text" name="password" id="password">
			<input type="submit">
		</form>
		
	</section>
	<section id="right">
		<table id="usertable">
			<tr id="titles">
				<td>ID</td>
				<td>EMAIL</td>
				<td>PASSWORD</td>
				<td>ADMIN</td>
				<td>ACTION</td>
			</tr>
		<?php

			$data = $p->searchUsers();
			if (count($data) > 0) // check if the user is already registred
			{
				for ($i=0; $i < count($data); $i++)
				 { 
				 	echo "<tr>";
					foreach ($data[$i] as $k => $v) 
					{
						if ($k != "id") 
						{
							echo "<td>".$v."</td>";
						}
					}
					?>
					<td>
						<a href="edituser.html">Edit</a>
						<a href="index_admin.php?ID=<?php echo $data[$i]['ID']; ?>">Del</a>
					</td>

		<?php
					echo "</tr>";
				}
		
			}
			else // if the database is empty
			{
			}	
			?>
					
			</table>
				<div class="warning">
				</div>
				    
		
	<form action="addproduct.php" method="post" id="addproduct">
    Nom<br>
	<input type="text" name="nameproduct" placeholder="Nom du produit">
	Prix<br>
    <input type="text" name="priceproduct" placeholder="Prix">
	Description<br>
    <input type="text" name="descproduct" placeholder="Description du produit">
	Type<br>
    <select name="typeproduct">
		<option value="Imac">Imac</option>
		<option value="Macbook">Macbook</option>
		<option value="Iphone">Iphone</option>
		<option value="Ipad">Ipad</option>
	</select>
	
    <input type="submit" name="submit" value="Upload">
    </form> 

    <form action="upload.php" method="post" enctype="multipart/form-data" id="upload">
        <h2>Photo du produit</h2>
        <input type="file" name="img" id="fileUpload">
        <input type="text" name="idimg" id="fileUpload" placeholder="ID du produit correspondant">
        <input type="submit" name="submit" value="Upload">
    </form> 

	<section>
		<table id="stock">
			<tr id="titles">
				<td>ID</td>
				<td>NOM</td>
				<td>PRIX</td>
				<td>DESCRIPTION</td>
				<td>TYPE</td>
				<td>IMG</td>
			</tr>

		
<?php
	
		require_once "stock.php";
		$stock = new Stock;
		$displaystock = $stock->displayStock();
		if (count($displaystock) > 0) 
			{
			for ($i=0; $i < count($displaystock); $i++)
			{
		echo "<tr>"	;
		foreach($displaystock[$i] as $k => $info){
			if ($k != "id") 
    	echo "<td>" . $info . "</td>";
    	}}
	}
?>
</table>
</section>

<section id=setproducts>
	<form action= "delete.php" method="post">
		<input type="text" name="iddelete" placeholder="ID du produit à supprimer"></input>
		<input type=submit value="Supprimer"></input>
</form>
</section>
</body>
</html>

<?php

	if (isset($_GET['ID'])) {
	$id_user = addslashes($_GET['ID']);
	$p->deleteUser($id_user);
	header('location: index_admin.php');
	}

?>