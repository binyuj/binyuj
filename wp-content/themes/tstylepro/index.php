<?php get_header(); ?>

			<div id="slide" class="col-7">
				<h2>幻灯片</h2>
				<div class="f-s"></div>
				<div class="f-m">
					<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.flow.js"></script>
<?php dafiSlide(5); ?>
				</div>
				<div class="f-e"></div>
			</div><!-- /slide -->

<?php include ("focus.php"); ?>

			<div id="home-album" class="col-18 last">
				<div class="f-s"></div>
				<div class="f-m">
					<h2>
						<em>相册图集</em>
						<span>Album</span>
						<a class="more" title="更多..." href="<?php ts_geturl("album", "cat"); ?>">更多...</a>
					</h2>
					<div class="box">
						<ul class="clearfix">
							<?php query_posts('category_name=album&posts_per_page=6&caller_get_posts=1'); ?>
							<?php while (have_posts()) : the_post(); ?>
								<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('home-thumb'); ?><span><?php the_title(); ?></span></a></li>
							<?php endwhile; ?>
						</ul>
					</div>
				</div>
				<div class="f-e"></div>
			</div><!-- /album -->

<!-- home-column -->

<!-- 修改首页分栏 -->
<div class="column-left" >
				<div class="f-s"></div>
		  <div class="f-m">
			  <h2><em>免费空间</em><span>Freehost</span><a class="more" href="/?cat=7" target="_blank">更多...</a></h2>
					<div class="column">
		    <ul class="list">
						  <?php query_posts('cat=7&posts_per_page=7&caller_get_posts=1'); ?>
						  <?php while (have_posts()) : the_post(); ?>
                          <li>			
                              <em><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></em>
                              	<?php if(get_comments_number() > 10) echo '<i class="hot">热门</i>'; ?>
								<?php if(date("ymd") - get_the_time("ymd") <= 2) echo '<i class="new">最新</i>'; ?>
								<?php if (is_sticky()) echo '<i class="top">置顶</i>'; ?>
								<span class="date"><?php the_time('m-d'); ?></span>	
						  </li>
                          <?php endwhile; ?>
                    </ul>
					</div>
				</div>
				<div class="f-e"></div>
			</div>
 
		<div class="column-right">
				<div class="f-s"></div>
				<div class="f-m">
					<h2><em>免费VPN</em><span>VPN</span><a class="more" href="/?cat=11" target="_blank">更多...</a></h2>
					<div class="column">
		    <ul class="list">
						  <?php query_posts('cat=11&posts_per_page=7&caller_get_posts=1'); ?>
						  <?php while (have_posts()) : the_post(); ?>
                          <li>			
                              <em><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></em>
                              	<?php if(get_comments_number() > 10) echo '<i class="hot">热门</i>'; ?>
								<?php if(date("ymd") - get_the_time("ymd") <= 2) echo '<i class="new">最新</i>'; ?>
								<?php if (is_sticky()) echo '<i class="top">置顶</i>'; ?>
								<span class="date"><?php the_time('m-d'); ?></span>	
						  </li>
                          <?php endwhile; ?>
                    </ul>
					</div>
				</div>
				<div class="f-e"></div>
			</div>
