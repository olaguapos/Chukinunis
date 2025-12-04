class ThreeDVisualizer {
    constructor() {
        console.log('✅ ThreeDVisualizer constructor ejecutado');
    }

    init(product) {
        console.log('🚀 ThreeDVisualizer.init EJECUTADO con producto:', product.name);
        
        const container = document.getElementById('product-3d-container');
        
        // Limpiar completamente
        container.innerHTML = '';
        
        try {
            // Crear escena
            const scene = new THREE.Scene();
            scene.background = new THREE.Color(0xf8f9fa);

            // Cámara
            const camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
            camera.position.z = 5;

            // Renderizador
            const renderer = new THREE.WebGLRenderer({ antialias: true });
            renderer.setSize(container.clientWidth, container.clientHeight);
            container.appendChild(renderer.domElement);

            // Controles
            const controls = new THREE.OrbitControls(camera, renderer.domElement);
            controls.enableDamping = true;
            controls.dampingFactor = 0.05;

            // Luces
            const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
            scene.add(ambientLight);

            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
            directionalLight.position.set(5, 10, 7);
            scene.add(directionalLight);

            // Geometría basada en categoría
            let geometry;
            const category = product.category ? product.category.toLowerCase() : '';
            
            if (category.includes('bebida') || category.includes('jugo')) {
                geometry = new THREE.CylinderGeometry(1, 0.8, 2, 32);
            } else if (category.includes('snack') || category.includes('galleta')) {
                geometry = new THREE.BoxGeometry(1.5, 0.5, 1);
            } else {
                geometry = new THREE.SphereGeometry(1, 32, 32);
            }

            // Material con color basado en impacto ecológico
            const material = new THREE.MeshPhongMaterial({ 
                color: 0x4caf50, // Verde por defecto
                shininess: 30
            });

            const mesh = new THREE.Mesh(geometry, material);
            scene.add(mesh);

            // Animación
            function animate() {
                requestAnimationFrame(animate);
                mesh.rotation.y += 0.01;
                controls.update();
                renderer.render(scene, camera);
            }
            animate();

            console.log('✅ Visualización 3D creada exitosamente');

        } catch (error) {
            console.error('❌ Error en ThreeDVisualizer.init:', error);
            // Fallback visual
            container.innerHTML = `
                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; color: #666;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 3rem; margin-bottom: 1rem; color: #ff9800;"></i>
                    <p>Error en visualización 3D</p>
                    <p style="font-size: 0.8rem; margin-top: 0.5rem;">${error.message}</p>
                </div>
            `;
        }
    }
}

// Exportar de manera más robusta
if (typeof window !== 'undefined') {
    window.ThreeDVisualizer = new ThreeDVisualizer();
    console.log('✅ ThreeDVisualizer asignado a window.ThreeDVisualizer');
} else {
    console.error('❌ window no está disponible');
}