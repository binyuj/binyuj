<?php
/**
 * @package WordPress
 * @subpackage TStyle
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php
if (is_single()) {
	if ($post->post_excerpt) {
		$description = $post->post_excerpt;
	} else {
		$dsscHideStr = array("\n", "\r", "&nbsp;", "  ", "　");
		$description = utf8Substr(trim(strip_tags($post->post_content)),0,80);
		$description = str_replace($dsscHideStr, "", $description);
	}
	$tags = wp_get_post_tags($post->ID);
	foreach ($tags as $tag ) {
		$keywords = $keywords . $tag->name . ", ";
	}
} else {
	if (is_home()) $keywords = '免费资源,免费空间,免费域名,免费网盘,免费SSH,免费VPN,软件分享,软件破解, WordPress 个人网站, ' . get_bloginfo('name');
	else $keywords = get_bloginfo('name') . ', ';
	$description = get_bloginfo('description');
}
?>
<meta name="keywords" content="<?php echo $keywords . trim(wp_title('',false)); ?>." />
<meta name="description" content="<?php echo $description; ?>" />
<title><?php echo trim(wp_title('',0)); ?><?php if (get_query_var('page')) {    echo ' -第';   echo get_query_var('page');   echo '页 &lsaquo;';   }?> <?php bloginfo('name'); ?></title> 
<link href="<?php bloginfo('stylesheet_url'); ?>?ver=2012.6.9" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.dafi.js?ver=2012.6.9"></script>
<script type="text/javascript">TsLazyload("<?php bloginfo('template_url'); ?>/img/space.gif");</script>



<?php if (is_archive() && ($paged > 1) && ($paged < $wp_query->max_num_pages)) { ?>
<link rel="prefetch" href="<?php echo get_next_posts_page_link(); ?>">
<link rel="prerender" href="<?php echo get_next_posts_page_link(); ?>">
<?php } elseif (is_singular()) { ?>
<link rel="prefetch" href="<?php bloginfo('home'); ?>">
<link rel="prerender" href="<?php bloginfo('home'); ?>">
<?php } ?>

<?php wp_head(); ?>
<?php if ( is_singular() ){ ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<?php } ?>

<SCRIPT type=text/javaScript>
function doZoom(size){
document.getElementById('zoom').style.fontSize=size+'px'}
</SCRIPT>
</head>
<body>
<div id="wrap">


	<div id="head">

		<div id="head-logo" class="col-6">
			<h1>
				<a href="<?php bloginfo('home'); ?>"><img src="<?php bloginfo('template_url'); ?>/img/logo-head.gif" alt="<?php bloginfo('name'); ?>" /></a>
				<em><?php bloginfo('name'); ?></em>
			</h1>
		</div>

		<div id="head-banner" class="col-11">
			<?php echo stripslashes(get_theme_mod('ts_ad1')); ?>
		</div>

		<div id="head-nav" class="col-7 last">
<!-- Feedsky FEED发布代码开始 -->
<!-- FEED自动发现标记开始 -->
<link title="RSS 2.0" type="application/rss+xml" href="http://feed.feedsky.com/iShare_feed" rel="alternate" />
<!-- FEED自动发现标记结束 -->
<script language="javascript"><!-- 
main_sub="c1s16";
more_subs="";
is_new="yes";
--> </script>
<script language="javascript" src="http://www.feedsky.com/jsout/publishlist_v2.js?burl=iShare_feed&out_html=true"></script>
<!-- Feedsky FEED发布代码结束 -->

			
			<span class="cut">|</span>
<a target="_blank" href="http://sighttp.qq.com/authd?IDKEY=d78d8267825609c71aa8d773874fb974c6bdbb4b27e3862f"><img border="0"  src="http://wpa.qq.com/imgd?IDKEY=d78d8267825609c71aa8d773874fb974c6bdbb4b27e3862f&pic=41" alt="QQ联系我" title="QQ联系我"></a>
			<span class="cut">|</span>
			<a target="_blank" href="http://jimudonation.com/project/271" title="赞助我 Donate">赞助我</a>
			<span class="cut">|</span>
			<?php wp_loginout(); ?>
		</div>

		<div id="search" class="col-5 last">
			<form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
				<label for="s">请输入关键字</label>
				<input type="text"  x-webkit-speech name="s" id="s" value="<?php the_search_query(); ?>" />
				<button type="submit">站内搜索</button>
			</form>
		</div>

		<?php wp_nav_menu('container_id=nav'); ?>

	</div><!-- /head -->


	<div id="container" class="clearfix">


		<div id="main" class="col-18">