<?php /* acerca.php */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="public/css/estilos.css"/>
  <title>Nosotros</title>
</head>
<body>
<?php include "views/layouts/header.php"; ?>

<main class="acerca-main">
  <!-- Intro -->
   <h1 class="acerca-titulo ti t-p">
        SOBRE ECOABRIGO
      </h1>
  <section class="acerca-intro">
    <div class="acerca-intro-texto">
      <h1 class="acerca-titulo">
        <ion-icon name="shirt-outline"></ion-icon> Nosotros
      </h1>
      <p class="acerca-parrafo">
        En <strong>EcoAbrigo</strong> diseñamos y fabricamos prendas funcionales que te acompañan todos los días.
        Creemos en la durabilidad, el comercio responsable y un diseño simple que realmente sirve.
      </p>
      <p class="acerca-parrafo">
        Trabajamos con proveedores locales siempre que es posible y buscamos reducir desperdicios en cada etapa:
        desde el patronaje hasta el empaque.
      </p>
    </div>
    <figure class="acerca-intro-imagen">
      <img  class="tienda"  src="public/img/icons/tienda.png" alt="">
    </figure>
  </section>

  <!-- Misión y Visión -->
  <section class="acerca-mision-vision">
    <article class="acerca-bloque">
      <h2 class="acerca-subtitulo">
        <ion-icon name="ribbon-outline"></ion-icon> Misión
      </h2>
      <p class="acerca-parrafo">
        Crear abrigos y prendas versátiles que combinen calidad, precio justo y procesos responsables,
        para que más personas puedan vestirse mejor sin gastar de más.
      </p>
    </article>
    <article class="acerca-bloque">
      <h2 class="acerca-subtitulo">Visión</h2>
      <p class="acerca-parrafo">
        Ser la marca de referencia en Latinoamérica por su sencillez, transparencia y resistencia real en el uso diario,
        manteniendo un impacto ambiental cada vez menor.
      </p>
    </article>
  </section>

  <!-- Valores -->
  <section class="acerca-valores">
    <h2 class="acerca-subtitulo">
      <ion-icon name="earth-outline"></ion-icon> Valores
    </h2>
    <div class="acerca-grid-valores">
      <article class="acerca-valor-card">
        <ion-icon name="happy-outline"></ion-icon>
        <h3 class="acerca-valor-titulo">Calidad honesta</h3>
        <p class="acerca-valor-texto">Probamos cada prenda en situaciones reales para asegurar costuras firmes y materiales que duren.</p>
      </article>
      <article class="acerca-valor-card">
        <ion-icon name="happy-outline"></ion-icon>
        <h3 class="acerca-valor-titulo">Sostenibilidad práctica</h3>
        <p class="acerca-valor-texto">Optimizamos cortes, reusamos retazos y priorizamos tejidos con menor huella.</p>
      </article>
      <article class="acerca-valor-card">
        <ion-icon name="happy-outline"></ion-icon>
        <h3 class="acerca-valor-titulo">Comunidad</h3>
        <p class="acerca-valor-texto">Colaboramos con talleres y emprendedores locales para crecer juntos.</p>
      </article>
      <article class="acerca-valor-card">
        <ion-icon name="happy-outline"></ion-icon>
        <h3 class="acerca-valor-titulo">Transparencia</h3>
        <p class="acerca-valor-texto">Comunicamos procesos, tiempos y costos de forma clara, sin humo.</p>
      </article>
    </div>
  </section>

  <!-- Historia -->
  <section class="acerca-historia">
    <h2 class="acerca-subtitulo">Nuestra historia</h2>
    <p class="acerca-parrafo">
      Nacimos en La Paz en 2021 con un objetivo simple: fabricar abrigos que realmente abriguen,
      que no se rompan al mes y que no cuesten una fortuna. Empezamos con 20 piezas y una mesa de corte prestada;
      hoy producimos lotes pequeños, mejor controlados, sin perder el toque artesanal.
    </p>
  </section>

  <!-- Equipo -->
  <section class="acerca-equipo">
    <h2 class="acerca-subtitulo">
      <ion-icon name="people-outline"></ion-icon> Equipo
    </h2>
    <div class="acerca-grid-equipo">
      <article class="acerca-persona">
      <ion-icon name="person-outline"></ion-icon>  
        <h3 class="acerca-persona-nombre">Carla R.</h3>
        <p class="acerca-persona-rol">Producto</p>
      </article>
      <article class="acerca-persona">
      <ion-icon name="person-outline"></ion-icon>  
       
        <h3 class="acerca-persona-nombre">Diego M.</h3>
        <p class="acerca-persona-rol">Taller</p>
      </article>
      <article class="acerca-persona">
      <ion-icon name="person-outline"></ion-icon>  
        
        <h3 class="acerca-persona-nombre">Valeria T.</h3>
        <p class="acerca-persona-rol">Diseño técnico</p>
      </article>
      <article class="acerca-persona">
      <ion-icon name="person-outline"></ion-icon>  
        
        <h3 class="acerca-persona-nombre">Andrés P.</h3>
        <p class="acerca-persona-rol">Calidad</p>
      </article>
      <article class="acerca-persona">
      <ion-icon name="person-outline"></ion-icon>  
        
        <h3 class="acerca-persona-nombre">Luisa G.</h3>
        <p class="acerca-persona-rol">Operaciones</p>
      </article>
      <article class="acerca-persona">
      <ion-icon name="person-outline"></ion-icon>  
        
        <h3 class="acerca-persona-nombre">Marco A.</h3>
        <p class="acerca-persona-rol">Atención</p>
      </article>
    </div>
  </section>

  <!-- Compromisos -->
  <section class="acerca-compromisos">
    <h2 class="acerca-subtitulo">Compromisos</h2>
    <ul class="acerca-lista-compromisos">
      <li class="acerca-item-compromiso">Series pequeñas para evitar sobreproducción.</li>
      <li class="acerca-item-compromiso">Reparación básica gratuita los primeros 6 meses.</li>
      <li class="acerca-item-compromiso">Etiquetas con información clara de materiales y cuidados.</li>
    </ul>
  </section>
</main>

<?php include "views/layouts/footer.php"; ?>

<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
