<?php
/**
 * @doc 文章
 * @filesource ArticleController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-10 11:35:41
 */
defined('InHeanes') or exit('Access Invalid!');

class ArticleController extends BaseWapController{
	
	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 单篇文章显示页面及列表页面
	 * @author Heanes
	 * @time 2015-06-23 18:44:23
	 */
	public function indexOp(){
		if (isset($_REQUEST['id'])) {
			$this->showOp();
		} else {
			$this->listOp();
		}
	}

	/**
	 * @doc 文章列表页面
	 * @author Carr
	 * @time 2015-08-07 14:38:03
	 */
	public function listOp(){
		//文章列表
		//@TODO 要显示的分类，应从后台设置中取出
		$articleCategoryModel = Model('article_category');
		$articleCategoryListParam['where'] = "`is_enable`=1 AND `is_deleted`=0";
		$articleCategoryListParam['order']=array('order_number' => 'ASC','insert_time'=>'DESC');
		$articleCategoryList = $articleCategoryModel->getList($articleCategoryListParam);
		Tpl::assign('articleCategoryList', $articleCategoryList);
		$articleModel = Model('article');
		$articleParam['where']="`is_enable`=1 AND `is_deleted`=0";
		$articleParam['order']=array('order_number' => 'ASC','insert_time'=>'DESC');
		$html_title='文章列表';
		if(isset($_GET['category']) && !empty($_GET['category'])){
			$category=Filter::doFilter($_GET['category'],'string');
			$articleCategoryParam['where'] = "`id`='$category' OR `code`='$category'";
			$articleCategory = $articleCategoryModel->getOne($articleCategoryParam);
			if($articleCategory){
				$articleParam['where'].=" AND `category_id`='".$articleCategory['id']."'";
				$html_title=$articleCategory['name'].' -分类文章列表';
			}
		}
		$page = new Page(10);
		$articleList = $articleModel->getList($articleParam, $page);
		//封面图片处理
		foreach ($articleList as $key => $article) {
			$articleList[$key]['_cover_img_src']=PATH_BASE_FILE_UPLOAD.'image'.DS.'article'.DS.$article['id'].DS.'cover'.DS.$article['cover_img_src'];
		}
		Tpl::assign('articleList', $articleList);
		//获取置顶的5条记录
		$hotArticleParam['where']="`is_recommend`=1 AND `is_enable`=1 AND `is_deleted`=0";
		$hotArticleParam['limit']='5';
		$hotArticleList=$articleModel->getList($hotArticleParam);
		foreach ($hotArticleList as $key => $article) {
			$hotArticleList[$key]['_cover_img_src']=PATH_BASE_FILE_UPLOAD.'image'.DS.'article'.DS.$article['id'].DS.'cover'.DS.$article['cover_img_src'];
		}
		Tpl::assign('hotArticleList', $hotArticleList);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('html_title',$html_title);
		Tpl::display('article/list-style2');
	}

	/**
	 * @doc 由分类作为数据列表
	 * @author Heanes
	 * @time 2015-08-19 11:37:59
	 */
	public function categoryOp(){
		$this->listOp();
	}

