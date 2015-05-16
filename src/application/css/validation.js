	

	function validation(max)
	{
		for (var i = 0; i <max; i++) {
			var x = "txtcant"+i;
			var y = "txtdesc"+i;
			x = document.getElementById(x).value;
			y = document.getElementById(y).value;
			if(x == "" || y == ""){
				alert("campos vacios");
				return false;
			}
		};

	}