import * as THREE from 'three';

let app = null;

function prefersReducedMotion() {
    return window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
}

function clamp(n, min, max) {
    return Math.max(min, Math.min(max, n));
}

function initThreeHero() {
    const root = document.getElementById('three-hero-root');
    if (!root) return;

    const canvasParent = document.createElement('div');
    canvasParent.id = 'three-hero-canvas-parent';
    canvasParent.style.position = 'absolute';
    canvasParent.style.inset = '0';
    canvasParent.style.overflow = 'hidden';
    canvasParent.style.zIndex = '0';
    root.prepend(canvasParent);

    const reduced = prefersReducedMotion();

    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true, powerPreference: 'high-performance' });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
    renderer.setSize(root.clientWidth, root.clientHeight);
    canvasParent.appendChild(renderer.domElement);

    const scene = new THREE.Scene();

    // Camera
    const camera = new THREE.PerspectiveCamera(45, root.clientWidth / root.clientHeight, 0.1, 200);
    camera.position.set(0, 0.4, 3.2);
    scene.add(camera);

    // Lights (dynamic-ish via animation loop)
    const ambient = new THREE.AmbientLight(0xffffff, 0.4);
    scene.add(ambient);

    const dir = new THREE.DirectionalLight(0xdc2626, 1.2);
    dir.position.set(2.2, 2.4, 2.0);
    scene.add(dir);

    // Soft background plane for subtle shading
    const bgGeo = new THREE.PlaneGeometry(8, 4.2, 1, 1);
    const bgMat = new THREE.MeshBasicMaterial({ color: 0x0a0a0b, transparent: true, opacity: 0.0 });
    const bg = new THREE.Mesh(bgGeo, bgMat);
    bg.position.set(0, -0.2, -2);
    scene.add(bg);

    // Floating rings / cards
    const group = new THREE.Group();
    scene.add(group);

    const redMat = new THREE.MeshStandardMaterial({
        color: 0xdc2626,
        metalness: 0.25,
        roughness: 0.25,
        emissive: 0xdc2626,
        emissiveIntensity: 0.35,
        transparent: true,
        opacity: 0.78,
    });

    const glassMat = new THREE.MeshStandardMaterial({
        color: 0xf3f4f6,
        metalness: 0.05,
        roughness: 0.18,
        transparent: true,
        opacity: 0.25,
        emissive: 0xffffff,
        emissiveIntensity: 0.08,
    });

    function makeCard(colorMat, w, h, z) {
        const geo = new THREE.BoxGeometry(w, h, 0.08);
        const mesh = new THREE.Mesh(geo, colorMat);
        mesh.position.z = z;
        return mesh;
    }

    const cards = [];
    const spreads = [
        { x: -0.9, y: 0.25, z: 0.1, mat: redMat },
        { x: 0.9, y: 0.1, z: -0.05, mat: glassMat },
        { x: -0.4, y: -0.15, z: 0.22, mat: glassMat },
        { x: 0.35, y: -0.35, z: 0.18, mat: redMat },
    ];

    for (let i = 0; i < spreads.length; i++) {
        const s = spreads[i];
        const card = makeCard(s.mat, 0.95, 0.52, s.z);
        card.position.x = s.x;
        card.position.y = s.y;
        group.add(card);
        cards.push(card);
    }

    // Torus rings for depth
    const ringMat = new THREE.MeshStandardMaterial({
        color: 0xdc2626,
        metalness: 0.35,
        roughness: 0.22,
        emissive: 0xdc2626,
        emissiveIntensity: 0.25,
        transparent: true,
        opacity: 0.55,
    });

    const rings = [];
    for (let i = 0; i < 6; i++) {
        const geo = new THREE.TorusGeometry(0.55 + i * 0.06, 0.03, 12, 80);
        const ring = new THREE.Mesh(geo, ringMat);
        ring.rotation.x = Math.PI / 2;
        ring.position.y = -0.05 + i * 0.07;
        ring.position.z = -0.35 + i * 0.12;
        ring.userData.spin = 0.3 + i * 0.08;
        group.add(ring);
        rings.push(ring);
    }

    // Pointer parallax
    const pointer = { x: 0, y: 0 };
    function onPointerMove(e) {
        const r = root.getBoundingClientRect();
        const px = (e.clientX - r.left) / r.width;
        const py = (e.clientY - r.top) / r.height;
        pointer.x = (px - 0.5) * 2;
        pointer.y = (py - 0.5) * 2;
    }

    // Scroll trigger state
    let targetScroll = 0;
    function onScroll() {
        const y = window.scrollY || 0;
        targetScroll = y;
    }

    root.addEventListener('pointermove', onPointerMove, { passive: true });
    window.addEventListener('scroll', onScroll, { passive: true });

    let last = performance.now();
    let t = 0;

    const reduce = reduced;

    function resize() {
        const w = root.clientWidth;
        const h = root.clientHeight;
        renderer.setSize(w, h);
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
    }

    const ro = new ResizeObserver(() => resize());
    ro.observe(root);

    function animate(now) {
        const dt = (now - last) / 1000;
        last = now;
        t += dt;

        const parX = pointer.x;
        const parY = pointer.y;

        // Simulated dynamic lighting based on pointer
        dir.position.x = 2.2 + parX * 1.6;
        dir.position.y = 2.4 + -parY * 1.4;
        dir.intensity = 1.0 + (Math.abs(parX) + Math.abs(parY)) * 0.35;

        // Scroll influence
        const scrollInfluence = reduce ? 0 : clamp(targetScroll / 900, 0, 1);

        // Rebutan effect: orbit cards in opposite directions
        const speed = reduce ? 0.2 : 1.0;
        const orbitA = t * 0.75 * speed;
        const orbitB = -t * 0.85 * speed;

        if (!reduce) {
            cards[0].position.x = -0.9 + Math.cos(orbitA) * 0.18;
            cards[0].position.y = 0.25 + Math.sin(orbitA) * 0.11;

            cards[1].position.x = 0.9 + Math.cos(orbitB) * -0.18;
            cards[1].position.y = 0.1 + Math.sin(orbitB) * 0.11;

            cards[2].position.x = -0.4 + Math.cos(orbitB * 1.15) * 0.12;
            cards[2].position.y = -0.15 + Math.sin(orbitB * 1.15) * -0.09;

            cards[3].position.x = 0.35 + Math.cos(orbitA * 1.1) * -0.12;
            cards[3].position.y = -0.35 + Math.sin(orbitA * 1.1) * -0.09;

            // Rings spin
            rings.forEach((r, idx) => {
                r.rotation.z += dt * (0.35 + idx * 0.05) * r.userData.spin;
                r.rotation.y += dt * (0.25 + idx * 0.03);
                // Subtle depth wobble
                r.position.z = -0.35 + idx * 0.12 + Math.sin(t * 0.9 + idx) * 0.03;
            });
        }

        // Parallax rotation for depth interaction
        group.rotation.x = (-parY * 0.25) * (reduce ? 0.4 : 1);
        group.rotation.y = (parX * 0.35) * (reduce ? 0.4 : 1);
        group.position.y = -0.03 + scrollInfluence * 0.08;

        // Camera z for subtle scroll zoom
        camera.position.z = 3.2 - scrollInfluence * 0.25;

        ambient.intensity = 0.35 + scrollInfluence * 0.15;

        renderer.render(scene, camera);
        app.raf = requestAnimationFrame(animate);
    }

    app = { raf: 0, dispose: () => {} };
    if (!reduce) {
        app.raf = requestAnimationFrame(animate);
    } else {
        // Reduced motion: render once
        renderer.render(scene, camera);
    }

    // Pause on tab hide
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            if (app && app.raf) cancelAnimationFrame(app.raf);
        } else if (!reduce) {
            last = performance.now();
            app.raf = requestAnimationFrame(animate);
        }
    });

    // Cleanup hook (optional)
    return {
        dispose: () => {
            try {
                if (app && app.raf) cancelAnimationFrame(app.raf);
                ro.disconnect();
                root.removeEventListener('pointermove', onPointerMove);
                window.removeEventListener('scroll', onScroll);
                renderer.dispose();
            } catch (e) {
                // noop
            }
        },
    };
}

export function mountThreeHero() {
    // Avoid double init
    if (window.__threeHeroMounted) return;
    window.__threeHeroMounted = true;
    initThreeHero();
}

