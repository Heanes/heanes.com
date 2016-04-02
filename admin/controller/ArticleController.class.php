<?php
/**
 * @doc 文章
 * @filesource ArticleController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-10 11:35:41
 */
defined('InHeanes') or exit('Access Invalid!');

class ArticleController extends BaseAdminController {
	
	function __construct() {
		parent::__construct();
	}
	
	public function indexOp() {
		$this->listOp();
	}

	/**
	 * @doc 文章列表页面
	 * @author Heanes
	 * @time 2015-06-10 14:38:03
	 */
	public function listOp() {
		//文章列表
		$articleModel = Model('article');
		$paramArticle=array();
		//如果有按分类查找，则先获得分类
		if (isset($_GET['category_id'])) {
			$articleCategoryModel = Model('articleCategory');
			$category_id=intval($_GET['category_id']);
			$paramCategory['where'] = "`id`=$category_id and `is_enable`=1";
			$articleCategory = $articleCategoryModel->selectArticleCategory($paramCategory);
			Tpl::assign('articleCategory', $articleCategory);
			$paramArticle['where'] = "`category_id`='$category_id'";
		}
		//如果是回收站查看
		if(isset($_GET['status'])){
			$status=Filter::doFilter($_GET['status'],'string');
			if($status=='recycle'){
				$paramArticle['where']= (empty($paramArticle['where'])? '' : 'AND')." `is_delete`=1 ";
			}
		}else{
			$paramArticle['where']= (empty($paramArticle['where'])? '' : 'AND')." `is_enable`=1 AND `is_delete`=0";
		}
		$page=new Page(10);
		$articleList = $articleModel->getList($paramArticle,$page);
		$articleCategoryModel = Model('articleCategory');
		//根据文章分类ID获取文章文类信息
		foreach ($articleList as $key => $article) {
			$articleCategoryParam['where']="`id`='".$article['category_id']."'";
			$articleList[$key]['category_name']=$articleCategoryModel->getOneCategory($articleCategoryParam)['name'];
		}

		$usersModel=Model('users');
		$userRoleModel=Model('user_role');
		foreach ($articleList as $key => $article) {
			if(!empty($article)){
				//文章作者（用户）ID
				$usersInfo=$usersModel->getOneByID($article['user_id']);
				$articleList[$key]['user_name']=$usersInfo['user_name'];
				//文章阅读用户权限
				$userRoleInfo=$userRoleModel->getOneByID($article['user_role_id']);
				$articleList[$key]['user_role_name']=$userRoleInfo['name'];
			}
		}
		Tpl::assign('articleList', $articleList);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','文章列表');
		Tpl::display('article/list');
	}

	/**
	 * @doc 添加文章
	 * @author Heanes
	 * @time 2015-07-02 23:16:41
	 */
	public function addOP(){
		$articleModel = Model('article');
		//获取自增ID
		$lastID = $articleModel->getAutoIncrementID();
		//文章作者（用户）ID
		$usersModel=Model('users');
		$usersList=$usersModel->getList();
		Tpl::assign('usersList',$usersList);
		//文章阅读用户权限
		$userRoleModel=Model('user_role');
		$userRoleList=$userRoleModel->getList();
		Tpl::assign('userRoleList',$userRoleList);
		//分类
		$articleCategoryModel=Model('article_category');
		$articleCategoryList=$articleCategoryModel->getList();
		Tpl::assign('articleCategoryList',$articleCategoryList);

		Tpl::assign('lastID',$lastID);
		Tpl::assign('page_title','添加文章');
		Tpl::display();
	}
	
