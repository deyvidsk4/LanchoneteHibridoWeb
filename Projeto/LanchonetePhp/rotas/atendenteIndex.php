<?php
//permitir solicitações de outros aplicativos
header('access-Control-Allow-Origin: *');
header('Acess-Control-Allow-Credentials: true');
header('Access-Control-Allow-Mthods: GET, PUT, POST, DELETE');
header('Acess-Control-Max-Age: 1000');
header('Acess-Control-Allow-Headers: Origin, Content-Type, X-auth-Token, Authorization');

require('../classes/Atendente.php');

// apresentar atendente

if (isset($_GET['action']) && $_GET['action'] == 'show' && isset($_GET['pk_matricula'])) {
    $atendente = new Atendente();
    echo json_encode($atendente->findOne($_GET['pk_matricula']));
}

// novo atendente

if (isset($_POST['action']) && $_POST['action'] == 'store') {
    $atendente = new Atendente();
    echo json_encode($atendente->store($_POST));
    return;
}

// atualizar atendente

if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $atendente = new Atendente();
    if ($atendente->update($_POST)) {
        echo 'Atendende Atualizado!';
    }
    return;
}

// remover atendente

if (isset($_GET['action']) && $_GET['action'] == 'destroy' && isset($_GET['pk_matricula'])) {
    $atendente = new Atendente();
    if ($atendente->destroy($_GET['pk_matricula'])) {
        echo 'Atendente deletado!';
    }
    return;
}

// listar todos os atendente

if (!isset($_GET['action'])) {
    $atendente = new Atendente();
    echo json_encode($atendente->findAll());
}
