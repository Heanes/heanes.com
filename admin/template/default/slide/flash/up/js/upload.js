function useCamera()
		{
			var content = '<embed height="464" width="514" ';
			content +='flashvars="type=camera';
			content +='&postUrl='+cameraPostUrl+'?&radom=1';
			content += '&saveUrl='+saveUrl+'?radom=1" ';
			content +='pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" ';
			content +='allowscriptaccess="always" quality="high" ';
			content +='src="'+editorFlaPath+'"/>';
			document.getElementById('avatar_editor').innerHTML = content;
		}
		function buildAvatarEditor(pic_id,pic_path,post_type)
		{
			var content = '<embed height="464" width="514"'; 
			content+='flashvars="type='+post_type;
			content+='&photoUrl='+pic_path;
			content+='&photoId='+pic_id;
			content+='&postUrl='+cameraPostUrl+'?&radom=1';
			content+='&saveUrl='+saveUrl+'?radom=1"';
			content+=' pluginspage="http://www.macromedia.com/go/getflashplayer"';
			content+=' type="application/x-shockwave-flash"';
			content+=' allowscriptaccess="always" quality="high" src="'+editorFlaPath+'"/>';
			document.getElementById('avatar_editor').innerHTML = content;
		}
			/**
			  * 提供给FLASH的接口 ： 没有摄像头时的回调方法
			  */
			 function noCamera(){
				 alert("没有摄像头");
			 }
					
			/**
			 * 提供给FLASH的接口：编辑头像保存成功后的回调方法
			 */
			function avatarSaved(){
				//alert('保存成功');
				$('#msg').fadeIn(1000);
				$('#info').fadeOut(1000);
			}


			
			 /**
			  * 提供给FLASH的接口：编辑头像保存失败的回调方法, msg 是失败信息，可以不返回给用户, 仅作调试使用.
			  */
			 function avatarError(msg){
				 alert("上传失败了");
			 }
			var selectVideo = false;
				function uploadVideo()
				{
					var uuid=1;
					
					var som = new SWFObject(baseurl + '/template/default/slide/flash/up/swf/up.swf', 'uploader_video', '84', '25', '8', '');
					som.addParam('allowScriptAccess', 'always');
					som.addParam('FlashVars',"t=3&m=0&s=10240000&n=UploadVideo&c=1&uuid="+1); //参数t表示允许上传的文件类型0：所有文件,1：视频文件,2：mp3,3:图片
					som.addParam('wmode','transparent');
					som.write('upload_flash_video');
				}

				var UploadVideo = {
				isUploading:false,
				onSelect:function(args){
					
					//选择视频文件
					if (args[0].status == 1){
						selectVideo = true;
						$('#uploadp').html(args[0].name);
						$('#type').val(args[0].type);
					} 
					if (args[0].status == '-1') {
					alert('文件超过最大尺寸');
					}
					UploadVideo.submit(); //自动上传
				},
				onProgress:function(args){
					//正在进行文件上传
					var width=parseInt((args.bytesLoaded/args.bytesTotal)*236)+'px';
					$('#e').css("width", width);
					$('#e').html(parseInt((args.bytesLoaded/args.bytesTotal)*100)+"%");
					$('#filesize').html((args.bytesLoaded/1024).float_n(2)+'KB/'+(args.bytesTotal/1024).float_n(2)+'KB');
				},
				onComplete:function(args){
					//文件上传成功
					if(args)
					{
						if(args.status=='1'){
							eval(args.data); //获取服务端返回的数据
							//$('#ex').html(args.data);
							$('#fsize').val($('#filesize').html());
							//alert('文件上传成功');
							this.isUploading = false;
							return true;
						}
						if(args.status=='-4') {
						alert('IO错误');
						return false;
						}
						if(args.status=='2') {
						alert('空间不足');
						return false;
						}
						if(args.status=='3') {
						alert('安全错误。');
						return false;
						}
						alert('对不起,服务器忙,请稍后重试.');
						return false;
					}else{
						alert('对不起,服务器忙,请稍后重试.');
						return false;
					}
				},
				onAllComplete:function(args){
				//批量上传时，所有文件上传完成
				},
				onAllRemove:function(args){
				//所有文件都移除
				},
				reset:function(){
				//重新上传
				},
				submit:function(){
					//上传视频
					if(this.isUploading){
					alert('文件正在上传中');
					return false;
					}
					this.isUploading=true;
					document.getElementById('uploader_video').onSubmit(　baseurl +　'/template/default/slide/flash/upload.php?method=uploader&uuid=1&site=1&cid=2');
					
					$('#uploadp').html('<div id="e"></div>');
					
					}	
				}
				uploadVideo();


				Number.prototype.float_n=function(n){
				var num=this;
				num=""+num;
				var pos=num.indexOf(".");
				if(pos>0) {
				return parseFloat(num.substr(0,pos+n+1));
				} else {
				return num;
				}
				}


				//---------------
				/*
				$().ready(function() {
					$('form').checkVideo(1);
					});
				*/

				jQuery.fn.checkVideo = function(m){
					mode = (m==1) ? 1 : 0;
					var form=jQuery(this);
					

					form.submit(function(){
						var ok = true;
						var n=0;
						
						
						if($('#video_uploader').val()==0)
						{
							UploadVideo.submit();
							return false;
						}
						
						return true;
					});
				}