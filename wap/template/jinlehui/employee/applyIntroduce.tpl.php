<?php
/**
 * @doc 加入金鹰的介绍信息
 * @author Heanes
 * @time 2015-07-09 14:52:13
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap" style="background:#2a2625;">
	<div class="introduce-partjober bg-gray">
		<div class="introduce-title" style="color:#155580;">
			<h1 style="font-size:24px;font-family:KaiTi,serif">金鹰，金融行业的大咖，金乐汇的VIP</h1>
		</div>
		<div class="english-title">
			<fieldset style="color:#a9a7a8;border-top:1px solid #fff;text-align:center;">
				<legend style="padding:0 4px;margin:0;font-size:16px;">join us</legend>
			</fieldset>
		</div>
		<div class="introduce-content">
			<div class="introduce-text">
				<p>中国领先的移动互联网金融超市——金乐汇，以云计算、大数据分析等技术让贷款行业进入移动互联网时代。金乐汇提供给力的产品和私人定制化的服务，搭建金鹰与金融机构、客户之间的桥梁，完全解决了贷款行业的难点和痛点。金乐汇以高效的产品研发、严格的平台监控为金鹰提供全面的业务支持和权益保障，让每位金鹰在时间自由、空间自由的基础上实现财富自由！</p>
			</div>
			<div class="introduce-subtitle" style="color:#155580;font-family:'Microsoft YaHei',SimHei,serif">
				<h2>必须成为金鹰的八大理由</h2>
			</div>
			<div class="introduce-text text-center" style="line-height:20px;font-family:KaiTi,serif;font-size:18px;font-weight:600;">
				<p>渠道稳定    产品给力</p>
				<p>产品丰富    点位超低</p>
				<p>明码标价    透明操作</p>
				<p>智能结算    极速返佣</p>
				<p>领先科技    安全高效</p>
				<p>军工品质    信誉保障</p>
				<p>贷动未来    金鹰先行</p>
				<p>金融大咖    谁主沉浮</p>
			</div>
			<div class="bg-wave"></div>
			<div class="introduce-subtitle" style="background:#fff;color:#155580;font-family:'Microsoft YaHei',SimHei,serif">
				<h2>金鹰尊享</h2>
			</div>
			<div class="introduce-text" style="background:#fff;line-height:26px;">
				<ol class="ol-no-reset">
					<li>平台点位以上部分，高出全返。</li>
					<li>金鹰成单奖励积分，当月累计积分2万以上奖励现金3000元。当月累计积分5万以上，奖励现金8000元。</li>
					<li>金鹰组建自己的营销团队，奖励团队业绩的10%。</li>
					<li>金鹰成单奖励的金币，可用于金宝街消费支付。</li>
					<li>金鹰实行实名制注册，终身享受以上权益。</li>
				</ol>
				<!--
				<p>1.平台点位以上部分，高出全返。</p>
				<p>2.金鹰成单奖励积分，当月累计积分2万以上奖励现金3000元。当月累计积分5万以上，奖励现金8000元。</p>
				<p>3.金鹰组建自己的营销团队，奖励团队业绩的10%。</p>
				<p>4.金鹰成单奖励的金币，可用于金宝街消费支付。</p>
				<p>5.金鹰实行实名制注册，终身享受以上权益。</p>
				-->
			</div>
			<div class="bg-wave-reverse"></div>
			<div class="introduce-subtitle" style="color:#155580;font-family:'Microsoft YaHei',SimHei,serif">
				<h2>本期活动</h2>
			</div>
			<div class="introduce-text no-text-indent" style="line-height:26px;">
				<ol class="ol-no-reset">
					<li>当月累计积分10000，送POS机（T+0）</li>
					<li>当月累计积分30000，送手表（全自动机械，男、女款任选）</li>
					<li>当月累计积分50000，送家电四件套（微波炉+电饭煲+电磁炉+烤箱）</li>
					<li>当月累计积分80000，送金条（10g）</li>
					<li>当月累计积分100000，送韩国六日游  （首尔+济州岛）</li>
				</ol>
				<!--
				<p>1.当月累计积分10000，送POS机（T+0）</p>
				<p>2.当月累计积分30000，送手表（全自动机械，男、女款任选）</p>
				<p>3.当月累计积分50000，送家电四件套（微波炉+电饭煲+电磁炉+烤箱）</p>
				<p>4.当月累计积分80000，送金条（10g）</p>
				<p>5.当月累计积分100000，送韩国六日游  （首尔+济州岛）</p>
				-->
			</div>
			<div class="introduce-number">
				<div class="introduce-number-block">
					<span class="introduce-num"><strong>5</strong><strong>9</strong><strong>9</strong><strong>6</strong>人</span>
					<p class="publicity">截止目前已有5996人加入金乐汇，成为大富翁</p>
				</div>
				<div class="introduce-number-block">
					<span class="introduce-num"><strong>3</strong><strong>6</strong><strong>4</strong>万</span>
					<p class="publicity">截止目前大富翁已累计收益364万元</p>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="introduce-handle bg-gray">
		<a href="<?php echo BASE_URL.'index.php?act=employee&op=joinIn';if(isset($output['invite']))echo '&invite='.$output['invite']?>"><button class="join-button">立即加入</button></a>
	</div>
</div>