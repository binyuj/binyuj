<?php get_header(); ?>

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
						<div id="page-cnt" class="tags">
							<?php wp_tag_cloud('smallest=9&largest=13&number=160&orderby=count&order=DESC'); ?>
						</div>
					</div>

				</div>
				<div class="f-e"></div>
			</div><!-- /content -->
			<?php endwhile; ?>

<?php
	get_sidebar();
	get_footer();
?>