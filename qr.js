$(document).ready(function()
{
	$("#create").click(function()
	{
		$.get("api/index.php", 
			{action: "createNewQueue", name: "test", time: 20},
			function(data)
			{
				//console.log(data);
				queuer("http://localhost/qr/?" + data.id);
				//$.cookie(data.token);
			}, "json");
		//display qr with link from data
	});
	$("#join").click(function()
	{
		//qr
		/*
		$.get("api/index.php", 
			{action: "createNewQueue", name: "test", time: 45},
			function(data)
			{
				console.log(data);
			}, "json");
			*/
	});

	if(status == "polling")
	{
		$.get("api/index.php", 
			{id: queue},
			function(data)
			{
				//console.log(data);
				queuer("http://localhost/qr/?" + data.id);
				//$.cookie(data.token);
			}, "json");
		setInterval(poll, 1000);
	}
});

function poll()
{
	$.get("api/index.php", 
		{action: "createNewQueue", name: "test", time: 20},
		function(data)
		{
			//console.log(data);
			queuer("http://localhost/qr/?" + data.id);
			//$.cookie(data.token);
		}, "json");
}

function queuer(link)
{
    options = 
	{
	// render method: 'canvas', 'image' or 'div'
	render: 'div',

	// version range somewhere in 1 .. 40
	minVersion: 1,
	maxVersion: 40,

	// error correction level: 'L', 'M', 'Q' or 'H'
	ecLevel: 'L',

	// offset in pixel if drawn onto existing canvas
	left: 0,
	top: 0,

	// size in pixel
	size: 400,

	// code color or image element
	fill: '#000',

	// background color or image element, null for transparent background
	background: null,

	// content
	text: link,

	// corner radius relative to module width: 0.0 .. 0.5
	radius: 0,

	// quiet zone in modules
	quiet: 0,

	// modes
	// 0: normal
	// 1: label strip
	// 2: label box
	// 3: image strip
	// 4: image box
	mode: 0,

	mSize: 0.1,
	mPosX: 0.5,
	mPosY: 0.5,

	label: 'no label',
	fontname: 'sans',
	fontcolor: '#000',

	image: null
    };
    $("#client-qr").qrcode(options);
}

