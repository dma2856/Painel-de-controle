<?php
// Exemplo de como os dados viriam do seu banco de dados MySQL
// Adicionamos a chave 'limite_dispositivos' para cada cliente mapeado
$clientes = [
    [
        "id" => 1,
        "usuario" => "joao_silva",
        "senha" => "123456",
        "validade" => "25/06/2026",
        "limite_dispositivos" => 1, // Limite padrão: 1 tela/dispositivo
        "status" => "ativo"
    ],
    [
        "id" => 2,
        "usuario" => "maria_souza",
        "senha" => "987654",
        "validade" => "10/05/2026",
        "limite_dispositivos" => 3, // Liberado para até 3 acessos simultâneos
        "status" => "bloqueado"
    ]
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin - Controle de Clientes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h2>Meu Painel Admin</h2>
        <p>Seus Créditos: <strong>Infinitos</strong></p>
        <button class="btn-novo" onclick="criarUsuario()">+ Criar Novo Usuário</button>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Senha</th>
                    <th>Validade</th>
                    <th>Limite Disp.</th> <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?php echo $cliente['usuario']; ?></td>
                        <td><?php echo $cliente['senha']; ?></td>
                        <td><?php echo $cliente['validade']; ?></td>
                        
                        <td><strong><?php echo $cliente['limite_dispositivos']; ?></strong></td>
                        
                        <td>
                            <?php if ($cliente['status'] == 'ativo'): ?>
                                <span class="badge ativo">Ativo</span>
                            <?php else: ?>
                                <span class="badge bloqueado">Bloqueado</span>
                            <?php endif; ?>
                        </td>
                        
                        <td>
                            <button class="btn-renovar" onclick="renovarUsuario(<?php echo $cliente['id']; ?>)">Renovar +30 dias</button>
                            
                            <?php if ($cliente['status'] == 'ativo'): ?>
                                <button class="btn-status btn-bloquear" onclick="alterarStatus(<?php echo $cliente['id']; ?>, 'bloquear')">Bloquear</button>
                            <?php else: ?>
                                <button class="btn-status btn-desbloquear" onclick="alterarStatus(<?php echo $cliente['id']; ?>, 'desbloquear')">Desbloquear</button>
                            <?php endif; ?>
                            
                            <button class="btn-excluir" onclick="return confirmarExclusao(<?php echo $cliente['id']; ?>)">Excluir</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <script>
        // Funções provisórias em JavaScript para testar os cliques na tela
        function alterarStatus(id, acao) {
            if(confirm(`Deseja realmente ${acao} o usuário de ID ${id}?`)) {
                alert(`Usuário ${id} foi solicitado para: ${acao}`);
                // window.location.href = `processar.php?acao=${acao}&id=${id}`;
            }
        }

        function confirmarExclusao(id) {
            return confirm("Tem certeza absoluta que deseja EXCLUIR este usuário? Esta ação não pode ser desfeita.");
        }

        function renovarUsuario(id) {
            alert(`Adicionado +30 dias de validade para o usuário ID ${id}`);
        }

        // Função simulada para capturar o limite de telas na criação do cliente
        function criarUsuario() {
            let usuario = prompt("Nome do Usuário:");
            if(!usuario) return;
            let senha = prompt("Senha:");
            if(!senha) return;
            let limite = prompt("Limite de dispositivos (Deixe em branco para padrão: 1):", "1");
            
            alert(`Solicitada criação:\nUsuário: ${usuario}\nLimite de Dispositivos: ${limite}`);
            // Aqui futuramente você enviará via POST/GET para salvar no banco MySQL
        }
    </script>
</body>
</html>
