<?php
/**
 * @doc 文件处理类
 * @filesource File.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-05-22 09:52:44
 */
defined('InHeanes') or exit('Access Invalid!');

class File {
	function __construct() {
		//echo __METHOD__.'<br />';
	}
	
	
	/**
	 * @doc 获取目录大小
	 * @param string $path 目录
	 * @param int $size 目录大小
	 * @return int 整型类型的返回结果
	 * @author Heanes
	 * @time 2015-06-08 13:21:33
	 */
	public static function getDirSize($path, $size = 0) {
		$dir = @dir($path);
		if (!empty($dir->path) && !empty($dir->handle)) {
			while ($filename = $dir->read()) {
				if ($filename != '.' && $filename != '..') {
					if (is_dir($path . DS . $filename)) {
						$size += self::getDirSize($path . DS . $filename);
					} else {
						$size += filesize($path . DS . $filename);
					}
				}
			}
		}
		return $size ? $size : 0;
	}
	
	
	/**
	 * @doc 在某个目录机器子目录下创建目录
	 * @param string $dir 待创建的目录
	 * @param string $mode 权限
	 * @return boolean 是否成功创建
	 * @author Heanes
	 * @time 2015-06-08 13:29:37
	 */
	function newDirInEveryDir($dir, $mode = '0777') {
		if (is_dir($dir) || @mkdir($dir, $mode)) {
			return true;
		}
		if (!self::newDirInEveryDir(dirname($dir), $mode)) {
			return false;
		}
		return @mkdir($dir, $mode);
	}
	
	/**
	 * @doc 获取目录及其子目录下的文件夹列表
	 * @param string $dir 查找路径
	 * @param array $ignore_dir 忽略路径名称数组
	 * @param boolean $case_sensitive 是否忽略大小写
	 * @return array|boolean false
	 * @author Heanes
	 * @time 2015-05-22 16:03:45
	 */
	public static function getDirList($dir, $ignore_dir = array(), $case_sensitive = false) {
		static $dirList = array();
		if (!is_dir($dir)) {
			echo $dir . '不是一个有效的目录!';
			exit();
		}
		//对特殊路径的处理
		if ($dir == '.') {
			$dir = str_replace('\\', '/', __DIR__);
		} elseif ($dir == '..') {
			$dir = str_replace('\\', '/', dirname(__DIR__));
		} elseif ($dir[strlen($dir) - 1] != '/' && $dir[strlen($dir) - 1] != '\\') {
			$dir = str_replace('\\', '/', $dir);
			$dir .= '/';
		}
		
		//是否对大小写敏感
		if ($case_sensitive) {
			$i = '';
		} else {
			$i = 'i';
		}
		
		$handler = opendir($dir);
		//列出$dir目录中的所有文件
		while (($fileName = readdir($handler)) != false) {
			$fileName = iconv('gb2312', 'utf-8', $fileName);
			if ($fileName != '.' && $fileName != '..' && !count(preg_grep("/$fileName/i" . $i, $ignore_dir)) && !strpos($fileName, '.')) {
				$curDir = $dir . $fileName;
				if (is_dir($curDir) && !count(preg_grep('/' . str_replace('/', '\\/', $curDir) . '/' . $i, $ignore_dir))) {
					$dirList[] = $curDir;
					//echo $curDir.'<br/>';
					self::getDirList($curDir, $ignore_dir, $case_sensitive);
				}
			}
		}
		return $dirList;
	}

	/**
	 * @doc 获取目录及其子目录下的文件列表
	 * @param string $dir 查找路径
	 * @param array $ignore_dir 忽略路径
	 * @param array $ignore_file 忽略文件列表数组
	 * @param boolean $case_sensitive 是否忽略大小写
	 * @return array|boolean false
	 * @author Heanes
	 * @time 2015-05-22 16:03:45
	 */
	public static function getFileList($dir, $ignore_dir = array(), $ignore_file = array(), $case_sensitive = false) {
		static $fileList = array();
		if (!is_dir($dir)) {
			echo $dir . '不是一个有效的目录!';
			exit();
		}
		//对特殊路径的处理
		if ($dir == '.') {
			$dir = str_replace('\\', '/', __DIR__);
		} elseif ($dir == '..') {
			$dir = str_replace('\\', '/', dirname(__DIR__));
		} elseif ($dir[strlen($dir) - 1] != '/' && $dir[strlen($dir) - 1] != '\\') {
			$dir = str_replace('\\', '/', $dir);
			$dir .= '/';
		}
		//是否对大小写敏感
		if ($case_sensitive) {
			$i = '';
		} else {
			$i = 'i';
		}
		
		$handler = opendir($dir);
		//列出$dir目录中的所有文件
		while (($fileName = readdir($handler)) != false) {
			$fileName = iconv('gb2312', 'utf-8', $fileName);
			if ($fileName != '.' && $fileName != '..' && !count(preg_grep("/$fileName/i" . $i, $ignore_dir))) {
				$curDir = $dir . $fileName;
				if (is_dir($curDir) && !count(preg_grep('/' . str_replace('/', '\\/', $curDir) . '/' . $i, $ignore_dir))) {
					//echo $curDir.'<br/>';
					self::getFileList($curDir, $ignore_dir, $ignore_file, $case_sensitive);
				} else if (!count(preg_grep("/$fileName/i", $ignore_file))) {
					$fileList[] = $curDir;
				}
			}
		}
		return $fileList;
	}

