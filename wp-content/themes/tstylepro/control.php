<?php
$themename = "TStyle Pro";
//$settings = "theme_mods_tstylepro";
$settings = "theme_mods_".get_template();
$ts_defaults = array(
	'ts_ctc1' => '电子邮件',
	'ts_ctc2' => '微博',
	'ts_ctc3' => 'QQ',
	'ts_ctc4' => 'MSN',
	'ts_mail' => 'mailto:你的EMail',
	'ts_mb' => 'http://你的微博',
	'ts_qq' => 'http://wpa.qq.com/msgrd?V=1&Menu=yes&Uin=你的QQ',
	'ts_msn' => 'msnim:chat?contact=你的MSN',
	'ts_clm1' => '0',
	'ts_clm2' => '0',
	'ts_clm3' => '0',
	'ts_clm4' => '0',
	'ts_clm5' => '0',
	'ts_clm6' => '0',
	'ts_clm7' => '0',
	'ts_clm8' => '0',
	'ts_ad1' => '<a target="_blank" href="http://item.taobao.com/auction/item_detail.htm?item_num_id=8685067590"><img src="http://www.dafi.cn/wp-content/themes/tstylepro/img/head-banner.gif" alt="TStyle Pro" /></a>',
	'ts_ad2' => '广告2代码',
	'ts_ad3' => '广告3代码',
	'ts_icp' => '备案号',
);

add_option($settings, $ts_defaults); //写入数据

add_action('admin_menu', 'mytheme_add_admin'); //载入侧栏

function register_theme_settings() {
	global $settings;
	register_setting($settings, $settings);
}

