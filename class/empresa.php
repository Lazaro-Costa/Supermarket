<?php
require 'conexao.php';
class Empresa extends Conexao
{
  public function listarEmpresas()
  {
    try {
      $sql = "SELECT * FROM empresa";
      $stmt = $this->conexao->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo 'Erro na consulta: ' . $e->getMessage();
    }
  }
  public function getEmpresaById($id)
  {
    try {
      $sql = "SELECT * FROM empresa WHERE id = :id";

      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();

      $empresa = $stmt->fetch(PDO::FETCH_ASSOC);

      return $empresa ? $empresa : array();
    } catch (PDOException $e) {
      echo 'Erro na consulta: ' . $e->getMessage();
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
      echo 'Erro na consulta: ' . $e->getMessage();
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

  public function excluirEmpresa($id)
  {
    try {
      $sql = "DELETE FROM empresa WHERE id = :id";

      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);

      return $stmt->execute();
    } catch (PDOException $e) {
      echo 'Erro ao excluir a empresa: ' . $e->getMessage();
      return false;
    }
  }
}
