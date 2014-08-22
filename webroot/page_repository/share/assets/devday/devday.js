var images;
var selectedGalleries;
var hidecheck = 0;

$(document).ready(function() {			
	images = new Array();
	selectedGalleries = 0;

	$(".tit_sub").text("DevDay "+data.id +"회");
	
	initIntro();
	if(data.items.projects != undefined)
	{
		$("#d_tabmenu").append('<li class="project"><a href="#project" onclick="javascript:selectProject();return false;" class="link menu2">프로젝트</a></li>');
		initProject();
	}
	
	if(data.items.galleries != undefined)
	{
		$("#d_tabmenu").append('<li class="gallery"><a href="#gallery" onclick="javascript:selectGallery();return false;" class="link menu3">갤러리</a></li>');
		initGallery();
	}

	if(data.items.social != undefined)
	{
		$("#d_tabmenu").append('<li class="social"><a href="#social" onclick="javascript:selectSocial();return false;" class="link menu3">반응모음</a></li>');
		initSocial();
	}

	selectIntro();

	parent.resizePageFrame();
});

function selectIntro()
{        
	if($(".intro.on").length == 1) return;
	$(".tab_evt>li").removeClass("on");
	$("li.intro").addClass("on");
	$(".cont_tab>div").hide();
	$(".cont_intro").show();

	parent.resizePageFrame();
}

function selectProject()
{
	if($(".project.on").length == 1) return;
	$(".tab_evt>li").removeClass("on");
	$("li.project").addClass("on");
	$(".cont_tab>div").hide();
	$(".cont_project").show();
	
	parent.resizePageFrame();
}

function selectGallery()
{
	if($(".gallery.on").length == 1) return;
	$(".tab_evt>li").removeClass("on");
	$("li.gallery").addClass("on");
	$(".cont_tab>div").hide();
	$(".cont_gallery").show();

	parent.resizePageFrame();
}

function selectSocial()
{
	if($(".social.on").length == 1) return;
	$(".tab_evt>li").removeClass("on");
	$("li.social").addClass("on");
	$(".cont_tab>div").hide();
	$(".cont_respond").show();

	parent.resizePageFrame();
}

function initIntro()
{
	$(".cont_intro img").attr("src","./assets/devday/"+data.id + "/" +  data.image1);
	$(".tit").text(data.title);
	$(".txt").text(data.desc);
}

function initProject()
{
    for(var p_i in data.items.projects)
    {
    	var $listTag = $('<li class="fst"><div class="thumb"><img src="./assets/images/common/imgx_person.gif" class="thumb_img" width="50" height="50" alt=""></div><div class="cont"><p class="desc">'+data.items.projects[p_i].team+'</p><strong class="tit">'+data.items.projects[p_i].name+'</strong></div></li>');
    	
    	if(data.items.projects[p_i].icon != "" && data.items.projects[p_i].url != undefined)
    	{
    		$listTag.find('img').attr('src', './assets/devday/'+ data.id +'/'+ data.items.projects[p_i].icon);
    	}
    	
    	if(data.items.projects[p_i].prize != "" && data.items.projects[p_i].prize != undefined)
    	{
    		$listTag.addClass("prize");
    		$listTag.prepend('<strong class="ico_share ico_prize">'+data.items.projects[p_i].prize+'</strong>');
    	}
    	if(data.items.projects[p_i].about != "" && data.items.projects[p_i].about != undefined)
    	{
    		$listTag.append('<a href="'+data.items.projects[p_i].about+'" class="btn_comm btn_type1 btn_link" target="_blank"><span class="btn_comm btn_end">팀 소개</span></a>');
    	}      	
    	if(data.items.projects[p_i].slide != "" && data.items.projects[p_i].slide != undefined)
    	{
    		$listTag.append('<a href="'+data.items.projects[p_i].slide+'" class="btn_comm btn_type1 btn_link" target="_blank"><span class="btn_comm btn_end">슬라이드</span></a>');
    	}
    	if(data.items.projects[p_i].movie != "" && data.items.projects[p_i].movie != undefined)
    	{
    		$listTag.append('<a href="'+data.items.projects[p_i].movie+'" class="btn_comm btn_type1 btn_link" target="_blank"><span class="btn_comm btn_end">동영상</span></a>');
    	}
    	if(data.items.projects[p_i].url != "" && data.items.projects[p_i].url != undefined)
    	{
    		$listTag.append('<a href="'+data.items.projects[p_i].url+'" class="btn_comm btn_type1 btn_link" target="_blank"><span class="btn_comm btn_end">바로가기</span></a>');
    	}
    	if(data.items.projects[p_i].github != "" && data.items.projects[p_i].github != undefined)
    	{
    		$listTag.append('<a href="'+data.items.projects[p_i].github+'" class="btn_comm btn_type1 btn_link" target="_blank"><span class="btn_comm btn_end">소스코드</span></a>');
    	}

    	$listTag.appendTo(".cont_project .list");
    }
}

