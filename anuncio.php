<?php 
include 'app/config/database.php';
$id = $_GET['id'];
$sql = "
    SELECT
        id,
        titulo, 
        imagen,
        color,
        talla,
        descripcion,
        precio
    FROM productos
    where id =${id};
";
$result = sqlsrv_query($conn, $sql);
?>
<?php include 'views/layouts/header.php' ?>
<main class="anuncio-page">
    <div class="anuncio-img media">
        <img class="anuncio-img__img" src="" alt="">
    </div>
    <div class="anuncio-datos panel">
        <div class="anuncio-descripcion-wrap">
            <p class="anuncio-descripcion"></p>
            <p class="anuncio-mas-vendido-boton">lo mas vendido</p>
        </div>
        <p class="anuncio-label-color">color:</p>
        <p class="anuncio-color"></p>
        <p class="anuncio-label-talla">talla:</p>
        <p class="anuncio-talla"></p>
        <div class="anuncio-acciones">
            <div class="anuncio-cantidad">
               <button class="anuncio-cantidad-menos">-</button>
               <p class="anuncio-cantidad-valor"></p>
               <button class="anuncio-cantidad-mas">+</button>
           </div>  
           <button class="anuncio-add-cart">añadir a la cesta</button>       
        </div>
        <p class="anuncio-envio-info">Envío GRATIS en pedidos de 70bs o más y Click & Collect</p>
        <h2 class="anuncio-disponibilidad-titulo">Disponibilidad en tienda</h2>
    </div>
</main>
<?php include 'views/layouts/footer.php' ?>
