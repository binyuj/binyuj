$(function() {
	//欢迎词自动消失
	$('#hellobaby').fadeOut(20000);
	//页面载入中...
	$('.wrap a:not(a[target*=_blank] , a[href*=javascript] , a[href*=#])').click(function(){
	$('#loading_').css({top:'180px',left:'45%'});
	$('#loading_').fadeIn(600);
	$('#loading_').fadeOut(6000)});	
	$('#choice .list a ,.list li em a ,#contentWz li em a ').hover(function(){
	$(this).stop().animate({'left':'5px'},'fast')},function(){
	$(this).stop().animate({'left':'0px'},'fast')});   	
	$('.list em a ,.list li a ,#contentWz li a ').click(function(){
	$(this).text('页面加载中,请稍侯...');
	  window.location = $(this).attr('href');});
	if(window.XMLHttpRequest){
	$("img").not("#side-cmtli-2 img,#hotfriends img").lazyload({
		placeholder: "http://www.linji.cn/wp-content/themes/tstyle/img/space.gif",
		effect: "fadeIn"
		});
	}    

	//响应框输入字数统计
	var $comment = $('#comment');
	var $str  =  $('#str');
	var time;
	$comment.focus(function(){
		 time = window.setInterval( substring,100 );
	}); 
	function substring() {
		var val = $comment.val();
		var length = val.length;
		if( $str.html() != (length) ){
			 if(length==0){
				 $("#wordcount")[0].firstChild.nodeValue = "您已输入 ";
				  $str.html(length)
				   }else{
				 $("#wordcount")[0].firstChild.nodeValue = "您已输入";
				 $str.html(length);
			}
		}
	}

	//搜索框
	var keyWord = $("input#s");
	if (keyWord.val().length >= 1 ) keyWord.prev("label").hide();
	keyWord.focus(function(){ keyWord.prev("label").hide(); })
	keyWord.blur(function(){
		if (keyWord.val() == "") {
			keyWord.val("");
			keyWord.prev("label").show();
		}
	});

	//主菜单下拉
	$("#nav li li").has('ul').children("a").append(" &raquo;");
	$("#nav li").has('ul').hover(
		function() {
			$(this).children("ul").slideDown(200);
		},
		function() {
			$(this).children("ul").slideUp(200);
		}
	);

	//赞助我
	$("#sponsor").html($("#sponsor-me").attr("title"));
	$("#sponsor-me").attr("title","");
	$("#sponsor-me").hover(
		function() {
			$("#sponsor").slideDown(200);
			$("#sponsor").attr("style","display:block;");//这一行是为了解决 jQuery IE8 bug
		},
		function() { $("#sponsor").fadeOut(200); }
	);

	//列表隔行换色
	$(".list li:odd").addClass("odd");

	//鼠标滑过切换选项卡
	$("#choice ul:first").idTabs();
	$("#side-cmt ul:first").idTabs();
	$("#column-nav ul:first").idTabs();

	//初始化选项卡
	$("#choice ul:first").idTabs();
	$("#side-cmt ul:first").idTabs();
	$("#column-nav ul:first").idTabs();

	//首页相册文字
	$("#home-album li a").hover(
		function() {
			$(this).children("span").slideDown(200);
		},
		function() {
			$(this).children("span").slideUp(200);
		}
	);

	//鼠标经过tips效果
	$("#container a").not("#home-album li a").mouseover(function(tips){
		this.tipsTxt = this.title;
		this.tipsTxt = (this.tipsTxt.length>100?this.tipsTxt.toString().substring(0,100)+"...":this.tipsTxt);
			if (this.tipsTxt){
				this.tipsUrl = this.href;
				this.title = '';
				var tips = '<div id="tips"><p>' + this.tipsTxt + '</p><p><em>' + this.tipsUrl + '</em></p></div>';
				$('body').append(tips);
				$('#tips').css({"opacity":"0.8"})
			}
		}).mouseout(function(){
			this.title=this.tipsTxt;
			$('#tips').remove();
		}).mousemove(function(tip){ $('#tips').css({"top":(tip.pageY+22)+"px","left":(tip.pageX-10)+"px"});
	});
	//鼠标经过tips效果结束

	//彩色tag云
	tagColor(".tags a");	

	//新窗口打开
	$(function() { $("a[rel*='external']").attr("target","_blank") });

	//滑动到顶部
	$('#to-top').click(function() { $("html,body,#wrap").animate({ scrollTop: 0 }, 1000); });
	var showDistance = 50;//距离顶端多少距离开始显示to-top
	$(window).scroll(function(){
		if($(this).scrollTop() < showDistance){
			$("#to-top").fadeOut("fast");
		}else{
			$("#to-top").fadeIn("fast");
		}
	});

});

//图片渐显
function TsLazyload(templateUrl) {
	if(window.XMLHttpRequest){
		$(function() {
			$("img").not("#slide-pic img, #side-cmtli-2 img, .gallery img").lazyload({
				placeholder: templateUrl,
				effect: "fadeIn"
			});
		});
	}
}

