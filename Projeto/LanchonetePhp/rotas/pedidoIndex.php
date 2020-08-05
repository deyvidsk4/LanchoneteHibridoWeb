<?php
// allow requests from other applications
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

require('../classes/Pedido.php');

// apresentar pedido

if (isset($_GET['action']) && $_GET['action'] == 'show' && isset($_GET['pk_cod_pedido'])) {
  $pedido = new Pedido();
  echo json_encode($pedido->findOne($_GET['pk_cod_pedido']));
}

// novo pedido

if (isset($_POST['action']) && $_POST['action'] == 'store') {
  $pedido= new Pedido();
  echo json_encode($pedido->store($_POST));
  return;
}

// atualizar pedido

if (isset($_POST['action']) && $_POST['action'] == 'update') {
  $pedido = new Pedido();
  if ($pedido->update($_POST)) {
    echo 'Updated!';
  }
  return;
}

// remover pedido
if (isset($_GET['action']) && $_GET['action'] == 'destroy' && isset($_GET['pk_cod_pedido'])) {
  $pedido = new Pedido();
  if ($pedido->destroy($_GET['pk_cod_pedido'])) {
    echo 'Deleted!';
  }
  return;
}

// listar todos os pedido
if (!isset($_GET['action'])) {
  $pedido = new Pedido();
  echo json_encode($pedido->findAll());
}
