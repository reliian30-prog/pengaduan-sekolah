<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: 'Outfit', sans-serif;
    background: #050508;

    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;

    overflow: hidden;
}

canvas {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1;
}

.container-center {
    position: relative;
    z-index: 10;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.box {
    width: 400px;
    padding: 30px;
    border-radius: 20px;

    backdrop-filter: blur(20px);
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);

    color: white;

    animation: fadeIn 0.8s ease;
}

.input {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    border-radius: 10px;
    border: none;

    background: rgba(255,255,255,0.1);
    color: white;
}

.btn {
    width: 100%;
    margin-top: 20px;
    padding: 12px;
    border-radius: 10px;
    border: none;

    background: linear-gradient(135deg,#667eea,#764ba2);
    color: white;
    font-weight: bold;
}

.link {
    margin-top: 10px;
    display: block;
    color: #aaa;
    font-size: 13px;
}
.link:hover {
    color: white;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
</head>

<body>

<canvas id="neural-network-canvas"></canvas>

<div class="container-center">
    <div class="box">
        <h2>Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="text" name="name" placeholder="Nama" class="input" required>
            <input type="text" name="username" placeholder="Username" class="input" required>
            <input type="text" name="class" placeholder="Kelas" class="input" required>
            <input type="password" name="password" placeholder="Password" class="input" required>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="input" required>

            <button class="btn">Register</button>

            <a href="{{ route('login') }}" class="link">Sudah punya akun? Login</a>
        </form>
    </div>
</div>

<!-- SAME BG -->
<script type="module">
import * as THREE from 'https://cdn.jsdelivr.net/npm/three@0.162.0/build/three.module.js';

const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, innerWidth/innerHeight, 0.1, 1000);
const renderer = new THREE.WebGLRenderer({
    canvas: document.getElementById("neural-network-canvas")
});

renderer.setSize(innerWidth, innerHeight);
camera.position.z = 30;

const geometry = new THREE.BufferGeometry();
const vertices = [];

for (let i = 0; i < 2000; i++) {
    vertices.push(
        (Math.random() - 0.5) * 100,
        (Math.random() - 0.5) * 100,
        (Math.random() - 0.5) * 100
    );
}

geometry.setAttribute('position', new THREE.Float32BufferAttribute(vertices, 3));

const material = new THREE.PointsMaterial({ size: 0.2 });
const points = new THREE.Points(geometry, material);

scene.add(points);

function animate() {
    requestAnimationFrame(animate);
    points.rotation.y += 0.001;
    renderer.render(scene, camera);
}

animate();
</script>

</body>
</html>