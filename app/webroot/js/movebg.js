$(document).ready(function() {

	//jqfloat.js script
	// $('.movebg').each(function() {
	// 	$(this).jqFloat({
	// 		width:Math.floor(Math.random()*10)*10,
	// 		height:40,
	// 		speed:Math.floor(Math.random()*10)*600
	// 	});
	// });

	$('#object1').jqFloat({
		width: 0,
		height: 50,
		speed: 2500,
		minHeight: 100
	});

	$('#object2').jqFloat({
		width: 20,
		height: 20,
		speed: 3000,
		minHeight: 100
	});

	$('#object3').jqFloat({
		width: 0,
		height: 20,
		speed: 3000,
		minHeight: 100
	});

	$('#object4').jqFloat({
		width: 0,
		height: 20,
		speed: 5000,
		minHeight: 100
	});

	$('#object5').jqFloat({
		width: 20,
		height: 20,
		speed: 3000,
		minHeight: 100
	});

	$('#object6').jqFloat({
		width: 20,
		height: 20,
		speed: 3000,
		minHeight: 100
	});

	$('#object7').jqFloat({
		width: 0,
		height: 20,
		speed: 3000,
		minHeight: 100
	});

});
