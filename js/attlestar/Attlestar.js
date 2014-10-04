/*
 * Attlestar Game Main Class
 * By: Louis <louis@ne02ptzero.me>
*/

function	Attlestar() {

	// Globals Variables
		var		grid_height, grid_width, density;
		var		baseUrl = "js/";
		var		renderer, scene, camera, fov, mesh, projector;
		var		mouseX = 0, mouseY = 0, mouseDown = false;
		var		orientation;
		var		g_ship = [];
		var		g_ship_click = [];
		var		g_ship_move = [];
		var		g_ship_i = 0;
		var		g_ship_move_i = 0;
		var		is_debug = 0;

	/*
	 * Set Debug On or Off
	 * @arguments: 1 / 0
	*/
	this.setDebug = function(val) {
		this.is_debug = val;
	}

	/*
	 * Debug function
	*/
	this.debug = function(message) {
		if (this.is_debug == 1)
			send(message);
	}

	/*
	 * Set base url
	 * @arguments: Url Path
	*/
	this.setBaseUrl = function(url) {
		this.url = val;
		this.debug("Set base URL to " + url);
	}

	/*
	 * Initialize WEBGL, three js and scene
	 * @arguments: Object element (document.body)
	*/
	this.initialize = function(element) {
		this.renderer = new THREE.WebGLRenderer({ alpha: true, antialias: false});
		this.debug("Initializing WEBGL");
		this.renderer.setSize(window.innerWidth, window.innerHeight);
		element.appendChild(this.renderer.domElement);
		this.scene = new THREE.Scene();
		this.debug("Add scene");
		this.orientation = {left: "4.5", bottom: "6.2", right: "7.8", top: "9.4"};
		this.g_ship_i = 0;
		this.g_ship_move_i = 0;
		this.is_debug = 0;
		this.g_ship = [];
		this.g_ship_click = [];
		this.g_ship_move = [];
	}

	/*
	 * Animation function (Frame request)
	*/
	this.animate = function() {
		//this.ship_move();
		this.mesh.rotation.x += 0.00001;
		this.mesh.rotation.y += 0.0001;
		this.renderer.render(this.scene, this.camera);
	}

	/*
	 * Adding a camera to the scene
	 * @arguments: FOV, aspect (width / height), near, far
	*/
	this.addCamera = function(fov, aspect, near, far) {
		this.camera = new THREE.PerspectiveCamera(fov, aspect, near, far);
		this.camera.position.set(0, 0, 1000);
		this.camera.position.x = 0;
		this.camera.position.y = 0;
		this.camera.position.z = 100;
		this.scene.add(this.camera);
		this.debug("Add Camera");
	}

	/*
	 * Adding Sphere World
	*/
	this.addWorld = function() {
		var geometry = new THREE.SphereGeometry(200, 32, 32);
		var worldtexture = THREE.ImageUtils.loadTexture(this.baseUrl + 'img/star.png')
		var material = new THREE.MeshBasicMaterial({ 
			map: worldtexture,
			side: THREE.DoubleSide
		});
		this.mesh = new THREE.Mesh(geometry, material);
		this.scene.add(this.mesh);
		this.debug("Add World");
	}

	/*
	 * Adding a Source Light to the scene
	*/
	this.addLight = function() {
		var light = new THREE.DirectionalLight(0xffffff, 1.0);
		light.position.set(0, 0, 400);
		this.scene.add(light);
		this.debug("Add light");
	}

	/*
	 * Update Object3D of a Ship
	 * @arguments: id, object3d
	*/
	this.updateObject3dShip = function (id, object3d) {
		this.g_ship[id].object3d = object3d;
		this.scene.add(object3d);
	}

	/*
	 * Add Ship
	 * @arguments: type, x, y, rotation, way
	*/
	this.addShip = function(type, x, y, rotation, way, team) {
		var		ship = new Ship();

		ship.createShip(type, x, y, rotation, way, this.baseUrl, this.g_ship_i, team);
		this.scene.add(ship.mesh);
		this.g_ship.push(ship);
		this.g_ship_i += 1;
		this.debug("Add ship[" + (g_ship - 1) + "] = {x: "+ x +", y: "+ y +"}, Team: " + team);
	}

	/*
	 * Add a grid on the map
	*/
	this.addGrid = function() {
		var		base = this.grid_width / 2;
		var material = new THREE.LineBasicMaterial({
			color: 0xffffff,
			transparent: true,
			opacity: 0.2
		});
		var i;
		// Vertical lines
			for (i = -(this.grid_height / 2); i < (base - 20); i += this.density) {
				var geometry = new THREE.Geometry();
				geometry.vertices.push(new THREE.Vector3(-(base), (i), 1));
				geometry.vertices.push(new THREE.Vector3(base, (i), 1));
				var line = new THREE.Line(geometry, material);
				this.scene.add(line);
			}

		// Horizontal lines
			for (i = -(this.grid_width / 2); i < (this.grid_width - 70); i += this.density) {
				var geometry = new THREE.Geometry();
				geometry.vertices.push(new THREE.Vector3(i, -(this.grid_width / 2) + 25, 1));
				geometry.vertices.push(new THREE.Vector3(i, (this.grid_width / 2) - 25, 1));
				var line = new THREE.Line(geometry, material);
				this.scene.add(line);
			}
		this.debug("Add grid");
	}

	/*
	 * Add a projector
	*/
	this.addProjector = function() {
		this.projector = new THREE.Projector();
		this.debug("Add projector");
	}
}