function initGallery(check)
{
	var item_id = 0;
	for(var i in data.items.galleries)
	{
		if(data.items.galleries[i].type == 'image')
		{
			images[i] = new Image();
			images[i].src = data.items.galleries[i].url;
		}

		$li = $('<li id=galleryItem' + item_id  + '><a href="#" onclick="javascript:selectGalleryItem('+i+');return false;" class="thumb"><img src="'+data.items.galleries[i].tn+'" width="70" height="59" class="thumb_img" alt="갤러리"><span class="frame"></span></a></li>');
		if(i == 0)
		{
			$li.addClass("on");
			$li.find("a").append($('<span class="frame"></span>'));
		}
		$li.appendTo(".list_video");
		
		item_id++;
	}
	selectGalleryItem(0);
	
	
}

function initSocial()
{
	for(var i in data.items.social)
	{
		$tag = $('<li><a href="'+data.items.social[i].url+'" class="link" target="_blank">'+data.items.social[i].title+'</a><span class="txt_bar">|</span><span class="txt_sub ls_1">'+data.items.social[i].name+'</span></li>');
		$tag.appendTo("#d_bloglist");
	}
}

function selectGalleryItem(gIndex)
{
	$('.list_video>li.on').removeClass('on');
	selectedGalleries = gIndex;
	$('.list_video>li').eq(gIndex).addClass('on');

	if(data.items.galleries[gIndex].type == 'iframe')
	{
		$content = $('<iframe width="100%" height="100%;" marginheight="0" marginwidth="0" frameborder="0" scrolling="no" title="갤러리" class="iframe" />');
		$content.attr('src',data.items.galleries[gIndex].url);
		$(".viewer").html("");
		$content.appendTo(".viewer");
	}
	else if(data.items.galleries[gIndex].type == 'image')
	{
		$(".viewer").html("");
		$(images[gIndex]).appendTo(".viewer");
	}
}


function galleryNext()
{
	var gIndex = selectedGalleries + 1;
	var itemLength = $('.list_video>li').size();
	
	//.alert(hidecheck);
	//var hideArr = Array();
	//alert(data.items.galleries.length);
	if(gIndex > 7 && gIndex != data.items.galleries.length )
	{
		//alert(11);
		$('#galleryItem'+(gIndex-8)).hide();
		//selectGalleryItem(gIndex-1);
		hidecheck++;
	}
		
	if(gIndex > data.items.galleries.length || itemLength <= gIndex) 
	{
		selectedGalleries = gIndex = 0;
		for(var i=0; i<hidecheck; i++)
			$('#galleryItem'+i).show();
		hidecheck = 0;
	}
		
	
	selectGalleryItem(gIndex);
}

/*
 * 이미지 8개 이상 추가시에 오른쪽으로 이동가능 
 */
/*
function galleryNext()
{
	var gIndex = selectedGalleries + 1;
	var itemLength = $('.list_video>li').size();
	
	
	if(gIndex > 7 && gIndex != data.items.galleries.length )
	{
		$('#galleryItem'+(gIndex-8)).hide();
		hidecheck++;
	}
		
	if(gIndex > data.items.galleries.length || itemLength <= gIndex) 
	{
		selectedGalleries = gIndex = 0;
		for(var i=0; i<hidecheck; i++)
			$('#galleryItem'+i).show();
		hidecheck = 0;
	}
		
	
	selectGalleryItem(gIndex);
}
*/


function galleryPrev()
{
	var gIndex = selectedGalleries - 1;
	var itemLength = $('.list_video>li').size();
	if(gIndex < 0) 
		selectedGalleries = gIndex = itemLength - 1;
	selectGalleryItem(gIndex);
}