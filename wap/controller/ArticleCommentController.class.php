<?php
/**
 * @doc 文章评论控制器
 * @filesource ArticleCommentController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.06.24 024 10:05
 */
defined('InHeanes') or exit('Access Invalid!');

class ArticleCommentController extends BaseWapController{
	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 添加评论
	 * @author Heanes
	 * @time 2015-06-24 10:10:46
	 */
	public function addCommentOp(){
		if (isSubmit('article_comment_form_submit')) {
			$this->_addComment();
		} else {
			showError('参数错误！');
		}
	}

	/**
	 * @doc 添加评论
	 * @author Heanes
	 * @time 2015-06-24 10:10:55
	 */
	protected function _addComment(){
		$newCommentArray['article_id'] = Filter::doFilter($_REQUEST['article_id'], 'integer');;
		$newCommentArray['content'] = Filter::doFilter($_POST['comment_content'], 'string');
		$newCommentArray['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
		$newCommentArray['insert_time'] = getGMTime();
		$newCommentArray['ip'] = get_client_ip();
		$location=get_ip_location(get_client_ip(),'taobao');
		$newCommentArray['location'] = $location['data']['region'].' '.$location['data']['city'];
		$newCommentArray['isp'] = $location['data']['isp'];
		$articleCommentModel = Model('ArticleComment');
		if ($articleCommentModel->addComment($newCommentArray)) {
			//更新文章评论数目
			$articleModel=Model('article');
			//更新文章点击数，实际阅读数
			$updateArticleArray = array(
				'comment_num' => array(
					'sign'  => 'increase',
					'value' => '1',
				),
			);
			$updateArticleWhere = "`id`='".$newCommentArray['article_id']."'";
			$articleModel->update($updateArticleArray, $updateArticleWhere);
			$articleModel->update();
			showSuccess('评论成功！');
		} else {
			showError('评论失败！');
		}
	}

	/**
	 * @doc 评论的支持、反对、举报功能
	 * @author Heanes
	 * @time 2015-07-05 01:58:10
	 */
	public function voteOp(){
		$newArticleCommentJudge['article_comment_id'] = Filter::doFilter($_POST['comment_id'], 'integer');
		$vote = '';
		switch (Filter::doFilter($_POST['type'], 'string')) {
			case 'up':
				//支持类型
				$vote = '支持';
				$newArticleCommentJudge['type'] = 1;
				break;
			case 'down':
				//反对类型
				$vote = '反对';
				$newArticleCommentJudge['type'] = -1;
				break;
			case 'report':
				//举报类型
				$vote = '举报';
				$newArticleCommentJudge['type'] = 2;
				break;
		}
		$newArticleCommentJudge['reason'] = Filter::doFilter($_POST['reason'], 'string');
		$newArticleCommentJudge['user_id'] = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
		$newArticleCommentJudge['user_ip'] = get_client_ip();
		$newArticleCommentJudge['insert_time'] = getGMTime();
		$findArticleCommentJudge['where'] = "`article_comment_id`='".$newArticleCommentJudge['article_comment_id']
			."' AND `user_id`='".$newArticleCommentJudge['user_id']
			."' AND `type`='".$newArticleCommentJudge['type']
			."' AND `user_ip`='".$newArticleCommentJudge['user_ip']."'";
		$articleCommentJudgeModel = Model('article_comment_judge');
		if (count($articleCommentJudgeModel->find($findArticleCommentJudge))) {
			$result['status'] = '2';
			$result['msg'] = '只能'.$vote.'一次';
			ajax_return($result);
		} else {
			if ($articleCommentJudgeModel->insert($newArticleCommentJudge)) {
				$result['status'] = '1';
				$result['msg'] = $vote.'成功';
				ajax_return($result);
			} else {
				$result['status'] = '-1';
				$result['msg'] = '失败';
				ajax_return($result);
			}
		}
	}
}
