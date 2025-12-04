<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecoscan - Huella Ecológica de Productos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    
    <!-- Cargar Three.js y dependencias PRIMERO en el head -->
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/controls/OrbitControls.js"></script>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <i class="fas fa-leaf"></i>
                <h1>Ecoscan</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#escanear">Escanear</a></li>
                    <li><a href="#productos">Productos</a></li>
                    <li><a href="#equipo">Equipo</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero" id="inicio">
        <div class="hero-content">
            <h2>Descubre la huella ecológica de tus productos</h2>
            <p>Escanea el código de barras de cualquier producto y conoce su impacto ambiental: emisiones, reciclabilidad, origen y más.</p>
            <a href="#escanear" class="btn">Comenzar a escanear</a>
        </div>
    </section>

    <div class="container">
        <section class="scanner-section" id="escanear">
            <h2 class="section-title">Escanear Producto</h2>
            <div class="scanner-container">
                <div class="scanner">
                    <i class="fas fa-barcode"></i>
                    <p>Coloca el código de barras frente a la cámara</p>
                    <div class="scanner-overlay"></div>
                </div>
                <div class="manual-input">
                    <p>O ingresa el código manualmente:</p>
                    <input type="text" placeholder="Ej: 7501006558602" id="barcode-input">
                    <button class="btn" id="search-btn" style="margin-top: 1rem; width: 100%;">Buscar Producto</button>
                </div>
            </div>
        </section>

        <section class="product-display" id="productos">
            <div class="product-info">
                <div class="product-image">
                    <img src="https://via.placeholder.com/300" alt="Producto" id="product-img">
                </div>
                <div class="product-details">
                    <h3 id="product-name">Producto Ejemplo</h3>
                    <p id="product-brand" class="product-brand"></p>
                    <p id="product-description">Escanea un código de barras para ver la información del producto y su huella ecológica.</p>
                    
                    <div class="eco-metrics">
                        <div class="metric">
                            <div class="metric-value" id="co2-value">-- kg</div>
                            <div class="metric-label">Emisiones de CO2</div>
                        </div>
                        <div class="metric">
                            <div class="metric-value" id="water-value">-- L</div>
                            <div class="metric-label">Uso de agua</div>
                        </div>
                        <div class="metric">
                            <div class="metric-value" id="recycle-value">--%</div>
                            <div class="metric-label">Reciclabilidad</div>
                        </div>
                        <div class="metric">
                            <div class="metric-value" id="origin-value">--</div>
                            <div class="metric-label">Origen</div>
                        </div>
                        <div class="metric">
                            <div class="metric-value" id="carbon-value">-- kg</div>
                            <div class="metric-label">Huella de carbono</div>
                        </div>
                        <div class="metric">
                            <div class="metric-value" id="energy-value">-- kWh</div>
                            <div class="metric-label">Consumo energético</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="product-3d">
                <h3>Visualización 3D del Impacto Ambiental</h3>
                <div id="product-3d-container">
                    <div class="placeholder-3d">
                        <i class="fas fa-cube"></i>
                        <p>La visualización 3D aparecerá aquí al escanear un producto</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="comparison-section">
            <h2 class="section-title">Comparación con Productos Similares</h2>
            <div class="chart-container">
                <canvas id="comparison-chart"></canvas>
            </div>
        </section>

        <section class="team-section" id="equipo">
            <h2 class="section-title">Nuestro Equipo</h2>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-photo">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3>Aldo Juventino Ballesteros Cruz</h3>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3>Victor Manuel Bojórquez Valdez</h3>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3>Luis Adao Leonel Durán Ponce</h3>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3>Maximiliano Alberto Grande Ortega</h3>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3>Jorge Luis López Morgado</h3>
                </div>
            </div>
        </section>
    </div>

    <footer>
        <div class="footer-content">
            <div class="logo">
                <i class="fas fa-leaf"></i>
                <h1>Ecoscan</h1>
            </div>
            <p>Promoviendo la producción y el consumo responsables</p>
            <div class="footer-links">
                <a href="#">Términos de uso</a>
                <a href="#">Política de privacidad</a>
                <a href="#">Contacto</a>
            </div>
            <p>&copy; 2023 Equipo Ecoscan. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Cargar Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Al FINAL del body, en ESTE ORDEN: -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/app.js"></script>
<script src="js/chart.js"></script>
<script src="js/threeD.js"></script>

<script>
    // Verificación final
    document.addEventListener('DOMContentLoaded', function() {
        console.log('=== VERIFICACIÓN FINAL ===');
        console.log('THREE:', typeof THREE);
        console.log('ThreeDVisualizer:', typeof window.ThreeDVisualizer);
        console.log('ThreeDVisualizer.init:', typeof window.ThreeDVisualizer?.init);
        
        // Test directo
        if (window.ThreeDVisualizer && typeof window.ThreeDVisualizer.init === 'function') {
            console.log('🎉 ThreeDVisualizer.init está LISTO para usar!');
        } else {
            console.error('💥 ThreeDVisualizer.init NO está disponible');
        }
    });
</script>
</body>
</html>