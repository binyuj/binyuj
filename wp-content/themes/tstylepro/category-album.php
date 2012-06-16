<?php get_header(); ?>

			<div id="album">
				<div class="f-s"></div>
				<div class="f-m">
					<h2>
						<em><a title="回到首页" href="<?php bloginfo('home'); ?>">首页</a></em>	
						<span class="cut">&raquo;</span>
						<em>
						<?php if ( get_category($cat)->category_parent ) : ?>
						<?php the_category('</em> <span class="cut">&raquo;</span>  <em><!-- ', 'multiple'); ?>-->
						<?php endif; ?>
						<?php single_cat_title(); ?>
						</em>
					</h2>
					<div class="box clearfix">
						<ul id="album-list" class="clearfix">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post('orderby=sticky'); ?>
<li id="post-<?php the_ID(); ?>">
	<span class="cover"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a></span>
	<span class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></span>
</li>
<?php endwhile; endif; ?>

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