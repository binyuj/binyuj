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
						<div id="page-cnt"><?php the_content(); ?></div>
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