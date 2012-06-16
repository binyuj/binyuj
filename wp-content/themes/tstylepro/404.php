<?php get_header(); ?>

			<div id="content">
				<div class="f-s"></div>
				<div class="f-m">
					<h2>
						<em>错误：404 找不到该页面</em>
					</h2>
					<div class="box">
						<h1 class="dotted">HTTP 404: Not Found</h1>
						<div id="article-cnt">
							<br >
							<center><h2>对不起，您所访问的页面不存在。</h2></center>
							
							<br >
							<div style="float: left; "><strong>请继续你的操作：</strong>
							<p><a href="<?php bloginfo('home'); ?>">返回首页</a></p>
							<p><a href="javascript:history.back();">返回前一页</a></p>
							<p><a href="#" onclick="TsFlicker('contact');">向站长报告错误</a></p>
							<p><label for="s"><strong onclick="TsFlicker('search');">点这里使用搜索功能</strong></label></p></div>
<div style="background: url(https://lh5.googleusercontent.com/-GX1Umll3g14/T4JOYs14GpI/AAAAAAAAAM8/zo5M0Ux7oHw/s500/404.jpeg); width: 500px; height: 454px; float: right; " ></div>
						</div>
					</div>

				</div>
				<div class="f-e"></div>
			</div><!-- /content -->

<?php
	get_sidebar();
	get_footer();
?>