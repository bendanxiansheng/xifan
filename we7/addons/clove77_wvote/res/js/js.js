
function tips(){

	this.show=function(msg,delay,fn){
		var msg=msg||'加载中';
		var delay=delay||2000;
		var fn=fn||function(){};
		$("#tips .tips-title").html(msg);
		setTimeout(function(){
			$("#tips").hide();
			(fn)();
		},delay);
		$("#tips").css('display','-webkit-flex');
	}
	this.hide=function(){
		$("#tips").hide();
	}
}
var tips = new tips();


function votePic(){
	this.show=function(config){

		var picShow=$("#pic-show");
		picShow.find('.pic-show-img-box img').attr('src',config.src);
		picShow.find('.pic-show-img-box .title').text(config.title);
		picShow.find('.pic-show-info .num').text(config.num);
		picShow.find('.pic-show-info .vote').text(config.vote);
		picShow.find('.hash').attr('href','#'+config.id);
		picShow.find('.select-btn').attr('data-id',config.id);
		$("#pic-show").css('display','-webkit-flex');
			
	}
	this.hide=function(){
		$("body").css('position','static');
		$("#pic-show").hide();
	}
}


function shareTips(){
	var a = $("#shareTips");
	var vote = new votePic();
	this.show=function(){
		vote.hide();
		$("#shareTips").show();
	}
	this.hide=function(){
		a.hide();
	}
}

var shareTips = new shareTips();

function topList(){
	this.show=function(){
		// $("body").css('position','fixed');
		// tips.show();
		// setTimeout(function(){
			$("#top-list").css('display','-webkit-flex');
		// 	tips.hide();
		// },200);
		
	}
	this.hide=function(){
		$("body").css('position','static');
		$("#top-list").hide();
	}
}






$(function(){
	$("#shareTips").click(function(){
		$(this).hide();
	});
	$(".btn2").live('click',function(){
		shareTips.show();
	});
	$(".pic-show-close").click(function(){
		vote.hide();
	});

});