//闪动联系我
function TsFlicker(getObject,times) {
	if (times == null) times = 5;
	for (i = 0; i<times; i++) {
		$("#" + getObject).fadeOut(200);
		$("#" + getObject).fadeIn(50);
	}
}

//彩色tag
function tagColor(getObject) {
	var colors = ["#0cf","#06f","#900","#990","#f36","#639","#60f","#0c0","#f90","#c66","#6cc","#f0f","#00f","#333"];
	var tags = $(getObject);
	var tagCount = tags.length;
	for ( i=0; i<tagCount; i++ ) {
		n = Math.floor( Math.random() * colors.length );
    	tags.eq(i).css({"color":colors[n]});
	}
}

//js版Ctrl+Enter回复

//上下滑动
jQuery(document).ready(function($){
$body=(window.opera)?(document.compatMode=="CSS1Compat"?$('html'):$('body')):$('html,body');//修复Opera滑动异常地，加过就不需要重复加了。
$('#shang').mouseover(function(){//鼠标移到id=shang元素上触发事件
		up();
	}).mouseout(function(){//鼠标移出事件
		clearTimeout(fq);
	}).click(function(){//点击事件
		$body.animate({scrollTop:0},400);//400毫秒滑动到顶部
});
$('#xia').mouseover(function(){
		dn();
	}).mouseout(function(){
		clearTimeout(fq);
	}).click(function(){ 
		$body.animate({scrollTop:$(document).height()},400);//直接取得页面高度，不再是手动指定页尾ID 
});
$('#comt').click(function(){
	$body.animate({scrollTop:$('#comment').offset().top},400);//滑动到id=comments元素，遇到不规范的主题需调整 
}); 
});  
//下面部分放jQuery外围，几个数值不妨自行改变试试 
function up(){
   $wd = $(window);
   $wd.scrollTop($wd.scrollTop() - 1); 
   fq = setTimeout("up()", 50); 
} 
function dn(){ 
   $wd = $(window); 
   $wd.scrollTop($wd.scrollTop() + 1); 
   fq = setTimeout("dn()", 50);
}

