function AddCookie (idx) {

	idx = parseInt(idx);
	var cook = document.cookie;

	//alert (cook);

	var count = 0;
	var x='';
	var y='cuenta';
	var yy=' cuenta';

	if (cook.length > 0) {
		carr = cook.split(';');
		for (var i=0; i<carr.length; i++) {
			x = String(carr[i].split('=')[0]);
			if (x==y || x==yy) { count = parseInt(carr[i].split('=')[1]); }
		}	
	}

	count = count+1;

	document.cookie = "cuenta="+count;
	document.cookie = "art"+count+"="+idx;

	//alert(document.cookie);
	alert("Articulo agregado al carrito");
}

function RemoveCookie (idx) {
	alert(idx);
	//alert(document.cookie);
	document.cookie = "art"+idx+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
	//alert(document.cookie);
	alert("Artículo quitado del carrito");
}