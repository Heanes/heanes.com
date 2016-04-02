<?php
/**
 * @doc 文件上传类
 * @filesource UploadFile.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-08 14:36:31
 */
defined('InHeanes') or exit('Access Invalid!');
class UploadFile{
	/**
	 * @var string 文件存储路径
	 */
	private $save_path;
	/**
	 * @var array 允许上传的文件类型
	 */
	private $allow_type=array('gif','jpg','jpeg','bmp','png','swf','tbi');
	/**
	 * @var integer 允许的最大文件大小，单位为KB
	*/
	private $max_size = 10240;
	/**
	 * @var integer 改变后的图片宽度
	 */
	private $thumb_width = 0;
	/**
	 * @var integer 改变后的图片高度
	 */
	private $thumb_height = 0;
	/**
	 * @var boolean 生成扩缩略图后缀
	 */
	private $thumb_ext = false;
	/**
	 * @var string 上传文件对象数组
	 */
	private $upload_file;
	/**
	 * @var bool 是否删除原图
	 */
	private $if_delete_original = false;
	/**
	 * @var string 上传文件名
	 */
	public $file_name;

	/**
	 * @var array 上传完成后的文件名
	 */
	public $uploaded_file=array();
	/**
	 * @var string 上传文件后缀名
	 */
	private $ext;
	/**
	 * @var string 上传文件新后缀名
	 */
	private $new_ext;
	/**
	 * @var string 默认文件存放文件夹
	 */
	private $default_dir = 'other';
	/**
	 * @var string 错误信息
	 */
	public $error = '';
	/**
	 * @var string 生成的缩略图，返回缩略图时用到
	 */
	public $thumb_image;
	/**
	 * @var boolean 是否立即弹出错误提示
	 */
	private $if_show_error = false;
	/**
	 * @var boolean 是否只显示最后一条错误
	 */
	private $if_show_error_one = false;
	/**
	 * @var string 文件名前缀，防保存文件重复
	 */
	private $file_pre_fix;

	private $config;
	/**
	 * 初始化
	 *
	 *	$upload = new UploadFile();
	 *	$upload->set('default_dir','upload');
	 *	$upload->set('max_size',1024);
	 *	//生成4张缩略图，宽高依次如下
	 *	$thumb_width	= '300,600,800,100';
	 *	$thumb_height	= '300,600,800,100';
	 *	$upload->set('thumb_width',	$thumb_width);
	 *	$upload->set('thumb_height',$thumb_height);
	 *	//4张缩略图名称扩展依次如下
	 *	$upload->set('thumb_ext',	'_small,_mid,_max,_tiny');
	 *	//生成新图的扩展名为.jpg
	 *	$upload->set('new_ext','jpg');
	 *	//开始上传
	 *	$result = $upload->upload('file');
	 *	if (!$result){
	 *		echo '上传成功';
	 *	}
	 *
	 */
	function __construct(){
		//加载语言包
		Language::read('common');
	}

