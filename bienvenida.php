<?php
session_start();

// Seguridad: Bloquear acceso si no hay sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$carnet = "25-" . str_pad($_SESSION['user_id'], 4, "0", STR_PAD_LEFT);
$fecha_actual = date("d/m/Y H:i A");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Estudiante | UDB</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Panel de Control</h2>
        <p style="color: var(--text-muted); margin-top: -10px; margin-bottom: 20px;">
            Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['nombre_completo']); ?></strong>
        </p>
        
        <div class="info-box">
            <p><strong>Carnet:</strong> <?php echo $carnet; ?></p>
            <p><strong>Facultad:</strong> Ingeniería</p>
            <p><strong>Carrera:</strong> Ingeniería en Ciencias de la Computación</p>
            <hr style="border: 0; border-top: 1px solid var(--border); margin: 10px 0;">
            <p><strong>Estado:</strong> <span style="color: var(--accent);">Estudiante Activo</span></p>
            <p><strong>Materias inscritas:</strong> 5</p>
            <p><strong>CUM Actual:</strong> 8.5</p>
        </div>

        <div class="info-box" style="background: rgba(16, 185, 129, 0.05);">
            <p style="font-size: 0.85rem;">
                <strong>Último acceso al sistema:</strong><br>
                <?php echo $fecha_actual; ?>
            </p>
        </div>

        <a href="logout.php" class="logout-btn">Cerrar Sesión Segura</a>
    </div>
</body>
</html>