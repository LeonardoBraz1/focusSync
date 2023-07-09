<?php
require_once 'conexao.php';

class ClienteModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::getInstance();
    }

    public function editarCliente($id_cliente, $nome_cliente, $email_cliente, $telefone_cliente)
    {
        $stmt = $this->conn->prepare("UPDATE clientes SET nome_cliente = :nome_cliente, email_cliente = :email_cliente, telefone_cliente = :telefone_cliente WHERE id_cliente = :id_cliente");
        $stmt->bindParam(':nome_cliente', $nome_cliente);
        $stmt->bindParam(':email_cliente', $email_cliente);
        $stmt->bindParam(':telefone_cliente', $telefone_cliente);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function deletarCliente($id_cliente)
    {
        $stmt = $this->conn->prepare("DELETE FROM clientes WHERE id_cliente = :id_cliente");
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function inserirCliente($nome_cliente, $email_cliente, $telefone_cliente, $id_barbearia)
    {
        $stmt = $this->conn->prepare("INSERT INTO clientes (nome_cliente, email_cliente, telefone_cliente, id_barbearia) VALUES (:nome_cliente, :email_cliente, :telefone_cliente, :id_barbearia)");
        $stmt->bindParam(':nome_cliente', $nome_cliente);
        $stmt->bindParam(':email_cliente', $email_cliente);
        $stmt->bindParam(':telefone_cliente', $telefone_cliente);
        $stmt->bindParam(':id_barbearia', $id_barbearia);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function obterClientes($id_barbearia)
    {
        $stmt = $this->conn->prepare("SELECT * FROM clientes WHERE id_barbearia = :barbearia_id");
        $stmt->bindParam(':barbearia_id', $id_barbearia);
        $stmt->execute();

        $clientes = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $formattedDate = date('Y-m-d', strtotime($row['cadastro']));
            $formattedPhone = str_replace(array('(', ')', '-'), '', $row['telefone_cliente']);

            $message = "Olá! Gostaríamos de agradecer pela sua preferência. Estamos entrando em contato para informar sobre nossos serviços de alta qualidade, profissionais especializados e um ambiente aconchegante para cuidar do seu visual. Ficamos à disposição para agendar um horário ou responder a qualquer dúvida que você possa ter. Agradecemos novamente pela confiança e esperamos vê-lo em breve na nossa barbearia. Tenha um ótimo dia!";

            $cliente = array(
                'id_cliente' => $row['id_cliente'],
                'nome_cliente' => $row['nome_cliente'],
                'email_cliente' => $row['email_cliente'],
                'telefone_cliente' => $row['telefone_cliente'],
                'cadastro' => $formattedDate,
                'retorno' => $row['retorno'],
                'telefone_formatado' => $formattedPhone,
                'message' => $message
            );

            $clientes[] = $cliente;
        }

        return $clientes;
    }


    public function obterClientesRetorno($barbeariaId)
    {
        $stmt = $this->conn->prepare("SELECT c.id_cliente, c.nome_cliente, c.telefone_cliente, c.cadastro, c.retorno, su.nome_servico AS ultimo_servico
                                      FROM clientes c
                                      LEFT JOIN (
                                          SELECT id_cliente, MAX(su.data) AS data, sb.nome_servico
                                          FROM servicos_usuarios su
                                          JOIN servicos_barbearia sb ON su.id_servico = sb.id_servico
                                          WHERE sb.id_barbearia = :barbearia_id
                                          GROUP BY id_cliente
                                      ) su ON c.id_cliente = su.id_cliente
                                      WHERE c.retorno < DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND c.id_barbearia = :barbearia_id");
        $stmt->bindParam(':barbearia_id', $barbeariaId);
        $stmt->execute();

        $clientesRetornos = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $formattedDate = date('Y-m-d', strtotime($row['retorno']));
            $formattedDate1 = date('Y-m-d', strtotime($row['cadastro']));
            $retorno = new DateTime($row['retorno']);
            $hoje = new DateTime();
            $intervalo = $retorno->diff($hoje);
            $dias_sem_retorno = $intervalo->days;

            $ultimo_servico = isset($row['ultimo_servico']) ? $row['ultimo_servico'] : '-';
            $formattedPhone = str_replace(array('(', ')', '-'), '', $row['telefone_cliente']);

            $message = "Olá! Gostaríamos de agradecer pela sua preferência. Estamos entrando em contato para informar sobre nossos serviços de alta qualidade, profissionais especializados e um ambiente aconchegante para cuidar do seu visual. Ficamos à disposição para agendar um horário ou responder a qualquer dúvida que você possa ter. Agradecemos novamente pela confiança e esperamos vê-lo em breve na nossa barbearia. Tenha um ótimo dia!";

            $clientesRetorno = array(
                'id_cliente' => $row['id_cliente'],
                'nome_cliente' => $row['nome_cliente'],
                'telefone_cliente' => $row['telefone_cliente'],
                'cadastro' => $formattedDate1,
                'ultimo_servico' => $ultimo_servico,
                'retorno' => $formattedDate,
                'dias_sem_retorno' => $dias_sem_retorno,
                'telefone_formatado' => $formattedPhone,
                'message' => $message
            );

            $clientesRetornos[] = $clientesRetorno;
        }

        return $clientesRetornos;
    }
    
    public function __destruct()
    {
        $this->conn = null;
    }
}
