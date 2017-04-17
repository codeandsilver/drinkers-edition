(function( $ ) {
	'use strict';	

	$(document).ready(function(){
        $('.heart').click(function(){
        	var id = $(this).attr("data-postid");        	
            $.ajax({
                type: 'POST',
                data: "postid=" + id + "&userid=" + userid,
                url: '/drinkers/wp-content/plugins/drinkers-edition/script.php',                
                success: function(data) {                    
                   $('#heart-'+id).css("color", "#d90000");
                   $('#heart-'+id).css("background-color", "#fff");                   
                }
            });
   	});
   	
   	$('.hearted').click(function(){
        	var id = $(this).attr("data-postid");        	
            $.ajax({
                type: 'POST',
                data: "postid=" + id + "&userid=" + userid,
                url: '/drinkers/wp-content/plugins/drinkers-edition/delete.php',                
                success: function(data) {                    
                   $('#hearted-'+id).css("color", "#cb6d6d");
                   $('#hearted-'+id).css("background-color", "#fff");                   
                }
            });
   	});
   	
	});



})( jQuery );
