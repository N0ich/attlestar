/*
 * Main.js file for test
 * By: Louis <louis@ne02ptzero.me>
*/

launchGame();

/*
 * Base Settings
*/
	// Globals
		var renderer, scene, camera, fov, mesh, floor;

	function	launchGame() {
		initGame();
		addCamera(45, window.innerWidth / window.innerHeight, 1, 10000);
		addWorld();
		addFloor();
		animate();
	}

	/*
	 * Initialize the WebGL and the scene
	*/
	function	initGame() {
		renderer = new THREE.WebGLRenderer({ alpha: true });
		renderer.setSize(window.innerWidth, window.innerHeight);
		document.body.appendChild(renderer.domElement);
		scene = new THREE.Scene();
	}

	/*
	 * Render the scene
	*/
	function	render() {
		renderer.render(scene, camera);
	}

	/*
	 * Animate the scene
	*/
	function	animate() {
		requestAnimationFrame(animate);
		mesh.rotation.x += 0.00001;
		mesh.rotation.y += 0.0001;
		//floor.rotation.x += 0.01;
		renderer.render(scene, camera);
	}

	/*
	 * Add camera to the scene
	*/
	function	addCamera(fov, aspect, near, far) {
		camera = new THREE.PerspectiveCamera(fov, aspect, near, far);
		camera.position.set(0, 0, 1000);
		camera.position.x = 0;
		camera.position.y = 0;
		camera.position.z = 100;
		scene.add(camera);
	}

	/*
	 * Add a world sphere
	*/
	function	addWorld() {
		var geometry = new THREE.SphereGeometry(200, 32, 32);
		var worldtexture = THREE.ImageUtils.loadTexture('js/img/star.png')
		var material = new THREE.MeshBasicMaterial({ 
			map: worldtexture,
			side: THREE.DoubleSide
		});
		mesh = new THREE.Mesh(geometry, material);
		scene.add(mesh);
	}

	/*
	 * Add a floor for the battle
	*/
	function	addFloor() {
		var geometry = new THREE.PlaneGeometry(80, 80, 1, 1);
		var material = new THREE.MeshBasicMaterial({color: 0xff0000/*, side: THREE.DoubleSide*/})
		floor = new THREE.Mesh(geometry, material);
		floor.position.y = -0.5;
		floor.rotation.x = 5.92;
		floor.rotation.z = 3.5;
		scene.add(floor);
	}

	/*
	 * Add the lights to the scene
	*/
	function	addLight() {
		var lumiere = new THREE.DirectionalLight(0xffffff, 1.0);
		lumiere.position.set(0, 0, 400);
		scene.add(lumiere);
	}
