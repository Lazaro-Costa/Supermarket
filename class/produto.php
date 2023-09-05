<?php
require 'conexao.php';
class Produto extends Conexao
{
  public function listarProdutos($emp)
  {
    try {
      $sql = "
    SELECT
        CASE
            WHEN COUNT(DISTINCT es.prod_id) = (SELECT COUNT(*) FROM PRODUTOS) THEN 'Possui todos os produtos'
            ELSE 'Não possui todos os produtos'
        END AS status
    FROM
        ESTOQUE es
    WHERE
        es.emp_id = (SELECT id FROM EMPRESA WHERE nome_emp = :nome_empresa);
";
      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(':nome_empresa', $emp, PDO::PARAM_STR);
      $stmt->execute();

      $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($resultado['status'] === 'Possui todos os produtos') {
        return json_encode('A empresa possui todos os produtos em seu estoque.');
      } else {
        $sql = "SELECT p.nome_prod
              FROM PRODUTOS p
              WHERE p.id NOT IN (
                  SELECT e.prod_id
                  FROM ESTOQUE e
                  WHERE e.emp_id = (SELECT id FROM EMPRESA WHERE nome_emp = :emp)
              )";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':emp', $emp, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
          $prods = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $prods;
        } else {

          return json_encode("A consulta não retornou nada.");
        }
      }
    } catch (PDOException $e) {
      return json_encode('Erro na consulta: ' . $e->getMessage());
    }
  }
  public function getNomesProdutos()
  {
    try {
      $sql = "SELECT e.nome_emp AS nome_empresa, p.nome_prod AS nome_produto, p.marca, p.tam_quant, es.preco AS preco
              FROM PRODUTOS p
              INNER JOIN (
                  SELECT prod_id, MIN(preco) AS min_preco
                  FROM ESTOQUE
                  GROUP BY prod_id
              ) min_preco_es ON p.id = min_preco_es.prod_id
              INNER JOIN ESTOQUE es ON p.id = es.prod_id AND min_preco_es.min_preco = es.preco
              INNER JOIN EMPRESA e ON es.emp_id = e.id
              ORDER BY preco ASC"; // Ordem crescente (do menor para o maior)

      $stmt = $this->conexao->prepare($sql);
      $stmt->execute();

      $nomesProdutos = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $nomesProdutos;
    } catch (PDOException $e) {
      echo 'Erro na consulta: ' . $e->getMessage();
    }
  }
  public function cadastrarProduto($p_name, $p_marca, $p_tamQuant)
  {
    try {
      // Verificar se a Empresa já existe
      $sql = "SELECT id FROM produtos WHERE nome_prod = :n";

      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(':n', $p_name, PDO::PARAM_STR);
      $stmt->execute();

      if ($stmt->rowCount() > 0) { // Se Empresa existe
        return json_encode('Produto ja existe no Banco de Dados.');
      } else { // Se Empresa não existe
        $sql = "INSERT INTO produtos (nome_prod, marca, tam_quant) VALUES (:n, :m, :tm)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':n', $p_name, PDO::PARAM_STR);
        $stmt->bindParam(':m', $p_marca, PDO::PARAM_STR);
        $stmt->bindParam(':tm', $p_tamQuant, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() >= 1) {
          return json_encode('Produto cadastrado com sucesso.');
        } else {
          return json_encode("Erro no cadastro do produto $p_name");
        }
      }
    } catch (PDOException $e) {
      json_encode('Erro ao cadastrar o produto: ' . $e->getMessage());
    }
  }
  public function attProduto($prod, $emp, $preco, $quant)
  {
    try {

      $sql = "SELECT COUNT(*) AS quantidade FROM ESTOQUE WHERE emp_id = (SELECT id FROM EMPRESA WHERE nome_emp = :emp) AND prod_id = (SELECT id FROM PRODUTOS WHERE nome_prod = :prd);";

      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(':emp', $emp, PDO::PARAM_STR);
      $stmt->bindParam(':prd', $prod, PDO::PARAM_STR);
      $stmt->execute();
      $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($resultado['quantidade'] > 0) {
        return json_encode('Produto ja atribuido a esta empresa, tente outro.');
      } else {

        $sql = "INSERT INTO ESTOQUE (emp_id, prod_id, preco, prod_quant) SELECT (SELECT id FROM EMPRESA WHERE nome_emp = :emp) AS emp_id, (SELECT id FROM PRODUTOS WHERE nome_prod = :prd) AS prod_id, :prc AS preco, :qnt AS prod_quant;";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':emp', $emp, PDO::PARAM_STR);
        $stmt->bindParam(':prd', $prod, PDO::PARAM_STR);
        $stmt->bindParam(':prc', $preco, PDO::PARAM_STR);
        $stmt->bindParam(':qnt', $quant, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() >= 1) {
          return json_encode('Produto atribuido com sucesso.');
        } else {
          return json_encode("Erro na atribuicao.");
        }
      }
    } catch (PDOException $e) {
      return json_encode('Erro ao cadastrar o produto: ' . $e->getMessage());
    }
  }
}
