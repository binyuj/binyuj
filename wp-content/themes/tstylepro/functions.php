<?php


//自己的小工具测试
if( function_exists( 'register_sidebar_widget' ) ) {   
    register_sidebar_widget('博客统计','mb_static');
    register_sidebar_widget('前台登录框','mb_login');
    register_sidebar_widget('两栏分类目录','mb_2cat');
}  
function mb_static() { include(TEMPLATEPATH . '/static.php'); }
function mb_login() { include(TEMPLATEPATH . '/login.php'); }
function mb_2cat() { include(TEMPLATEPATH . '/2cat.php'); }

/** RSS 中添加查看全文链接 */
function feed_read_more($content) {
    return $content . '<p><a rel="bookmark" href="'.get_permalink().'" target="_blank">查看全文</a></p>';
}
add_filter ('the_excerpt_rss', 'feed_read_more');

/**
 * welcome message
 * @param unknown_type $email
 * @return void|string
 */
function WelcomeCommentAuthorBack($email = ''){
	if(empty($email)){
		return;
	}
	global $wpdb;

	$past_30days = gmdate('Y-m-d H:i:s',((time()-(24*60*60*30))+(get_option('gmt_offset')*3600)));
	$sql = "SELECT count(comment_author_email) AS times FROM $wpdb->comments
					WHERE comment_approved = '1'
					AND comment_author_email = '$email'
					AND comment_date >= '$past_30days'";
	$times = $wpdb->get_results($sql);
	$times = ($times[0]->times) ? $times[0]->times : 0;
	$message = $times ? sprintf(__('过去30天内您评论了<strong>%1$s</strong>次，感谢关注~' ), $times) : '您很久都没有留言了，这次想说点什么吗？';

	return $message;
}


/* 获取缩略图 cmhello.com */
function catch_that_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1] [0];
	if(empty($first_img)){ 
	$first_img = bloginfo('template_url'). '/img/default-thumb.jpg';
	}
	return $first_img;
	}
;

/*获取用户名 */
function wt_get_user_name()
{
	global $userdata;
	get_currentuserinfo();
	return $userdata->user_login;
}

/*欢迎词 by wange.im */
function show_refer_in(){
$refer_info=$_SERVER['HTTP_REFERER'];
$ban_list=array($_SERVER["HTTP_HOST"]);
for($ii=0;$ii<count($ban_list);$ii++){
if(strpos($refer_info,$ban_list[$ii])){
return;
}
}
if($refer_info){
preg_match("/^(http:\/\/)?([^\/]+)/i",
$refer_info, $matches);
$host = $matches[2];
echo "<div id=\"hellobaby\">欢迎来自 ".$host." 的朋友！<br />您可以 <b><a href=\"http://feed.feedsky.com/iShare_feed\" target=\"_blank\">点击这里</a></b> 订阅我的博客 o(∩_∩)o<div class=\"closebox\"><a href=\"javascript:void(0)\" onclick=\"$('#hellobaby').slideUp('slow');$('.closebox').css('display','none');\" title=\"关闭\">×</a></div></div>";
}
}

/* comment_mail_notify v1.0 by willin kan.  */
function comment_mail_notify($comment_id) {
  $admin_notify = '0'; // admin 要不要收回复通知 ( '1'=要 ; '0'=不要 )
  $admin_email = get_bloginfo ('admin_email'); // $admin_email 可改为你指定的 e-mail.
  $comment = get_comment($comment_id);
  $comment_author_email = trim($comment->comment_author_email);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  global $wpdb;
  if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
    $wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
  if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
    $wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
  $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
  $spam_confirmed = $comment->comment_approved;
  if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 发出点, no-reply 可改为可用的 e-mail.
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
    $message = '
    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px;">
      <p><strong>' . trim(get_comment($parent_id)->comment_author) . '</strong>, 您好!</p>
      <p>您曾在 [' . get_option("blogname") . '] 的文章 《' . get_the_title($comment->comment_post_ID) . '》 上发表评论:<br />
<p style="background-color: #EEE;border: 1px solid #DDD;
padding: 20px;margin: 15px 0;">'. trim(get_comment($parent_id)->comment_content) . '</p>
      <p><strong>' . trim($comment->comment_author) . ' </strong>给您的回复:<br />
<p style="background-color: #EEE;border: 1px solid #DDD;
padding: 20px;margin: 15px 0;">' . trim($comment->comment_content) . '<br /></p>
      <p>您可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回复完整內容</a></p>
      <p>欢迎再度光临 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
      <p>(此邮件由系统自动发送，请勿回复.)</p>
    </div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}
add_action('comment_post', 'comment_mail_notify');
/* 自动加勾选栏 */  
function add_checkbox() {   
  echo '<input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked" style="margin: 4px 0 0 220px; width: 13px;" /><label for="comment_mail_notify" style="margin-left: -180px;" >有回复时邮件通知</label>';   
}   
add_action('comment_form', 'add_checkbox');     //如需要取消这项功能请注释这行代码  

