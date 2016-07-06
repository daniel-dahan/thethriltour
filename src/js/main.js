var bSend = false;
var bCircleOpen = false;
var bHasClick = false;
var bHover = false;
var video = $("video");
var idButton = 0;
var opened = false;

$(document).ready(function(){
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
	$('#intro').on('mousewheel', function(e) {
		openCircle();
	});
	 $("#intro").swipe( {
		swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
			openCircle();
		}
	});
	video.bind('ended', function(){ 
		$("#intro").css("top","-100%");
	    $(".maskVideo").fadeOut(300);
	    $("body").css("overflow","auto");
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
	$(".containerSvg").hover(
	   	function(){
	   	  if(opened == true){
			  if(bHover == false) {
					$(".secondCircle").attr("src", "../../media/img/circle-" + idButton + ".svg");
				}
		      bHover = true;
			  $(".centerFestival").css("transform","scale(1)");
			  $(".centerFestival").addClass("changementFest");
		   	  $(".firstCircle").attr("src","../../media/img/grey-big.svg");
			  $(".firstCircle, .secondCircle, .openCircle").css({
				'animation-name':'rotateOnly',
				'-webkit-animation-name':'rotateOnly',
			  });
			  $("body").addClass("showCircle");
			  $(".centerFestival").addClass("changementFest");
			  bCircleOpen = true;
			}
		},
		function(){
		  bHover = false;
		  $(".secondCircle").attr("src","../../media/img/blue-circle.svg");
		  $(".firstCircle").attr("src","../../media/img/grey-circle.svg");
		  $("body").removeClass("showCircle");
		  $(".centerFestival").removeClass("changementFest");
		  $(".centerFestival").css("transform","scale(0)");
			bCircleOpen = false;
		}
	);
	$(".bigCircle").hover(
		function(){
			bHasClick = true;
			idButton = $(this).parent('.containerBtn').attr('id').replace('btn-', '' );
			switchFestival(idButton);
		},
		function(){
		}
	);
});

$("form").submit(function(e){ // Quand on envoie le formulaire
	e.preventDefault(); // Le navigateur n'envoie pas le formulaire (ACTION)  
	if (bSend == false){
		$.ajax({ // Appel Ajax pour envoi de mail sans refresh
		   url : '/php/mail.php',
		   type : 'POST',
		   data : 'mail=' + $(".mail").val(),
		   success : function(code_html, statut){
			   if(code_html.length != 0){
					$(".mail").val(code_html);
			   }
			   else{
					$(".mail").attr("readonly","readonly");
					$(".mail").val("Merci de vous être inscrit !")
					bSend = true;
			   }
		   },

		   error : function(resultat, statut, erreur){
				$(".mail").val("Erreur pendant l'enregistrement");
		   }
		});
	}
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

var cachedRequest = [];
var cachedResult = [];
function switchFestival(idButton){
	if (bHover == true) {
		$(".secondCircle").attr("src", "../../media/img/circle-" + idButton + ".svg");
	}
	$(".containerSvg").attr("class","containerSvg");
	$(".containerSvg").addClass("color" + idButton);
	$(".containerBtn").removeClass("selectFest");
	$("#btn-" + idButton).addClass("selectFest");

	var ajax = true;
	for(var i = 0; i < cachedRequest.length; i++) {
		if(cachedRequest[i] == idButton) {
			ajax = false;
			handleFestivalReturn(cachedResult[i]);
		}
	}

	if (ajax) {
		$.ajax({ // Appel Ajax sans refresh
			url : 'src/include/festival.php',
			type : 'POST',
			data : 'idButton=' + idButton,
			success : function(code_html, statut) {
				cachedRequest.push(idButton);
				cachedResult.push(code_html);
				handleFestivalReturn(code_html, statut)
			},
			error : function(resultat, statut, erreur){
			}
		});
	}
}

function handleFestivalReturn ( code_html, statut ) {
	//$('.contentCircle').children().addClass("glitch");
	//$('.contentCircle h3').addClass("glitchStrong");

	//setTimeout(function () {
		// On récupère le p date
		var sParagrapheDate = code_html;
		// On remplace le p date
		$('.contentCircle').html(sParagrapheDate);
		$(".centerFestival").toggleClass("changementFest", "changementFest");
		if(bHover == true){
			$(".centerFestival").css("transform","scale(1)");
		}
		//$('.contentCircle').children().removeClass("glitch");
		//$('.contentCircle h3').removeClass("glitchStrong");
		//$('.contentCircle').children("h3").addClass("glitch");
	//}, 200);
}

function openCircle(){
	$("#intro").css("top","-100%");
	$(".maskVideo").fadeOut(300);
	$("body").css("overflow","auto"); 
	video[0].pause();
	setTimeout(function(){
		$(".baseline").css({
	    	'top': 0,
	    	'opacity': 1
	    });
	}, 500);
	setTimeout(function(){
		$("footer, #centerSvg").css({
	    	'opacity': 1
	    });
	}, 3000);
	setTimeout(function(){
		autoSwitchFestival(idButton);
		$("body").addClass("showCircle");
		if(bHover == false) {
			$(".secondCircle").attr("src", "../../media/img/circle-" + idButton + ".svg");
		}
		bHover = true;
		$(".centerFestival").css("transform","scale(1)");
		$(".centerFestival").addClass("changementFest");
	   	$(".firstCircle").attr("src","../../media/img/grey-big.svg");
		$(".firstCircle, .secondCircle, .openCircle").css({
			'animation-name':'rotateOnly',
			'-webkit-animation-name':'rotateOnly',
		});
		$("body").addClass("showCircle");
		$(".centerFestival").addClass("changementFest");
		opened = true;
		bCircleOpen = true;
	}, 5000);
}

function autoSwitchFestival(idButton){
	var onOpen = 0;
	setInterval(function() {
		if(bHasClick == true){
			return;
		}
		if(bHover == true){
			if(onOpen !=0){
				switchFestival(idButton);
				idButton++;
				if (idButton > 2){
					idButton = 0;
				}
			}
			else{
				onOpen = 1;
				idButton++;
			}
		}
	}, 4000);
}