<!-- 第二行 -->
<div class="column-left" >
				<div class="f-s"></div>
		  <div class="f-m">
			  <h2><em>免费网盘</em><span>Freedisk</span><a class="more" href="/?cat=8" target="_blank">更多...</a></h2>
					<div class="column">
		    <ul class="list">
						  <?php query_posts('cat=8&posts_per_page=6&caller_get_posts=1'); ?>
						  <?php while (have_posts()) : the_post(); ?>
                          <li>			
                              <em><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></em>
                              	<?php if(get_comments_number() > 10) echo '<i class="hot">热门</i>'; ?>
								<?php if(date("ymd") - get_the_time("ymd") <= 2) echo '<i class="new">最新</i>'; ?>
								<?php if (is_sticky()) echo '<i class="top">置顶</i>'; ?>
								<span class="date"><?php the_time('m-d'); ?></span>	
						  </li>
                          <?php endwhile; ?>
                    </ul>
					</div>
				</div>
				<div class="f-e"></div>
			</div>
 
		<div class="column-right">
				<div class="f-s"></div>
				<div class="f-m">
					<h2><em>WordPress</em><span>WP</span><a class="more" href="/?cat=36" target="_blank">更多...</a></h2>
					<div class="column">
		    <ul class="list">
						  <?php query_posts('cat=36&posts_per_page=6&caller_get_posts=1'); ?>
						  <?php while (have_posts()) : the_post(); ?>
                          <li>			
                              <em><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></em>
                              	<?php if(get_comments_number() > 10) echo '<i class="hot">热门</i>'; ?>
								<?php if(date("ymd") - get_the_time("ymd") <= 2) echo '<i class="new">最新</i>'; ?>
								<?php if (is_sticky()) echo '<i class="top">置顶</i>'; ?>
								<span class="date"><?php the_time('m-d'); ?></span>	
						  </li>
                          <?php endwhile; ?>
                    </ul>
					</div>
				</div>
				<div class="f-e"></div>
			</div>
<!-- 第三行 -->
<div class="column-left" >
				<div class="f-s"></div>
		  <div class="f-m">
			  <h2><em>免费SSH</em><span>FreeSSH</span><a class="more" href="/?cat=12" target="_blank">更多...</a></h2>
					<div class="column">
		    <ul class="list">
						  <?php query_posts('cat=12&posts_per_page=6&caller_get_posts=1'); ?>
						  <?php while (have_posts()) : the_post(); ?>
                          <li>			
                              <em><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></em>
                              	<?php if(get_comments_number() > 10) echo '<i class="hot">热门</i>'; ?>
								<?php if(date("ymd") - get_the_time("ymd") <= 2) echo '<i class="new">最新</i>'; ?>
								<?php if (is_sticky()) echo '<i class="top">置顶</i>'; ?>
								<span class="date"><?php the_time('m-d'); ?></span>	
						  </li>
                          <?php endwhile; ?>
                    </ul>
					</div>
				</div>
				<div class="f-e"></div>
			</div>
 
		<div class="column-right">
				<div class="f-s"></div>
				<div class="f-m">
					<h2><em>软件分享</em><span>Software</span><a class="more" href="/?cat=13" target="_blank">更多...</a></h2>
					<div class="column">
		    <ul class="list">
						  <?php query_posts('cat=13&posts_per_page=6&caller_get_posts=1'); ?>
						  <?php while (have_posts()) : the_post(); ?>
                          <li>			
                              <em><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></em>
                              	<?php if(get_comments_number() > 10) echo '<i class="hot">热门</i>'; ?>
								<?php if(date("ymd") - get_the_time("ymd") <= 2) echo '<i class="new">最新</i>'; ?>
								<?php if (is_sticky()) echo '<i class="top">置顶</i>'; ?>
								<span class="date"><?php the_time('m-d'); ?></span>	
						  </li>
                          <?php endwhile; ?>
                    </ul>
					</div>
				</div>
				<div class="f-e"></div>
			</div>
<!-- /修改首页分栏 -->


<?php get_sidebar(); ?>

			<div id="friendly">
				<div class="f-s"></div>
				<div class="f-m">
					<h2>
						<em>友情链接</em>
						<span>Friendly</span>
						<a class="more" title="更多..." href="<?php ts_geturl("friendly"); ?>">更多...</a>
					</h2>
					<div class="box">	
						<h3>图片链接</h3>				
						<div id="friendly-img" class="clearfix">
							<?php tstyle_links("img",9) ?>
						</div>
						<h3>文字链接</h3>
						<div id="friendly-txt" class="clearfix">
							<?php tstyle_links("txt",24) ?>
						</div>
					</div>
				</div>
				<div class="f-e"></div>
			</div><!-- /friendly -->

<?php get_footer(); ?>