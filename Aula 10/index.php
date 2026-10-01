<?php

class Usuario {
    public ?int $id = null;
    public string $nome;
    public string $email;
    public string $senha_hash;
    public string $tipo;

    public function salvar(PDO $pdo): void {
        // stmt -> statement (declaração)
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha_hash, tipo_usuario) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->nome, $this->email, $this->senha_hash, $this->tipo]);
        $this->id = (int) $pdo->lastInsertId();
    }

    // static = chamado direto pela classe: Usuario::buscarPorEmail($pdo, $email)​
    public static function buscarPorEmail(PDO $pdo, string $email): ?self { // ?self = retorna um objeto do tipo Usuario ou null
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $dados = $stmt->fetch();
        return $dados ? self::formatarDados($dados) : null;
    }
}


class demo {
    public string $msg;

    public function helloWorld($msg = "print") {
        $this->msg = $msg;
        return $this->msg;
    }
}

class demoStatic {
    public static function helloWorld(string $msg) {
        $msg = "print";
        return $msg;
    }
}

$demoTeste = new demo();
print $demoTeste->helloWorld('hello');    // retorna 'print'
print demoStatic::helloWorld('hello'); // retorna 'print'

?>