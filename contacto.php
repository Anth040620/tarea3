<?php
include 'config/database.php'; // Ajusta el path si es necesario
$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $asunto = $_POST['asunto'];
    $comentario = $_POST['comentario'];

    $stmt = $pdo->prepare('INSERT INTO contacto (nombre, correo, asunto, comentario) VALUES (?, ?, ?, ?)');
    if ($stmt->execute([$nombre, $correo, $asunto, $comentario])) {
        $mensaje = 'Comentario enviado exitosamente.';
    }
}

// Obtener todos los comentarios para mostrarlos en orden descendente
$comentariosStmt = $pdo->query('SELECT nombre, correo, asunto, comentario FROM contacto ORDER BY id DESC');
$comentarios = $comentariosStmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include 'header.php'; ?>
<main class="main-content container">
    <h1 class="page-title">Formulario de Contacto</h1>
    
    <?php if ($mensaje): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $mensaje; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <div id="alert-placeholder"></div>
    <form id="contact-form" method="post" action="contacto.php" class="contact-form">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required class="form-control">
        </div>
        
        <div class="mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email" id="correo" name="correo" required class="form-control">
        </div>
        
        <div class="mb-3">
            <label for="asunto" class="form-label">Asunto:</label>
            <input type="text" id="asunto" name="asunto" required class="form-control">
        </div>
        
        <div class="mb-3">
            <label for="comentario" class="form-label">Comentario:</label>
            <textarea id="comentario" name="comentario" required class="form-control"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <h2 class="comments-title mt-5">Comentarios</h2>
    <ul class="comments-list list-unstyled">
        <?php foreach ($comentarios as $comentario): ?>
            <li class="comment-item mb-3 p-3 bg-light border rounded">
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($comentario['nombre']); ?></p>
                <p><strong>Correo:</strong> <?php echo htmlspecialchars($comentario['correo']); ?></p>
                <p><strong>Asunto:</strong> <?php echo htmlspecialchars($comentario['asunto']); ?></p>
                <p><strong>Comentario:</strong> <?php echo htmlspecialchars($comentario['comentario']); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</main>
<?php include 'footer.php'; ?>
