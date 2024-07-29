<?php
include 'config/database.php';

// Obtener el término de búsqueda si se envía
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

// Prevenir inyecciones SQL
$searchQueryParam = "%" . $searchQuery . "%";

// Consultar libros filtrados por búsqueda
$sql = 'SELECT * FROM titulos WHERE titulo LIKE :query';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':query', $searchQueryParam, PDO::PARAM_STR);
$stmt->execute();
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include 'header.php'; ?>
<main class="main-content">
    <h1 class="page-title">Listado de Libros</h1>

    <!-- Formulario de búsqueda -->
    <form action="libros.php" method="GET" class="search-form">
        <input type="text" name="query" value="<?php echo htmlspecialchars($searchQuery); ?>" placeholder="Buscar libros...">
        <button type="submit">Buscar</button>
    </form>

    <!-- Lista de libros -->
    <?php if (count($libros) > 0): ?>
        <ul class="book-list">
            <?php foreach ($libros as $libro): ?>
                <li class="book-item">
                    <?php echo htmlspecialchars($libro['titulo']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No se encontraron libros que coincidan con la búsqueda.</p>
    <?php endif; ?>
</main>
<?php include 'footer.php'; ?>