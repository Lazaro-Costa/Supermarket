<?php
require 'conexao.php';
class Estoque extends Conexao
{
  public function listarEstoque($nome)
  {
    if (empty($nome)) {
      echo 'Variavel nome da Classe não foi definida';
      return false;
    } else {
      try {
        $sql = "SELECT
        (SELECT produtos.nome_prod FROM PRODUTOS produtos WHERE produtos.id = ESTOQUE.prod_id) AS nome_produto,
        (SELECT produtos.marca FROM PRODUTOS produtos WHERE produtos.id = ESTOQUE.prod_id) AS marca,
        estoque.preco
      FROM ESTOQUE
      WHERE emp_id = (SELECT id FROM EMPRESA WHERE nome_emp = :nome)
      ORDER BY estoque.preco;";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        echo 'Erro na consulta: ' . $e->getMessage();
      }
    }
  }
  public function getEstoqueById($id) // Passar o Id da Empresa
  {
    try {
      $sql = "SELECT * FROM estoque WHERE emp_id = :id";

      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();

      $estoque = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $estoque ? $estoque   : array();
    } catch (PDOException $e) {
      echo 'Erro na consulta: ' . $e->getMessage();
    }
  }
  public function getNomesProdutos()
  {
    try {
      $sql = "SELECT nome_prod FROM produtos";

      $stmt = $this->conexao->prepare($sql);
      $stmt->execute();

      $nomesProdutos = $stmt->fetchAll(PDO::FETCH_COLUMN);

      return $nomesProdutos;
    } catch (PDOException $e) {
      echo 'Erro na consulta: ' . $e->getMessage();
    }
  }
  public function getMore($nomeEmp, $nomeProd)
  {
    try {
      $sql = "SELECT e.nome_emp AS nome_empresa, 
      es.preco AS preco_produto
FROM EMPRESA e
INNER JOIN ESTOQUE es ON e.id = es.emp_id
WHERE es.prod_id = (SELECT id FROM PRODUTOS WHERE nome_prod = :pdt)
     AND e.nome_emp <> :emp
ORDER BY es.preco ASC;";

      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(':pdt', $nomeProd, PDO::PARAM_STR);
      $stmt->bindParam(':emp', $nomeEmp, PDO::PARAM_STR);
      $stmt->execute();

      $estoque = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $estoque;
    } catch (PDOException $e) {
      echo 'Erro na consulta: ' . $e->getMessage();
    }
  }
}
