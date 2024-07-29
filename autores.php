<?php
include 'config/database.php'; // Ajusta el path si es necesario

// Obtener el término de búsqueda si se envía
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

// Prevenir inyecciones SQL
$searchQueryParam = "%" . $searchQuery . "%";

// Consultar autores filtrados por búsqueda
$sql = 'SELECT * FROM autores WHERE nombre LIKE :query OR apellido LIKE :query';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':query', $searchQueryParam, PDO::PARAM_STR);
$stmt->execute();
$autores = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include 'header.php'; ?>
<main class="main-content">
    <h1 class="page-title">Listado de Autores</h1>

    <!-- Formulario de búsqueda -->
    <form action="autores.php" method="GET" class="search-form">
        <input type="text" name="query" value="<?php echo htmlspecialchars($searchQuery); ?>" placeholder="Buscar autores...">
        <button type="submit">Buscar</button>
    </form>

    <!-- Lista de autores -->
    <?php if (count($autores) > 0): ?>
        <ul class="author-list">
            <?php foreach ($autores as $autor): ?>
                <li class="author-item">
                    <?php echo htmlspecialchars($autor['nombre']) . ' ' . htmlspecialchars($autor['apellido']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No se encontraron autores que coincidan con la búsqueda.</p>
    <?php endif; ?>
</main>
<?php include 'footer.php'; ?>
