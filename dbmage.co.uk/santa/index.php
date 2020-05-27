<style type="text/css">
h1
{
font-size: 50;
color: red;
background-color: white;
text-align: center;
}
body
{
background-color: black;
}
select, button
{
font-size: 30;
}
</style>
<body>
<form method="POST" action=''>
<select name="name">
<option value="joe">Joe</option>
<option value="zoe">Zoe</option>
<option value="kieran">Kieran</option>
<option value="perry">Perry</option>
<option value="dale">Dale</option>
<option value="becky">Becky</option>
<option value="fay">Fay</option>
<option value="sam">Sam</option>
<option value="dav">Dav</option>
<option value="shaun">Shaun</option>
<option value="alfie">Alfie</option>
<option value="kyle">Kyle</option>
<option value="louisa">Louisa</option>
</select>
<button type="submit">GO!</button>
</form>

<?php
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
$name = $_POST["name"];
$name = escapeshellarg($name);
$old_path = getcwd();
chdir('/scripts/');
$santa = shell_exec("/bin/bash thehat $name");
chdir($old_path);
echo "<h1>$santa</h1><br>";
//echo "<h1>$name</h1>";
echo '<a href="index.php"><button>Finish</button></a>';
}

?>


</body>
