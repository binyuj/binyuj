			<div id="comment-list">
				<div class="f-s"></div>
				<div class="f-m">
					<h2>
						<?php $pagetype = (is_page('guestbook')) ? '留言' : '评论'; ?>
						<em><?php echo $pagetype; ?></em>
						<span class="thin"> 共<?php comments_number('0','1','%'); ?>条</span>
						<span class="thin"> (<?php printf(__("<a target='_blank' href='%s'>RSS 2.0</a>", "kubrick"), get_post_comments_feed_link()); ?>)</span>
						<a class="to-respond" href="#respond">发表<?php echo $pagetype; ?></a>
					</h2>
					<div class="box">

						<ol class="commentlist">
						<?php if ($comments) : ?>
							<?php wp_list_comments('type=comment&avatar_size=48'); ?>
						<?php else: ?>
							<li class="no-comment"><?php _e('暂无评论，快抢沙发吧。'); ?></li>
						<?php endif; ?>

						</ol>
<?php
if (get_option('page_comments')) {
	$comment_pages = paginate_comments_links('echo=0&prev_text=‹&next_text=›&type=list');
  	if ($comment_pages) {
?>
<ul class="pagination">
	<?php echo $comment_pages; ?>
</ul>
<?php }}; ?>
					</div>

				</div>
				<div class="f-e"></div>
			</div><!-- /comment-list -->

			<div id="respond">
				<div class="f-s"></div>
				<div class="f-m">
					<h2>
						<em>发表<?php echo $pagetype; ?></em>
					</h2>
					<div class="box">
						<ul id="respond-form">

						<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<div  style="width: 381px; float: left;">
<?php if ( is_user_logged_in() ) : ?>

<li><?php printf(__('Logged in as %s.'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account') ?>"><?php _e('Log out &raquo;'); ?></a></li>

<?php else : ?>
							<li>
								<label for="author"><?php _e('Name'); ?> <?php if ($req) _e('(required)'); ?></label>
								<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" />
							</li>
							<li>
								<label for="email"><?php _e('Mail (will not be published)');?> <?php if ($req) _e('(required)'); ?></label>
								<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" />
							</li>
							<li>
								<label for="url"><?php _e('Website'); ?></label>
								<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" />
							</li>
<?php endif; ?>

<li>
<?php echo WelcomeCommentAuthorBack($comment_author_email); ?>
</li>

</div>

<div id="real-avatar" style="float: right; margin: 10px;">
    <?php if(isset($_COOKIE['comment_author_email_'.COOKIEHASH])) : ?>
        <?php echo get_avatar($comment_author_email, 50);?>
    <?php else :?>
        <?php global $user_email;?><?php echo get_avatar($user_email, 50); ?>
    <?php endif;?>
</div>


<li>
  <?php if ( function_exists(cs_print_smilies) ) {cs_print_smilies();} ?>
</li>
<li style="padding-top: 2px;">
<div id="editor_tools">
   <a href="javascript:SIMPALED.Editor.strong()">粗体</a>
    <a href="javascript:SIMPALED.Editor.em()">斜体</a>
    <a href="javascript:SIMPALED.Editor.del()">删除线</a>
    <a href="javascript:SIMPALED.Editor.underline()">下划线</a>
    <a href="javascript:SIMPALED.Editor.ahref()">链接</a>
    <a href="javascript:SIMPALED.Editor.code()">插代码</a>
    <a href="javascript:SIMPALED.Editor.quote()">引用</a>
    <a href="javascript:SIMPALED.Editor.img()">插图</a>
</div>
</li>

								<textarea name="comment" id="comment" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
						</li>
							<li class="form-post">
								<span class="btn"><span><button type="submit" name="submit" id="submit" tabindex="5">提交(Ctrl+Enter)</button></span></span>
								<span class="btn"><span><button type="reset">重置</button></span></span>
								<span class="btn cancel"><span><button type="button" id="cancel-comment-reply-link">取消回复</button></span></span>
<p id="wordcount" style="float: right;">
    您已输入 <span id="str">0</span> 个字
</p>
	
							</li>
							<?php comment_id_fields(); ?>
							<?php do_action( 'comment_form', $post_id ); ?>
						</form>
						</ul>
					</div>
				</div>
				<div class="f-e"></div>
			</div><!-- /respond -->


<?php if ( post_password_required() ) : ?>
<p><?php _e('Enter your password to view comments.'); ?></p>
<?php return; endif; ?>
<?php if ( comments_open() ) : ?>
	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url( get_permalink() ) );?></p>
	<?php else : ?>
	<?php endif; // If registration required and not logged in ?>
<?php else : // Comments are closed ?>
<?php _e(''); ?>
<?php endif; ?>
<!-- pingbacks -->
<?php
	$trackbacks = $comments_by_type['pings'];
?>
<?php if ($trackbacks) : ?>
			<div id="pingbacks">
				<div class="f-s"></div>
					<div class="f-m">
						<h2>(<?php echo count($trackbacks); ?>) Trackbacks/Pingbacks</h2> <!-- 有 Trackbacks 总数 -->
						<div class="box">
							<ul class="commentlist">
								<?php foreach ($trackbacks as $comment) : ?>
									<li id="comment-<?php comment_ID( ); ?>" class="trackback"><strong></strong><?php comment_author_link(); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				<div class="f-e"></div>
			</div>
<?php endif; ?><!-- /pingbacks -->