	public function insertOp(){
		$newArticle['order']=Filter::doFilter($_POST['order'],'integer');
		$newArticle['category_id']=Filter::doFilter($_POST['category_id'],'integer');
		$newArticle['title']=Filter::doFilter($_POST['title'],'string');
		$newArticle['subtitle']=Filter::doFilter($_POST['subtitle'],'string');
		$newArticle['cover_img_src']=Filter::doFilter($_POST['cover_img_src'],'string');
		$newArticle['user_id']=Filter::doFilter($_POST['user_id'],'integer');
		$newArticle['user_link']=Filter::doFilter($_POST['user_link'],'string');
		$newArticle['author']=Filter::doFilter($_POST['author'],'string');
		$newArticle['editor']=Filter::doFilter($_POST['editor'],'string');
		$newArticle['origin_source']=Filter::doFilter($_POST['origin_source'],'string');
		$newArticle['keywords']=Filter::doFilter($_POST['keywords'],'string');
		$newArticle['tags']=Filter::doFilter($_POST['tags'],'string');
		$newArticle['semantic_a_href']=Filter::doFilter($_POST['semantic_a_href'],'string');
		$newArticle['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newArticle['a_title']=Filter::doFilter($_POST['a_title'],'string');
		$newArticle['title_bg_color']=Filter::doFilter($_POST['title_bg_color'],'string');
		$newArticle['content_bg_color']=Filter::doFilter($_POST['content_bg_color'],'string');
		$newArticle['template_id']=Filter::doFilter($_POST['template_id'],'integer');
		$newArticle['is_new'] = Filter::doFilter($_POST['is_new'], 'integer');
		$newArticle['is_recommend'] = Filter::doFilter($_POST['is_recommend'], 'integer');
		$newArticle['is_top'] = Filter::doFilter($_POST['is_top'], 'integer');
		$newArticle['is_great'] = Filter::doFilter($_POST['is_great'], 'integer');
		$newArticle['allow_comment'] = Filter::doFilter($_POST['allow_comment'], 'integer');
		$newArticle['comment_num'] = Filter::doFilter($_POST['comment_num'], 'integer');
		$newArticle['comment_score'] = Filter::doFilter($_POST['comment_score'], 'integer');
		$newArticle['read_num'] = Filter::doFilter($_POST['read_num'], 'integer');
		$newArticle['click_count'] = Filter::doFilter($_POST['click_count'], 'integer');
		$newArticle['seo_title']=Filter::doFilter($_POST['seo_title'],'string');
		$newArticle['seo_keywords']=Filter::doFilter($_POST['seo_keywords'],'string');
		$newArticle['seo_description']=Filter::doFilter($_POST['seo_description'],'string');
		$newArticle['user_role_id']=Filter::doFilter($_POST['user_role_id'],'integer');
		$newArticle['user_rank']=Filter::doFilter($_POST['user_rank'],'integer');
		$pwd=Filter::doFilter($_POST['pwd'],'string');
		$newArticle['pwd']=md5($pwd);
		$newArticle['insert_time']=to_timespan(Filter::doFilter($_POST['article_insert_time'],'string'));
		$newArticle['update_time']=to_timespan(Filter::doFilter($_POST['article_update_time'],'string'));
		$newArticle['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newArticle['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newArticle['content']=Filter::doFilter($_POST['content'],'string');
		$articleModel=Model('article');
		if($articleModel->insert($newArticle)){
			showSuccess('添加成功');
		}else{
			showError('添加失败');
		}
	}
	
	/**
	 * @doc 文章编辑
	 * @author Heanes
	 * @time 2015-07-02 23:12:14
	 */
	public function editOp(){
		if (isset($_REQUEST['id'])) {
			$article_id=Filter::doFilter($_REQUEST['id'],'integer');
			//获取文章数据
			$articleModel = Model('article');
			$article = $articleModel->getOneArticle(intval($_REQUEST['id']));
			//文章作者（用户）ID
			$usersModel=Model('users');
			$usersList=$usersModel->getList();
			Tpl::assign('usersList',$usersList);
			//文章阅读用户权限
			$userRoleModel=Model('user_role');
			$userRoleList=$userRoleModel->getList();
			Tpl::assign('userRoleList',$userRoleList);
			//分类
			$articleCategoryModel=Model('article_category');
			$articleCategoryList=$articleCategoryModel->getList();
			Tpl::assign('articleCategoryList',$articleCategoryList);

			Tpl::assign('article', $article);
			Tpl::assign('page_title','修改文章');
			Tpl::display();
		} else {
			showError('参数错误');
		}
	}

	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:18
	 */
	public function updateOp(){
		$id=Filter::doFilter($_POST['article_id'],'integer');
		$newArticle['order']=Filter::doFilter($_POST['order'],'integer');
		$newArticle['category_id']=Filter::doFilter($_POST['category_id'],'integer');
		$newArticle['title']=Filter::doFilter($_POST['title'],'string');
		$newArticle['subtitle']=Filter::doFilter($_POST['subtitle'],'string');
		$newArticle['cover_img_src']=Filter::doFilter($_POST['cover_img_src'],'string');
		$newArticle['user_id']=Filter::doFilter($_POST['user_id'],'integer');
		$newArticle['user_link']=Filter::doFilter($_POST['user_link'],'string');
		$newArticle['author']=Filter::doFilter($_POST['author'],'string');
		$newArticle['editor']=Filter::doFilter($_POST['editor'],'string');
		$newArticle['origin_source']=Filter::doFilter($_POST['origin_source'],'string');
		$newArticle['keywords']=Filter::doFilter($_POST['keywords'],'string');
		$newArticle['tags']=Filter::doFilter($_POST['tags'],'string');
		$newArticle['semantic_a_href']=Filter::doFilter($_POST['semantic_a_href'],'string');
		$newArticle['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newArticle['a_title']=Filter::doFilter($_POST['a_title'],'string');
		$newArticle['title_bg_color']=Filter::doFilter($_POST['title_bg_color'],'string');
		$newArticle['content_bg_color']=Filter::doFilter($_POST['content_bg_color'],'string');
		$newArticle['template_id']=Filter::doFilter($_POST['template_id'],'integer');
		$newArticle['is_new'] = Filter::doFilter($_POST['is_new'], 'integer');
		$newArticle['is_recommend'] = Filter::doFilter($_POST['is_recommend'], 'integer');
		$newArticle['is_top'] = Filter::doFilter($_POST['is_top'], 'integer');
		$newArticle['is_great'] = Filter::doFilter($_POST['is_great'], 'integer');
		$newArticle['allow_comment'] = Filter::doFilter($_POST['allow_comment'], 'integer');
		$newArticle['comment_num'] = Filter::doFilter($_POST['comment_num'], 'integer');
		$newArticle['comment_score'] = Filter::doFilter($_POST['comment_score'], 'integer');
		$newArticle['read_num'] = Filter::doFilter($_POST['read_num'], 'integer');
		$newArticle['click_count'] = Filter::doFilter($_POST['click_count'], 'integer');
		$newArticle['seo_title']=Filter::doFilter($_POST['seo_title'],'string');
		$newArticle['seo_keywords']=Filter::doFilter($_POST['seo_keywords'],'string');
		$newArticle['seo_description']=Filter::doFilter($_POST['seo_description'],'string');
		$newArticle['user_role_id']=Filter::doFilter($_POST['user_role_id'],'integer');
		$newArticle['user_rank']=Filter::doFilter($_POST['user_rank'],'integer');
		$pwd=Filter::doFilter($_POST['pwd'],'string');
		$newArticle['pwd']=md5($pwd);
		$newArticle['insert_time']=to_timespan(Filter::doFilter($_POST['article_insert_time'],'string'));
		$newArticle['update_time']=getGMTime();
		$newArticle['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newArticle['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newArticle['content']=Filter::doFilter($_POST['content'],'string');
		$where="`id`=$id";
		$articleModel=Model('article');
		if($articleModel->update($newArticle,$where)){
			showSuccess('修改成功');
		}else{
			showError('修改失败');
		}
	}

	/**
	 * @doc 文章回收站功能
	 * @author Heanes
	 * @time 2015-07-01 18:23:33
	 */
	public function recycleOp(){
		echo '文章回收站功能开发中';
	}
}