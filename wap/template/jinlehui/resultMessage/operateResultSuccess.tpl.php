<?php
/***
 * @doc 结果提示页，成功页
 * @author Heanes
 * @time 2015-07-29 16:39:41
 */
defined('InHeanes') or exit('Access Invalid!');?>
<div class="main-content w-wrap">
	<!-- 操作成功 -->
	<div class="operate-result">
		<div class="operate-result-success">
			<?php if(is_array($output['result'])){?>
				<div class="operate-result-title">
					<h3><?php echo empty($output['result']['title'])?'提示':$output['result']['title'];?></h3>
				</div>
				<div class="operate-result-text-content">
					<p><?php echo empty($output['result']['message'])?'操作成功':$output['result']['message'];?></p>
				</div>
				<div class="operate-result-jump">
					<ul class="jump-ul">
						<?php if(isset($output['result']['jump']['left'])){?>
						<li>
							<a class="button-normal jump-button-normal button-ok" href="<?php echo empty($output['result']['jump']['left']['href'])? $output['ref_url']:$output['result']['jump']['left']['href'];?>"><?php echo empty($output['result']['jump']['left']['text'])?'继续':$output['result']['jump']['left']['text'];?></a>
						</li>
						<?php }?>
						<?php if(isset($output['result']['jump']['right'])){?>
						<li>
							<a class="button-normal jump-button-normal button-ok" href="<?php echo empty($output['result']['jump']['right']['href'])?'javascript:history.go(-2)':$output['result']['jump']['right']['href'];?>"><?php echo empty($output['result']['jump']['right']['text'])?'确定':$output['result']['jump']['right']['text'];?></a>
						</li>
						<?php }?>
					</ul>
				</div>
			<?php }else{?>
				<div class="operate-result-title">
					<h3>提示</h3>
				</div>
				<div class="operate-result-text-content">
					<p><?php echo empty($output['result'])?'操作成功':$output['result'];?></p>
				</div>
				<div class="operate-result-jump">
					<ul class="jump-ul">
						<li>
							<a class="button-normal jump-button-normal button-ok" href="<?php echo $output['ref_url']?>">确定</a>
						</li>
					</ul>
				</div>
			<?php }?>
		</div>
	</div>
</div>
