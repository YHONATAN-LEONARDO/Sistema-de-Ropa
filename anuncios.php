<?php
include 'app/config/database.php';

$sql = "SELECT id, titulo, imagen, precio FROM productos ORDER BY id DESC";
$result = sqlsrv_query($conn, $sql);
?>
<section class="grid-anuncios">
<?php while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { ?>
  <article class="card-anuncio">
    <a href="anuncio.php?id=<?php echo $row['id']; ?>">
      <img src="imagenes/<?php echo $row['imagen']; ?>" alt="<?php echo $row['titulo']; ?>">
      <h3><?php echo $row['titulo']; ?></h3>
      <p class="precio"><?php echo $row['precio']; ?> Bs</p>
    </a>
  </article>
<?php } ?>
</section>
