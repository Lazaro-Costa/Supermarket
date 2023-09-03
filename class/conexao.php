<?php
class Conexao
{
  private $host = 'localhost';
  private $usuario = 'root';
  private $senha = '';
  private $banco = 'cadastro';
  protected $conexao; // Mudamos para protected para que subclasses possam acessá-lo

  public function __construct()
  {
    try {
      $this->conexao = new PDO("mysql:host=$this->host;dbname=$this->banco", $this->usuario, $this->senha);
      $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
    }
  }
}
