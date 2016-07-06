$(document).ready(function(){
	$("form").css("height",$("#slideForm .part1").height());
	$("form div.buttonBig, .step2").on("click",function(){
		$("#slideForm").css('left','-100vw');
		$("form").css("height",$("#slideForm .part2").height());
		$(".step1 div, .step2 div").toggleClass("nonActive");
	});
	$(".step1").on("click",function(){
		$("#slideForm").css('left',0);
		$("form").css("height",$("#slideForm .part1").height());
		$(".step1 div, .step2 div").toggleClass("nonActive");
	});
	$(".close").on("click", function(){
       $(".blocPop").removeClass("showPop"); // Fermer les blocs ouverts
       $("#main").removeClass("limitHeight");
       $("#main").css("height", "auto");
   });
   $("#btnMentions").on("click", function(){ // Afficher le bloc mentions légales (Animation)
      $("#mentions").addClass("showPop");
      $("#main").addClass("limitHeight");
      $("#main").css("height", $(".showPop").height());
   });
});

function cutText(){ // Fonction pour animer le loader (pas encore disponible)
    var word = "CHARGEMENT";
    var i = 0;
	setInterval(function(){
		var length = word.length;
		if(i <= length){
            $(".cutText").html(word.substring(0, i));
			i++;
		}
	}, 20);
}