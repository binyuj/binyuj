<?php
/**
 * Template Name: tougao
 * 作者：露兜
 * 博客：http://www.ludou.org/
 * 
 * 更新记录
 *  2010年09月09日 ：
 *  首个版本发布
 *  
 *  2011年03月17日 ：
 *  修正时间戳函数，使用wp函数current_time('timestamp')替代time()
 *  
 *  2011年04月12日 ：
 *  修改了wp_die函数调用，使用合适的页面title
 */
    
if( isset($_POST['tougao_form']) && $_POST['tougao_form'] == 'send')
{
    global $wpdb;
    $last_post = $wpdb->get_var("SELECT post_date FROM $wpdb->posts WHERE post_type = 'post' ORDER BY post_date DESC LIMIT 1");

    // 博客当前最新文章发布时间与要投稿的文章至少间隔120秒。
    // 可自行修改时间间隔，修改下面代码中的120即可
    // 相比Cookie来验证两次投稿的时间差，读数据库的方式更加安全
    if ( current_time('timestamp') - strtotime($last_post) < 120 )
    {
        wp_die('您投稿也太勤快了吧，先歇会儿！');
    }
        
    // 表单变量初始化
    $name = isset( $_POST['tougao_authorname'] ) ? trim(htmlspecialchars($_POST['tougao_authorname'], ENT_QUOTES)) : '';
    $email =  isset( $_POST['tougao_authoremail'] ) ? trim(htmlspecialchars($_POST['tougao_authoremail'], ENT_QUOTES)) : '';
    $blog =  isset( $_POST['tougao_authorblog'] ) ? trim(htmlspecialchars($_POST['tougao_authorblog'], ENT_QUOTES)) : '';
    $title =  isset( $_POST['tougao_title'] ) ? trim(htmlspecialchars($_POST['tougao_title'], ENT_QUOTES)) : '';
    $category =  isset( $_POST['cat'] ) ? (int)$_POST['cat'] : 0;
    $tags = isset( $_POST['tougao_tags'] ) ? $_POST['tougao_tags'] : '';
	$content =  isset( $_POST['tougao_content'] ) ? trim(htmlspecialchars($_POST['tougao_content'], ENT_QUOTES)) : '';
    
    // 表单项数据验证
    if ( empty($name) || mb_strlen($name) > 20 )
    {
        wp_die('昵称必须填写，且长度不得超过20字');
    }
    
    if ( empty($email) || strlen($email) > 60 || !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email))
    {
        wp_die('Email必须填写，且长度不得超过60字，必须符合Email格式');
    }
    
    if ( empty($title) || mb_strlen($title) > 100 )
    {
        wp_die('标题必须填写，且长度不得超过100字');
    }
    
    if ( empty($content) || mb_strlen($content) > 3000 || mb_strlen($content) < 50)
    {
        wp_die('内容必须填写，且长度不得超过3000字，不得少于50字');
    }
    
    $post_content = '昵称: '.$name.'<br />Email: '.$email.'<br />blog: '.$blog.'<br />内容:<br />'.$content;
  
    $tougao = array(
        'post_title' => $title,
        'post_content' => $post_content,
        'post_category' => array($category),
		'tags_input' => $tags,
    );


    // 将文章插入数据库
    $status = wp_insert_post( $tougao );
  
    if ($status != 0) 
    { 
        // 投稿成功给博主发送邮件
        // somebody#example.com替换博主邮箱
        // My subject替换为邮件标题，content替换为邮件内容
        wp_mail("ishare_web@163.com","有新的投稿","content");

        wp_die('投稿成功！感谢投稿！<br />
							<p><a href="javascript:history.back();">返回前一页</a></p>', '投稿成功');
    }
    else
    {
        wp_die('投稿失败！<br />
							<p><a href="javascript:history.back();">返回前一页</a></p>');
    }
}
 get_header(); ?>






			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div id="content">
				<div class="f-s"></div>
				<div class="f-m">
					<h2>
						<em><a title="回到首页" href="<?php bloginfo('home'); ?>">首页</a></em>
						<span class="cut">&raquo;</span>
						<em><?php the_title(); ?></em>
					</h2>
					<div class="box" id="post-<?php the_ID(); ?>">
						<div id="page-cnt">
						<?php the_content(); ?>

<!-- 关于表单样式，请自行调整-->
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
    <div style="text-align: left; padding-top: 10px;">
        <input type="text" size="40" value="" id="tougao_authorname" name="tougao_authorname" />
        <label for="tougao_authorname">昵称:*</label>

    </div>

    <div style="text-align: left; padding-top: 10px;">
        <input type="text" size="40" value="" id="tougao_authoremail" name="tougao_authoremail" />
        <label for="tougao_authoremail">E-Mail:*</label>
    </div>
                    
    <div style="text-align: left; padding-top: 10px;">
        <input type="text" size="40" value="" id="tougao_authorblog" name="tougao_authorblog" />
        <label for="tougao_authorblog">您的博客:</label>
    </div>

    <div style="text-align: left; padding-top: 10px;">
        <label for="tougao_title">文章标题:*</label><br>
        <input type="text" size="40" value="" id="tougao_title" style="width: 400px; height: 20px" name="tougao_title" />
      </p>
    </div>

    <div style="text-align: left; padding-top: 10px;">
        <label for="tougaocategorg">分类:*</label>
        <?php wp_dropdown_categories('id=tougaocategorg&show_count=1&hierarchical=1'); ?>
    </div>
      
    <div style="text-align: left; padding-top: 10px;">
		<label>文章标签(多个用半角逗号隔开):</label>
	</div>
	<div>
		<input type="text" size="40" value="" style="width: 300px; height: 20px" name="tougao_tags" />
	</div>
                  
    <div style="text-align: left; padding-top: 10px;">
        <label for="tougao_content">文章内容:*</label><br />
        <textarea rows="40" cols="110" id="tougao_content" name="tougao_content" class="xheditor" style="width: 690px; border: 1px solid #CCC"></textarea>
    </div>
                    
    <br clear="all">
    <div style="padding-top: 10px;">
        <input type="hidden" value="send" name="tougao_form" />
        <span class="btn"><span><button type="submit" name="submit" id="submit" tabindex="5" style="height: 25px">提交(Ctrl+Enter)</button></span></span>
	<span class="btn"><span><button type="reset" style="height: 25px">重置</button></span></span>
    </div>
</form>
		</div>
					</div>

				</div>
				<div class="f-e"></div>
			</div><!-- /content -->
			<?php endwhile; ?>
<script type="text/javascript" src="/xh/xheditor-1.1.13-zh-cn.min.js"></script>
			<?php if (comments_open()) comments_template( '', true ); ?>

<?php
	get_sidebar();
	get_footer();
?>