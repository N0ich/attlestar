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
			fov = 60
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
					object3d.position.x	= -1
					object3d.position.y	= 0.5
					scene.add(object3d)
			})

			THREEx.SpaceShips.loadSpaceFighter02(function(object3d){
				var x, y;
					object3d.position.x	= 2
					object3d.position.y	= 2
					scene.add(object3d)
			})

			THREEx.SpaceShips.loadSpaceFighter03(function(object3d){
				var x, y;
					object3d.position.x	= -2
					object3d.position.y	= 2
					scene.add(object3d)
			})

		// Mouse Control
			var mouse= {x : 0, y : 0}
			document.addEventListener('mousemove', function(event){
				mouse.x= (event.clientX / window.innerWidth ) - 0.5
				mouse.y= (event.clientY / window.innerHeight) - 0.5
			}, false)
			onRenderFcts.push(function(delta, now){
				camera.position.x += (mouse.x*5 - camera.position.x) * (delta*3)
				camera.position.y += (mouse.y*5 - camera.position.y) * (delta*3)
				camera.lookAt( scene.position )
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
