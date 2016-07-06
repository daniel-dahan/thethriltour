var random;
var inset = 0;
var idAvantage = 1;
var half = $("#avantages p").size() / 2;
var video = $("video");

$(document).ready(function(){
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
   $("#avantages p").each(function(){
	   /*random = Math.random() * (150 - 0);
	   random = Math.round(random / 10) * 10;
	   $(this).css("margin-left", random + "px");*/
	   $(this).attr("id", ''+idAvantage+'');
	   $(this).css("margin-left", inset + "px");
	   idAvantage ++;
	   if( $(this).attr("id") < half){
		if( $(this).attr("id") < half - 1){
			inset += 30; 
		}
		else if( $(this).attr("id") > half - 1 && $(this).attr("id") < half + 1){
			inset += 10; 
		}
		else{
			inset += 50; 
		}
	   }
	   else{
		if( $(this).attr("id") <= half + 1){
			inset -= 10; 
		}
		else{
			inset -= 30; 
		}
	   }
   })
   $("video, #play").on('click',function(){
    if (video[0].paused || video[0].currentTime == 0) {
      video[0].play();
      $("#festivalDetail .infos").addClass("play");
      $("#play").fadeOut(300);
    }
    else{
      video[0].pause();
      $("#play").fadeIn(300);
      $("#festivalDetail .infos").removeClass("play");
    }
   });
});

$(window).load(function(){
  $('#containerVideo').css('height',$('#containerVideo video').height() + 'px');
});
$(window).resize(function(){
	$('#containerVideo').css('height',$('#containerVideo video').height() + 'px');
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