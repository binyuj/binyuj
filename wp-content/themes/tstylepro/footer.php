	</div><!-- /container -->


	<div id="foot">
		<div id="foot-logo" class="col-4">
			<a href="#"><img src="<?php bloginfo('template_url'); ?>/img/logo-foot.gif" alt="" /></a>
		</div>
		<div class="col-13">
			<p id="foot-nav">
				<a href="<?php bloginfo('siteurl'); ?>/about-me" target="_blank">关于我</a>
				<span class="cut">|</span>
				<a href="#" onclick="TsFlicker('contact');">帮助中心</a>
				<span class="cut">|</span>
				<a href="#" onclick="TsFlicker('contact');">联系我</a>
				<span class="cut">|</span>
				<a href="#" onclick="TsFlicker('contact');">提建议</a>
				<span class="cut">|</span>
				<a href="http://jimudonation.com/project/271" target="_blank">赞助我</a>
				<span class="cut">|</span>

			<a href="#" target="_blank"><?php echo stripslashes(get_theme_mod('ts_icp')); ?></a>
			</p>
			<p id="copyright">Copyright &copy; 2011 <a href="http://ishare.cn.ms" target="_blank">iShare爱分享</a>, Powered by <a href="http://wordpress.org/" target="_blank">WordPress 3.3</a>, Designed by <a href="http://www.dafi.cn" target="_blank">dafi</a>.

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-27129143-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>	
		</p>


		</div>
		<div id="product-logo" class="col-7 last">
	<div style="float:left; margin: 20px 0px 0px 55px; font-size: 10px; line-height: 10px; -webkit-text-size-adjust:none;">
<?php echo('页面执行时间: '.timer_stop( 0 ).'s.<br />'); ?>
<?php printf(' 本次内存使用: %01.2f MB', memory_get_usage()/1024/1024); ?>
	</div>
	<div>
<!--百度统计-->
<div>
		<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Ffc54fc2672b12b91a4602b0f2b9d2d28' type='text/javascript'%3E%3C/script%3E"));
</script></div>
<!-- IPv6-test.com button BEGIN -->
<p><a href='http://ipv6-test.com/validate.php?url=referer' target="_blank"><img src='http://ipv6-test.com/button-ipv6-80x15.png' alt='ipv6 ready' title='ipv6 ready' border='0' /></a></p>
<!-- IPv6-test.com button END -->
	</div>
		</div>


	</div><!-- /foot -->


</div><!-- /wrap -->
<!-- 上下滑动 -->
<div id="shangxia"><div id="shang"></div>
<?php if (is_single()) { ?><div id="comt"></div><?php } ?><div id="xia"></div></div>

<!--adminsay-->
<div id="adminsay">
<b>博主留言：</b><br />
我还没死，只是很忙。<br />
各种论文考试 =w= <br />
feed已改为全文输出，<br />
感谢大家支持。
<div class="closebox">
<a href="javascript:void(0)" onclick="$('#adminsay').slideUp('slow');$('.closebox').css('display','none');" title="关闭">×</a>
</div>
</div>

<!--欢迎词-->
<?php show_refer_in();?>

<div id="special">
	<div id="to-top"><a>回到页首</a></div>
</div>
<!--[if IE 6]>
	<script src="http://letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/realgravatar.js"></script>
<!-- 图片特效 -->
<script type='text/javascript'>
$(function () {
$('img').hover(
function() {$(this).fadeTo("fast", 0.7);},
function() {$(this).fadeTo("fast", 1);
});
});
</script>
 
<div style="background: #CF1; padding:2px; position:fixed; left:0; top:10px;" >
<?php wp_footer(); ?>
</div>
</body>
</html>