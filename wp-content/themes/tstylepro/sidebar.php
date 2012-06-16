		</div><!-- /main -->


		<div id="side" class="col-6 last">

	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-Top') ) : else : ?>
	<?php endif; ?>

			<div id="contact" class="col-6 last">
				<div class="f-s"></div>
				<div class="f-m">
					<h2>
						<em>联系我</em>
						<span>Contact Me</span>
					</h2>
					<div class="box">
						<ul id="contact-li">
							<li class="email"><a href="<?php echo stripslashes(get_theme_mod('ts_mail')); ?>" title="<?php echo stripslashes(get_theme_mod('ts_ctc1')); ?>"><?php echo stripslashes(get_theme_mod('ts_tit1')); ?></a></li>
							<li class="twitter"><a target="_blank" href="<?php echo stripslashes(get_theme_mod('ts_mb')); ?>" title="<?php echo stripslashes(get_theme_mod('ts_ctc2')); ?>"><?php echo stripslashes(get_theme_mod('ts_tit2')); ?></a></li>
							<li class="qq"><a target="_blank" href="<?php echo stripslashes(get_theme_mod('ts_qq')); ?>" title="<?php echo stripslashes(get_theme_mod('ts_ctc3')); ?>"><?php echo stripslashes(get_theme_mod('ts_tit3')); ?></a></li>
							<li class="msn"><a href="<?php echo stripslashes(get_theme_mod('ts_msn')); ?>" title="<?php echo stripslashes(get_theme_mod('ts_ctc4')); ?>"><?php echo stripslashes(get_theme_mod('ts_tit4')); ?></a></li>
						</ul>
					</div>


				</div>
				<div class="f-e"></div>
			</div><!-- /contact -->

<?php
	wp_reset_query();
	if (!is_home()) include("focus.php");
?><!-- focus -->

			<div id="side-cmt" class="col-6 last">
				<ul class="tab">
					<li><a href="#side-cmtli-1">最新评论</a></li>
					<li><a href="#side-cmtli-2">最新留言</a></li>
				</ul>
				<div class="f-m">
					<ul id="side-cmtli-1" class="side-cmtli">
						<?php if (function_exists('recent_comment')) recent_comment(); ?>
					</ul>
					<ul id="side-cmtli-2" class="side-cmtli">
						<?php if (function_exists('recent_comment')) recent_comment(guestbook); ?>
					</ul>
				</div>
				<div class="f-e"></div>
			</div><!-- /side-cmt -->
<?php
	wp_reset_query();
	if (!is_category() && !is_page("tags")) :
?>

			<div id="side-dfn" class="col-6 last">
				<div class="f-s"></div>
				<div class="f-m">
					<h2>
						<em>标签云</em>
						<span>Tag Cloud</span>
						<a class="more" title="更多..." href="<?php ts_geturl("tags"); ?>">更多...</a>
					</h2>
					<div id="side-tags" class="tags">
						<?php wp_tag_cloud('smallest=9&largest=12&number=28&orderby=count&order=RAND'); ?>
					</div>

				</div>
				<div class="f-e"></div>
			</div><!-- /home-dfn -->
<?php endif; ?>


<?php if (is_home()) { ?>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(首页) ) : ?>
	<?php endif; ?>
<?php } elseif( is_single() ) { ?>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(文章页) ) : ?>
	<?php endif; ?>
<?php } else { ?>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(其他页) ) : ?>
	<?php endif; ?>
<?php } ?>

		</div><!-- /side -->