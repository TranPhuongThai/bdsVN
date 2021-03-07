$(document).ready(function(){
	$("#browser li span.folder").click(function(){
	   $("#browser li.open").addClass("closed");
	   $("#browser li.open").removeClass("open");
	   $(this).parent().removeClass("closed");
	   $(this).parent().addClass("open");
       return false;
	});
});