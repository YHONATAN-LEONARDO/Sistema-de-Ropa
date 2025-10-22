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

<main class="contenedor acerca">
  <!-- Intro -->
  <section class="intro seccion-grid">
    <div class="intro-texto">
      <h1>Nosotros</h1>
      <p>En <strong>EcoAbrigo</strong> diseñamos y fabricamos prendas funcionales que te acompañan todos los días. 
      Creemos en la durabilidad, el comercio responsable y un diseño simple que realmente sirve.</p>
      <p>Trabajamos con proveedores locales siempre que es posible y buscamos reducir desperdicios en cada etapa: 
      desde el patronaje hasta el empaque.</p>
    </div>
    <figure class="intro-imagen">
      <img src="public/img/nosotros/intro.jpg" alt="Taller y equipo de EcoAbrigo">
    </figure>
  </section>

  <!-- Misión y Visión -->
  <section class="mision-vision flex-dos">
    <article class="bloque">
      <h2>Misión</h2>
      <p>Crear abrigos y prendas versátiles que combinen calidad, precio justo y procesos responsables, 
      para que más personas puedan vestirse mejor sin gastar de más.</p>
    </article>
    <article class="bloque">
      <h2>Visión</h2>
      <p>Ser la marca de referencia en Latinoamérica por su sencillez, transparencia y resistencia real en el uso diario, 
      manteniendo un impacto ambiental cada vez menor.</p>
    </article>
  </section>

  <!-- Valores -->
  <section class="valores">
    <h2>Valores</h2>
    <div class="grid-valores">
      <article class="valor-card">
        <img src="public/img/nosotros/valor-1.jpg" alt="Valor de calidad">
        <h3>Calidad honesta</h3>
        <p>Probamos cada prenda en situaciones reales para asegurar costuras firmes y materiales que duren.</p>
      </article>
      <article class="valor-card">
        <img src="public/img/nosotros/valor-2.jpg" alt="Valor de sostenibilidad">
        <h3>Sostenibilidad práctica</h3>
        <p>Optimizamos cortes, reusamos retazos y priorizamos tejidos con menor huella.</p>
      </article>
      <article class="valor-card">
        <img src="public/img/nosotros/valor-3.jpg" alt="Valor de comunidad">
        <h3>Comunidad</h3>
        <p>Colaboramos con talleres y emprendedores locales para crecer juntos.</p>
      </article>
      <article class="valor-card">
        <img src="public/img/nosotros/valor-4.jpg" alt="Valor de transparencia">
        <h3>Transparencia</h3>
        <p>Comunicamos procesos, tiempos y costos de forma clara, sin humo.</p>
      </article>
    </div>
  </section>

  <!-- Historia breve -->
  <section class="historia">
    <h2>Nuestra historia</h2>
    <p>Nacimos en La Paz en 2021 con un objetivo simple: fabricar abrigos que realmente abriguen, 
    que no se rompan al mes y que no cuesten una fortuna. Empezamos con 20 piezas y una mesa de corte prestada; 
    hoy producimos lotes pequeños, mejor controlados, sin perder el toque artesanal.</p>
  </section>

  <!-- Equipo -->
  <section class="equipo">
    <h2>Equipo</h2>
    <div class="grid-equipo">
      <article class="persona">
        <img src="public/img/nosotros/team-1.jpg" alt="Directora de producto">
        <h3>Carla R.</h3>
        <p>Producto</p>
      </article>
      <article class="persona">
        <img src="public/img/nosotros/team-2.jpg" alt="Maestro sastre">
        <h3>Diego M.</h3>
        <p>Taller</p>
      </article>
      <article class="persona">
        <img src="public/img/nosotros/team-3.jpg" alt="Diseñadora técnica">
        <h3>Valeria T.</h3>
        <p>Diseño técnico</p>
      </article>
      <article class="persona">
        <img src="public/img/nosotros/team-4.jpg" alt="Control de calidad">
        <h3>Andrés P.</h3>
        <p>Calidad</p>
      </article>
      <article class="persona">
        <img src="public/img/nosotros/team-5.jpg" alt="Operaciones y logística">
        <h3>Luisa G.</h3>
        <p>Operaciones</p>
      </article>
      <article class="persona">
        <img src="public/img/nosotros/team-6.jpg" alt="Atención al cliente">
        <h3>Marco A.</h3>
        <p>Atención</p>
      </article>
    </div>
  </section>

  <!-- Compromisos -->
  <section class="compromisos">
    <h2>Compromisos</h2>
    <ul class="lista-compromisos">
      <li>Series pequeñas para evitar sobreproducción.</li>
      <li>Reparación básica gratuita los primeros 6 meses.</li>
      <li>Etiquetas con información clara de materiales y cuidados.</li>
    </ul>
  </section>
</main>

<?php include "views/layouts/footer.php"; ?>
</body>
</html>
