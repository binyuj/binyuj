<?php get_header(); ?>

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div id="friendly">
				<div class="f-s"></div>
				<div class="f-m">
					<h2>
						<em><a title="回到首页" href="<?php bloginfo('home'); ?>">首页</a></em>
						<span class="cut">&raquo;</span>
						<em><?php the_title(); ?></em>
					</h2>
					<div class="box">
						<div id="page-cnt" class="friends">
							<?php the_content(); ?>
							<h3>图片链接</h3>
							<ul id="friendly-img" class="clearfix">
								<?php tstyle_links("img") ?>
							</ul>
							<h3>文字链接</h3>
							<ul id="friendly-txt" class="clearfix">
								<?php tstyle_links("txt") ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="f-e"></div>
			</div><!-- /friendly -->
			<?php endwhile; ?>

<?php
	get_sidebar();
	get_footer();
?>