function mytheme_add_admin() {
    global $themename, $settings, $ts_defaults;
	add_options_page($themename." Options", "$themename "."设置", 'edit_themes', basename(__FILE__), 'tstyle_admin');
	register_setting($settings, $settings);
}
function tstyle_admin() {
?>
<style>
<!--
#all_cat span { display: inline-block; white-space: nowrap; margin-right: 10px; font-size: 12px; }
#all_cat em { font-weight: bold; color: #c00; font-style: normal; }
.small-txt { width: 32px; text-align: center; }
.large-text { height: 50px; }
.general-text { width: 150px; }
.ts-info { display: block; color: #888; }
.settings-error { display: none; }
-->
</style>
<div class="wrap">
<?php
    global $themename, $settings, $ts_defaults;
	if(get_theme_mod('reset')) {
		echo '<div id="setting-error-settings_updated" class="updated"><p><strong>已恢复默认设置。</strong></p></div>';
		update_option($settings, $ts_defaults);
	} elseif($_REQUEST['updated'] == 'true') {
		echo '<div id="setting-error-settings_updated" class="updated"><p><strong>设置已保存。</strong></p></div>';
	}
	screen_icon('options-general');
?>
	<h2><?php echo $themename.' 主题设置'; ?></h2>
	<form method="post" action="options.php">
		<?php settings_fields($settings); ?>
		<h3 style="margin:20px 0 0;">网站备案号</h3>
		<table class="form-table">
			<tr> 
				<th>网站备案号：</th>
				<td><input type="text" class="regular-text" name="<?php echo $settings; ?>[ts_icp]" value="<?php echo stripslashes(get_theme_mod('ts_icp')); ?>" /></td>
			</tr>
		</table>
		<h3 style="margin:20px 0 0;">联系方式</h3>
		<p class="ts-info">设置网站右侧的"联系我"，默认有四个方法：邮件、微博、QQ、MSN，你也可以自己更改图标后改变链接的值。</p>
		<table class="form-table">
			<tr> 
				<th><input type="text" class="general-text" name="<?php echo $settings; ?>[ts_ctc1]" value="<?php echo stripslashes(get_theme_mod('ts_ctc1')); ?>" />：</th>
				<td><input type="text" class="regular-text" name="<?php echo $settings; ?>[ts_mail]" value="<?php echo stripslashes(get_theme_mod('ts_mail')); ?>" /></td>
			</tr>
			<tr> 
				<th><input type="text" class="general-text" name="<?php echo $settings; ?>[ts_ctc2]" value="<?php echo stripslashes(get_theme_mod('ts_ctc2')); ?>" />：</th>
				<td><input type="text" class="regular-text" name="<?php echo $settings; ?>[ts_mb]" value="<?php echo stripslashes(get_theme_mod('ts_mb')); ?>" /></td>
			</tr>
			<tr> 
				<th><input type="text" class="general-text" name="<?php echo $settings; ?>[ts_ctc3]" value="<?php echo stripslashes(get_theme_mod('ts_ctc3')); ?>" />：</th>
				<td><input type="text" class="regular-text" name="<?php echo $settings; ?>[ts_qq]" value="<?php echo stripslashes(get_theme_mod('ts_qq')); ?>" /></td>
			</tr>
			<tr> 
				<th><input type="text" class="general-text" name="<?php echo $settings; ?>[ts_ctc4]" value="<?php echo stripslashes(get_theme_mod('ts_ctc4')); ?>" />：</th>
				<td><input type="text" class="regular-text" name="<?php echo $settings; ?>[ts_msn]" value="<?php echo stripslashes(get_theme_mod('ts_msn')); ?>" /></td>
			</tr>
		</table>
		<h3 style="margin:20px 0 0;">首页栏目调用</h3>
		<p class="ts-info">此处是设置网站首页左下方的栏目选项卡顺序，下面为你已建立的栏目及ID(括号内红色数字为栏目ID)，你的栏目不足8个的话，剩下的请填入0，请注意填写。</p>
		<div id="all_cat">
<?php
function show_category() {
	global $wpdb;
	$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
	$request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
	$request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
	$request .= " ORDER BY term_id asc";
	$categorys = $wpdb->get_results($request);
	foreach ($categorys as $category) { //调用菜单
		$output = '<span>'.$category->name."(<em>".$category->term_id.'</em>)</span>';
		echo $output;
	}
}//栏目列表结束
show_category();
?>
		</div>
		<table class="form-table">
			<tr>
				<th>首页调用的八个栏目ID：</th>
				<td>
					<input class="small-txt" name="<?php echo $settings; ?>[ts_clm1]" type="text" value="<?php echo stripslashes(get_theme_mod('ts_clm1')); ?>" />
					<input class="small-txt" name="<?php echo $settings; ?>[ts_clm2]" type="text" value="<?php echo stripslashes(get_theme_mod('ts_clm2')); ?>" />
					<input class="small-txt" name="<?php echo $settings; ?>[ts_clm3]" type="text" value="<?php echo stripslashes(get_theme_mod('ts_clm3')); ?>" />
					<input class="small-txt" name="<?php echo $settings; ?>[ts_clm4]" type="text" value="<?php echo stripslashes(get_theme_mod('ts_clm4')); ?>" />
					<input class="small-txt" name="<?php echo $settings; ?>[ts_clm5]" type="text" value="<?php echo stripslashes(get_theme_mod('ts_clm5')); ?>" />
					<input class="small-txt" name="<?php echo $settings; ?>[ts_clm6]" type="text" value="<?php echo stripslashes(get_theme_mod('ts_clm6')); ?>" />
					<input class="small-txt" name="<?php echo $settings; ?>[ts_clm7]" type="text" value="<?php echo stripslashes(get_theme_mod('ts_clm7')); ?>" />
					<input class="small-txt" name="<?php echo $settings; ?>[ts_clm8]" type="text" value="<?php echo stripslashes(get_theme_mod('ts_clm8')); ?>" />
					（顺序从左到右）
				</td>
			</tr>
		</table>
		<h3 style="margin:20px 0 0;">广告位</h3>
		<p class="ts-info">设置网站的广告代码，共有3个广告位：1.页面头部。 2.内容页文章内容右上角方块。 3.内容页文章内容底部横幅。</p>
		<table class="form-table">
			<tr> 
				<th>广告位一：</th>
				<td><textarea class="large-text code" name="<?php echo $settings; ?>[ts_ad1]"><?php echo stripslashes(get_theme_mod('ts_ad1')); ?></textarea><span class="ts-info">广告1位于页面头部，最佳大小为430*45。</span></td>
			</tr>
			<tr> 
				<th>广告位二：</th>
				<td><textarea class="large-text code" name="<?php echo $settings; ?>[ts_ad2]"><?php echo stripslashes(get_theme_mod('ts_ad2')); ?></textarea><span class="ts-info">广告2位于内容页文章内容右上角方块，最佳大小250*250。</span></td>
			</tr>
			<tr> 
				<th>广告位三：</th>
				<td><textarea class="large-text code" name="<?php echo $settings; ?>[ts_ad3]"><?php echo stripslashes(get_theme_mod('ts_ad3')); ?></textarea><span class="ts-info">广告3位于内容页文章内容底部横幅，你也可以把这个当作你的文章声明什么的，最佳宽度640。</span></td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" class="button-primary" value="修改设置" />
			<input type="submit" class="button-highlighted" name="<?php echo $settings; ?>[reset]" value="重置到初始数据(慎用)" />
		</p>
	</form>
</div>
<?php
}
?>