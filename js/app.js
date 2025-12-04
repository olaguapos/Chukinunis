class EcoscanApp {
    constructor() {
        this.apiBaseUrl = 'api/get_product.php';
        this.currentProduct = null;
        console.log('🔄 EcoscanApp constructor iniciado');
        this.init();
    }

    init() {
        console.log('✅ EcoscanApp init() ejecutado');
        this.bindEvents();
    }

    bindEvents() {
        console.log('🔗 Configurando eventos...');
        document.getElementById('search-btn').addEventListener('click', () => {
            this.searchProduct();
        });

        document.getElementById('barcode-input').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.searchProduct();
            }
        });
    }

    async searchProduct() {
        const barcodeInput = document.getElementById('barcode-input');
        const barcode = barcodeInput.value.trim();
        
        if (!barcode) {
            this.showMessage('Por favor ingresa un código de barras', 'error');
            return;
        }

        this.showLoading(true);
        console.log('🔍 Buscando producto con código:', barcode);

        try {
            const response = await fetch(this.apiBaseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ barcode: barcode })
            });

            const data = await response.json();
            console.log('📦 Respuesta API:', data);

            if (data.success) {
                this.displayProduct(data.data);
                this.showMessage('Producto encontrado exitosamente', 'success');
            } else {
                this.showMessage(data.message || 'Producto no encontrado', 'error');
            }
        } catch (error) {
            console.error('❌ Error en searchProduct:', error);
            this.showMessage('Error al buscar el producto', 'error');
        } finally {
            this.showLoading(false);
        }
    }

    displayProduct(product) {
        console.log('🎨 Mostrando producto:', product.name);
        this.currentProduct = product;

        // Actualizar información básica
        document.getElementById('product-img').src = product.image_url;
        document.getElementById('product-name').textContent = product.name;
        document.getElementById('product-brand').textContent = product.brand || '';
        document.getElementById('product-description').textContent = product.description;

        // Actualizar métricas ecológicas
        const metrics = product.eco_metrics;
        document.getElementById('co2-value').textContent = `${metrics.co2_emissions} kg`;
        document.getElementById('water-value').textContent = `${metrics.water_usage} L`;
        document.getElementById('recycle-value').textContent = `${metrics.recyclability}%`;
        document.getElementById('origin-value').textContent = metrics.origin;
        document.getElementById('carbon-value').textContent = `${metrics.carbon_footprint} kg`;
        document.getElementById('energy-value').textContent = `${metrics.energy_consumption} kWh`;

        // Actualizar gráfica de comparación
        this.updateComparisonChart(product);

        // Inicializar visualización 3D
        this.init3DVisualization(product);
    }

    updateComparisonChart(product) {
        if (typeof comparisonChart !== 'undefined') {
            comparisonChart.data.datasets[0].data = [
                product.eco_metrics.co2_emissions,
                product.eco_metrics.water_usage,
                product.eco_metrics.recyclability
            ];
            
            comparisonChart.data.datasets[1].data = [
                product.comparisons.category_avg.co2,
                product.comparisons.category_avg.water,
                product.comparisons.category_avg.recycle
            ];
            
            comparisonChart.data.datasets[2].data = [
                product.comparisons.best_option.co2,
                product.comparisons.best_option.water,
                product.comparisons.best_option.recycle
            ];
            
            comparisonChart.update();
        }
    }

    init3DVisualization(product) {
        console.log('🎯 Inicializando visualización 3D...');
        console.log('📦 Producto recibido:', product);
        console.log('🔍 ThreeDVisualizer:', window.ThreeDVisualizer);
        console.log('🔍 Tipo de ThreeDVisualizer:', typeof window.ThreeDVisualizer);
        console.log('🔍 ThreeDVisualizer.init:', window.ThreeDVisualizer.init);
        console.log('🔍 Tipo de ThreeDVisualizer.init:', typeof window.ThreeDVisualizer.init);
        
        // Verificación exhaustiva
        if (window.ThreeDVisualizer && typeof window.ThreeDVisualizer.init === 'function') {
            console.log('✅ ThreeDVisualizer.init ES una función, llamando...');
            try {
                window.ThreeDVisualizer.init(product);
                console.log('✅ ThreeDVisualizer.init llamado exitosamente');
            } catch (error) {
                console.error('❌ Error al ejecutar ThreeDVisualizer.init:', error);
                this.showFallback3D();
            }
        } else {
            console.error('❌ ThreeDVisualizer.init NO es una función o no existe');
            console.log('🔄 Usando fallback 3D');
            this.showFallback3D();
        }
    }

    showFallback3D() {
        const container = document.getElementById('product-3d-container');
        container.innerHTML = `
            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; color: #666;">
                <i class="fas fa-cube" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                <p>Visualización 3D temporalmente no disponible</p>
                <p style="font-size: 0.8rem; margin-top: 0.5rem;">El producto se cargó correctamente</p>
            </div>
        `;
    }

    showLoading(show) {
        const button = document.getElementById('search-btn');
        if (show) {
            button.innerHTML = '<div class="loading"></div> Buscando...';
            button.disabled = true;
        } else {
            button.innerHTML = 'Buscar Producto';
            button.disabled = false;
        }
    }

    showMessage(message, type) {
        // Eliminar mensajes anteriores
        const existingMessages = document.querySelectorAll('.message');
        existingMessages.forEach(msg => msg.remove());

        const messageEl = document.createElement('div');
        messageEl.className = `message ${type}`;
        messageEl.textContent = message;
        messageEl.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            border-radius: 5px;
            color: white;
            font-weight: 500;
            z-index: 1000;
            background-color: ${type === 'success' ? '#4caf50' : '#f44336'};
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        `;
        document.body.appendChild(messageEl);
        setTimeout(() => messageEl.remove(), 3000);
    }
}

// Inicialización mejorada
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 DOM completamente cargado, inicializando EcoscanApp...');
    try {
        window.ecoscanApp = new EcoscanApp();
        console.log('✅ EcoscanApp inicializado exitosamente en window.ecoscanApp');
    } catch (error) {
        console.error('❌ Error al inicializar EcoscanApp:', error);
    }
});