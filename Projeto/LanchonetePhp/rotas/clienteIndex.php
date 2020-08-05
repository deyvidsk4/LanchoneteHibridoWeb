<?php
// allow requests from other applications
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

require('../classes/Cliente.php');

// show cliente
if (isset($_GET['action']) && $_GET['action'] == 'show' && isset($_GET['pk_cod_cliente'])) {
  $cliente = new Cliente();
  echo json_encode($cliente->findOne($_GET['pk_cod_cliente']));
}

// new cliente
if (isset($_POST['action']) && $_POST['action'] == 'store') {
  $cliente = new Cliente();
  echo json_encode($cliente->store($_POST));
  return;
}

// atualizar cliente
if (isset($_POST['action']) && $_POST['action'] == 'update') {
  $cliente = new Cliente();
  if ($cliente->update($_POST)) {
    echo 'Updated!';
  }
  return;
}

// remover cliente
if (isset($_GET['action']) && $_GET['action'] == 'destroy' && isset($_GET['pk_cod_cliente'])) {
  $cliente = new Cliente();
  if ($cliente->destroy($_GET['pk_cod_cliente'])) {
    echo 'Deleted!';
  }
  return;
}

// listar todos os cliente

if (!isset($_GET['action'])) {
  $cliente = new Cliente();
  echo json_encode($cliente->findAll());
}
