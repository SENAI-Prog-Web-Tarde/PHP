<?php
    $senhaUsuario = 'minha_senha_secreta';

    // Gera o hash usando Bcrypt
    $hash = password_hash($senhaUsuario, PASSWORD_BCRYPT);

    echo $hash; 
    // Exemplo de saída: $2y$12$eImiTXuWVxjM9370V..uO.h5s2ZfG.n8z6H2m7WZ/M.GZ7Z1G6m8q
?>

<?php if ($usuario_logado instanceof Aluno): ?>
    <p>Seu XP total é: <?php echo $usuario_logado->xp_total; ?></p>
<?php elseif ($usuario_logado instanceof Instrutor): ?>
    <p>Matérias: <?php echo implode(', ', $usuario_logado->materias_leciona); ?></p>
<?php endif; ?>