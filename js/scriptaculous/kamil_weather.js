$(document).ready(function (){
	var last = $("#dataWeather #lastDate").html();
	var dateLast = new Date(last);
	dateLast.setTime(dateLast.getTime() + 600000);
	var dateNow = new Date();

	if(dateNow >= dateLast || last == ""){
		$(function(){
			var t = $('#dataWeather #temp');
			var p = $('#dataWeather #pressure');
			var w = $('#dataWeather #wind');
			var l = $('#dataWeather #lastDate');

			
			$.ajax({  
				type: 'POST',  
				url: 'update',
				dataType: 'json',  
				success: function(args) {
					t.html(args.temp);
					p.html(args.pressure);
					w.html(args.wind);
					location.reload();
				}  
			});
		});
	}
	else 
		{
			$(function countTime(){

				var miliSec = dateLast.getTime() - dateNow.getTime();
				miliSec = Math.floor(miliSec/1000);

			    var count = miliSec;
			    var counter = setInterval(timer, 1000);
			    function timer()
			    {
			        --count;
			        var minutes = Math.floor(count / 60);
			        var sec = count % 60;
			        if(sec<10) sec = '0' + sec;
			        var out = "Kolejna aktualizacja za: " + minutes + ':' + sec;
			        $("#timer").html(out);
			        if( count <= 0)
			        {
					    clearInterval(counter);
					    var t = $('#dataWeather #temp');
						var p = $('#dataWeather #pressure');
						var w = $('#dataWeather #wind');
						var l = $('#dataWeather #lastDate');

			            $.ajax({  
						    type: 'POST',  
						    url: 'update',
						    dataType: 'json',  
						    success: function(args) {
						        location.reload();
						    } 
						});
			        }
			    }
			});	
		}

});
