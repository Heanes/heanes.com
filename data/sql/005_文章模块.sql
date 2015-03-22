use `heanes.com`;
#----------pre_article_category表--------------------------------------------------------
/* 
 * @doc 文章分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists pre_article_category;
create table pre_article_category(
article_category_id int unsigned auto_increment comment'自增ID，主键',
article_category_parent_id int unsigned comment'父分类ID',
article_category_name varchar(63) not null comment'分类名称',
article_category_template_id int unsigned comment'分类模版ID',
article_category_a_href varchar(255) comment'分类链接',
article_category_a_title varchar(255) comment'分类链接标题',
article_category_img_src varchar(255) comment'分类图标',
article_category_keywords varchar(511) comment'分类SEO关键词',
article_category_comment text comment'分类备注信息',
article_category_user_role_id smallint unsigned comment'分类阅读用户角色权限',
article_category_user_rank int unsigned comment'分类阅读用户积分',
article_category_pwd varchar(64) comment'分类阅读密码',
article_category_insert_time int(10) comment'创建时间',
article_category_update_time int(10) comment'更新时间',
article_category_order int unsigned  comment'排序',
article_category_enbale tinyint default 1 comment'是否启用（显示）',
primary key(article_category_id)
)engine=innodb auto_increment=1 default charset=utf8 comment'文章分类表';

#----------pre_article表--------------------------------------------------------
/* 
 * @doc 文章内容表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists pre_article;
create table pre_article(
article_id int unsigned auto_increment comment'自增ID，主键',
article_category_id int unsigned comment'文章分类ID',
article_title varchar(255) comment'文章标题',
article_subtitle varchar(255) comment'文章副标题',
article_cover_img_src varchar(255) comment'文章封面图片',
article_user_id int unsigned comment'文章作者（用户）ID',
article_user_name varchar(127) comment'文章作者（用户）名称',
article_user_link varchar(255) comment'文章作者链接',
article_author_name varchar(127) comment'文章作者笔名',
article_content text comment'文章内容',
article_a_href varchar(255) comment'文章链接',
article_a_title varchar(255) comment'文章链接标题',
article_template_id int unsigned comment'文章模版ID',
article_is_new tinyint unsigned comment'是否为新发布文章',
article_is_promot tinyint unsigned comment'是否推荐',
article_is_top tinyint unsigned comment'是否置顶',
article_is_great tinyint unsigned comment'是否精品',
article_allow_comment tinyint unsigned comment'是否允许评论',
article_comment_num int unsigned comment'阅读数',
article_comment_score smallint comment'文章评分，允许为负分',
article_read_num int unsigned comment'阅读次数',
article_keywords varchar(511) comment'文章SEO关键词',
article_user_role_id smallint unsigned comment'文章阅读用户权限',
article_user_rank int unsigned comment'文章阅读用户积分',
article_pwd varchar(64) comment'阅读密码',
article_insert_time int(10) comment'文章创建时间',
article_update_time int(10) comment'文章更新时间',
article_order int comment'排序',
article_enable tinyint comment'是否启用（显示）',
primary key(article_id)
)engine=innodb auto_increment=1 default charset=utf8 comment'文章内容表';

#----------pre_article_comment表--------------------------------------------------------
/* 
 * @doc 文章评论表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists pre_article_comment;
create table pre_article_comment(
article_comment_id int unsigned auto_increment comment'自增ID，主键',
article_comment_article_id int unsigned comment'被评论文章ID',
article_comment_parent_id int unsigned comment'父评论，“盖楼”形式',
article_comment_user_id int unsigned comment'评论人用户ID',
article_comment_user_name varchar(255) comment'评论人名称',
article_comment_email varchar(255) comment'评论人Email',
article_comment_web_link varchar(255) comment'评论人网站地址',
article_comment_title varchar(1023) comment'评论标题',
article_comment_content text comment'评论内容',
article_comment_score smallint comment'评分',
article_comment_ip varchar(40) comment'评论人IP，兼容IPv6',
article_comment_is_hot tinyint comment'是否热门',
article_comment_is_top tinyint comment'是否置顶',
article_comment_insert_time int(10) comment'评论时间',
article_comment_update_time int(10) comment'评论更新时间',
article_comment_order int unsigned comment'排序',
article_comment_enable tinyint unsigned default 1 comment'是否启用（显示）',
primary key(article_comment_id)
)engine=innodb auto_increment=1 default charset=utf8 comment'文章评论表';