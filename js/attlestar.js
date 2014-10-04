/*
 * Main.js file for test
 * By: Louis <louis@ne02ptzero.me>
*/

/*
 * Events
*/
	// MouseWheel
		//document.getElementById('main').addEventListener('mousewheel', mousewheel, false);
		//document.getElementById('main').addEventListener('DOMMouseScroll', mousewheel, false);
	// MouseDown
		//document.getElementById('main').addEventListener('mousedown', mousedown, false);
		//document.getElementById('main').addEventListener('DOMMouseDown', mousedown, false);
	//// MouseUp
		//document.getElementById('main').addEventListener('mouseup', mouseup, false);
		//document.getElementById('main').addEventListener('DOMMouseUp', mouseup, false);
	//// MouseMove
		//document.getElementById('main').addEventListener('mousemove', mousemove, false);
		/*document.getElementById('main').addEventListener('DOMMouseMove', mousemove, false);*/

		function	animate() {
			requestAnimationFrame(animate);
			Attlestar.mesh.rotation.x += .00001;
			Attlestar.mesh.rotation.y += .0001;
			Attlestar.renderer.render(Attlestar.scene, Attlestar.camera);
		}

		Attlestar = new Attlestar();

		Attlestar.setDebug(1);
		Attlestar.initialize(document.getElementById('main'));
		Attlestar.baseUrl = 'js/';
		Attlestar.addCamera(60, (window.innerWidth / window.innerHeight), 1, 10000);
		Attlestar.addWorld();
		Attlestar.addShip(1, 15, 10, -5, Attlestar.orientation.top, 0);
		Attlestar.addShip(3, 5, 5, -5, Attlestar.orientation.left, 0);
		Attlestar.grid_width = 150;
		Attlestar.grid_height = 100;
		Attlestar.density = 10;
		Attlestar.addGrid();
		animate();

	//function	move(i, x, y) {
		//var actX = g_ship[i].position.x,
			//actY = g_ship[i].position.y,
			//futureZ = 0;

		//if (x > actX)
			//futureZ = ship_right;
		//else if (x < actX)
			//futureZ = ship_left;
		//if (y < actY)
			//futureZ = (futureZ + ship_bottom) / 2;
		//else if (y > actY)
			//futureZ = (futureZ + ship_top) / 2;
		//g_ship_move[i]["go"] = 1;
		//g_ship_move[i]["x"] = x;
		//g_ship_move[i]["y"] = y;
		//g_ship_move[i]["z"] = futureZ;
		//g_ship_move_i += 1;
	//}
	/*
	 * Animate the scene
	*/
	//function	animate() {
		//var i;
		//requestAnimationFrame(animate);
		//ship_move();
		//mesh.rotation.x += 0.00001;
		//mesh.rotation.y += 0.0001;
		//renderer.render(scene, camera);
	//}

	/*
	 * Making Ship Move
	*/
	//function	ship_move() {
		//for (i = 0; i < g_ship_i; i += 1) {
			//if (g_ship_move[i]["go"] == 1) {
				//ship = g_ship[i];
				//shipc = g_ship_click[i];

				//x = g_ship_move[i]["x"];
				//y = g_ship_move[i]["y"];
				//z = g_ship_move[i]["z"];
				//if (ship.position.x == x && ship.position.y == y) {
					//g_ship_move[i]["go"] = 0;
					//g_ship_move_i -= 1;
				//}
				//if (ship.rotation.y > z)
					//zInc = 0.05;
				//else
					//zInc = -0.05;
				//if (ship.position.x > x)
					//xInc = 0.5;
				//else
					//xInc = -0.5;
				//if (ship.position.y > y)
					//yInc = 0.5;
				//else
					//yInc = -0.5;
				//if (ship.position.x != x) {
					//ship.position.x = ship.position.x - xInc;
					//shipc.position.x = shipc.position.x - xInc;
				//} if (ship.position.y != y) {
					//ship.position.y = ship.position.y - yInc;
					//shipc.position.y = shipc.position.y - yInc;
				//} if (ship.rotation.y != z) {
					//ship.rotation.y = (ship.rotation.y - zInc);
					//ship.rotation.y = ship.rotation.y.toFixed(2);
				//}
			//}
		//}
	//}

	/*
	 * Event on click Ship
	*/
	//function	click(ship) {
		//if (debug == 1)
			//send("Ship " + ship + " clicked");
	//}

/*
 * Events
*/

	/*
	 * On Mouse Wheel (Scroll)
	*/
	//function	mousewheel(e) {
		//var d = ((typeof e.wheelDelta != "undefined")?(-e.wheelDelta):e.detail);
		//var cPos = camera.position;
		//if (d == 3 && cPos.z < 200)
			//cPos.z += 0.3;
		//else if (d == -3 && cPos.z > 50)
			//cPos.z -= 0.3;
	//}

	/*
	 * On Mouse Down (Click)
	*/
	//function	mousedown(event) {
		//event.preventDefault();
		//var vector = new THREE.Vector3( ( event.clientX / window.innerWidth ) * 2 - 1, - ( event.clientY / window.innerHeight ) * 2 + 1, 0.5 );
		//projector.unprojectVector( vector, camera );
		//var raycaster = new THREE.Raycaster( camera.position, vector.sub( camera.position ).normalize() );
		//var intersects = raycaster.intersectObjects(g_ship_click);
		//if ( intersects.length > 0 ) {
			//for (i = 0; i < g_ship_i; i++) {
				//if (g_ship[i].position.x == intersects[0].object.position.x &&
						//g_ship[i].position.y == intersects[0].object.position.y) {
					//click(i);
				//}
			//}
		//}
	/*}*/
