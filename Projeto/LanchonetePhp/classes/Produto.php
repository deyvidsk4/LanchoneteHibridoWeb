<?php
require('../conexaoBanco/Database.php');

class Produto
{
  /**
   *Estanciando conexão
   * @var Database $connection
   */
  private $connection;

  /**
   * 
   * Iniciando conexão
   * @return 
   */
  public function __construct()
  {
    $this->connection = (new Database())->connect();
  }

  /**
   * Listando  todos produtos
   * 
   * @return array
   */
  public function findAll()
  {
    $sql = 'SELECT * FROM Produto';
    $produto = $this->connection->prepare($sql);
    $produto->execute();
    return $produto->fetchAll(PDO::FETCH_OBJ);
  }

  /**
   * Listando produto
   * 
   * @param int 
   * @return object
   */
  public function findOne($pk_cod_produto)
  {
    $sql = 'SELECT * FROM Produto WHERE pk_cod_produto = :cod';
    $produto = $this->connection->prepare($sql);
    $produto->bindValue(':cod', $pk_cod_produto, PDO::PARAM_INT);
    $produto->execute();
    return $produto->fetch(PDO::FETCH_OBJ);
  }

  /**
   * Inseriondo produto
   * 
   * @param array $data
   * @return int
   */
  public function store($data)
  {
    $sql = 'INSERT INTO Produto ( nome, disponibilidade, valor_unitario, tipo)';
    $sql .= 'VALUES (:nome, :disponibilidade, :valor, :tipo)';



    $produto = $this->connection->prepare($sql);

    $produto->bindValue(':nome', $data['nome'], PDO::PARAM_STR);
    $produto->bindValue(':disponibilidade', $data['disponibilidade'], PDO::PARAM_STR);
    $produto->bindValue(':valor', $data['valor_unitario'], PDO::PARAM_STR);
    $produto->bindValue(':tipo', $data['tipo'], PDO::PARAM_STR);

    $produto->execute();
    return $this->connection->lastInsertId();
  }

  /**
   * Atualizando produto
   * 
   * @param array $data
   * @return object
   */
  public function update($data)
  {
    $sql = 'UPDATE produto SET nome = :nome, disponibilidade = :disponibilidade,
            valor_unitario = :valor,  tipo = :tipo
            WHERE pk_cod_produto = :cod';

    $produto = $this->connection->prepare($sql);
    
    $produto->bindValue(':cod', $data['pk_cod_produto'], PDO::PARAM_INT);
    $produto->bindValue(':nome', $data['nome'], PDO::PARAM_STR);
    $produto->bindValue(':disponibilidade', $data['disponibilidade'], PDO::PARAM_STR);
    $produto->bindValue(':valor', $data['valor_unitario'], PDO::PARAM_STR);
    $produto->bindValue(':tipo', $data['tipo'], PDO::PARAM_STR);
    
    return $produto->execute();
  }

  /**
   * removendo produto
   * 
   * @param int
   * @return object
   */
  public function destroy($pk_cod_produto)
  {
    $sql = 'DELETE FROM produto WHERE pk_cod_produto = :cod';
    $produto = $this->connection->prepare($sql);
    $produto->bindValue(':cod', $pk_cod_produto, PDO::PARAM_INT);
    return $produto->execute();
  }
}