	/**
	 * @doc 批量重命名某个目录及其子目录下的某个文件
	 * @param string $dir 查找目录
	 * @param string $srcExtension 源后缀名
	 * @param string $desExtension 目标后缀名
	 * @param array $ignore_file 忽略文件列表数组
	 * @param array $ignore_dir 忽略路径
	 * @param boolean $case_sensitive 忽略文件列表是否忽略大小写
	 * @author Heanes
	 * @time 2015-05-22 09:56:18
	 */
	public static function fileRename($dir, $srcExtension, $desExtension, $ignore_file = array(), $ignore_dir = array(), $case_sensitive = false) {
		if (!is_dir($dir)) {
			echo $dir . '不是一个有效的目录!';
			exit();
		}
		//对特殊路径的处理
		if ($dir == '.') {
			$dir = str_replace('\\', '/', __DIR__);
		} elseif ($dir == '..') {
			$dir = str_replace('\\', '/', dirname(__DIR__));
		} elseif ($dir[strlen($dir) - 1] != '/' && $dir[strlen($dir) - 1] != '\\') {
			$dir = str_replace('\\', '/', $dir);
			$dir .= '/';
		}
		
		//是否对大小写敏感
		if ($case_sensitive) {
			$i = '';
		} else {
			$i = 'i';
		}
		
		$handler = opendir($dir);
		//列出$dir目录中的所有文件
		while (($fileName = readdir($handler)) != false) {
			$fileName = iconv('gb2312', 'utf-8', $fileName);
			if ($fileName != '.' && $fileName != '..') {
				//'.' 和 '..'是分别指向当前目录和上级目录 
				$curDir = $dir . $fileName;
				if (is_dir($curDir) && !count(preg_grep('/' . str_replace('/', '\\/', $curDir) . '/' . $i, $ignore_dir))) {
					//如果是目录，则递归下去
					self::fileRename($curDir, $srcExtension, $desExtension, $ignore_file, $ignore_dir, $case_sensitive);
				} else {
					//获取文件路径的信息
					$path = pathinfo($curDir);
					//print_r($curDir."<br />");
					//print_r($path);
					//echo "<br />";
					//print_r(str_replace('\\', '/',__FILE__)."<br />");
					//echo '/'.str_replace('/', '\\/', $curDir).'/';
					//var_dump($ignore_file);
					//var_dump(!count(preg_grep("/$fileName/i", $ignore_file)));
					//echo $fileName.'---<br/>';
					//continue;
					if ($curDir != str_replace('\\', '/', __FILE__) && !count(preg_grep("/$fileName/" . $i, $ignore_file))) {
						if ($path['extension'] == $srcExtension) {
							$new_name = $path['dirname'] . '/' . $path['filename'] . '.' . $desExtension;
							//echo $curDir.'_________<br />';
							//continue;
							rename($curDir, $new_name);
							//echo $curDir.'-->'.$new_name."<br />";
						}
					}
				}
			}
		}
	}