	/**
	 * @doc 显示单篇文章
	 * @author Heanes
	 * @time 2015-07-22 17:33:09
	 */
	public function showOp(){
		//var_dump(get_ip_location('202.198.16.3'));
		$article_id = Filter::doFilter($_REQUEST['id'], 'integer');
		//获取文章数据
		$articleModel = Model('article');
		$article = $articleModel->getOneArticle(intval($_REQUEST['id']));
		//获取文章收藏数
		$articleCollectModel=Model('article_collect');
		$articleCollectParam['field']='id';
		$articleCollectParam['where']="`article_id`='$article_id' AND `is_enable`=1 AND `is_deleted`=0";
		$articleCollectIdList=$articleCollectModel->getList($articleCollectParam);
		$article['_collect_count']=count($articleCollectIdList);
		Tpl::assign('article', $article);
		//获取文章分类信息
		$articleCategoryModel = Model('articleCategory');
		//$articleCategoryTree=$articleCategoryModel->generateCategoryTree($article['category_id']);

		//更新文章点击数，实际阅读数
		$updateArticleArray = array(
			'click_count' => array(
				'sign'  => 'increase',
				'value' => '1',
			),
		);
		$updateArticleWhere = "`id`='$article_id'";
		$articleModel->update($updateArticleArray, $updateArticleWhere);
		//@todo 获取相关文章信息
		$relateArticleList = array();
		Tpl::assign('relateArticleList', $relateArticleList);

		//获取文章评论数据
		$commentModel = Model('article_comment');
		$commentParam['where']="`article_id`='$article_id' AND `is_enable`=1 AND `is_deleted`=0";
		$articleCommentPage = new Page(10);
		$commentList = $commentModel->getList($commentParam, $articleCommentPage);
		Tpl::assign('pager', $articleCommentPage->getPager());
		foreach ($commentList as $key => $comment) {
			//对评论用户的用户名处理
			if ($comment['user_id'] == 0) {
				$commentList[$key]['user_name'] = '游客';
			} else {
				$userModel = Model('user');
				$paramUser['where'] = 'id='.$comment['user_id'];
				$user = $userModel->getUser($paramUser);
				$commentList[$key]['user_name'] = $user['user_name'];
				$user['avatar_src'] = $user['avatar_src']=='' ? null : (PATH_BASE_FILE_UPLOAD.'user'.DS.$user['id'].DS.'avatar'.DS.$user['avatar_src']);
				$commentList[$key]['_user'] = $user;
				$commentList[$key]['avatar_src'] = PATH_BASE_FILE_UPLOAD.''.$user['avatar_src'];
			}
			//对评论用户地理位置的处理
			if ($comment['isp'] == '' || $comment['isp'] == 'null' || $comment['isp'] == 'NULL') {
				$commentList[$key]['isp'] = '未知';
			}
			//获取评论支持反对数
			$articleCommentJudgeModel = Model('article_comment_judge');
			$findArticleCommentJudge['where'] = "`article_comment_id`='".$comment['id']."'";
			$commentList[$key]['comment_judge'] = $articleCommentJudgeModel->select($findArticleCommentJudge);
			$comment_judge_arr = $articleCommentJudgeModel->select($findArticleCommentJudge);
			$commentList[$key]['comment_judge']['support'] = $commentList[$key]['comment_judge']['against'] = 0;
			foreach ($comment_judge_arr as $k => $comment_judge) {
				if ($comment_judge['type'] == 1) {
					$commentList[$key]['comment_judge']['support']++;
				} elseif ($comment_judge['type'] == -1) {
					$commentList[$key]['comment_judge']['against']++;
				}
			}
		}
		$commentNum = count($commentModel->getList($commentParam));
		Tpl::assign('commentList', $commentList);
		Tpl::assign('commentNum', $commentNum);
		Tpl::assign('html_title',$article['title']);
		Tpl::display('article/show','defaultCommonChildLayout');
	}

	/**
	 * @doc 文章收藏列表
	 * @author Heanes
	 * @time 2015-09-10 11:29:11
	 */
	public function collectListOp(){
		$this->needLogin();
		$user_id=Filter::doFilter($_SESSION['user_id'],'integer');
		$articleCollectModel=Model('article_collect');
		$articleCollectParam['field']='article_id,collect_time';
		$articleCollectParam['where']="`user_id`='$user_id' AND `is_enable`=1";
		$articleCollectParam['order']=array('collect_time'=>'DESC');
		$articleCollectList=$articleCollectModel->getList($articleCollectParam);
		$sql='select'
			.' `c`.`article_id`, `c`.`collect_time`,`p`.*'
			.' from'
			.' `'.DB_PRE.'article_collect` `c`, `'.DB_PRE.'article` `p`'
			.' where'
			.' `c`.`user_id` = '.$user_id
			.' and `c`.`article_id` = `p`.`id`'
			.' and `c`.`is_enable` = 1 and `p`.`is_enable`=1'
			.' and `c`.`is_deleted` = 0 and `p`.`is_deleted`=0'
			.' order by'
			.' `c`.`collect_time` desc';
		if(isset($_GET['page']) && !empty($_GET['page'])){
			$limit_start=(Filter::doFilter($_GET['page'],'integer')-1)*10;
			$limit_end  =Filter::doFilter($_GET['page'],'integer')*10;
			$sql.=' limit '.$limit_start.','.$limit_end;
		}else{
			//$sql.=' limit 0,5';
		}
		//echo $sql;
		//@todo 实现分页
		$articleCollectList=$articleCollectModel->executeSql($sql);
		if($articleCollectList){
			//根据收藏日期进行分组，具体到天
			$articleCollectListOrdered=array();
			foreach ($articleCollectList as $key => $articleCollect) {
				$articleCollect['_cover_img_src']=PATH_BASE_FILE_UPLOAD.'image/article/'.$articleCollect['article_id'].'/cover/'.$articleCollect['cover_img_src'];
				$collect_date=date('Y-m-d',$articleCollect['collect_time']);
				$collect_date_exists=array_column($articleCollectListOrdered,'collect_date');
				if(in_array($collect_date,$collect_date_exists)){
					$collect_date_key=array_search($collect_date,$collect_date_exists);
					$articleCollectListOrdered[$collect_date_key]['collect_date']=$collect_date;
					$articleCollectListOrdered[$collect_date_key]['collect_articles'][]=$articleCollect;
				}else{
					$articleCollectListOrdered[]=array(
						'collect_date'=>$collect_date,
						'collect_articles'=>array($articleCollect));
				}
			}
		}else{
			$articleCollectListOrdered=array();
		}
		Tpl::assign('articleCollectListOrdered',$articleCollectListOrdered);
		Tpl::assign('html_title','文章收藏');
		Tpl::display();
	}

