/*
 * Main.js file for test
 * By: Louis <louis@ne02ptzero.me>
*/

/*
 * Events
*/
	// MouseWheel
		document.getElementById('main').addEventListener('mousewheel', mousewheel, false);
		document.getElementById('main').addEventListener('DOMMouseScroll', mousewheel, false);
	// MouseDown
   /*     document.getElementById('main').addEventListener('mousedown', mousedown, false);*/
		//document.getElementById('main').addEventListener('DOMMouseDown', mousedown, false);
	//// MouseUp
		//document.getElementById('main').addEventListener('mouseup', mouseup, false);
		//document.getElementById('main').addEventListener('DOMMouseUp', mouseup, false);
	//// MouseMove
		//document.getElementById('main').addEventListener('mousemove', mousemove, false);
		/*document.getElementById('main').addEventListener('DOMMouseMove', mousemove, false);*/


/*
 * Base Settings
*/
	// Globals
		var inclinaison = -0.15;
		var grid_height = 100;
		var grid_width = 150;
		var density = 10;
		var baseUrl = "js/";
		var renderer, scene, camera, fov, mesh,
			mouseX = 0, mouseY = 0, mouseDown = false;
		var ship_left = 4.5;
		var ship_bottom = 6.2;
		var ship_right = 7.8;
		var ship_top = 9.4;
		var g_ship = {};
		var g_ship_move = [{}, {}];
		var g_ship_i = 0;
		var g_ship_move_i = 0;
		var go = false;
		var bound = 0;
		var debug = 1;


	launchGame();

	function	launchGame() {
		if (debug == 1)
			send("Initialize WebGl...");
		initGame();
		if (debug == 1)
			send("Add camera...");
		addCamera(60, window.innerWidth / window.innerHeight, 1, 10000);
		if (debug == 1)
			send("Add World...");
		addWorld();
		if (debug == 1)
			send("Add Ship...");
		addSheep(1, 15, 10, -5, ship_top);
		addSheep(2, 5, 5, -5, ship_left);
		if (debug == 1)
			send("Add Grid...");
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
	 * Move a ship
	*/
	function	move(i, x, y) {
		var actX = g_ship[i].position.x,
			actY = g_ship[i].position.y,
			futureZ = 0;

		if (x > actX)
			futureZ = ship_right;
		else if (x < actX)
			futureZ = ship_left;
		if (y < actY)
			futureZ = (futureZ + ship_bottom) / 2;
		else if (y > actY)
			futureZ = (futureZ + ship_top) / 2;
		g_ship_move[i]["go"] = 1;
		g_ship_move[i]["x"] = x;
		g_ship_move[i]["y"] = y;
		g_ship_move[i]["z"] = futureZ;
		g_ship_move_i += 1;
	}
	/*
	 * Animate the scene
	*/
	function	animate() {
		var i;
		requestAnimationFrame(animate);
		ship_move();
		mesh.rotation.x += 0.00001;
		mesh.rotation.y += 0.0001;
		renderer.render(scene, camera);
	}

	/*
	 * Making Ship Move
	*/
	function	ship_move() {
		for (i = 0; i < g_ship_i; i += 1) {
			if (g_ship_move[i]["go"] == 1) {
				ship = g_ship[i];
				x = g_ship_move[i]["x"];
				y = g_ship_move[i]["y"];
				z = g_ship_move[i]["z"];
				if (ship.position.x == x && ship.position.y == y) {
					g_ship_move[i]["go"] = 0;
					g_ship_move_i -= 1;
				}
				if (ship.rotation.y > z)
					zInc = 0.05;
				else
					zInc = -0.05;
				if (ship.position.x > x)
					xInc = 0.5;
				else
					xInc = -0.5;
				if (ship.position.y > y)
					yInc = 0.5;
				else
					yInc = -0.5;
				if (ship.position.x != x)
					ship.position.x = ship.position.x - xInc;
				if (ship.position.y != y)
					ship.position.y = ship.position.y - yInc;
				if (ship.rotation.y != z) {
					ship.rotation.y = (ship.rotation.y - zInc);
					ship.rotation.y = ship.rotation.y.toFixed(2);
				}
			}
		}
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
			g_ship[g_ship_i] = object3d;
			send("Add ship " + g_ship_i);
			g_ship_i += 1;
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
