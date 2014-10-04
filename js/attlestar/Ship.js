/*
 * Attlestar Ship function
 * By: Louis <louis@ne02ptzero.me>
*/

var object3d_tmp;
function	Ship() {

	// Globals Variables
		var		object3d;
		var		mesh;
		var		id;
		var		team;
		var		caseShip = {};
		var		life;
		var		pp;

	/*
	 * Build a ship
	 * @arguments: Type, x, y, rotation, way, baseUrl
	*/
	this.createShip = function (type, x, y, rotation, way, baseUrl, id, team) {
		var type_name = "Shuttle0";
		if (type > 2) {
			type_name = "SpaceFighter0";
			type -= 2;
		}
		var loader	= new THREE.OBJMTLLoader();
		var objUrl	= baseUrl + 'models/'+ type_name +  type +'/'+ type_name + type +'.obj';
		var mtlUrl	= baseUrl + 'models/'+ type_name +  type +'/'+ type_name + type +'.mtl';

		loader.load(objUrl, mtlUrl, function( object3d ){
			object3d.scale.multiplyScalar(1/50);
			object3d.traverse(function(object3d){
				if (object3d.material) {
					object3d.material.emissive.set('white')
				}
			});
			// Visible Ship
				object3d.position.y = y;
				object3d.position.x = x;
				object3d.position.z = 2;
				object3d.rotation.x = rotation;
				object3d.rotation.y = way;
				Attlestar.updateObject3dShip(id, object3d);
		});
		// Invisible Box (HitBox && Click)
			this.mesh = new THREE.Mesh(new THREE.BoxGeometry(10, 10, 10),
			new THREE.MeshBasicMaterial({color: 0xffffff, transparent: true, opacity: 0.01}));
			this.mesh.position.y = y;
			this.mesh.position.x = x;
			this.mesh.position.z = 2;
			this.team = team;
			this.id = id;
	}

	this.set3dObject = function(object3d) {
		this.object3d = object3d;
			send("here2");
	}
}