//Comment Editor 
$(function() {
    function addEditor(a, b, c) {
        if (document.selection) {
            a.focus();
            sel = document.selection.createRange();
            c ? sel.text = b + sel.text + c: sel.text = b;
            a.focus()
        } else if (a.selectionStart || a.selectionStart == '0') {
            var d = a.selectionStart;
            var e = a.selectionEnd;
            var f = e;
            c ? a.value = a.value.substring(0, d) + b + a.value.substring(d, e) + c + a.value.substring(e, a.value.length) : a.value = a.value.substring(0, d) + b + a.value.substring(e, a.value.length);
            c ? f += b.length + c.length: f += b.length - e + d;
            if (d == e && c) f -= c.length;
            a.focus();
            a.selectionStart = f;
            a.selectionEnd = f
        } else {
            a.value += b + c;
            a.focus()
        }
    }
    var g = document.getElementById('comment') || 0;
    var h = {
        strong: function() {
            addEditor(g, '<strong>', '</strong>')
        },
        em: function() {
            addEditor(g, '<em>', '</em>')
        },
        del: function() {
            addEditor(g, '<del>', '</del>')
        },
        underline: function() {
            addEditor(g, '<u>', '</u>')
        },
        quote: function() {
            addEditor(g, '<blockquote>', '</blockquote>')
        },
        ahref: function() {
            var a = prompt('请输入链接地址', 'http://');
            var b = prompt('请输入链接描述','');
            if (a) {
                addEditor(g, '<a target="_blank" href="' + a + '"rel="external">' + b + '</a>','')
            }
        },
        img: function() {
            var a = prompt('请输入图片地址', 'http://');
            if (a) {
                addEditor(g, '<img src="' + a + '" alt="" />','')
            }
        },
        code: function() {
            addEditor(g, '<code>', '</code>')
        }
    };
    window['SIMPALED'] = {};
    window['SIMPALED']['Editor'] = h
});
//tab我已把原本框架的类selected换成了current，另外，把变量dep调取idTabs官网的jquery去掉了。
(function() {
    var dep;
    var init = function() { (function($) {
            $.fn.idTabs = function() {
                var s = {};
                for (var i = 0; i < arguments.length; ++i) {
                    var a = arguments[i];
                    switch (a.constructor) {
                    case Object:
                        $.extend(s, a);
                        break;
                    case Boolean:
                        s.change = a;
                        break;
                    case Number:
                        s.start = a;
                        break;
                    case Function:
                        s.mouseover = a;
                        break;
                    case String:
                        if (a.charAt(0) == '.') s.current = a;
                        else if (a.charAt(0) == '!') s.event = a;
                        else s.start = a;
                        break;
                    }
                }
                if (typeof s['return'] == "function") s.change = s['return'];
                return this.each(function() {
                    $.idTabs(this, s);
                });
            }
            $.idTabs = function(tabs, options) {
                var meta = ($.metadata) ? $(tabs).metadata() : {};
                var s = $.extend({},
                $.idTabs.settings, meta, options);
                if (s.current.charAt(0) == '.') s.current = s.current.substr(1);
                if (s.event.charAt(0) == '!') s.event = s.event.substr(1);
                if (s.start == null) s.start = -1;
                var showId = function() {
                    if ($(this).is('.' + s.current)) return s.change;
                    var id = "#" + this.href.split('#')[1];
                    var aList = [];
                    var idList = [];
                    $("a", tabs).each(function() {
                        if (this.href.match(/#/)) {
                            aList.push(this);
                            idList.push("#" + this.href.split('#')[1]);
                        }
                    });
                    if (s.mouseover && !s.mouseover.apply(this, [id, idList, tabs, s])) return s.change;
                    for (i in aList) $(aList[i]).removeClass(s.current);
                    for (i in idList) $(idList[i]).hide();
                    $(this).addClass(s.current);
                    $(id).show();
                    return s.change;
                }
                var list = $("a[href*='#']", tabs).unbind(s.event, showId).bind(s.event, showId);
                list.each(function() {
                    $("#" + this.href.split('#')[1]).hide();
                });
                var test = false;
                if ((test = list.filter('.' + s.current)).length);
                else if (typeof s.start == "number" && (test = list.eq(s.start)).length);
                else if (typeof s.start == "string" && (test = list.filter("[href*='#" + s.start + "']")).length);
                if (test) {
                    test.removeClass(s.current);
                    test.trigger(s.event);
                }
                return s;
            }
            $.idTabs.settings = {
                start: 0,
                change: false,
                mouseover: null,
                current: ".current",
                event: "!mouseover"
            };
            $.idTabs.version = "2.2";
            $(function() {
                $(".idTabs").idTabs();
            });
        })(jQuery);
    }
    var check = function(o, s) {
        s = s.split('.');
        while (o && s.length) o = o[s.shift()];
        return o;
    }
    var head = document.getElementsByTagName("head")[0];
    var add = function(url) {
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.src = url;
        head.appendChild(s);
    }
    var s = document.getElementsByTagName('script');
    var src = s[s.length - 1].src;
    var ok = true;
    for (d in dep) {
        if (check(this, d)) continue;
        ok = false;
        add(dep[d]);
    }
    if (ok) return init();
    add(src);
})();
//jquery.lazyload.js
(function($){$.fn.lazyload=function(options){var settings={threshold:0,failurelimit:0,event:"scroll",effect:"show",container:window};if(options){$.extend(settings,options);}
var elements=this;if("scroll"==settings.event){$(settings.container).bind("scroll",function(event){var counter=0;elements.each(function(){if($.abovethetop(this,settings)||$.leftofbegin(this,settings)){}else if(!$.belowthefold(this,settings)&&!$.rightoffold(this,settings)){$(this).trigger("appear");}else{if(counter++>settings.failurelimit){return false;}}});var temp=$.grep(elements,function(element){return!element.loaded;});elements=$(temp);});}
this.each(function(){var self=this;if(undefined==$(self).attr("original")){$(self).attr("original",$(self).attr("src"));}
if("scroll"!=settings.event||undefined==$(self).attr("src")||settings.placeholder==$(self).attr("src")||($.abovethetop(self,settings)||$.leftofbegin(self,settings)||$.belowthefold(self,settings)||$.rightoffold(self,settings))){if(settings.placeholder){$(self).attr("src",settings.placeholder);}else{$(self).removeAttr("src");}
self.loaded=false;}else{self.loaded=true;}
$(self).one("appear",function(){if(!this.loaded){$("<img />").bind("load",function(){$(self).hide().attr("src",$(self).attr("original"))
[settings.effect](settings.effectspeed);self.loaded=true;}).attr("src",$(self).attr("original"));};});if("scroll"!=settings.event){$(self).bind(settings.event,function(event){if(!self.loaded){$(self).trigger("appear");}});}});$(settings.container).trigger(settings.event);return this;};$.belowthefold=function(element,settings){if(settings.container===undefined||settings.container===window){var fold=$(window).height()+$(window).scrollTop();}else{var fold=$(settings.container).offset().top+$(settings.container).height();}
return fold<=$(element).offset().top-settings.threshold;};$.rightoffold=function(element,settings){if(settings.container===undefined||settings.container===window){var fold=$(window).width()+$(window).scrollLeft();}else{var fold=$(settings.container).offset().left+$(settings.container).width();}
return fold<=$(element).offset().left-settings.threshold;};$.abovethetop=function(element,settings){if(settings.container===undefined||settings.container===window){var fold=$(window).scrollTop();}else{var fold=$(settings.container).offset().top;}
return fold>=$(element).offset().top+settings.threshold+$(element).height();};$.leftofbegin=function(element,settings){if(settings.container===undefined||settings.container===window){var fold=$(window).scrollLeft();}else{var fold=$(settings.container).offset().left;}
return fold>=$(element).offset().left+settings.threshold+$(element).width();};$.extend($.expr[':'],{"below-the-fold":"$.belowthefold(a, {threshold : 0, container: window})","above-the-fold":"!$.belowthefold(a, {threshold : 0, container: window})","right-of-fold":"$.rightoffold(a, {threshold : 0, container: window})","left-of-fold":"!$.rightoffold(a, {threshold : 0, container: window})"});})(jQuery);