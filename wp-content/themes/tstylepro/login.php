			<div id="login" class="col-6 last">
				<div class="f-s"></div>
				<div class="f-m">
					<h2>
						<em>用户登录</em>
						<span>Login</span>
					</h2>
<?php if (!(current_user_can('level_0'))){ ?>
<form name="loginform" action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
	<div class="box">
	<p> 
		<label>用户名:<input type="text" name="log" style="width: 130px;" value="" size="20" /></label> 
	</p> 
	<p> 
		<label>密　码:<input type="password" name="pwd" style="width: 130px;" value="" size="20" /></label> 
	</p> 
	<p> 
		<label><input name="rememberme" type="checkbox" value="forever" class="rmb" /> 记住密码　<input type="submit" name="submit" value=" 登 录 " class="rm" style="width: 35px;" /></label>
	</p>
	<p>
		<a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword" title="忘记密码？点此去找回密码">找回密码</a>
		<a class="rm" href="<?php echo get_option('home'); ?>/wp-login.php?action=register" title="还没注册？点此去注册吧"> 用户注册</a>
	</p>
	</div>
		<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
</form>
<?php } else { ?>
<div class="box">
	<div class="info" >
   <P><?php echo '尊敬的' . wt_get_user_name(); ?>. 欢迎回来!</P>
   <P>祝您浏览愉快 O(∩_∩)O~</P>
 	</div>
	<p>
	<a href="<?php bloginfo('home'); ?>/wp-admin/" target="_blank">进入后台</a>
	<a class="rm" href="<?php echo wp_logout_url( get_bloginfo('url') ); ?>" title="">退出登录</a>
</p>
</div>
<?php }?>
				</div>
				<div class="f-e"></div>
			</div>