<?php
require('../conexaoBanco/Database.php');


class Cliente
{
  /**
   * Estanciando conexão
   * @var Database $connection
   */
  private $connection;

  /**
   * iniciando conexão
   * 
   * @return 
   */
  public function __construct()
  {
    $this->connection = (new Database())->connect();
  }

  /**
   * listando todos cliente
   * 
   * @return array
   */
  public function findAll()
  {
    $sql = 'SELECT * FROM cliente';
    $cliente = $this->connection->prepare($sql);
    $cliente->execute();
    return $cliente->fetchAll(PDO::FETCH_OBJ);
  }

  /**
   * listando  cliente
   * 
   * @param int 
   * @return object
   */
  public function findOne($pk_cod_cliente)
  {
    $sql = 'SELECT * FROM cliente WHERE pk_cod_cliente = :cod';
    $cliente = $this->connection->prepare($sql);
    $cliente->bindValue(':cod', $pk_cod_cliente, PDO::PARAM_INT);
    $cliente->execute();
    return $cliente->fetch(PDO::FETCH_OBJ);
  }

  /**
   *Inserindo  cliente
   * 
   * @param array $data
   * @return int
   */
  public function store($data)
  {

    $sql = 'INSERT INTO cliente ( nome, cpf, senha)';
    $sql .= 'VALUES (:nome, :cpf, :senha)';
    
    $cliente = $this->connection->prepare($sql);

    $cliente->bindValue(':nome', $data['nome'], PDO::PARAM_STR);
    $cliente->bindValue(':cpf', $data['cpf'], PDO::PARAM_STR);
    $cliente->bindValue(':senha', password_hash($data['senha'], PASSWORD_DEFAULT), PDO::PARAM_STR);
    $cliente->execute();
    
    return $this->connection->lastInsertId();
  }

  /**
   *atualizando  cliente
   * 
   * @param array $data
   * @return object
   */
  public function update($data)
  {
    $sql = 'UPDATE cliente SET nome = :nome, cpf  = :cpf, senha= :senha  
    WHERE pk_cod_cliente = :cod';

    $cliente = $this->connection->prepare($sql);

    $cliente->bindValue(':cod', $data['pk_cod_cliente'], PDO::PARAM_INT);
    $cliente->bindValue(':nome', $data['nome'], PDO::PARAM_STR);
    $cliente->bindValue(':cpf', $data['cpf'], PDO::PARAM_STR);
    $cliente->bindValue(':senha', $data['senha'], PDO::PARAM_STR);
    return $cliente->execute();
  }

  /**
   * Remove cliente
   * 
   * @param int $cod_cliente
   * @return object
   */
  public function destroy($pk_cod_cliente)
  {
    $sql = 'DELETE FROM cliente WHERE pk_cod_cliente = :cod';
    $cliente = $this->connection->prepare($sql);
    $cliente->bindValue(':cod', $pk_cod_cliente, PDO::PARAM_INT);
    return $cliente->execute();
  }
}