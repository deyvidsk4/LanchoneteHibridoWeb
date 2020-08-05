<?php
// allow requests from other applications
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

require('../classes/Produto.php');

// apresentar pedido
if (isset($_GET['action']) && $_GET['action'] == 'show' && isset($_GET['pk_cod_produto'])) {
  $produto = new Produto();
  echo json_encode($produto->findOne($_GET['pk_cod_produto']));
}

// novo pedido
if (isset($_POST['action']) && $_POST['action'] == 'store') {
  $produto = new Produto();
  echo json_encode($produto->store($_POST));
  return;
}

// atualizar venda
if (isset($_POST['action']) && $_POST['action'] == 'update') {
  $produto = new Produto();
  if ($produto->update($_POST)) {
    echo 'Updated!';
  }
  return;
}

// remover venda
if (isset($_GET['action']) && $_GET['action'] == 'destroy' && isset($_GET['pk_cod_produto'])) {
  $produto = new Produto();
  if ($produto->destroy($_GET['pk_cod_produto'])) {
    echo 'Deleted!';
  }
  return;
}

// listar todos os venda
if (!isset($_GET['action'])) {
  $produto = new Produto();
  echo json_encode($produto->findAll());
}
