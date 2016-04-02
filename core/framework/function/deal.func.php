<?php
/**
 * @doc 交易相关函数
 * @filesource deal.func.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-08 13:24:28
 */


/**
 * @doc 价格格式化
 * @param int $price 价格数
 * @return string $price_format 格式化后的价格
 */
function fgPriceFormat($price) {
	$price_format	= number_format($price,2,'.','');
	return $price_format;
}
