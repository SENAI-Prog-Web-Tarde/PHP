<?php

// 1. MODEL (Representação dos Dados)

// Classe base (Encontro 08)
class Usuario {
    public int $id;
    public string $nome;
    public string $email;
    public string $tipo;
    
    // Encapsulamento da senha (Encontro 09)
    protected string $senha_hash; 

    public function __construct(int $id, string $nome, string $email, string $tipo, string $senha) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->tipo = $tipo;

        // Na prática, a senha vinda do banco já estaria hasheada. 
        // Simulando o hash no construtor para fins didáticos.
        $this->senha_hash = password_hash($senha, PASSWORD_BCRYPT); 
    }

    // Método simples (Encontro 08)
    public function saudacao(): string {
        return "Olá, {$this->nome}!";
    }

    // Método para não expor a propriedade privada (Encontro 09)
    public function verificarSenha(string $senha_digitada): bool {
        return password_verify($senha_digitada, $this->senha_hash);
    }
}

// Herança e propriedade exclusiva (Encontro 09)
class Instrutor extends Usuario {
    public array $materias_leciona;

    public function __construct(int $id, string $nome, string $email, string $senha, array $materias_leciona) {
        parent::__construct($id, $nome, $email, 'Instrutor', $senha);
        $this->materias_leciona = $materias_leciona;
    }
}

// Herança e propriedade exclusiva (Encontro 09)
class Aluno extends Usuario {
    public int $xp_total;

    public function __construct(int $id, string $nome, string $email, string $senha, int $xp_total = 0) {
        parent::__construct($id, $nome, $email, 'Aluno', $senha);
        $this->xp_total = $xp_total;
    }
}


// 2. CONTROLLER (Lógica de Negócio/Requisição)
// Função baseada na validação do Encontro 07 e adaptada para POO
function validar_login(string $email, string $senha, array $usuarios_banco): array {
    $erros = [];

    if (empty($email)) {
        $erros[] = "Preencha todos os campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "E-mail inválido.";
    }

    if (empty($senha)) {
        $erros[] = "Preencha todos os campos.";
    } elseif (strlen($senha) < 8) {
        $erros[] = "Senha deve ter no mínimo 8 caracteres.";
    }

    $erros_unique = array_unique($erros);
    if (count($erros_unique) > 0){
        return ['erros' => $erros_unique];
    }

    $usuario_encontrado = null;
    
    // Repetição para percorrer array (Encontro 08)
    foreach ($usuarios_banco as $user) {
        if ($user->email === $email) {
            $usuario_encontrado = $user;
            break;
        }
    }

    if ($usuario_encontrado === null || !$usuario_encontrado->verificarSenha($senha)) {
        $erros[] = "Usuário ou Senha incorretos.";
        $usuario_encontrado = null;
    }

    return ['erros' => array_unique($erros), 'usuario' => $usuario_encontrado];
}

// Instanciando objetos simples (Encontro 08 e 09)
$instrutor = new Instrutor(1, 'Carlos Silva', 'carlos@escola.com', 'senha123', ['PHP', 'Banco de Dados']);
$aluno1 = new Aluno(2, 'Maria Oliveira', 'maria@escola.com', 'senha456', 150);

$banco_de_dados = [$instrutor, $aluno1];

// Cenário A: Simulando tentativa com erros para demonstrar o foreach do Encontro 08
$cenario_erro = validar_login('a@escola.com', 'senha_errada', $banco_de_dados);
// print_r($cenario_erro);
$lista_erros = $cenario_erro['erros'];

// Cenário B: Simulando tentativa de login bem-sucedida para testar herança e métodos
$cenario_sucesso = validar_login('carlos@escola.com', 'senha456', $banco_de_dados);
$usuario_logado = $cenario_sucesso['usuario'];
print_r($cenario_sucesso);

?>

<!-- 3. VIEW (Apresentação / HTML)-->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>PHP na Prática - Encontros 08 e 09</title>
    <style>
        body { font-family: 'Inter', sans-serif; background: #121212; color: #ffffff; padding: 20px; }
        .box { background: #1e1e1e; padding: 15px; margin-bottom: 20px; border-radius: 8px; }
        .erro { color: #ff6b6b; }
        .sucesso { color: #51cf66; }
    </style>
</head>
<body>
    <h1>Resultados Práticos</h1>

    <div class="box">
        <h2>Exibição de Erros com Foreach (Encontro 08)</h2>
        <?php if (!empty($lista_erros)): ?>
            <ul class="erro">
                <!-- Percorrendo e exibindo os erros -->
                <?php foreach ($lista_erros as $erro): ?>
                    <li><?php echo htmlspecialchars($erro); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <div class="box">
        <h2>Teste de POO e Herança (Encontros 08 e 09)</h2>
        <?php if ($usuario_logado) { ?>
            <div class="sucesso">
                <p><strong><?php echo $usuario_logado->saudacao(); ?></strong></p>
                <p>Você acessou como: <?php echo $usuario_logado->tipo; ?></p>
                
                <!-- Verificando a classe especializada (Encontro 09) -->
               
                <?php
                switch($usuario_logado->tipo){
                    case "Aluno":
                        echo "<p>Seu XP total é: $usuario_logado->xp_total </p>";
                        break;
                    case "Instrutor":
                        echo "<p>Matérias: " . implode(', ', $usuario_logado->materias_leciona) . "</p>";
                        break;
                }
                ?>
            </div>
        <?php }; ?>
    </div>
</body>
</html>