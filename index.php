<?php

/* 
 * Created by Eliézer Santos Nunes
*/
require_once dirname(__FILE__) . '/model/TipoTransporte.php';
require_once dirname(__FILE__) . '/model/Transporte.php';
require_once dirname(__FILE__) . '/model/Servico.php';
require_once dirname(__FILE__) . '/utils/Util.php';
?>
<!doctype html>
<html lang="pt-br">
  <?php
	include('view/head.php');
  ?>
  <body>
	<?php
		include('view/menu.php');
		include('view/pages.php');
		include('view/foot.php');
	?>
  </body>
</html>