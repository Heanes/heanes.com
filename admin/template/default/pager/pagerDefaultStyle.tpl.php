<?php
/**
 * @doc 分页默认样式
 * @filesource pagerDefaultStyle.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-01 13:34:43
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<!-- 分页部分 S -->
<div class="turn_page">
	<p class="text-right">
		<span class="page_info">
			总计<?php echo $output['pager']['total_num'];?>个记录<?php if($output['pager']['total_page'] && $output['pager']['total_page']>1){?>分为<?php echo $output['pager']['total_page'];?>页，
				当前第<?php echo $output['pager']['now_page'];?>页，
				每页<input type="text" name="pager_input_page_size" value="<?php echo $output['pager']['page_size'];?>"/>条
				<input type="button" name="pager_input_page_size_to_go" value="确定" class="btn"/><?php }?></span>
		<span class="page_link">
			<!-- 上一页、首页导航 -->
			<?php if($output['pager']['now_page']>0 && $output['pager']['now_page']!=1){?>
			<a href="<?php echo $output['pager']['page_url'].'1';?>">首页</a>
			<a href="<?php echo $output['pager']['page_url'].$output['pager']['pre_page'];?>"><b class="triangle-left"></b> 上一页</a>
			<?php } ?>
			<!--  页码导航 -->
			<?php if($output['pager']['now_page']>=1 && $output['pager']['now_page']<=$output['pager']['total_page']){?>
				<?php if($output['pager']['now_page']>3){ ?>
					<em>...</em>
				<?php } ?>
			<?php if($output['pager']['now_page']==3){ ?>
					<a href="<?php echo $output['pager']['page_url'].($output['pager']['now_page']-2);?>"><?php echo $output['pager']['now_page']-2;?></a>
				<?php } ?>
			<?php if($output['pager']['now_page']-1>0){ ?>
					<a href="<?php echo $output['pager']['page_url'].($output['pager']['now_page']-1);?>"><?php echo $output['pager']['now_page']-1;?></a>
				<?php } ?>
			<a href="javascript:" class="current"><?php echo $output['pager']['now_page'];?></a>
			<?php if($output['pager']['now_page']+1<=$output['pager']['total_page']){ ?>
					<a href="<?php echo $output['pager']['page_url'].($output['pager']['now_page']+1);?>"><?php echo $output['pager']['now_page']+1;?></a>
				<?php } ?>
			<?php if($output['pager']['now_page']+2==$output['pager']['total_page']){ ?>
					<a href="<?php echo $output['pager']['page_url'].($output['pager']['now_page']+2);?>"><?php echo $output['pager']['now_page']+2;?></a>
				<?php } ?>
			<?php if($output['pager']['now_page']+2<$output['pager']['total_page']){ ?>
					<em>...</em>
				<?php } ?>
			<?php }?>
			<!-- 下一页、末页导航 -->
			<?php if($output['pager']['now_page']>=1 && $output['pager']['now_page']!=$output['pager']['total_page'] && $output['pager']['total_page']>1){?>
				<a href="<?php echo $output['pager']['page_url'].$output['pager']['total_page'];?>">末页</a>
				<a href="<?php echo $output['pager']['page_url'].$output['pager']['next_page'];?>">下一页 <b class="triangle-right"></b></a>
			<?php }?>
			<?php if($output['pager']['total_page'] && $output['pager']['total_page']>1){?>
			<label>到第<input type="text" name="pager_input_to_go" value="<?php echo $output['pager']['now_page'];?>">/<?php echo $output['pager']['total_page'];?>页 <input type="button" id="go_to_page" class="btn mini" value="确定" /></label>
			<select name="pager_select_to_go">
				<?php for($i=1;$i<$output['pager']['total_page']+1;$i++){?>
				<option value="<?php echo $output['pager']['page_url'].$i;?>" <?php if($i==$output['pager']['now_page']){?>selected<?php }?>><?php echo $i;?></option>
				<?php }?>
			</select>
			<?php }?>
		</span>
	</p>
</div>
<!-- 分页部分 E -->
<script type="text/javascript">
	/**
	 * @doc 页码相关的处理
	 * @author Heanes
	 * @time 2015-07-12 01:25:11
	 */
	//按下左右方向键翻页
	$(document).keydown(function(event){
		//左方向键
		if(event.keyCode==37 && parseInt('<?php echo $output['pager']['now_page']?>') > 1 ){
			window.location='<?php echo $output['pager']['page_url']?>'+(parseInt('<?php echo $output['pager']['now_page']?>')-1);
		}
		//右方向键
		if(event.keyCode==39 && parseInt('<?php echo $output['pager']['now_page']?>') < parseInt('<?php echo $output['pager']['total_page']?>') ){
			window.location='<?php echo $output['pager']['page_url']?>'+(parseInt('<?php echo $output['pager']['now_page']?>')+1);
		}
	});

	//输入页码数，按下回车键
	$('input[name="pager_input_page_size"]').on('keydown',function(event){
		if(event.keyCode==13){
			var set_page_size=$(this).val();
			//alert(set_page_size);
			var page_size_name=<?php echo $output['pager']['page_size_name'];?>;
			//ajax 传递page_size值到url中
			var ajaxurl = "<?php echo CURRENT_URL;?>";
			var query = {'page_size_name':set_page_size};
			$.ajax({
				url: ajaxurl,
				data:query,
				type: "GET",
				dataType: "json",
				success: function(result){
					alert('yes');
				},error:function(){
					alert('未能设置页码大小！');
				}
			});
		}
	});
	//输入页码数，按下回车键
	$('input[name="pager_input_page_size_to_go"]').on('click',function(event){
		var set_page_size=$('input[name="pager_input_page_size"]').val();
		//alert(set_page_size);
		var page_size_name='<?php echo $output['pager']['page_size_name'];?>';
		//ajax 传递page_size值到url中
		var ajaxurl = "<?php echo CURRENT_URL;?>";
		var query = {'<?php echo $output['pager']['page_size_name'];?>':set_page_size};
		$.ajax({
			url: ajaxurl,
			data:query,
			type: "GET",
			dataType: "json",
			success: function(result){
				alert('yes');
			},error:function(){
				alert('未能设置页码大小！');
			}
		});
	});

	//输入页码，点击确定键
	$('#go_to_page').on('click',function(){
		window.location='<?php echo $output['pager']['page_url']?>'+$('input[name="pager_input_to_go"]').val();
	});
	//输入页码，按下回车键
	$('input[name="pager_input_to_go"]').on('keydown',function(event){
		if(event.keyCode==13){
			window.location='<?php echo $output['pager']['page_url']?>'+$(this).val();
		}
	});
	//下拉框跳转页码
	$('select[name="pager_select_to_go"]').on('change',function(){
		window.location=$(this).find("option:selected").val();
	});

</script>

