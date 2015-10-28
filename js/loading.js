var LoadingImg = [
	"../imgs/bg.jpg",
	"../imgs/btn-1.png",
	"../imgs/btn-2.png",
	"../imgs/coupon-1.png",
	"../imgs/coupon-2.png",
	"../imgs/coupon-3.png",
	"../imgs/coupon-bg.png",
	"../imgs/logo.png",
	"../imgs/mask.png",
	"../imgs/share_tips.png",
	"../imgs/qrcode.png"
]


function LoadFn ( arr , fn , fn2){
		var loader = new PxLoader();
		for( var i = 0 ; i < arr.length; i ++)
		{
			loader.addImage(arr[i]);
		};
		
		loader.addProgressListener(function(e) {
				var percent = Math.round( e.completedCount / e.totalCount * 100 );
				if(fn2) fn2(percent)
		});	
		
		
		loader.addCompletionListener( function(){
			if(fn) fn();	
		});
		loader.start();	
}



function loading(allAmg){
	LoadFn(allAmg , function (){

		$("img").each(function(){ 
			$(this).attr("src",$(this).attr("sourcesrc"));
		})

		TweenMax.fromTo(document.querySelector('.bg'), 2, {
	        scale:3,
	        autoAlpha:0,
	        blurFilter:{blurX:50, blurY:10},
	        opacity:0
	    }, {
	        autoAlpha:1,
	    	scale:1,
	    	opacity:1,
	        ease: Elastic.easeOut,
	        easeParams: [0.2, 0.7],
	        force3D: false,
	        onComplete:function(){
	        	$(".footer").animate({"opacity":1});
	        }
	    });


	    TweenMax.fromTo(document.querySelector('.loading'), 0.9, {
	        scale:1,
	        autoAlpha:0,
	        blurFilter:{blurX:50, blurY:10},
	        opacity:1
	    }, {
	    	scale:2,
	    	opacity:0,
	        ease: Elastic.easeOut,
	        easeParams: [0.2, 0.7],
	        force3D: false,
	        onComplete:function(){


	        	TweenMax.fromTo(document.querySelector('#dreambox'), 3.6, {
			        x: 0,
			        y:-10,
			        z:0,
			        rotationY:0,
			        rotationX:0,
			        rotationZ:0,
			        scale:1,
			        autoAlpha:0,
			        blurFilter:{blurX:50, blurY:10},
			        opacity:0
			    }, {
			        delay: 0.3,
			        autoAlpha:1,
			    	rotationY:0,
			    	rotationX:0,
			    	rotationZ:0,
			    	scale:1,
			    	opacity:1,
			        x: 0,
			        y: 0,
			        z: 0,
			        ease: Elastic.easeOut,
			        easeParams: [0.2, 0.7],
			        force3D: false,
			        onComplete:function(){

			        }
			    });


	        	TweenMax.fromTo(document.querySelector('.ticket'), 2, {
				        rotationY:100,
				        rotationX:100,
				        rotationZ:100,
				        scale:4,
				        autoAlpha:0,
				        blurFilter:{blurX:50, blurY:10},
				        opacity:0
				    }, {
				        autoAlpha:1,
				    	rotationY:0,
				    	rotationX:0,
				    	rotationZ:0,
				    	scale:1,
				    	opacity:1,
				        ease: Elastic.easeOut,
				        easeParams: [0.2, 0.7],
				        force3D: false,
				        onComplete:function(){
				        	
				        }
				    });



	        }
	    });

	    

  		
	} , function (p){
		//$("#loading span").html("<i>"+p+"%</i>");
		//console.log(p);
	});
}




