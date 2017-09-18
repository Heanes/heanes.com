<?php
/**
 * @doc 文章分类控制器
 * @filesource ArticleCategoryController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-01 18:14:37
 */
defined('InHeanes') or exit('Access Invalid!');

class ArticleCategoryController extends BaseAdminController{
	
	function __construct(){
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}

	/**
	 * @doc 列表
	 * @author Heanes
	 * @time 2015-07-07 09:25:43
	 */
	public function listOp(){
		$articleCategoryModel=Model('article_category');
		$articleCategoryListParam=array();
		$articleCategoryListParam['where']= (empty($articleCategoryListParam['where'])? '' : 'AND')."`is_enable`=1 AND `is_deleted`=0";
		$page=new Page(10);
		$articleCategoryList=$articleCategoryModel->getList($articleCategoryListParam,$page);
		//获取文章分类下文章个数
		$articleModel=Model('article');
		foreach ($articleCategoryList as $key => $articleCategory) {
			$articleCategoryList[$key]['article_count']=$articleModel->getCountInCategory($articleCategory['id']);
		}
		//分类阅读用户角色权限
		$userRoleModel = Model('user_role');       //角色表
		foreach ($articleCategoryList as $user_role_key => $articleCategory) {
			if(!empty($articleCategory)){
				$userRoleInfo=$userRoleModel->getOneByID($articleCategory['user_role_id']);
				$articleCategoryList[$user_role_key]['user_role_name']=$userRoleInfo['name']; //根据user_role_id查询分类阅读用户角色权限
			}
		}

		Tpl::assign('articleCategoryList',$articleCategoryList);
		Tpl::assign('page_title','文章分类列表');
		Tpl::assign('pager',$page->getPager());
		Tpl::display('articleCategory/list');
	}

	/**
	 * @doc 获取下拉框父分类ID
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function getSelectOption(){
		//父分类ID
		$articleCategoryModel=Model('article_category');
		$articleCategoryList=$articleCategoryModel->getList();
		return $articleCategoryList;
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-07-07 09:25:52
	 */
	public function addOp(){
		$articleCategoryModel = Model('article_category');
		//获取自增ID
		$lastID = $articleCategoryModel->getAutoIncrementId();

		$articleCategoryList=$this->getSelectOption(); //获取下拉框值
		Tpl::assign('articleCategoryList',$articleCategoryList);

		//分类阅读用户角色权限
		$userRoleModel = Model('user_role');
		$roleUrl_List = $userRoleModel->getList();
		Tpl::assign('roleUrl_List',$roleUrl_List);

		Tpl::assign('lastID',$lastID);
		Tpl::assign('page_title','添加文章分类');
		Tpl::display();
	}


	/**
	 * @doc 添加操作
	 * @author Heanes
	 * @time 2015-07-07 09:43:51
	 */
	public function insertOp(){
		$newArticleCategory['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newArticleCategory['parent_id']=Filter::doFilter($_POST['parent_id'],'integer');
		$newArticleCategory['name']=Filter::doFilter($_POST['article_category_name'],'string');
		$newArticleCategory['code']=Filter::doFilter($_POST['code'],'string');
		$newArticleCategory['template_id']=Filter::doFilter($_POST['template_id'],'integer');
		$newArticleCategory['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newArticleCategory['a_title']=Filter::doFilter($_POST['a_title'],'string');
		$newArticleCategory['img_src']=Filter::doFilter($_POST['img_src'],'string');
		$newArticleCategory['seo_keywords']=Filter::doFilter($_POST['seo_keywords'],'string');
		$newArticleCategory['seo_description']=Filter::doFilter($_POST['seo_description'],'string');
		$newArticleCategory['user_role_id']=Filter::doFilter($_POST['user_role_id'],'integer');
		$newArticleCategory['user_rank']=Filter::doFilter($_POST['user_rank'],'string');
		$pwd=Filter::doFilter($_POST['pwd'],'string');
		$newArticleCategory['pwd'] = md5($pwd);
		$newArticleCategory['create_time']=to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newArticleCategory['update_time']=to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$newArticleCategory['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newArticleCategory['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newArticleCategory['description']=Filter::doFilter($_POST['description'],'string');
		$article_categoryModel=Model('article_category');
		if($article_categoryModel->insert($newArticleCategory)){
			showSuccess('添加成功');
		}else{
			showError('添加失败');
		}
	}


	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-07-07 09:25:52
	 */
	public function editOp(){
		$id=Filter::doFilter($_GET['id'],'integer');
		$articleCategoryModel=Model('article_category');
		$articleCategory=$articleCategoryModel->getOneByID($id);
		//父分类ID
		$articleCategoryWhereParam['where']="`id` != '$id'";
		$articleCategoryList=$articleCategoryModel->getList($articleCategoryWhereParam);
		Tpl::assign('articleCategoryList',$articleCategoryList);
		//分类阅读用户角色权限
		$userRoleModel = Model('user_role');
		$roleUrl_List = $userRoleModel->getList();
		Tpl::assign('roleUrl_List',$roleUrl_List);

		Tpl::assign('articleCategory',$articleCategory);
		Tpl::assign('page_title','修改文章分类');
		Tpl::display();
	}
	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id=Filter::doFilter($_POST['category_id'],'integer');
		$newArticleCategory['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newArticleCategory['parent_id']=Filter::doFilter($_POST['parent_id'],'integer');
		$newArticleCategory['name']=Filter::doFilter($_POST['article_category_name'],'string');
		$newArticleCategory['code']=Filter::doFilter($_POST['code'],'string');
		$newArticleCategory['template_id']=Filter::doFilter($_POST['template_id'],'integer');
		$newArticleCategory['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newArticleCategory['a_title']=Filter::doFilter($_POST['a_title'],'string');
		$newArticleCategory['img_src']=Filter::doFilter($_POST['img_src'],'string');
		$newArticleCategory['seo_keywords']=Filter::doFilter($_POST['seo_keywords'],'string');
		$newArticleCategory['seo_description']=Filter::doFilter($_POST['seo_description'],'string');
		$newArticleCategory['user_role_id']=Filter::doFilter($_POST['user_role_id'],'integer');
		$newArticleCategory['user_rank']=Filter::doFilter($_POST['user_rank'],'string');
		$pwd=Filter::doFilter($_POST['pwd'],'string');
		$newArticleCategory['pwd'] = md5($pwd);
		$newArticleCategory['create_time']=to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newArticleCategory['update_time']=getGMTime();
		$newArticleCategory['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newArticleCategory['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newArticleCategory['description']=Filter::doFilter($_POST['description'],'string');
		$where="`id`=$id";
		$articleCategoryModel=Model('article_category');
		if($articleCategoryModel->update($newArticleCategory,$where)){
			showSuccess('修改成功');
		}else{
			showError('修改失败');
		}
	}

	/**
	 * @doc 删除操作
	 * @author Heanes
	 * @time 2015-07-06 14:08:44
	 */
	public function deleteOp(){
		$id = Filter::doFilter($_POST['id'], 'integer');
		$where = "`id`=$id";
		$articleCategoryModel = Model('article_category');
		if ($articleCategoryModel->delete($where)) {
			showSuccess('修改成功');
		} else {
			showError('修改失败');
		}
	}


}