<?php
require_once 'conexao.php';

class FuncionarioModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::getInstance();
    }

    public function editarFuncionario($id, $nome, $email, $id_nivel, $cpf, $comissao, $atendimento, $endereco, $cidade, $tipoPix, $pix)
    {
        $stmt = $this->conn->prepare("UPDATE usuarios SET nome = :nome, email = :email, id_nivel = :id_nivel, cpf = :cpf, comissao = :comissao, atendimento = :atendimento, endereco = :endereco, cidade = :cidade, tipoPix = :tipoPix, pix = :pix WHERE id = :id");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id_nivel', $id_nivel);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':comissao', $comissao);
        $stmt->bindParam(':atendimento', $atendimento);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':tipoPix', $tipoPix);
        $stmt->bindParam(':pix', $pix);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function deletarFuncionario($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function inserirFuncionario($nome, $email, $id_nivel, $cpf, $comissao, $atendimento, $endereco, $cidade, $tipoPix, $pix, $id_barbearia)
    {
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nome, email, id_nivel, cpf, comissao, atendimento, endereco, cidade, tipoPix, pix id_barbearia) VALUES (:nome, :email, :id_nivel, :cpf, :comissao, :atendimento, :endereco, :cidade, :tipoPix, :pix, :id_barbearia)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id_nivel', $id_nivel);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':comissao', $comissao);
        $stmt->bindParam(':atendimento', $atendimento);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':tipoPix', $tipoPix);
        $stmt->bindParam(':pix', $pix);
        $stmt->bindParam(':id_barbearia', $id_barbearia);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function validarNome($nome)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS count FROM usuarios WHERE nome = :nome");
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            $response = array("status" => "existe");
        } else {
            $response = array("status" => "nao_existe");
        }

        return $response;
    }

    public function validarEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS count FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            $response = array("status" => "existe");
        } else {
            $response = array("status" => "nao_existe");
        }

        return $response;
    }

    public function obterHorarios($id, $id_barbearia)
    {
        $stmt = $this->conn->prepare("SELECT * FROM funcionario_dias_trabalho where funcionario_id = :id and :id_barbearia");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_barbearia', $id_barbearia);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>
                  <td style="display: none;">' . $row['id_dia'] . '</td>
                  <td>' . $row['dia_semana'] . '</td>
                  <td>' . substr($row['horario_inicio'], 0, 5) . ' / ' . substr($row['horario_fim'], 0, 5) . '</td>
                  <td>' . substr($row['intervalo_inicio'], 0, 5) . ' / ' . substr($row['intervalo_fim'], 0, 5) . '</td>
                  <td style="display: flex; justify-content: center; align-item: center; gap: 7px;">
                    <label style="cursor: pointer;" for="btnDeletarDiaSemana1-' . $row['id_dia'] . '"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
                    <input style="display: none;" type="button" onclick="deletarDiaSemana1(' . $row['id_dia'] . ')" id="btnDeletarDiaSemana1-' . $row['id_dia'] . '">
                  </td>
                </tr>';
            };
        } else {
            echo '<tr>
                    <td colspan="5" style="text-align: center;">
                       <p>Não possui nenhum Dia Cadastrado!</p>
                    </td>
                </tr>';
        }
    }

    public function inserirDia($id, $diaSemana, $id_barbearia)
    {
        $stmt = $this->conn->prepare("INSERT INTO funcionario_dias_trabalho (funcionario_id, dia_semana, id_barbearia) VALUES (:id, :diaSemana, :id_barbearia)");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':diaSemana', $diaSemana);
        $stmt->bindParam(':id_barbearia', $id_barbearia);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function deletarDiaSemana($id_dia)
    {
        $stmt = $this->conn->prepare("DELETE FROM funcionario_dias_trabalho WHERE id_dia = :id_dia");
        $stmt->bindParam(':id_dia', $id_dia);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function obterServ($id)
    {
        $stmt = $this->conn->prepare("SELECT sb.nome_servico, us.id_servico_usuario FROM servicos_barbearia sb INNER JOIN servicos_usuarios us ON sb.id_servico = us.id_servico WHERE us.id_usuario = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>
                  <td style="display: none;">' . $row['id_servico_usuario'] . '</td>
                  <td>' . $row['nome_servico'] . '</td>
                  <td style="display: flex; justify-content: center; align-item: center; gap: 7px;">
                  <label style="cursor: pointer;" for="btnDeletarServ1-' . $row['id_servico_usuario'] . '"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
                  <input style="display: none;" type="button" onclick="deletarServ1(' . $row['id_servico_usuario'] . ')" id="btnDeletarServ1-' . $row['id_servico_usuario'] . '">
                  </td>
                </tr>';
            }
        } else {
            echo '<tr>
            <td colspan="1" style="text-align: center;">
               <p>Não possui nenhum serviço atribuído!</p>
            </td>
        </tr>';
        }
    }

    public function inserirServ($id, $Serv)
    {
        $stmt = $this->conn->prepare("INSERT INTO servicos_usuarios (id_usuario, id_servico) VALUES (:id, :serv)");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':serv', $Serv);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function deletarServ($id_servico)
    {
        $stmt = $this->conn->prepare("DELETE FROM servicos_usuarios WHERE id_servico_usuario = :id_servico");
        $stmt->bindParam(':id_servico', $id_servico);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }
}
