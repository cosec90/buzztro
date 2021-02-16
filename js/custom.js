$('.owl-carousel_one').owlCarousel({
		loop:true,
		margin:10,
		nav:true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:3
			},
			1000:{
				items:5
			}
		}
	})

$('.owl-carousel_two').owlCarousel({
		loop:true,
		margin:10,
		nav:true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:3
			},
			1000:{
				items:4
			}
		}
	})

$(document).ready(function()
{
	"use strict";
	let navbar=document.getElementById("navigation");
	let sticky= navbar.offsetTop;
	console.log(sticky);

	function check(){
		if(window.pageYOffset >= sticky){
			navbar.classList.add("fix-nav");
		}
		else{
			navbar.classList.remove("fix-nav");
		}
	}
	window.onscroll = function(){
		check();
	}
})