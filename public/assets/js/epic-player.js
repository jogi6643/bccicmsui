	var player = "";
	var promo_player = "";
	$('#promoplayer-modal').on({"hide.uk.modal": function(){
        if(typeof(promo_player) == 'object')
			promo_player.stop();
    	}
    });
	$("#player a").click(function(){
		console.log(typeof(promo_player));
		if(typeof(promo_player) == 'object')
			promo_player.pause();
		if(typeof(player) == 'object')
			player.remove();
		var cid = $(this).attr('data-cid');
	  	cid = cid.substring(3).slice(0,-3);
	  	var tp = $(this).attr('data-type');
	  	var title = $(this).attr('data-title');
	  	var setplytitle = $(this).attr('setplaytitle');
	  	if(tp == 'SHOW' || tp=='SEASON')
	  		tp = "promo";
	  	else
	  		tp = "video";
	  	var st = 0
	  	if($(this).attr('data-st'))
	  		st = $(this).attr('data-st');
	  	var cover = $(this).find(".player_cover").attr('src');
	  	var cont_title = $(this).find(".cont_title").text();
	  	$.ajaxSetup({
	          headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	        });
	  	$.ajax({
		  	url: window.location.protocol+"//"+window.location.hostname+"/ajaxplayer/",
		  	data:{cid:cid,action:"st",type:tp,v:Math.random()},
		  	type:"POST",
		  	cache: false,
		  	success: function(result){
		  		var result = $.parseJSON(result);
		  		if(result.success == true){
		  			var file = "";
		  			if(tp == 'promo')
		  				file = result.url.promo_url;
		  			else
		  				file = result.url.video_url;
		  			var tracks = [];
		  			if(result.subtitles && result.subtitles.length > 0){
		  				var subtitle_obj = result.subtitles[0];
		  				tracks.push({"file":subtitle_obj.file,"label":subtitle_obj.lang,"default":false,"kind":"captions"}); 
		  			}
			         player = jwplayer("epicpl");
					  player.setup({
					  	 playlist: [{
					        file: file,
					        title:cont_title,
					        image: cover,
					        tracks: tracks,
					        mediaid:result.media_id
					    }],
					    "ga":{label: "title"},
					    "width":"100%",
					    "aspectratio":"16:9",
					    "autostart":true,
					  	"skin":{
					  		"url":window.location.protocol+"//"+window.location.hostname+"/css/jwepic_web.css?v=17",
					  		"name":"epic"
					  	},
					  	"displaytitle":false,
					  	"displaydescription":false,
					  }).on('ready',function(){
					  	if(sitedevice == 'mobile'){
					  		player.addButton('<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-ff" viewBox="5 5 30 30" focusable="false"><path class="cls-1" d="M20.49,8.54,17.27,5.32,18.6,4,24,9.39,18.6,14.78l-1.32-1.32,2.93-2.93A11.52,11.52,0,1,0,33.54,21.87h1.89A13.43,13.43,0,1,1,20.49,8.54Z"/><path class="cls-1" d="M17.91,26.6H19.8V17.14H17.93a9.74,9.74,0,0,1-1.13,1.18,3.22,3.22,0,0,1-1.73.85v1.61a7.56,7.56,0,0,0,2.84-1.42Z"/><path class="cls-1" d="M25.22,26.46a2.61,2.61,0,0,0,2.17-.95c.66-.76.95-2.08.95-3.88s-.28-3.12-.95-3.88a2.5,2.5,0,0,0-2.17-.95,2.61,2.61,0,0,0-2.17.95c-.66.76-.95,2.08-.95,3.88a6.18,6.18,0,0,0,.85,3.78A3,3,0,0,0,25.22,26.46Zm-.95-7.19a1.42,1.42,0,0,1,.38-.76.69.69,0,0,1,.57-.19,1.34,1.34,0,0,1,.57.19c.19.09.28.38.38.85a11.08,11.08,0,0,1,.19,2.27A12.24,12.24,0,0,1,26.16,24a1.42,1.42,0,0,1-.38.76,1.34,1.34,0,0,1-.57.19,1.34,1.34,0,0,1-.57-.19c-.19-.09-.28-.38-.38-.85a10.38,10.38,0,0,1-.19-2.27A7.5,7.5,0,0,1,24.27,19.27Z"/></svg>', "Forward 10 Secs", function(){player.seek(player.getPosition()+10)}, 'jw-ff-btn', 'jw-ff-btn').addButton('<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-rw" viewBox="8 8 30 30"><path class="cls-1" d="M23.51,10.89l3.22-3.22L25.4,6.35,20,11.74l5.39,5.39,1.32-1.32L23.8,12.87A11.52,11.52,0,1,1,10.46,24.22H8.57A13.43,13.43,0,1,0,23.51,10.89Z"/><path class="cls-1" d="M17.5,29h1.89V19.49H17.53a9.74,9.74,0,0,1-1.13,1.18,3.22,3.22,0,0,1-1.73.85v1.61a7.56,7.56,0,0,0,2.84-1.42Z"/><path class="cls-1" d="M24.81,28.81A2.61,2.61,0,0,0,27,27.86c.66-.76.95-2.08.95-3.88s-.28-3.12-.95-3.88a2.5,2.5,0,0,0-2.17-.95,2.61,2.61,0,0,0-2.17.95c-.66.76-.95,2.08-.95,3.88a6.18,6.18,0,0,0,.85,3.78A3,3,0,0,0,24.81,28.81Zm-.95-7.19a1.42,1.42,0,0,1,.38-.76.69.69,0,0,1,.57-.19,1.34,1.34,0,0,1,.57.19c.19.09.28.38.38.85A11.08,11.08,0,0,1,25.95,24a12.24,12.24,0,0,1-.19,2.36,1.42,1.42,0,0,1-.38.76,1.34,1.34,0,0,1-.57.19,1.34,1.34,0,0,1-.57-.19c-.19-.09-.28-.38-.38-.85A10.38,10.38,0,0,1,23.68,24,7.5,7.5,0,0,1,23.87,21.62Z"/></svg>', "Rewind 10 Secs", function(){if(player.getPosition() > 10) player.seek(player.getPosition()-10); else player.seek(0);}, 'jw-rw-btn', 'jw-rw-btn');
							$("#epicpl .jw-icon-rewind").remove();
							$("#epicpl .jw-icon-next").remove();
							$("#epicpl .jw-button-container .jw-ff-btn").insertAfter('#epicpl .jw-display-icon-display');
							$("#epicpl .jw-button-container .jw-rw-btn").insertBefore('#epicpl .jw-display-icon-display');
							$("#epicpl .jw-display-icon-next").remove();
							$("#epicpl .jw-display-icon-rewind").remove();
							$("#epicpl .jw-icon-volume").remove();
							$("#epicpl .jw-icon-playback").remove();
							//$("#epicpl .jw-icon-settings").remove();
					  	}else{
					    player.addButton('<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-ff" viewBox="5 5 30 30" focusable="false"><path class="cls-1" d="M20.49,8.54,17.27,5.32,18.6,4,24,9.39,18.6,14.78l-1.32-1.32,2.93-2.93A11.52,11.52,0,1,0,33.54,21.87h1.89A13.43,13.43,0,1,1,20.49,8.54Z"/><path class="cls-1" d="M17.91,26.6H19.8V17.14H17.93a9.74,9.74,0,0,1-1.13,1.18,3.22,3.22,0,0,1-1.73.85v1.61a7.56,7.56,0,0,0,2.84-1.42Z"/><path class="cls-1" d="M25.22,26.46a2.61,2.61,0,0,0,2.17-.95c.66-.76.95-2.08.95-3.88s-.28-3.12-.95-3.88a2.5,2.5,0,0,0-2.17-.95,2.61,2.61,0,0,0-2.17.95c-.66.76-.95,2.08-.95,3.88a6.18,6.18,0,0,0,.85,3.78A3,3,0,0,0,25.22,26.46Zm-.95-7.19a1.42,1.42,0,0,1,.38-.76.69.69,0,0,1,.57-.19,1.34,1.34,0,0,1,.57.19c.19.09.28.38.38.85a11.08,11.08,0,0,1,.19,2.27A12.24,12.24,0,0,1,26.16,24a1.42,1.42,0,0,1-.38.76,1.34,1.34,0,0,1-.57.19,1.34,1.34,0,0,1-.57-.19c-.19-.09-.28-.38-.38-.85a10.38,10.38,0,0,1-.19-2.27A7.5,7.5,0,0,1,24.27,19.27Z"/></svg>', "Forward 10 Secs", function(){player.seek(player.getPosition()+10)}, 'jw-ff-btn', 'jw-ff-btn').addButton('<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-rw" viewBox="8 8 30 30"><path class="cls-1" d="M23.51,10.89l3.22-3.22L25.4,6.35,20,11.74l5.39,5.39,1.32-1.32L23.8,12.87A11.52,11.52,0,1,1,10.46,24.22H8.57A13.43,13.43,0,1,0,23.51,10.89Z"/><path class="cls-1" d="M17.5,29h1.89V19.49H17.53a9.74,9.74,0,0,1-1.13,1.18,3.22,3.22,0,0,1-1.73.85v1.61a7.56,7.56,0,0,0,2.84-1.42Z"/><path class="cls-1" d="M24.81,28.81A2.61,2.61,0,0,0,27,27.86c.66-.76.95-2.08.95-3.88s-.28-3.12-.95-3.88a2.5,2.5,0,0,0-2.17-.95,2.61,2.61,0,0,0-2.17.95c-.66.76-.95,2.08-.95,3.88a6.18,6.18,0,0,0,.85,3.78A3,3,0,0,0,24.81,28.81Zm-.95-7.19a1.42,1.42,0,0,1,.38-.76.69.69,0,0,1,.57-.19,1.34,1.34,0,0,1,.57.19c.19.09.28.38.38.85A11.08,11.08,0,0,1,25.95,24a12.24,12.24,0,0,1-.19,2.36,1.42,1.42,0,0,1-.38.76,1.34,1.34,0,0,1-.57.19,1.34,1.34,0,0,1-.57-.19c-.19-.09-.28-.38-.38-.85A10.38,10.38,0,0,1,23.68,24,7.5,7.5,0,0,1,23.87,21.62Z"/></svg>', "Rewind 10 Secs", function(){if(player.getPosition() > 10) player.seek(player.getPosition()-10); else player.seek(0);}, 'jw-rw-btn', 'jw-rw-btn');
					    $("#epicpl .jw-button-container .jw-icon-volume").insertBefore('#epicpl .jw-button-container .jw-spacer');
					    $("#epicpl .jw-button-container .jw-icon-playback").insertAfter('#epicpl .jw-button-container .jw-rw-btn');
					    $("#epicpl .jw-button-container .jw-icon-rewind").remove();
					    $("#epicpl .jw-button-container .jw-icon-next").remove();
					    $("#epicpl .jw-button-container .jw-text-alt").remove();
					    $("#epicpl .jw-button-container .jw-text-live").remove();
					    $("#epicpl .jw-button-container .jw-text-elapsed").remove();
					    $("#epicpl .jw-button-container .jw-text-countdown").css('display','flex').insertAfter('#epicpl .jw-slider-horizontal .jw-slider-container');
					    $('<div class="jw-text jw-reset">&nbsp;&nbsp;-</div>').insertAfter('#epicpl .jw-slider-horizontal .jw-slider-container');
					    $("#epicpl .jw-button-container .jw-text-duration").remove();
					    $("#epicpl .jw-button-container .jw-icon-inline.jw-icon-volume").remove();
					    $("#epicpl .jw-button-container .jw-spacer").clone().insertAfter("#epicpl .jw-button-container .jw-ff-btn");
					    //$("#epicpl .jw-button-container .jw-rw-btn").css('margin-left','10%');
					    $("#epicpl .jw-display-container .jw-display-icon-rewind").css('visibility','hidden');
						}
					    playbackCheck(player,cid,false,setplytitle);
					}).on('firstFrame',function(obj){
						if(st > 0)
					    	player.seek(st);
					}).on('pause',function(obj){
						console.log(obj);
						if(obj.oldstate == 'playing'){
							playbackCheck(player,cid,true,setplytitle);
						}
					}).on('complete',function(){
						playbackCheck(player,cid,true,setplytitle);
						var elapsed =  jwplayer("epicpl").getDuration();
						//var elapsed =  '120';
					    setplaytracking(cid,tp,elapsed,setplytitle);
						if($("#next-cont") && $("#next-cont").length > 0)
							window.location.href = $("#next-cont").attr('href');
					}).on('play',function(){
						$.ajaxSetup({
				          headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				          }
				        });
						$.ajax({
						  	url: window.location.protocol+"//"+window.location.hostname+"/ajaxplayer/",
						  	data:{cid:cid,action:"st",type:tp,v:Math.random()},
						  	type:"POST",
						  	cache: false,
						  	success: function(result1){
						  		result1 = $.parseJSON(result1);
						  		if(result1.success == false){
						  			player.remove();
						  			$("#player .player-button").hide();
						  			$("#player .player-overlay").html('<div class="po-table"><div class="po-inner"><i class="fas fa-lock"></i><p>'+result1.message+'</p><a href="?autostart=true"><strong>Try Again</strong></a></div></div>');	
						  		}

						  	}
					  });
					}).on('setupError',function(){
						player.remove();
						$("#player .player-button").hide();
			  			$("#player .player-overlay").html('<div class="po-table"><div class="po-inner"><i class="fas fa-lock"></i><p>Something Went Wrong</p><a href=""><strong>Try Again</strong></a></div></div>');
					}).on('error',function(){
						st = player.getPosition();
						player.remove();
			  			$("#player .player-button").hide();
			  			$("#player .player-overlay").html('<div class="po-table"><div class="po-inner"><i class="fas fa-lock"></i><p>Something Went Wrong</p><a href=""><strong>Try Again</strong></a></div></div>');	
						$.ajaxSetup({
				          headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				          }
				        });
						$.ajax({
						  	url: window.location.protocol+"//"+window.location.hostname+"/ajaxplayer/",
						  	data:{cid:cid,action:"st",type:tp,v:Math.random()},
						  	type:"POST",
						  	cache: false,
						  	success: function(result1){
						  		result1 = $.parseJSON(result1);
						  		if(result1.success == false){
						  			player.remove();
						  			$("#player .player-button").hide();
						  			$("#player .player-overlay").html('<div class="po-table"><div class="po-inner"><i class="fas fa-lock"></i><p>'+result1.message+'</p><a href="?autostart=true"><strong>Try Again</strong></a></div></div>');	
						  		}else if(result.success == true){
						  			var file = "";
						  			if(tp == 'promo')
						  				file = result.url.promo_url;
						  			else
						  				file = result.url.video_url;
						  			var tracks = [];
						  			if(result.subtitles && result.subtitles.length > 0){
						  				var subtitle_obj = result.subtitles[0];
						  				tracks.push({"file":subtitle_obj.file,"label":subtitle_obj.lang,"default":false,"kind":"captions"}); 
						  			}
						  			player.load([{
									    file: file,
								        title:cont_title,
								        image: cover,
								        tracks: tracks,
								        mediaid:cid
									}]);
									player.seek(st);
									player.play();
						  		}

						}
					});
					});
				}else{
					$("#player .player-button").hide();
					if(result.errorcode == 1024 || result.errorcode == 1008) {				
						$("#player .player-overlay").html('<div class="po-table"><div class="po-inner"><i class="fas fa-lock"></i><p>'+result.message+'</p><a class="login-link-2" href="'+window.location.protocol+"//"+window.location.hostname+'/login?rt='+window.location.href+'"><strong>Login</strong></a></div></div>');
						//$("#player .player-overlay").html('<div class="po-table"><div class="po-inner"><i class="fas fa-lock"></i><p>'+result.message+'</p><a class="login-link-2" href="javascript:void(0);"><strong>Login</strong></a></div></div>');
						//PlaceHolder Login Button Click
							$('.login-link-2').on("click",function(){
								  console.log("Login Placeholder clicked2");
								  var websitetype = sitedevice + " Website";
								  var $datatitle = $('div.psharecontainer').attr('data-title'); 
								  var $dataid = $('div.psharecontainer').attr('data-id');
								  var $datatype = $('div.psharecontainer').attr('data-type');
								  var placeholderdata={
								              "Title":$datatitle,
								              "contentid":$dataid,
								              "contenttype":$datatype,
								              "Device":websitetype,
								              "Country":ucountry
								            }
								  clevertap.event.push("Placeholder Login Click",placeholderdata);
								  console.log("Login Placeholder clicked");
							});
					} else if(result.errorcode == 1023){
						//var placeholderdt=JSON.parse(placeholderdata);
						$("#player .player-overlay").html('<div class="po-table"><div class="po-inner"><i class="fas fa-lock"></i><p>'+result.message+'</p><a class="login-link-1" href="'+window.location.protocol+"//"+window.location.hostname+'/getSubscription?rt='+window.location.href+'"><strong>Subscribe</strong></a></div></div>');
						//$("#player .player-overlay").html('<div class="po-table"><div class="po-inner" event-status="true"><i class="fas fa-lock"></i><p>'+result.message+'</p><a class="login-link-1" href="javascript:void(0);"><strong>Subscribe</strong></a></div></div>');

						if($('.place-view').attr('event-status-view') == 'true'){
							console.log("event fire:"+$('.place-view').attr('event-status-view'));
							var websitetype = sitedevice + " Website";
							var $datatitle = $('div.psharecontainer').attr('data-title');
							var $dataid = $('div.psharecontainer').attr('data-id');
							var $datatype = $('div.psharecontainer').attr('data-type');
							var country = ucontry;
							var placeholderdata={
								"Title":$datatitle,
								"contentid":$dataid,
								"contenttype":$datatype,
								"Device":websitetype,
								"Country":country
							}

							clevertap.event.push("Placeholder_View",placeholderdata);

							$('.place-view').attr("event-status-view","false");
						}

						$('.login-link-1').on("click",function(){
							  var websitetype = sitedevice + " Website";
							  var $datatitle = $('div.psharecontainer').attr('data-title'); 
							  var $dataid = $('div.psharecontainer').attr('data-id');
							  var $datatype = $('div.psharecontainer').attr('data-type');
							  var placeholderdata={
							              "Title":$datatitle,
							              "contentid":$dataid,
							              "contenttype":$datatype,
							              "Device":websitetype,
							              "Country":ucountry
							            }
							  clevertap.event.push("Placeholder Continue Click",placeholderdata);
						});

						//PlaceHolder Login Button Click Ends
						// function clevertapPushEvent(eventName,properties){
  				// 			if(eventName != '' && eventName != null && eventName != undefined){
      //   					clevertap.event.push(eventName, properties);
  				// 			}
						// }
						// var $datatitle = $('div.psharecontainer').attr('data-title');
						// var $dataid = $('div.psharecontainer').attr('data-id');
						// var $datatype = $('div.psharecontainer').attr('data-type');
						// var country = ucontry;
						// var placeholderdata={
						// 	"Title":$datatitle,
						// 	"contentid":$dataid,
						// 	"contenttype":$datatype,
						// 	"Country":country
						// }
						// console.log("Placeholder View");
						// var $value = $('.po-inner').attr('event-status');
						// if($value == "true"){
						// 	clevertapPushEvent("Placeholder View",placeholderdata);
						// 	$('.po-inner').attr('event-status','f$('.po-inner').attr('event-status')alse');
						// }

						// $("a.login-link-1").click(function(){
						//   console.log("clickedddddd");
						//   var websitetype = sitedevice + " Website";
						//   var $datatitle = $('div.psharecontainer').attr('data-title'); 
						//   var $dataid = $('div.psharecontainer').attr('data-id');
						//   var $datatype = $('div.psharecontainer').attr('data-type');
						//   var placeholderdata={
						//               "Title":$datatitle,
						//               "contentid":$dataid,
						//               "contenttype":$datatype,
						//               "Device":websitetype,
						//               "Country":ucountry
						//             }
						//   cleverTapPush("Placeholder_Click",placeholderdata);
						// });

					} else {						
						$("#player .player-overlay").html('<div class="po-table"><div class="po-inner" event-status="true"><i class="fas fa-lock"></i><p>'+result.message+'</p><a href="?autostart=true"><strong>Try Again</strong></a></div></div>');	
					//alert(result.message);
					}
				}
		    }
		});
	});

