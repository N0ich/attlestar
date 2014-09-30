/*
 * Main.js file for test
 * By: Louis <louis@ne02ptzero.me>
*/


/*
 * Base Settings
*/
	// Globals
		var renderer, onRenderFcts, scene, camera, fov;

	// Settings
		// Initialize variables
			renderer	= new THREE.WebGLRenderer();
			onRenderFcts= [];
			scene	= new THREE.Scene();
			camera	= new THREE.PerspectiveCamera(50, window.innerWidth / window.innerHeight, 1, 100);
			fov = 100
		// Create the scene
			renderer.setSize( window.innerWidth, window.innerHeight );
			document.body.appendChild(renderer.domElement);
		// Camera FOV
			camera.position.z = 10;
			camera.position.y = 5;
			camera.fov = fov;
			camera.updateProjectionMatrix();

	// Main function
		;(function(){
			// Lights
				// Global Light
					var object3d	= new THREE.AmbientLight(0x101010)
					object3d.name	= 'Ambient light'
					scene.add(object3d)

				// Source Light
					var object3d	= new THREE.DirectionalLight('white', 0.225)
					object3d.position.set(2.6,1,3)
					object3d.name	= 'Back light'
					scene.add(object3d)
		})()

		// Add the ship
			THREEx.SpaceShips.loadSpaceFighter01(function(object3d){
				var x, y;
				//for (x = -1, y = 0.5; x > -6; x = x - 4, y = y + 0.5) {
					object3d.position.x	= -1
					object3d.position.y	= 0.5
					scene.add(object3d)
				//}
			})

		// Render Scene
			onRenderFcts.push(function(){
				renderer.render( scene, camera );
			})

		// Main Loop
			var lastTimeMsec= null
			requestAnimationFrame(function animate(nowMsec){
				requestAnimationFrame( animate );
				lastTimeMsec	= lastTimeMsec || nowMsec-1000/60
				var deltaMsec	= Math.min(200, nowMsec - lastTimeMsec)
				lastTimeMsec	= nowMsec
				onRenderFcts.forEach(function(onRenderFct){
					onRenderFct(deltaMsec/1000, nowMsec/1000)
				})
			})