//缩略图
add_theme_support('post-thumbnails');
set_post_thumbnail_size(100, 100, true);
add_image_size('home-thumb', 80, 60, true);
add_image_size('slide-thumb', 260, 227, true);

//激活菜单
register_nav_menus();

//移除前台顶部管理条
add_filter('show_admin_bar','__return_false');

//禁止在head泄露wordpress版本号
remove_action('wp_head','wp_generator');

//禁止半角符号自动变全角
foreach(array('comment_text','the_content','the_excerpt','the_title') as $xx)
remove_filter($xx,'wptexturize');

/*回复某人链接添加nofollow
这个理应是原生的, 可是在wp某次改版后被改动了,
现在是仅当开启注册回复时才有nofollow,否则需要自己手动了*/ 
function nofollow_comreply_link($link){
    return str_replace('<a','<a rel="nofollow"',$link);
}
get_option('comment_registration')||
add_filter('comment_reply_link','nofollow_comreply_link');


//相册设置
function remove_css_gal() {
	return "\n" . '<div class="gallery">'; //ici vous pouvez changer de classe
}
add_filter( 'gallery_style', 'remove_css_gal', 9 );

//utf8截字函数
function utf8Substr($str,$from,$len) { 
 return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s','$1',$str); 
}

//最新评论、留言
function recent_comment( $comment_post_ID=0, $get_total=5, $show_author_url=1, $before='<li class="vcard">', $after='</li>') {
	global $wpdb;
	$is_gb = ($comment_post_ID == "0") ? " != 'guestbook' " : " = 'guestbook' ";
	$request="SELECT ID, post_name, comment_ID, comment_content, comment_author_email, comment_author, comment_author_url, comment_date, post_title FROM $wpdb->comments ";
	$request .= " LEFT JOIN $wpdb->posts ON $wpdb->posts.ID=$wpdb->comments.comment_post_ID ";
	$request .= " WHERE post_status IN ('publish','static') AND comment_approved = '1' AND $wpdb->posts.post_name ".$is_gb."  ORDER BY comment_ID DESC LIMIT $get_total";
	$comments=$wpdb->get_results($request);
	if ($comments) {
		foreach ($comments as $comment) {
			$email=$comment->comment_author_email;
			$grav_url="http://www.gravatar.com/avatar/".md5($email)."?s=32&d=http://www.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536%3Fs%3D32";
			$comment_author=stripslashes(strip_tags($comment->comment_author));
			$comment_content=utf8Substr(stripslashes(strip_tags($comment->comment_content)),0,150);
			if ($show_author_url == 1 && strlen($comment->comment_author_url) > 12) $comment_author='<a target="_blank" class="url" rel="nofollow" title="访问 '.$comment_author. '的网站" href="' . $comment->comment_author_url . '">' . $comment_author . '</a>';
			$post_title=stripslashes($comment->post_title);
			$comment_date=date("m-d H:i",strtotime($comment->comment_date));
			$permalink=get_permalink($comment->ID)."#comment-".$comment->comment_ID;

			$output=$before."\n";
			$output .= '<span class="avatar"><img src="'.$grav_url.'" alt="" /></span>'."\n";
			$output .= '<span class="fn">'.$comment_author.'</span>'."\n";
			$output .= '<span class="date">'.$comment_date.'</span>'."\n";
			$output .= '<span class="txt"><a href="'.$permalink.'" title="'.$post_title.' &raquo; '.$comment_content.'">'.$comment_content.'</a></span>'."\n";
			$output .= $after."\n";
			echo $output."\n";
		}
	}
}

//首页幻灯
function dafiSlide($get_total=5,$parent=0) {
	global $wpdb;
	if ($get_total>5) $get_total=5;
	$parent = ($parent == 0) ? '' : "and post_parent = $parent";
	$request = "SELECT ID, post_title FROM $wpdb->posts p, $wpdb->postmeta pm WHERE p.ID = pm.post_id and p.post_status = 'publish' and pm.meta_key='_thumbnail_id' $parent ORDER BY ID desc";
	$slides = $wpdb->get_results($request);

	$TSlide = '<div id="slide-pic">'."\n";
	$s = 1;
	foreach ($slides as $post) {
		if (is_sticky($post->ID)) {
			$TSlide .= '<div>';
			$TSlide .= '<a title="'.get_the_title($post->ID).'" href="'.get_permalink($post->ID).'">'.get_the_post_thumbnail($post->ID, 'slide-thumb').'</a>';
			$TSlide .= '<p><span><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">'.get_the_title($post->ID).'</a></span></p>';
			$TSlide .= "</div>\n";
			$s ++;
		}
		if ($s == ($get_total+1)) break;
	}
	$TSlide .= "</div>\n\n";
	$TSlide .= '<div id="controller">'."\n";
	for ($i=1; $i<($s); $i++) {
		$TSlide .= '<span class="jFlowControl">'.$i.'</span>'."\n";
	}
	$TSlide .= "</div>\n\n";
	if ($s>2) $TSlide .= '<div id="slide-btn">'."\n".'<a title="上一张" class="slide-prev">上一张</a>'."\n".'<a title="下一张" class="slide-next">下一张</a>'."\n"."</div>\n\n";
	$TSlide .= '<script type="text/javascript">$("#controller").jFlow({ slides: "#slide-pic", auto: true, prev: ".slide-prev", next: ".slide-next" });</script>'."\n\n";
	echo $TSlide;
}

