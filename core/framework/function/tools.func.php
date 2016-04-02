<?php
/**
 * @doc 工具类函数
 * @filesource tools.func.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-08-26 13:39:36
 */
require_once( PATH_ABS_BASE_CORE.'include/bankTypeList.php');
/**
 * @doc 识别银行卡类型
 * @author Heanes
 * @param string $card 卡号
 * @param array $bankList 银行卡类型库
 * @time 2015-08-26 13:46:54
 */
function bankType($card, $bankList){
	$card_8 = substr($card, 0, 8);
	if (isset($bankList[$card_8])){
		echo $bankList[$card_8];
		return;
	}
	$card_6 = substr($card, 0, 6);
	if (isset($bankList[$card_6])){
		echo $bankList[$card_6];
		return;
	}
	$card_5 = substr($card, 0, 5);
	if (isset($bankList[$card_5])){
		echo $bankList[$card_5];
		return;
	}
	$card_4 = substr($card, 0, 4);
	if (isset($bankList[$card_4])){
		echo $bankList[$card_4];
		return;
	}
	echo '该卡号信息暂未录入';
}
//bankType('622908328618283013', $bankList);//兴业银行