	/**
	 * @doc 上传操作
	 * @param string $field 上传表单名
	 * @return bool
	 */
	public function upload($field){

		//上传文件
		$this->upload_file = $_FILES[$field];
		if ($this->upload_file['tmp_name'] == ""){
			$this->setError(Language::get('cant_find_temporary_files'));
			return false;
		}

		//对上传文件错误码进行验证
		$error = $this->fileInputError();
		if (!$error){
			return false;
		}
		//验证是否是合法的上传文件
		if(!is_uploaded_file($this->upload_file['tmp_name'])){
			$this->setError(Language::get('upload_file_attack'));
			return false;
		}

		//验证文件大小
		if ($this->upload_file['size']==0){
			$error = Language::get('upload_file_size_none');
			$this->setError($error);
			return false;
		}
		//超出最大允许范围
		if($this->upload_file['size'] > $this->max_size*1024){
			$error = Language::get('upload_file_size_cant_over').$this->max_size.'KB';
			$this->setError($error);
			return false;
		}

		//文件后缀名
		$tmp_ext = explode(".", $this->upload_file['name']);
		$tmp_ext = $tmp_ext[count($tmp_ext) - 1];
		$this->ext = strtolower($tmp_ext);

		//验证文件格式是否为系统允许
		if(!in_array($this->ext,$this->allow_type)){
			$error = Language::get('image_allow_ext_is').implode(',',$this->allow_type);
			$this->setError($error);
			return false;
		}

		//检查是否为有效图片
		if(!$image_info = @getimagesize($this->upload_file['tmp_name'])) {
			$error = Language::get('upload_image_is_not_image');
			$this->setError($error);
			return false;
		}

		//设置图片路径
		if(empty($this->save_path)){
			$this->setPath($this->default_dir);
		}

		//设置文件名称
		if(empty($this->file_name)){
			$this->setFileName();
		}

		//是否立即弹出错误
		if($this->if_show_error){
			echo "<script type='text/javascript'>alert('". ($this->if_show_error_one ? $error : $this->error) ."');history.back();</script>";
			die();
		}
		//没消息就是最好的消息
		//针对一次上传多张图片，注释这段
		/*
		if ($this->error != '') {
			return false;
		}
		*/

		//echo '<br/>save_path:'.PATH_SYS_FILE_UPLOAD.$this->save_path;
		//移动文件到指定路径
		if(@move_uploaded_file($this->upload_file['tmp_name'],PATH_ABS_SYS_FILE_UPLOAD.$this->save_path.$this->file_name)){
			//echo $this->upload_file['tmp_name'].'移动到'.PATH_SYS_FILE_UPLOAD.$this->save_path.$this->file_name;
			//删除原图
			if ($this->if_delete_original && is_file(PATH_ABS_SYS_FILE_UPLOAD.$this->save_path.$this->file_name)) {
				@unlink(PATH_ABS_SYS_FILE_UPLOAD.$this->save_path.$this->file_name);
			}
			//批量上传时重新生成文件名
			$this->uploaded_file['file_name']=$this->file_name;
			$this->file_name='';
			$this->error='';
			return true;
		}else {
			//echo '移动文件出错';
			$this->setError(Language::get('upload_file_fail'));
			return false;
		}
	}
	
	public function getUploadResult(){
		return array(
			'save_path'=>$this->save_path,
			'save_name'=>$this->uploaded_file['file_name'],
		);
	}

	/**
	 * @doc 设置存储路径，防止如果没有此路径则创建此路径
	 * @param string $path 路径名称
	 * @return bool|string 设置结果|错误信息
	 * @author Heanes
	 * @time 2015-07-02 14:41:42
	 */
	public function setPath($path=''){
		$this->save_path=$path;
		//判断目录是否存在，如果不存在 则生成
		//未设置保存路径，则创建默认目录
		if (empty($this->save_path)) {
			if (!is_dir(PATH_ABS_SYS_FILE_UPLOAD.$this->default_dir)) {
				$dir = $this->default_dir;
				$default_save_path = PATH_ABS_SYS_FILE_UPLOAD.$this->default_dir;
				//echo '<br/>$default_save_path'.$default_save_path;
				if (!is_dir($default_save_path)) {
					if (@mkdir($default_save_path, 0755, true)) {
						$this->save_path = $this->default_dir;
					}else{
						$this->setError(Language::get('upload_file_mkdir').$default_save_path.Language::get('upload_file_mkdir_fail'));
						return false;
					}
				}
				unset($dir, $dir_array, $default_save_path);
			}
		}
		//设置了保存路径
		else{
			//但是物理路径不存在
			if (!is_dir(PATH_ABS_SYS_FILE_UPLOAD.$this->save_path)) {
				$save_path = PATH_ABS_SYS_FILE_UPLOAD.$this->save_path;
				if (!is_dir($save_path)) {
					//echo '<br/>$save_path'.$save_path;
					if (!@mkdir($save_path, 0755, true)) {
						//echo '创建文件夹失败';
						$this->setError(Language::get('upload_file_mkdir').$save_path.Language::get('upload_file_mkdir_fail'));
						return false;
					}
				}
			}
		}
		//加上末尾路径分隔符
		$this->save_path.=DS;
		//设置权限
		@chmod(PATH_ABS_SYS_FILE_UPLOAD.$this->save_path,0755);
		//echo '<br/>save_path:'.PATH_SYS_FILE_UPLOAD.$this->save_path.'<br/>';
		//判断文件夹是否可写
		if(!is_writable(PATH_ABS_SYS_FILE_UPLOAD.$this->save_path)) {
			$this->setError(Language::get('upload_file_dir').$this->default_dir.Language::get('upload_file_dir_cant_touch_file'));
			return false;
		}
		return PATH_ABS_SYS_FILE_UPLOAD.$this->save_path;
	}

