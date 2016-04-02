<?php
/**
 * @doc 
 * @filesource text.func.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015年6月8日下午1:33:10
 */

/**
 * @doc 格式化ubb标签
 * @param string $theme_content/$reply_content 话题内容/回复内容
 * @return string
 * @author Heanes
 * @time 2015-06-08 13:33:39
 */
function ubb($ubb){
	$ubb = str_replace(array(
			'[B]', '[/B]', '[I]', '[/I]', '[U]', '[/U]', '[IMG]', '[/IMG]', '[/FONT]', '[/FONT-SIZE]', '[/FONT-COLOR]'
	), array(
			'<b>', '</b>', '<i>', '</i>', '<u>', '</u>', '<img class="pic" src="', '"/>', '</span>', '</span>', '</span>'
	), preg_replace(array(
			"/\[URL=(.*)\](.*)\[\/URL\]/iU",
			"/\[FONT=([A-Za-z ]*)\]/iU",
			"/\[FONT-SIZE=([0-9]*)\]/iU",
			"/\[FONT-COLOR=([A-Za-z0-9]*)\]/iU",
			"/\[SMILIER=([A-Za-z_]*)\/\]/iU",
			"/\[FLASH\](.*)\[\/FLASH\]/iU",
			"/\\n/i"
	), array(
			"<a href=\"$1\" target=\"_blank\">$2</a>",
			"<span style=\"font-family:$1\">",
			"<span style=\"font-size:$1px\">",
			"<span style=\"color:#$1\">",
			"<img src=\"".CIRCLE_SITE_URL.'/templates/'.TPL_CIRCLE_NAME."/images/smilier/$1.png\">",
			"<embed src=\"$1\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" wmode=\"opaque\" width=\"480\" height=\"400\"></embed>",
			"<br />"
	), $ubb));
	return $ubb;
}
/**
 * @doc 去掉ubb标签
 * @param string $theme_content/$reply_content 话题内容/回复内容
 * @return string
 * @author Heanes
 * @time 2015-06-08 13:33:59
 */
function removeUBBTag($ubb){
	$ubb = str_replace(array(
			'[B]', '[/B]', '[I]', '[/I]', '[U]', '[/U]', '[/FONT]', '[/FONT-SIZE]', '[/FONT-COLOR]'
	), array(
			'', '', '', '', '', '', '', '', ''
	), preg_replace(array(
			"/\[URL=(.*)\](.*)\[\/URL\]/iU",
			"/\[FONT=([A-Za-z ]*)\]/iU",
			"/\[FONT-SIZE=([0-9]*)\]/iU",
			"/\[FONT-COLOR=([A-Za-z0-9]*)\]/iU",
			"/\[SMILIER=([A-Za-z_]*)\/\]/iU",
			"/\[IMG\](.*)\[\/IMG\]/iU",
			"/\[FLASH\](.*)\[\/FLASH\]/iU",
			"<img class='pi' src=\"$1\"/>",
	), array(
			"$2",
			"",
			"",
			"",
			"",
			"",
			"",
			""
	), $ubb));
	return $ubb;
}