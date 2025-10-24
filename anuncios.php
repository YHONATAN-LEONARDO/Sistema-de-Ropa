<?php
include 'app/config/database.php';

// Verifica y limpia el parámetro de género recibido
$generoParam = isset($_GET['genero']) ? (int)$_GET['genero'] : 1; // 1=Hombre por defecto

// Traduce el valor numérico al texto usado en la base de datos
$generoTexto = ($generoParam === 1) ? 'hombre' : 'mujer';

// Consulta SQL filtrando por género
$sql = "SELECT id, titulo, descripcion, imagen, precio, color 
        FROM productos 
        WHERE genero = ?
        ORDER BY id DESC";

// Ejecutar con parámetro seguro
$params = array($generoTexto);
$result = sqlsrv_query($conn, $sql, $params);

// Verificar si hay resultados
if ($result === false) {
    die("Error en la consulta: " . print_r(sqlsrv_errors(), true));
}
?>

<section class="grid-anuncios">
<?php while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>

  <?php 
    // 🔥 Probabilidad del 30% de mostrar la etiqueta “Nuevo”
    $mostrarEtiqueta = (rand(1, 100) <= 30);
  ?>

  <article class="card-anuncio">
    <a href="anuncio.php?id=<?php echo $row['id']; ?>">
      <div class="img-container">
        <img src="imagenes/<?php echo htmlspecialchars($row['imagen']); ?>" alt="<?php echo htmlspecialchars($row['titulo']); ?>">

        <!-- Etiqueta de promoción aleatoria -->
        <?php if ($mostrarEtiqueta): ?>
          <span class="etiqueta-nuevo">🔥 Nuevo</span>
        <?php endif; ?>

        <!-- Parte superior: bola verde y corazón rojo -->
        <div class="top-icons">
          <div class="bola-verde"></div>
          <ion-icon class="icono-corazon" name="heart-outline"></ion-icon>
        </div>

        <!-- Overlay con botón -->
        <div class="overlay">
          <button class="ver-detalle">Ver Detalles</button>
        </div>
      </div>

      <div class="info">
        <h3><?php echo htmlspecialchars($row['titulo']); ?></h3>

        <!-- Estrellas de calificación -->
        <div class="estrellas">
          <ion-icon name="star"></ion-icon>
          <ion-icon name="star"></ion-icon>
          <ion-icon name="star"></ion-icon>
          <ion-icon name="star-half-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
        </div>

        <p class="descripcion"><?php echo htmlspecialchars($row['descripcion']); ?></p>
        <p class="color">Color: <span><?php echo htmlspecialchars($row['color']); ?></span></p>
        <p class="precio"><?php echo number_format($row['precio'], 2); ?> Bs</p>

        <button class="add-cart">🛒 Añadir al carrito</button>
      </div>
    </a>
  </article>

<?php } ?>
</section>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
