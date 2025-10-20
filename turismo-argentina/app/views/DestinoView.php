<?php
class DestinoView {

    public function showHome($destinos) {
        require_once 'templates/header.phtml';
        echo '<div class="hero-section"><h1>¡Descubrí las maravillas de Argentina!</h1></div>';
        $this->renderDestinosGrid($destinos, "Destinos Destacados");
        require_once 'templates/footer.phtml';
    }

    public function showAllDestinos($destinos, $regiones) {
        require_once 'templates/header.phtml';
        echo "<h2>Todos Nuestros Destinos</h2>";
        $this->renderFilterMenu($regiones);
        $this->renderDestinosGrid($destinos);
        $this->renderTravelTips(); 
        require_once 'templates/footer.phtml';
    }

    public function showDestinos($destinos, $regiones, $titulo) {
        require_once 'templates/header.phtml';
        echo "<h2>$titulo</h2>";
        $this->renderFilterMenu($regiones);
        $this->renderDestinosGrid($destinos);
        $this->renderTravelTips(); 
        require_once 'templates/footer.phtml';
    }

    public function showDestinoDetail($destino) {
        require_once 'templates/header.phtml';
        
        echo '
        <div class="destino-detail-container">
            <img src="' . $destino->imagen_url . '" alt="Imagen de ' . $destino->nombre . '" class="destino-detail-img">
            <div class="destino-detail-content">
                <h1>' . $destino->nombre . '</h1>
                <p>' . $destino->descripcion . '</p>
                <a href="destinos" class="cta-button">Volver a Destinos</a>
            </div>
        </div>
        ';
        
        require_once 'templates/footer.phtml';
    }

    public function renderFilterMenu($regiones) {
        echo '<nav class="filter-nav">
                <span>Filtrar por región:</span>
                <ul>
                    <li><a href="destinos">Mostrar Todos</a></li>';
        foreach ($regiones as $region) {
            echo "<li><a href='destinos/{$region->id_region}'>{$region->nombre}</a></li>";
        }
        echo '  </ul>
              </nav>';
    }

    public function renderDestinosGrid($destinos) {
        if (empty($destinos)) {
            // ...
        } else {
            echo '<div class="destinations-grid">';
            foreach ($destinos as $destino) {
                echo '<a href="destino/' . $destino->id_destino . '" class="destination-card-link">';
                echo '  <div class="destination-card">';
                echo "      <img src='{$destino->imagen_url}' alt='{$destino->nombre}'>";
                echo '      <div class="destination-card-content">';
                echo "          <h3>{$destino->nombre}</h3>";
                $short_desc = strlen($destino->descripcion) > 100 ? substr($destino->descripcion, 0, 100) . '...' : $destino->descripcion;
                echo "          <p>{$short_desc}</p>";
                echo '      </div>';
                echo '  </div>';
                echo '</a>';
            }
            echo '</div>';
        }
    }    
    public function renderTravelTips() {
        echo '
        <section class="info-section">
            <h2>Tips para tu Viaje por Argentina ✈️</h2>
            <div class="info-content">
                <p>Argentina es un país de contrastes, con una enorme diversidad de climas y paisajes. Desde las selvas tropicales del norte hasta los glaciares del sur, ¡prepará ropa para todas las estaciones!</p>
                <p>No te vayas sin probar un auténtico <strong>asado</strong>, las deliciosas <strong>empanadas</strong> o un buen vino de Mendoza. La cultura gastronómica es una parte fundamental de la experiencia argentina.</p>
                <ul>
                    <li><strong>Mejor época para visitar:</strong> La primavera (septiembre a noviembre) y el otoño (marzo a mayo) suelen ofrecer el clima más agradable en la mayoría de las regiones.</li>
                    <li><strong>Moneda:</strong> La moneda local es el Peso Argentino (ARS). Es recomendable tener algo de efectivo, aunque las tarjetas son ampliamente aceptadas en las ciudades.</li>
                    <li><strong>Transporte:</strong> Para largas distancias, el avión es la opción más rápida. Para recorridos regionales, la red de autobuses (micros) es extensa y de muy buena calidad.</li>
                </ul>
            </div>
        </section>
        ';
    }
}