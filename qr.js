$(document).ready(function()
{
	$("#create").click(function()
	{
		$.get("api/index.php", 
			{action: "createNewQueue", name: "test", time: 45},
			function(data)
			{
				console.log(data);
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
		alert("polling timer set");
});

function poll()
{
}