var queryDict = {};
location.search.substr(1).split("&").forEach(function(item) {queryDict[item.split("=")[0]] = item.split("=")[1]})
//if(queryDict.autostart == "true"){
if($("#epicpl").length > 0){	
	document.getElementById("epicpl").click();	
}

function playbackCheck(player,cid,st=false,title=''){
	if(player.getState() == 'playing' || st==true){
		var dur = player.getPosition();
		$.ajaxSetup({
	          headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	        });
	  	$.ajax({
		  	url: window.location.protocol+"//"+window.location.hostname+"/ajaxplayer/",
		  	data:{cid:cid,action:"ch",dur:dur},
		  	type:"POST",
		  	success: function(result){
		  		setTimeout(function(){playbackCheck(player,cid,st,title)}, 15000);
		  	}
		  });
		var plinf = {cid:cid,dur:dur,title:title};
		$('.currvdoset').attr('currentvideo-playbackinfo',JSON.stringify(plinf));
	}else{
		setTimeout(function(){playbackCheck(player,cid,st,title)}, 500);
	}
}

function watchPromo(cid, title, type,param){ 
	console.log(param);
		if(typeof(promo_player) == 'object') {
			//promo_player.remove();
			promo_player.stop();		
		}
		if(typeof(player) == 'object')
			player.pause();
		var tp = "promo";
	
		$.ajaxSetup({
	          headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	        });
	  	$.ajax({
		  	url: window.location.protocol+"//"+window.location.hostname+"/ajaxplayer/",
		  	data:{cid:cid,action:"st",type:tp,param:param},
		  	type:"POST",
		  	success: function(result){
				  
				if(type == 'promo' && result.promo_url != '') {
			        var url = result.promo_url;
				} else if(type == 'video' && result.video_url != '') {
					var url = result.video_url;
				} else if(result.video_url != ''){
					var url = result.video_url;					
				} else if(result.promo_url != ''){
					var url = result.promo_url;	
				}		
			
				promo_player = jwplayer("promo-player").setup({
				  	 playlist: [{
				        file: url,
				        title:title,
				        mediaid:result.media_id
				    }],
				    //"ga":{label: "title"},
				    "width":"100%",
				    "aspectratio":"16:9",
				    "autostart":false,
				  	"skin":{
				  		"url":window.location.protocol+"//"+window.location.hostname+"/css/jwepic.css",
				  		"name":"epic"
				  	},
				  	"displaytitle":true,
				  	"displaydescription":false,
				  }).on('ready',function(){
				    //promo_player.addButton('<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-ff" viewBox="5 5 30 30" focusable="false"><path class="cls-1" d="M20.49,8.54,17.27,5.32,18.6,4,24,9.39,18.6,14.78l-1.32-1.32,2.93-2.93A11.52,11.52,0,1,0,33.54,21.87h1.89A13.43,13.43,0,1,1,20.49,8.54Z"/><path class="cls-1" d="M17.91,26.6H19.8V17.14H17.93a9.74,9.74,0,0,1-1.13,1.18,3.22,3.22,0,0,1-1.73.85v1.61a7.56,7.56,0,0,0,2.84-1.42Z"/><path class="cls-1" d="M25.22,26.46a2.61,2.61,0,0,0,2.17-.95c.66-.76.95-2.08.95-3.88s-.28-3.12-.95-3.88a2.5,2.5,0,0,0-2.17-.95,2.61,2.61,0,0,0-2.17.95c-.66.76-.95,2.08-.95,3.88a6.18,6.18,0,0,0,.85,3.78A3,3,0,0,0,25.22,26.46Zm-.95-7.19a1.42,1.42,0,0,1,.38-.76.69.69,0,0,1,.57-.19,1.34,1.34,0,0,1,.57.19c.19.09.28.38.38.85a11.08,11.08,0,0,1,.19,2.27A12.24,12.24,0,0,1,26.16,24a1.42,1.42,0,0,1-.38.76,1.34,1.34,0,0,1-.57.19,1.34,1.34,0,0,1-.57-.19c-.19-.09-.28-.38-.38-.85a10.38,10.38,0,0,1-.19-2.27A7.5,7.5,0,0,1,24.27,19.27Z"/></svg>', "Forward 10 Secs", function(){promo_player.seek(promo_player.getPosition()+10)}, 'jw-ff-btn', 'jw-ff-btn').addButton('<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-rw" viewBox="8 8 30 30"><path class="cls-1" d="M23.51,10.89l3.22-3.22L25.4,6.35,20,11.74l5.39,5.39,1.32-1.32L23.8,12.87A11.52,11.52,0,1,1,10.46,24.22H8.57A13.43,13.43,0,1,0,23.51,10.89Z"/><path class="cls-1" d="M17.5,29h1.89V19.49H17.53a9.74,9.74,0,0,1-1.13,1.18,3.22,3.22,0,0,1-1.73.85v1.61a7.56,7.56,0,0,0,2.84-1.42Z"/><path class="cls-1" d="M24.81,28.81A2.61,2.61,0,0,0,27,27.86c.66-.76.95-2.08.95-3.88s-.28-3.12-.95-3.88a2.5,2.5,0,0,0-2.17-.95,2.61,2.61,0,0,0-2.17.95c-.66.76-.95,2.08-.95,3.88a6.18,6.18,0,0,0,.85,3.78A3,3,0,0,0,24.81,28.81Zm-.95-7.19a1.42,1.42,0,0,1,.38-.76.69.69,0,0,1,.57-.19,1.34,1.34,0,0,1,.57.19c.19.09.28.38.38.85A11.08,11.08,0,0,1,25.95,24a12.24,12.24,0,0,1-.19,2.36,1.42,1.42,0,0,1-.38.76,1.34,1.34,0,0,1-.57.19,1.34,1.34,0,0,1-.57-.19c-.19-.09-.28-.38-.38-.85A10.38,10.38,0,0,1,23.68,24,7.5,7.5,0,0,1,23.87,21.62Z"/></svg>', "Rewind 10 Secs", function(){if(player.getPosition() > 10) jwplayer("myElement").seek(promo_player.getPosition()-10); else promo_player.seek(0);}, 'jw-rw-btn', 'jw-rw-btn');
				    // $("#promo-player .jw-button-container .jw-icon-volume").insertBefore('#promo-player .jw-button-container .jw-spacer');
				    // $("#promo-player .jw-button-container .jw-icon-playback").insertAfter('#promo-player .jw-button-container .jw-rw-btn');
				    // $("#promo-player .jw-button-container .jw-icon-rewind").remove();
				    // $("#promo-player .jw-button-container .jw-icon-next").remove();
				    // $("#promo-player .jw-button-container .jw-text-alt").remove();
				    // $("#promo-player .jw-button-container .jw-text-live").remove();
				    // $("#promo-player .jw-button-container .jw-text-elapsed").remove();
				    // $("#promo-player .jw-button-container .jw-text-countdown").css('display','flex').insertAfter('.jw-slider-horizontal .jw-slider-container');
				    // $('<div class="jw-text jw-reset">&nbsp;&nbsp;-</div>').insertAfter('#promo-player .jw-slider-horizontal .jw-slider-container');
				    // $("#promo-player .jw-button-container .jw-text-duration").remove();
				    // $("#promo-player .jw-button-container .jw-icon-inline.jw-icon-volume").remove();
				    // $("#promo-player .jw-button-container .jw-spacer").clone().insertAfter("#promo-player .jw-button-container .jw-ff-btn");
				    // $("#promo-player .jw-button-container .jw-rw-btn").css('margin-left','10%');
				    // $("#promo-player .jw-display-container .jw-display-icon-rewind").css('visibility','hidden');
					//playbackCheck(promo_player,cid);
					$('div.panel').unblock();
					$(".watch-preview-modal").modal('show');
				}).on('pause',function(obj){
					if(obj.oldstate == 'playing'){
						//playbackCheck(promo_player,cid,true);
					}
				}).on('complete',function(){
					//playbackCheck(promo_player,cid,true);
					var elapsed =  jwplayer("promo-player").getDuration();
						//var elapsed =  '120';
					    //setplaytracking(cid,tp,elapsed,title);
					
				})

				
		    }
		});

}
function setplaytracking(cid,tp,elapsed,title){
        console.log(cid + tp + elapsed + title);
        // var device = sitedevice;
        // $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        // $.ajax({
        //     url: window.location.protocol+"//"+window.location.hostname+"/ajaxSetPlayTracking/",
        //     data:{cid:cid,type:tp,duration:elapsed,title:title,device:device},
        //     type:"POST",
        //     cache: false,
        //     success: function(result1){
        //         console.log(result1);//result1 = $.parseJSON(result1);//if(result1.success == false){}
        //     }
        // });
	}
	
