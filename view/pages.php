<?php

$page_initial = 'servicos';
$page = !isset($_GET['page']) ? $page_initial : $_GET['page'];

switch($page){
    case 'servicos':
        include('view/servicos.php');
        break;
    case 'transportes':
        include('view/transportes.php');
        break;
    case 'tipo_transporte':
        include('view/tipo_transporte.php');
        break;
}

?>