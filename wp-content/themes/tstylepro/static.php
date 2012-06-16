<div id="S-blog" class="col-6 last">
	<div class="f-s"></div>
		<div class="f-m" >
		<h2>
			<em>博客统计</em>
			<span>Static</span>
		</h2>
			<div class="box">
<ul>
<li style="padding:2px 0 0 10px">日志总数：<?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?> 篇</li>
<li style="padding:2px 0 0 10px">分类总数：<?php echo $count_categories = wp_count_terms('category'); ?></li>
<li style="padding:2px 0 0 10px">页面总数：<?php $count_pages = wp_count_posts('page'); echo $page_posts = $count_pages->publish; ?></li>

<li style="padding:2px 0 0 10px">标签数量：<?php echo $count_tags = wp_count_terms('post_tag'); ?> 个</li>
<li style="padding:2px 0 0 10px">运行天数：<?php echo floor((time()-strtotime("2011-9-30"))/86400); ?> 天</li>				
<li style="padding:2px 0 0 10px">建站日期：2011-09-30</li> <!-- 其中2009-09-09改成自己的建站日期 -->

<li style="padding:2px 0 0 10px"><?php printf(' 内存使用: %01.2f MB', memory_get_usage()/1024/1024); ?></li>

</ul>
				</div>
		</div>
	<div class="f-e"></div>
</div>