function removePlayer() {
	promo_player.stop();
}

    // ************** When main content video playing as current video and page event occurs where user redirect to somewhere and current video gets stopped
    
    if($(".uk-navbar-container .logo .uk-navbar-right a,.uk-navbar-container .uk-navbar-left ul.uk-navbar-nav a,.uk-navbar-container .uk-navbar-right .user a").length > 0){
    	$(".uk-navbar-container .logo .uk-navbar-right a,.uk-navbar-container .uk-navbar-left ul.uk-navbar-nav a,.uk-navbar-container .uk-navbar-right .user a").click(function(){
	var currentvideo = $('.currvdoset').attr('currentvideo-playbackinfo');
	if(currentvideo!=""){
		currentvideo = $.parseJSON(currentvideo);
		setplaytracking(currentvideo.cid,'video',currentvideo.dur,currentvideo.title);
	}
});
}

    if($(".uk-container .logo a,.uk-container .footer-menu ul.uk-navbar-nav").length > 0) {
	$(".uk-container .logo a,.uk-container .footer-menu ul.uk-navbar-nav").click(function(){
		var currentvideo = $('.currvdoset').attr('currentvideo-playbackinfo');
		if(currentvideo!=""){
			currentvideo = $.parseJSON(currentvideo);
			setplaytracking(currentvideo.cid,'video',currentvideo.dur,currentvideo.title);
		}
	});
}