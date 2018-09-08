
var language = window.navigator.userLanguage || window.navigator.language;

function tumblrPrevent(element){
	var properties = element.getBoundingClientRect();
	var top = properties.width + properties.top;
	var left = properties.left - 30; 
	d3.select("#sns").append("div")
	.attr("style","font-size:2em;font-family: 'Arizonia';position:fixed; left:" + left + "px;top:" + top + "px")
	.html("Coming soon!");
}

//alert(window.innerWidth + "/" + window.innerHeight);

$(document).ready(function() {


	$(".gallery").chosen({
		max_selected_options:1,
		search_contains : true,
	});


});
