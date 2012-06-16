<div id="choice" class="col-11 last">
	<ul class="tab">
		<li><a href="#choice-1">最新发表</a></li>
		<li><a href="#choice-2">热评文章</a></li>
		<li><a href="#choice-3">随机文章</a></li>
	</ul>
	<div class="f-m">
		<div id="choice-1">
			<ul class="list">
			<?php query_posts('posts_per_page=8&caller_get_posts=1'); ?>
			<?php while (have_posts()) : the_post(); ?>
				<li>
					<em><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></em>
					<span class="date"><?php the_time('m-d H:i'); ?></span>
				</li>
			<?php endwhile; ?>
			</ul>
		</div>
		<div id="choice-2">
			<ul class="list">
			<?php query_posts('posts_per_page=8&caller_get_posts=1&orderby=comment_count'); ?>
			<?php while (have_posts()) : the_post(); ?>
				<li>
					<em><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></em>
					<span class="date"><?php the_time('m-d H:i'); ?></span>
				</li>
			<?php endwhile; ?>
			</ul>
		</div>
		<div id="choice-3">
			<ul class="list">
			<?php query_posts('posts_per_page=8&caller_get_posts=1&orderby=rand'); ?>
			<?php while (have_posts()) : the_post(); ?>
				<li>
					<em><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></em>
					<span class="date"><?php the_time('m-d H:i'); ?></span>
				</li>
			<?php endwhile; ?>
			</ul>
		</div>
	</div>
	<div class="f-e"></div>
</div><!-- /choice -->