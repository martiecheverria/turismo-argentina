<?php
class AdminView {
    public function showAdminPanel($destinos, $regiones) {
        require_once 'templates/header.phtml';
        echo '<div class="admin-panel">';
        echo '<div class="admin-section">';
        $this->showAddDestinoForm($regiones);
        $this->showDestinosTable($destinos);
        echo '</div>';
        echo '<div class="admin-section">';
        $this->showAddRegionForm();
        $this->showRegionesTable($regiones);
        echo '</div>';
        echo '</div>';
        require_once 'templates/footer.phtml';
    }

    public function showAddDestinoForm($regiones) {
        echo '<h2>Agregar Destino</h2>';
        echo '<form action="add-destino" method="POST">
                <input type="text" name="nombre" placeholder="Nombre del destino" required>
                <textarea name="descripcion" placeholder="Descripción" required></textarea>
                <input type="text" name="imagen_url" placeholder="URL de la imagen">
                <select name="id_region">';
        foreach ($regiones as $region) {
            echo "<option value='{$region->id_region}'>{$region->nombre}</option>";
        }
        echo '  </select>
                <button type="submit">Agregar</button>
              </form>';
    }

    public function showEditDestinoForm($destino, $regiones) {
        require_once 'templates/header.phtml';
        echo '<h2>Editar Destino</h2>';
        echo '<form action="update-destino" method="POST">
                <input type="hidden" name="id_destino" value="' . $destino->id_destino . '">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="' . $destino->nombre . '" required>
                <label>Descripción:</label>
                <textarea name="descripcion" required>' . $destino->descripcion . '</textarea>
                <label>URL Imagen:</label>
                <input type="text" name="imagen_url" value="' . $destino->imagen_url . '">
                <label>Región:</label>
                <select name="id_region">';
        foreach ($regiones as $region) {
            if ($region->id_region == $destino->id_region_fk) {
                echo "<option value='{$region->id_region}' selected>{$region->nombre}</option>";
            } else {
                echo "<option value='{$region->id_region}'>{$region->nombre}</option>";
            }
        }
        echo '  </select>
                <button type="submit">Guardar Cambios</button>
              </form>';
        require_once 'templates/footer.phtml';
    }


    public function showDestinosTable($destinos) {
        echo '<h2>Gestionar Destinos</h2>';
        echo '<table>
                <thead><tr><th>Destino</th><th>Región</th><th>Acciones</th></tr></thead>
                <tbody>';
        foreach ($destinos as $destino) {
            echo "<tr>
                    <td>{$destino->nombre}</td>
                    <td>{$destino->region_nombre}</td>
                    <td>
                        <a href='delete-destino/{$destino->id_destino}'>Borrar</a>
                        <a href='edit-destino/{$destino->id_destino}'>Editar</a>
                    </td>
                  </tr>";
        }
        echo '  </tbody></table>';
    }

    public function showAddRegionForm() {
        echo '<h2>Agregar Región</h2>';
        echo '<form action="add-region" method="POST">
                <input type="text" name="nombre" placeholder="Nombre de la región" required>
                <input type="text" name="imagen_url" placeholder="URL de la imagen">
                <button type="submit">Agregar Región</button>
              </form>';
    }

    public function showEditRegionForm($region) {
        require_once 'templates/header.phtml';
        echo '<h2>Editar Región</h2>';
        echo '<form action="update-region" method="POST">
                <input type="hidden" name="id_region" value="' . $region->id_region . '">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="' . $region->nombre . '" required>
                <label>URL Imagen:</label>
                <input type="text" name="imagen_url" value="' . $region->imagen_url . '">
                <button type="submit">Guardar Cambios</button>
              </form>';
        require_once 'templates/footer.phtml';
    }

    public function showRegionesTable($regiones) {
        echo '<h2>Gestionar Regiones</h2>';
        echo '<table>
                <thead><tr><th>Región</th><th>Acciones</th></tr></thead>
                <tbody>';
        foreach ($regiones as $region) {
            echo "<tr>
                    <td>{$region->nombre}</td>
                    <td>
                        <a href='delete-region/{$region->id_region}'>Borrar</a>
                        <a href='edit-region/{$region->id_region}'>Editar</a>
                    </td>
                  </tr>";
        }
        echo '  </tbody></table>';
    }



    public function showError($msg) {
        require_once 'templates/header.phtml';
        echo "<h2>Error</h2><p>$msg</p>";
        require_once 'templates/footer.phtml';
    }
}