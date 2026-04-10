<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_input = $_POST['usuario'];
    $pass_input = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario_correo = ?");
    $stmt->execute([$user_input]);
    $user = $stmt->fetch();

    if ($user && password_verify($pass_input, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nombre_completo'] = $user['nombre_completo'];
  
        // Actualizamos el último acceso para la info adicional de la bienvenida
        $pdo->prepare("UPDATE usuarios SET ultimo_acceso = NOW() WHERE id = ?")->execute([$user['id']]);
        
        header("Location: bienvenida.php");
        exit();
    } else {
        $error = "Credenciales incorrectas. Intenta de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Portal Estudiantil</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Acceso al Portal</h2>
        
        <?php if(isset($_GET['success'])): ?>
            <p class="success">Registro completado. Ya puedes ingresar.</p>
        <?php endif; ?>

        <?php if(isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="usuario" placeholder="Usuario o Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
        </form>

        <div style="margin-top: 20px;">
            <p style="color: var(--text-muted); font-size: 0.9rem;">
                ¿Aún no tienes una cuenta? 
                <a href="registro.php" style="color: var(--accent); font-weight: 600;">Regístrate aquí</a>
            </p>
        </div>
    </div>
</body>
</html>