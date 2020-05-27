<?php
	// mySQL connection information
	$MYSQL_HOST = 'localhost';
	$MYSQL_USER = 'root';
	$MYSQL_PASSWORD = 'yst94*';
	$MYSQL_DATABASE = 'blog';
	$MYSQL_PREFIX = '';
	// new in 3.50. first element is db handler, the second is the db driver used by the handler
	// default is $MYSQL_HANDLER = array('mysql','mysql');
	//$MYSQL_HANDLER = array('mysql','mysql');
	//$MYSQL_HANDLER = array('pdo','mysql');
	$MYSQL_HANDLER = array('mysql','');

	// main nucleus directory
	$DIR_NUCLEUS = '/var/www/blog/nucleus/';

	// path to media dir
	$DIR_MEDIA = '/var/www/blog/media/';

	// extra skin files for imported skins
	$DIR_SKINS = '/var/www/blog/skins/';

	// these dirs are normally sub dirs of the nucleus dir, but
	// you can redefine them if you wish
	$DIR_PLUGINS = $DIR_NUCLEUS . 'plugins/';
	$DIR_LANG = $DIR_NUCLEUS . 'language/';
	$DIR_LIBS = $DIR_NUCLEUS . 'libs/';

	// include libs
	include($DIR_LIBS.'globalfunctions.php');
?>