	/**
	 * @doc 递归删除目录下的某个文件
	 * @param string $dir
	 * @param string $deleteFileName 删除文件名称
	 * @param array $ignore_dir 忽略路径
	 * @param array $ignore_file 忽略文件列表数组
	 * @param bool $case_sensitive
	 * @author Heanes
	 * @time 2015-05-22 13:19:15
	 */
	public static function deleteFile($dir, $deleteFileName = 'index.html', $ignore_dir = array(), $ignore_file = array(), $case_sensitive = false) {
		if (!is_dir($dir)) {
			echo $dir . '不是一个有效的目录!';
			exit();
		}
		//对特殊路径的处理
		if ($dir == '.') {
			$dir = str_replace('\\', '/', __DIR__);
		} elseif ($dir == '..') {
			$dir = str_replace('\\', '/', dirname(__DIR__));
		} elseif ($dir[strlen($dir) - 1] != '/' && $dir[strlen($dir) - 1] != '\\') {
			$dir = str_replace('\\', '/', $dir);
			$dir .= '/';
		}
		//是否对大小写敏感
		if ($case_sensitive) {
			$i = '';
		} else {
			$i = 'i';
		}
		
		$handler = opendir($dir);
		//列出$dir目录中的所有文件
		while (($fileName = readdir($handler)) != false) {
			$fileName = iconv('gb2312', 'utf-8', $fileName);
			if ($fileName != '.' && $fileName != '..' && !count(preg_grep("/$fileName/" . $i, $ignore_dir))) {
				//echo $fileName.'<br/>';
				//'.' 和 '..'是分别指向当前目录和上级目录 
				$curDir = $dir . $fileName;
				if (is_dir($curDir) && !count(preg_grep('/' . str_replace('/', '\\/', $curDir) . '/' . $i, $ignore_dir))) {
					//如果是目录，则递归下去
					self::deleteFile($curDir, $deleteFileName, $ignore_dir, $ignore_file, $case_sensitive);
				} else {
					//获取文件路径的信息
					$path = pathinfo($curDir);
					if ($curDir != str_replace('\\', '/', __FILE__) && !count(preg_grep("/$fileName/" . $i, $ignore_file))) {
						if ($path['basename'] == $deleteFileName) {
							//echo $deleteFileName;
							//continue;
							//var_dump($path['basename']);
							if (file_get_contents($curDir) == ' ') {
								//var_dump(file_get_contents($curDir));
								echo $i++ . $curDir . '(' . filesize($curDir) . 'B)<br/>';
								//continue;
								unlink($curDir);
							}
						}
					}
				}
			}
		}
	}

	/**
	 * @doc 在目录所有子目录中创建新文件
	 * @param string $dir 目的文件夹
	 * @param string $newFileName 创建的文件
	 * @param array $ignore_dir 忽略路径
	 * @param boolean $force 是否覆盖
	 * @param bool $case_sensitive 是否忽略大小写
	 * @author Heanes
	 * @time 2015-05-22 14:03:55
	 */
	public static function newFileInEveryDir($dir, $newFileName = 'index.html', $ignore_dir = array(), $force = false, $case_sensitive = false) {
		if (!is_dir($dir)) {
			echo $dir . '不是一个有效的目录!';
			exit();
		}
		//对特殊路径的处理
		if ($dir == '.') {
			$dir = str_replace('\\', '/', __DIR__);
		} elseif ($dir == '..') {
			$dir = str_replace('\\', '/', dirname(__DIR__));
		} elseif ($dir[strlen($dir) - 1] != '/' && $dir[strlen($dir) - 1] != '\\') {
			$dir = str_replace('\\', '/', $dir);
			$dir .= '/';
		}
		
		$handler = opendir($dir);
		//是否对大小写敏感
		if ($case_sensitive) {
			$i = '';
		} else {
			$i = 'i';
		}
		//列出$dir目录中的所有文件
		while (($fileName = readdir($handler)) != false) {
			$fileName = iconv('gb2312', 'utf-8', $fileName);
			if ($fileName != '.' && $fileName != '..' && !count(preg_grep("/$fileName/" . $i, $ignore_dir)) && !strpos($fileName, '.')) {
				$curDir = $dir . $fileName;
				if (is_dir($curDir) && !count(preg_grep('/' . str_replace('/', '\\/', $curDir) . '/' . $i, $ignore_dir))) {
					//echo $curDir,'<br/>';
					if ($force) {
						fclose(fopen($curDir . '/' . $newFileName, 'w+'));
					} else {
						if (!file_exists($curDir . '/' . $newFileName)) {
							//echo $curDir.'/'.$newFileName.'<br/>';
							//写入文件
							fclose(fopen($curDir . '/' . $newFileName, 'w+'));
						}
					}
					//如果是目录，则递归下去
					self::newFileInEveryDir($curDir, $newFileName, $ignore_dir, $case_sensitive);
				}
			}
		}
	}

	/**
	 * @doc 某个目录下生成新文件名，如果文件已存在，则在名字后面跟数字
	 * @param string $path 所在文件夹
	 * @param string $filename 文件名称
	 * @return string <string, boolean>
	 * @author Heanes
	 * @time 2015-05-22 14:03:31
	 */
	public static function fileNewName($path, $filename) {
		if ($pos = strrpos($filename, '.')) {
			$name = substr($filename, 0, $pos);
			$ext = substr($filename, $pos);
		} else {
			$name = $filename;
			$ext = substr($filename, $pos);
		}

		$new_path = $path . '/' . $filename;
		$new_name = $filename;
		$counter = 0;
		while (file_exists($new_path)) {
			$new_name = $name . '_' . $counter . $ext;
			$new_path = $path . '/' . $new_name;
			$counter++;
		}

		return $new_name;
	}
}