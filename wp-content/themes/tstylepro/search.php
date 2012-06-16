<?php get_header(); ?>

			<div id="archive">
				<div class="f-s"></div>
				<div class="f-m">
					<h2>
						<span><?php the_search_query(); ?></span>
						<em>的搜索结果</em>
					</h2>
					<div class="box">
						<ul class="list">
<?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>
            <span class="articlelist">
				<h3>
                	<p class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
	<?php if(date("ymd") - get_the_time("ymd") <= 3) echo '<i class="new">最新</i>'; ?>
	<?php if(get_comments_number() > 10) echo '<i class="hot">热门</i>'; ?>
	<?php if(is_sticky()) echo '<i class="top">推荐</i>'; ?>
                    <p class="time"><span class="ico view" title="点击量"><?php echo getPostViews(get_the_ID()); ?></span>
							<span class="ico cmt" title="文章评论"><a href="#comment-list"><?php comments_number('0','1','%'); ?></a></span> |  <span title="发表时间"><?php the_time('Y年m月j日'); ?></span></p>
                </h3>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo catch_that_image() ?>" alt="<?php the_title(); ?>" /></a>
                <p class="abstract"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 310,"..."); ?><a href="<?php the_permalink(); ?>" rel="nofollow">阅读全文 </a></p>
            </span>
		<?php endwhile; ?>
	<?php else : ?>
		<h3>没有找到你要的文章！</h3>
		<p>抱歉,你要找的文章不在这里.</p>
        <?php endif; ?>
						</ul>

						<?php wp_pagenavi(); ?>

					</div>
				</div>
				<div class="f-e"></div>
			</div><!-- /archive -->

<?php
	get_sidebar();
	get_footer();
?>