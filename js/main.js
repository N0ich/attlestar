/*
 * Main.js file for test
 * By: Louis <louis@ne02ptzero.me>
*/

/*
 * Events
*/
	// MouseWheel
		document.body.addEventListener('mousewheel', mousewheel, false);
		document.body.addEventListener('DOMMouseScroll', mousewheel, false);
	// MouseDown
		document.body.addEventListener('mousedown', mousedown, false);
		document.body.addEventListener('DOMMouseDown', mousedown, false);
	// MouseUp
		document.body.addEventListener('mouseup', mouseup, false);
		document.body.addEventListener('DOMMouseUp', mouseup, false);
	// MouseMove
		document.body.addEventListener('mousemove', mousemove, false);
		document.body.addEventListener('DOMMouseMove', mousemove, false);


/*
 * Base Settings
*/
	// Globals
		var inclinaison = -0.15;
		var grid_height = 100;
		var grid_width = 150;
		var density = 10;
		var baseUrl = "js/";
		var renderer, scene, camera, fov, mesh, g_ship,
			mouseX = 0, mouseY = 0, mouseDown = false;
		var ship_left = 4.5;
		var ship_bottom = 6.2;
		var ship_right = 7.8;
		var ship_top = 9.4;
		var go = false;
		var bound = 0;


	launchGame();

	function	launchGame() {
		initGame();
		addCamera(60, window.innerWidth / window.innerHeight, 1, 10000);
		addWorld();
		addSheep(1, 15, 10, -5, ship_top);
		addSheep(2, 5, 5, -5, ship_left);
		addLines();
		animate();
	}

	/*
	 * Initialize the WebGL and the scene
	*/
	function	initGame() {
		renderer = new THREE.WebGLRenderer({ alpha: true, antialias: false});
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
		if (go == true) {
			if (g_ship.position.x > -20)
				g_ship.position.x = (g_ship.position.x - 0.5);
			if (g_ship.position.y > -15)
				g_ship.position.y = (g_ship.position.y - 0.5);
			else if (g_ship.position.x > -20 && g_ship.position.y > -10)
				go = false;
		}
		//cube.rotation.z += 0.01;
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
	 * Add a Ship
	*/
	function	addSheep(ship, pos_y, pos_x, rot_x, way) {
		var loader	= new THREE.OBJMTLLoader();
		var objUrl	= baseUrl + 'models/SpaceFighter0'+ ship +'/SpaceFighter0'+ ship +'.obj';
		var mtlUrl	= baseUrl + 'models/SpaceFighter0'+ ship +'/SpaceFighter0'+ ship +'.mtl';
		var return_o;
		loader.load(objUrl, mtlUrl, function( object3d ){
			object3d.scale.multiplyScalar(1/50)
			object3d.traverse(function(object3d){
				if( object3d.material ){
					object3d.material.emissive.set('white')
				}
			})
			object3d.position.y = pos_y;
			object3d.position.x = pos_x;
			object3d.rotation.x = rot_x;
			object3d.rotation.y = way;
			scene.add(object3d);
			g_ship = object3d;
		});
		return return_o;
	}

	/*
	 * Add the lights to the scene
	*/
	function	addLight() {
		var lumiere = new THREE.DirectionalLight(0xffffff, 1.0);
		lumiere.position.set(0, 0, 400);
		scene.add(lumiere);
	}

	function	addLines() {
		base = grid_width / 2;
		var material = new THREE.LineBasicMaterial({
			color: 0xffffff,
			transparent: true,
			opacity: 0.07
		});
		var i;
		// Vertical lines
			for (i = -(grid_height / 2); i < (base - 20); i += density) {
				var geometry = new THREE.Geometry();
				geometry.vertices.push(new THREE.Vector3(-(base), (i), 1));
				geometry.vertices.push(new THREE.Vector3(base, (i), 1));
				var line = new THREE.Line(geometry, material);
				scene.add(line);
			}
		// Horizontal lines
			for (i = -(grid_width / 2); i < (grid_width - 70); i += density) {
				var geometry = new THREE.Geometry();
				geometry.vertices.push(new THREE.Vector3(i, -(grid_width / 2) + 25, 1));
				geometry.vertices.push(new THREE.Vector3(i, (grid_width / 2) - 25, 1));
				var line = new THREE.Line(geometry, material);
				scene.add(line);
			}

	}

/*
 * Events
*/

	/*
	 * On Mouse Wheel (Scroll)
	*/
	function	mousewheel(e) {
		var d = ((typeof e.wheelDelta != "undefined")?(-e.wheelDelta):e.detail);
		var cPos = camera.position;
		if (d == 3 && cPos.z < 200)
			cPos.z += 0.3;
		else if (d == -3 && cPos.z > 50)
			cPos.z -= 0.3;
	}

	/*
	 * On Mouse Down
	*/
	function	mousedown(event) {
		event.preventDefault();
		mouseDown = true;
		mouseX = event.clientX;
		mouseY = event.clientY;
	}

	/*
	 * On Mouse Move
	*/
	function	mousemove(event) {
		if (!mouseDown)
			return;
		event.preventDefault();
		var deltaX = event.clientX - mouseX,
		deltaY = event.clientY - mouseY;
		mouseX = event.clientX;
		mouseY = event.clientY;
		camera.rotation.y += deltaX / 100;
		camera.rotation.x += deltaY / 100;
	}

	/*
	 * On Mouse Up
	*/
	function	mouseup(event) {
		event.preventDefault();
		mouseDown = false;
	}