	/**
	 * @doc 获取保存路径
	 * @return string
	 * @author Heanes
	 * @time 2015-07-02 18:30:06
	 */
	public function getPath(){
		return $this->save_path;
	}

	/**
	 * @doc 设置文件名称，不包括文件路径，生成(从2000-01-01 00:00:00 到现在的秒数+微秒+四位随机)
	 * @author Heanes
	 * @time 2015-07-02 14:41:00
	 */
	private function setFileName(){
		$tmp_name = sprintf('%010d',time() - 946656000)
			. sprintf('%03d', microtime() * 1000)
			. sprintf('%04d', mt_rand(0,9999));
		$this->file_name = (empty ( $this->file_pre_fix ) ? '' : $this->file_pre_fix . '_')
			. $tmp_name . '.' . ($this->new_ext == '' ? $this->ext : $this->new_ext);
	}

	/**
	 * @doc 获取上传文件的错误信息
	 * @return string 返回字符串错误信息
	 * @author Heanes
	 * @time 2015-07-02 15:11:10
	 */
	private function fileInputError(){
		switch($this->upload_file['error']) {
			case 0:
				//文件上传成功
				return true;
				break;

			case 1:
				//上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值
				$this->setError(Language::get('upload_file_size_over'));
				return false;
				break;

			case 2:
				//上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值
				$this->setError(Language::get('upload_file_size_over'));
				return false;
				break;

			case 3:
				//文件只有部分被上传
				$this->setError(Language::get('upload_file_is_not_complete'));
				return false;
				break;

			case 4:
				//没有文件被上传
				$this->setError(Language::get('upload_file_is_not_uploaded'));
				return false;
				break;

			case 6:
				//找不到临时文件夹
				$this->setError(Language::get('upload_dir_chmod'));
				return false;
				break;

			case 7:
				//文件写入失败
				$this->setError(Language::get('upload_file_write_fail'));
				return false;
				break;

			default:
				return true;
		}
	}

	/**
	 * @doc 设置错误信息
	 * @param string $error 错误信息
	 * @return bool 布尔类型的返回结果
	 * @author Heanes
	 * @time 2015-07-02 14:40:41
	 */
	private function setError($error){
		$this->error = $error;
	}

	/**
	 * @doc 获取错误信息
	 * @return string 错误信息
	 * @author Heanes
	 * @time 2015-07-02 18:28:56
	 */
	public function getError(){
		return $this->error;
	}

	/**
	 * @doc 设置
	 * @param mixed $key
	 * @param mixed $value
	 */
	public function set($key,$value){
		$this->$key = $value;
	}

	/**
	 * @doc 读取类的属性
	 * @param string $key 属性名称
	 * @return mixed 属性值
	 * @author Heanes
	 * @time 2015-07-02 14:22:16
	 */
	public function get($key){
		return $this->$key;
	}
}