<?php include "../config.php"; ?>
<?php include "../template_top.php";
$add = "none";
$remove = "none";
$title = "Choices Editor";

if(isset($_POST['add']))
{
$add = "";
$remove = "none";
$title = "Add choices";
}
if(isset($_POST['remove']))
{
$add = "none";
$remove = "";
$title = "Request choice removal";
}
?>
<title><?php echo $title; ?> </title>
<head>
<style type="text/css">
body {
	background-color: black;
}

input.menu {
	font-size: 20pt;
	margin-left: 10px;
}

form.menu {
	display: inline;
}

div {
	position: fixed;
	top: 70px;
	left: 70px;
	width: 450px;
}

div.add {
	display: <?php echo $add; ?>;
}

div.remove {
	display: <?php echo $remove; ?>;
}

a {
	color: white;
	font-size: 20px;
}
</style>
</head>
<body>
<form class="menu" method="post" action="food.php">
<input class="menu" type="submit" value="Food">
</form>
<form class="menu" method="post" action="<?php echo $PHP_SELF;?>">
<input class="menu" type="submit" value="Add to choices" name="add">
<input class="menu" type="submit" value="Request removal" name="remove">
</form>
<div class="add">
<form class="add" method="post" action="">
<a>Place/food name</a><input type="text" name="restaurant">
<input type="submit">
</form>
</div>
<div class="remove">
<a>Name of food/place to remove</a><br><input class="email" type="text" name="choice">
<br><br><a>Reason for removal request</a><form class="email" method="post" action="" id="email">
<textarea rows="10" cols="50" name="request" form="email"></textarea>
<input type="submit">
</form>
</div>


<?php include "../template_bottom.php"; ?>