	/**
	 * @doc 文章收藏
	 * @author Heanes
	 * @time 2015-09-11 09:59:18
	 */
	public function collectOp(){
		if(isset($_POST['article_id']) && isset($_POST['user_id'])){
			$newWareCollect['article_id']=Filter::doFilter($_POST['article_id'],'integer');
			$newWareCollect['user_id']=Filter::doFilter($_POST['user_id'],'integer');
			if(empty($newWareCollect['article_id']) || empty($newWareCollect['user_id'])){
				ajax_return(array('status'=>'-1','msg'=>'参数错误'));
				exit;
			}
			$articleCollectModel=Model('article_collect');
			$articleCollectParam['where']="`article_id`='".$newWareCollect['article_id']."' AND `user_id`='".$newWareCollect['user_id']."' AND `is_enable`=1";
			$articleCollect=$articleCollectModel->getOne($articleCollectParam);
			if(count($articleCollect)){
				//若已经收藏则取消收藏，将is_delete置为1
				$articleCollect['is_delete']==1 ? $newWareCollect['is_delete']=0 : $newWareCollect['is_delete']=1;
				$articleCollect['is_delete']==1 ? $newWareCollect['collect_time']=getGMTime() : null;
				$newWareCollect['update_time']=getGMTime();
				$articleCollectWhere="`article_id`='".$newWareCollect['article_id']."' AND `user_id`='".$newWareCollect['user_id']."' AND `is_enable`=1";
				if($articleCollectModel->update($newWareCollect,$articleCollectWhere)){
					$articleCollect['is_delete']==1 ? $result=array('status'=>1,'msg'=>'收藏成功') : $result=array('status'=>0,'msg'=>'取消收藏成功');
				}else{
					$result=array('status'=>-1,'msg'=>'抱歉，操作失败！');
				}
			}else{
				$newWareCollect['insert_time']=getGMTime();
				$newWareCollect['collect_time']=getGMTime();
				if($articleCollectModel->insert($newWareCollect)){
					$result=array('status'=>1,'msg'=>'加入收藏成功！');
				}else{
					$result=array('status'=>-1,'msg'=>'抱歉，加入收藏失败，请稍后再试！');
				}
			}
			ajax_return($result);
		}else{
			//显示收藏列表
			$this->collectListOp();
		}
	}

	/**
	 * @doc 关于我们
	 * @author Heanes
	 * @time 2015-07-10 09:44:46
	 */
	public function aboutOp(){
		Tpl::assign('html_title','关于我们');
		Tpl::display('articleSubject/aboutUs');
	}

	/**
	 * @doc 联系我们
	 * @author Heanes
	 * @time 2015-07-10 09:44:53
	 */
	public function contactUsOp(){
		Tpl::assign('html_title','联系我们');
		Tpl::display('articleSubject/contactUs');
	}
}