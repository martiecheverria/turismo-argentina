<?php
class RegionView {
    public function showAll($regiones) {
        require_once 'templates/header.phtml';
        
        echo "<h2>Explorá las Regiones de Argentina</h2>";
        
        echo '<div class="region-grid">';
        foreach ($regiones as $region) {
            echo '
            <div class="region-card">
                <img src="' . $region->imagen_url . '" alt="Imagen de ' . $region->nombre . '">
                <div class="region-card-content">
                    <h3>' . $region->nombre . '</h3>
                    <p>' . $region->descripcion . '</p>
                    <a href="destinos/' . $region->id_region . '" class="cta-button">Ver Destinos</a>
                </div>
            </div>
            ';
        }
        echo '</div>';

        $this->renderArgentinaInfoSection();

        require_once 'templates/footer.phtml';
    }

    private function renderArgentinaInfoSection() {
        echo '
        <section class="info-section">
            <h2>Un País, Mil Mundos 🌎</h2>
            <div class="info-content">
                <p>Argentina es el octavo país más grande del mundo, y su vasto territorio alberga una diversidad de paisajes que asombra a cada paso. Recorrerlo por regiones es la mejor manera de sumergirse en sus contrastes y descubrir sus tesoros únicos.</p>
                <p>Cada región tiene su propia identidad, marcada por su geografía, su clima, su cultura y su gastronomía. No es solo un viaje, ¡son múltiples viajes en uno!</p>
                <ul>
                    <li><strong>Aventura y Naturaleza:</strong> Desde el trekking en los glaciares de la Patagonia hasta el montañismo en los Andes de Cuyo.</li>
                    <li><strong>Cultura e Historia:</strong> Desde las raíces ancestrales del Noroeste hasta la herencia europea en las grandes ciudades.</li>
                    <li><strong>Sabores Inolvidables:</strong> Cada región te espera con platos típicos que deleitarán tu paladar.</li>
                </ul>
                <p><strong>¿Estás listo para la aventura?</strong> Elegí una región y comenzá a planificar un viaje que nunca olvidarás.</p>
            </div>
        </section>
        ';
    }
}