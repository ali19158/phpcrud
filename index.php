<?php

    define('ROOT', dirname(__FILE__));
    require_once(ROOT.'/autoload.php');

    __autoload('User');
    __autoload('BaseController');
    __autoload('UserController');

?>


<div id="container">
	<ul>
		<li><a class="menu" href="?method=index">Crud</a></li>
	</ul>
</div>