//列表分页
function wp_pagenavi() {
	$range = 9;
	global $paged, $wp_query;
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){
		echo '<ul class="pagination">';
		if(!$paged) $paged = 1;
		if($paged != 1){echo "<li><a href='" . get_pagenum_link(1) . "'>&laquo;</a></li>";}
		echo '<li>'; previous_posts_link('&lsaquo;'); echo '</li>';
		if($max_page > $range){
			if($paged < $range){
				for($i = 1; $i <= ($range + 1); $i++){
					echo "<li><a href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current'";
					echo ">$i</a></li>";
				}
			}

		elseif ($paged >= ($max_page - ceil(($range/2))) || $paged >= $range && $paged < ($max_page - ceil(($range/2)))) {
			for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++) {
				if ($i==$paged) echo '<li><span  class="current">' . $i . '</span></li>';
				else echo '<li><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
			}
		}
	}
    else {
		for($i = 1; $i <= $max_page; $i++) {
			if ($i==$paged) echo '<li><span  class="current">' . $i . '</span></li>';
			else echo '<li><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
		}
	}
		echo '<li>'; next_posts_link('&rsaquo;'); echo '</li>';
    	if ($paged != $max_page) echo "<li><a href='" . get_pagenum_link($max_page) . "'>&raquo;</a></li>";
		echo '</ul>';
	}
}



//添加小工具
if ( function_exists('register_sidebar') ){
        register_sidebar(array(
		'name' => 'sidebar-Top',
        'before_widget' => '<div id="%1$s" class="col-6 last widget"><div class="f-s"></div><div class="f-m">', 
        'after_widget' => '</div></div><div class="f-e"></div></div>', 
        'before_title' => '<h2><em>', 
        'after_title' => '</em></h2><div class="box">', 
 )); 
        register_sidebar(array(
		'name' => '首页',
        'before_widget' => '<div id="%1$s" class="col-6 last widget"><div class="f-s"></div><div class="f-m">', 
        'after_widget' => '</div></div><div class="f-e"></div></div>', 
        'before_title' => '<h2><em>', 
        'after_title' => '</em></h2><div class="box">', 
 )); 
        register_sidebar(array(
		'name' => '文章页',
        'before_widget' => '<div id="%1$s" class="col-6 last widget"><div class="f-s"></div><div class="f-m">', 
        'after_widget' => '</div></div><div class="f-e"></div></div>', 
        'before_title' => '<h2><em>', 
        'after_title' => '</em></h2><div class="box">', 
 )); 
        register_sidebar(array(
		'name' => '其他页',
        'before_widget' => '<div id="%1$s" class="col-6 last widget"><div class="f-s"></div><div class="f-m">', 
        'after_widget' => '</div></div><div class="f-e"></div></div>', 
        'before_title' => '<h2><em>', 
        'after_title' => '</em></h2><div class="box">', 
 )); 
	}










//调用友情链接
function tstyle_links($link_type="txt",$get_total=0) {
	global $wpdb;
	$link_select = ($link_type == "txt") ? " = ''" : " != ''";
	$get_total = ($get_total != 0) ? "LIMIT $get_total" : "";
	$request = "SELECT link_id, link_url, link_name, link_image, link_target, link_description, link_visible, link_rating FROM $wpdb->links ";
	$request .= " WHERE $wpdb->links.link_visible = 'Y' AND $wpdb->links.link_image $link_select ";
	$request .= " ORDER BY link_rating DESC, link_id ASC $get_total";
	$links = $wpdb->get_results($request);
	foreach ($links as $link) { //调用菜单
		$output = '<li>';
		if ($link_type == "txt") $output .= '<a target="'.$link->link_target.'" title="'.$link->link_description.'" href="'.$link->link_url.'">'.$link->link_name.'</a>';
		else $output .= '<a target="'.$link->link_target.'" title="'.$link->link_description.'" href="'.$link->link_url.'"><img src="'.$link->link_image.'" alt="'.$link->link_name.'"></a>';
		$output .= '</li>'."\n";
		echo $output;
	}
}

//调用页面或类别链接
function ts_geturl($url_slug, $url_type="page") {
	global $wpdb;
	if ($url_type == "page") {
		$url_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$url_slug."'");
		echo get_permalink($url_id);
	}else {
		$url_id = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE slug = '".$url_slug."'");
		echo get_category_link($url_id);
	}
}

//文章浏览数
function getPostViews($postID){
	$count_key = 'views';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '1');
		return "1";
	}
	return $count;
}
function setPostViews($postID) {
	$count_key = 'views';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 1;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '1');
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}
?>
<?php
require_once(TEMPLATEPATH . '/control.php');
?>