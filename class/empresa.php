<?php
require 'conexao.php';
class Empresa extends Conexao
{
  public function showCompanies()
  {
    try {
      $sql = "SELECT e.nome_emp, e.end, e.cidade, e.num_lojas, COUNT(es.prod_id) AS total_prods
                FROM empresa e
                LEFT JOIN estoque es ON e.id = es.emp_id
                GROUP BY e.nome_emp, e.end, e.cidade, e.num_lojas
                ORDER BY e.nome_emp";

      $stmt = $this->conexao->prepare($sql);
      $stmt->execute();

      $infoEmpresas = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $infoEmpresas;
    } catch (PDOException $e) {
      return json_encode('Erro na consulta: ' . $e->getMessage());
    }
  }

  public function getNomesEmpresas()
  {
    try {
      $sql = "SELECT nome_emp FROM empresa ORDER BY nome_emp";

      $stmt = $this->conexao->prepare($sql);
      $stmt->execute();

      $nomesEmpresas = $stmt->fetchAll(PDO::FETCH_COLUMN);

      return $nomesEmpresas;
    } catch (PDOException $e) {
      return json_encode('Erro na consulta: ' . $e->getMessage());
    }
  }

  public function cadastrarEmpresa($nome, $endereco, $cidade, $numLojas)
  {
    try {
      // Verificar se a Empresa já existe
      $sql = "SELECT id FROM empresa WHERE nome_emp = :nome";

      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
      $stmt->execute();

      if ($stmt->rowCount() > 0) { // Se Empresa existe
        return json_encode('Empresa ja existe no Banco de Dados.');
      } else { // Se Empresa não existe
        $sql = "INSERT INTO empresa (nome_emp, end, cidade, num_lojas) VALUES (:nome, :endereco, :cidade, :numLojas)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
        $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);
        $stmt->bindParam(':numLojas', $numLojas, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() >= 1) {
          return json_encode('Empresa cadastrada');
        } else {
          return json_encode("Erro no cadastro da empresa $nome");
        }
      }
    } catch (PDOException $e) {
      json_encode('Erro ao cadastrar a empresa: ' . $e->getMessage());
    }
  }

  public function getMoreInfoCo($nomeEmp)
  {
    try {
      $sql = "SELECT p.nome_prod AS nome_produto, es.preco 
                FROM PRODUTOS p
                INNER JOIN ESTOQUE es ON p.id = es.prod_id
                INNER JOIN EMPRESA e ON es.emp_id = e.id
                WHERE e.nome_emp = :emp
                ORDER BY es.preco ASC";

      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(':emp', $nomeEmp, PDO::PARAM_STR);
      $stmt->execute();

      $infoComp = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $infoComp;
    } catch (PDOException $e) {
      echo 'Erro ao acessar o banco: ' . $e->getMessage();
      return false;
    }
  }
}
