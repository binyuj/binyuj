<?php get_header(); ?>

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<!-- 不统计管理员查看量 -->
		<?php global $user_ID; if ( 1 != $user_ID) : ?>
<!-- 原统计查看量函数 -->		<?php setPostViews(get_the_ID()); ?>
		<?php endif; ?>
<!-- /不统计管理员查看量 -->
			<div id="content">
				<div class="f-s"></div>
				<div class="f-m">
					<h2>
						<em><a title="回到首页" href="<?php bloginfo('home'); ?>">首页</a></em>
						<span class="cut">&raquo;</span>
						<em><?php the_category(' </em><span class="cut">&raquo;</span><em> ',multiple); ?></em>
						<span class="cut">&raquo;</span>
						<em>阅读文章</em>
					</h2>
					<div class="box" id="post-<?php the_ID(); ?>">

						<h1><?php if(is_sticky()) echo '<span>[置顶]</span>'; the_title(); ?></h1>
						<div id="article-inf">
							<span class="ico date" title="发表时间"><?php the_time('Y-m-d H:i'); ?></span>
							<span class="ico view" title="点击量"><?php echo getPostViews(get_the_ID()); ?></span>
							<span class="ico cmt" title="文章评论"><a href="#comment-list"><?php comments_number('0','1','%'); ?></a></span>

选择字体：<a href="javascript:doZoom(18)">大</a> <a href="javascript:doZoom(14)">中</a> <a href="javascript:doZoom(12)">小</a>

							<?php edit_post_link( __('编辑文章'), '<span class="edit">', '</span>' ); ?>
							<?php if (comments_open()) : ?><span class="ico cmt add"><a href="#respond">发表评论</a></span><?php endif; ?>
						</div>
						<div id="article-cnt">
							<?php if (get_the_tags()): ?>
							<div id="article-tag">
								<?php the_tags('<strong>标签：</strong>', '，'); ?>
							</div>
							<?php endif; ?>
							<?php if (!in_category('album')) : ?>
							<!--<div id="article-dfn">
								<?php echo stripslashes(get_theme_mod('ts_ad2')); ?>
							</div>-->
							<?php endif; ?>

<span id="zoom" style="font-size:14px;">

							<?php the_content(); ?>

</span>



<?php if(is_single() && in_category('album')): //如果属于相册页面 ?>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.galleria.js"></script>
<script type="text/javascript">
	Galleria.loadTheme('<?php bloginfo('template_url'); ?>/css/galleria.classic.js');
	$(".gallery").galleria();
</script>
<?php endif; ?>

<?php
wp_link_pages('before=<p id="article-page">&after=&next_or_number=next&nextpagelink=&previouspagelink=<em><span class="prenext">‹</span></em>');
wp_link_pages('before=&after=&pagelink=<em><span>%</span></em>');
wp_link_pages('before=&after=</p>&next_or_number=next&previouspagelink=&nextpagelink=<em><span class="prenext">›</span></em>');
?>
							<div id="article-banner">
								<?php echo stripslashes(get_theme_mod('ts_ad3')); ?>
							</div>

<div id="wumiiDisplayDiv"></div>

<!-- JiaThis Button BEGIN -->
<script type="text/javascript">var jiathis_config = {data_track_clickback:true};</script>
<script type="text/javascript" src="http://v2.jiathis.com/code/jiathis_r.js?type=left&amp;move=0&amp;uid=1539138" charset="utf-8"></script>
<!-- JiaThis Button END -->

						</div>

						<?php if (!in_category('album')) : ?>
						<div id="p-n">
							<span class="ico prev"><?php previous_post_link('%link') ?></span>
							<span class="ico next last"><?php next_post_link('%link') ?></span>
						</div>
						<?php endif; ?>

					</div>

				</div>
				<div class="f-e"></div>
			</div><!-- /content -->
			<?php endwhile; ?>

			<?php if (comments_open()) comments_template( '', true ); ?>

<?php
	get_sidebar();
	get_footer();
?>