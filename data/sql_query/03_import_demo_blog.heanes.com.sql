use `heanes.com`;
set FOREIGN_KEY_CHECKS = 0;

#================================================demo数据导入=============================================#

#================================================网站管理员数据导入=============================================#
/**
 * @doc 导入管理员用户数据
 * @author Heanes
 * @time 2015-07-04 09:27:10
 */
truncate `heanes.com`.`pre_admin_user`;
insert into `heanes.com`.`pre_admin_user` (
    `user_name`, `user_pwd`, `user_email`, `insert_time`)
values
    # admin - fg123456
    ('admin', 'd6f19b13cc75b70cabe99ca6d92e5de7', 'heanes@163.com', '1425922473')
;

#================================================网站设置类数据导入=============================================#
truncate `heanes.com`.`pre_setting_common`;
insert into `heanes.com`.`pre_setting_common` (
    `parent_id`, `code`, `name`, `description`, `input_type`, `input_range`, `stored_value`, `order_number`, `can_edit`)
values
    # 默认管理员
    ('1', 'default_admin', '默认管理员', '', 'text', null, 'admin', '1', '0')
    #-------------------------------------------网站信息设置
    # 网站名称
    , ('1', 'site_name', '网站名称', '', 'text', null, '海利系统', '1', '1')
    # 网站logo
    , ('1', 'web_logo', '网站logo', '', 'file', null, 'logo.jpg', '1', '1')
    # 网站版权申明
    , ('1', 'web_copyright', '网站版权申明', '', 'text', null, '<div style=\"text-align:center;\">\r\n<span style=\"line-height:1.5;\">版权所有&copy;Heanes Soft 京ICP备123456</span> \r\n</div>', '1', '1')
    # 网站关键字
    , ('1', 'web_keywords', '网站关键字', '', 'text', null, '软件|商务|原创|开发|后端|php|java', '1', '1')
    # 网站描述
    , ('1', 'web_description', '网站描述', '', 'textarea', null, '海利系统软件，多模块支持', '1', '1')
    # 网站名称
    , ('1', 'web_name', '网站名称', '', 'text', null, '海利系统', '1', '1')
    # 网站标题
    , ('1', 'web_title', '网站标题', '', 'text', null, '海利系统', '1', '1')
    # 网站联系地址-国家
    , ('1', 'web_country', '网站联系地址-国家', '', 'text', null, '中国', '1', '1')
    # 网站联系地址-省
    , ('1', 'web_province', '网站联系地址-省', '', 'text', null, '北京', '1', '1')
    # 网站联系地址-市
    , ('1', 'web_city', '网站联系地址-市', '', 'text', null, '海淀', '1', '1')
    # 网站联系地址-区
    , ('1', 'web_region', '网站联系地址-区', '', 'text', null, '中关村', '1', '1')
    # 网站详细地址
    , ('1', 'service_address', '网站详细地址', '', 'text', null, '北京市海淀区中关村', '1', '1')
    # 网站服务邮箱
    , ('1', 'service_email', '网站服务邮箱', '', 'text', null, 'service@heanes.com', '1', '1')
    # 网站备案信息
    , ('1', 'icp_number', '网站备案号', '', 'text', null, '京ICP证 123456号', '1', '1')
    # 网站备案文件
    , ('1', 'icp_file', '网站备案文件', '', 'file', '网站备案的证书文件', 'cert.png', '1', '1')
    #-------------------------------------------网站功能设置
    # 是否支持注册
    , ('1', 'enable_register', '是否支持注册', '', 'select', '1,0', '1', '1', '1')
    # 是否开启验证码
    , ('1', 'captcha_enable', '是否开启验证码', '是否启用登录验证码', 'select', '0,1', '0', '1', '1')
    # 尝试多少次后需要验证码
    , ('1', 'captcha_need_try_times', '尝试多少次后需要验证码', '尝试多少次后需要验证码', 'select', '0,1', '0', '1', '1')
    # 网站主题-前台
    , ('1', 'web_theme_home', '网站主题-前台', '', 'text', '网站主题-前台', 'default', '1', '1')
    # 网站主题-后台
    , ('1', 'web_theme_admin', '网站主题-后台', '', 'text', '网站主题-后台', 'modernUI', '1', '1')
    # 网站是否关闭
    , ('1', 'web_close', '网站是否关闭', '', 'select', '0,1', '0', '1', '1')
    # 网站关闭原因
    , ('1', 'web_close_description', '网站关闭原因', '', 'textarea', null, '网站暂时关闭，敬请耐心等待', '1', '1')
    # 网站语言
    , ('1', 'lang', '网站语言', '', 'select', 'zh_cn,en_us', 'zh_cn', '1', '1')
    # 网站图片水印
    , ('1', 'watermark', '网站水印文件', '', 'file', null, 'watermark.png', '1', '1')
    # 网站水印位置
    , ('1', 'watermark_place', '网站水印位置', '', 'text', '0,1,2,3,4,5', '水印位置', '1', '1')
    # 网站水印透明度
    , ('1', 'watermark_alpha', '网站水印透明度', '', 'text', null, '10', '1', '1')
    # rewrite重写功能
    , ('1', 'rewrite', 'rewrite重写功能', '', 'select', '0,1,2', '1', '1', '1')
    # 文件上传大小限制
    #------------------------------------------网站显示设置
    , ('1', 'upload_size_limit', '文件上传大小限制', '', 'text', '-1,0,64,128,256,512,1024,2048,4096', '4096', '1', '1')
    # 首页文章显示条数
    , ('1', 'home_article_num', '首页文章显示条数', '首页文章显示条数', 'text', '', '20', '1', '1')
    # 首页友情链接是否显示图片
    , ('1', 'friendly_link_logo', '首页友情链接是否显示图片', '尾部友情链接是否显示图片，0-不显示，1-显示', 'text', '0,1', '1', '1', '1')
    # 文章分页大小
    , ('1', 'article_list_page_size', '文章分页大小', '', 'text', '', '20', '1', '1')
    # 日期格式化
    , ('1', 'date_formative', '日期格式化', '', 'text', '20', 'Y-m-d', '1', '1')
    # 日期及时间格式化
    , ('1', 'date_time_formative', '日期及时间格式化', '', 'text', '20', 'Y-m-d H:i:s', '1', '1')
    # 网站分页参数"分页"名称
    , ('1', 'request_page_param_name', '分页参数名称', '分页参数名称，url中请求用', 'text', '20', 'p', '1', '1')
    # 网站分页参数"分页大小"名称
    , ('1', 'request_page_size_param_name', '分页参数-分页大小名称', '分页参数分页大小名称，url中请求用', 'text', '20', 'pageSize', '1', '1')
    # 分页大小
    , ('1', 'data_list_page_size', '分页大小', '分页大小', 'text', '20', '20', '1', '1')
    #-----------------------------------------网站开发信息
    # 网站安装时间
    , ('1', 'web_install_time', '网站安装时间', '网站安装时间，不可更改，作为参考信息', 'text', '', '1467363203', '1', '1')
    # 网站运营时间
    , ('1', 'web_run_time', '网站运营时间', '网站运营时间，可以更改', 'text', '2年', '1467363203', '1', '1')
;

#================================================网站导航栏数据导入=============================================#
/**
 * @doc 导入导航栏数据
 * @author fanggang
 * @time 2016-07-01 17:13:39 周五
 */
truncate `heanes.com`.`pre_navigation`;
insert into `heanes.com`.`pre_navigation` (
    `parent_id`, `name`, `a_href`, `a_title`, `a_target`, `icon_class`, `img_src`, `img_src_hover`, `img_src_active`, `href_active_match_path`
    , `style_class`, `style_class_hover`, `style_class_acitve`, `order_number`, `insert_time`, `create_user`
)values
    ('0', '首页', '/', '首页', '_self', 'fa fa-home icon-nav icon-web-home', '', '', '', '', '', '', '', '1', '1467363203', '1')
    ,('0', '精选推荐', '/articleCategory/great.html', '精选推荐', '_blank', 'fa fa-modx icon-nav icon-great', '', '', '', '', '', '', '', '2', '1467363203', '1')
    ,('0', '技术专题', '/articleCategory/technique.html', '技术专题', '_blank', 'fa fa-hashtag icon-nav icon-technique', '', '', '', '', '', '', '', '3', '1467363203', '1')
    ,('0', '文字专栏', '/articleCategory/write.html', '文字专栏', '_blank', 'fa fa-edit icon-nav icon-write', '', '', '', '', '', '', '', '4', '1467363203', '1')
    ,('0', '原创作品', '/articleCategory/selfWork.html', '原创作品', '_blank', 'fa fa-diamond icon-nav icon-self-work', '', '', '', '', '', '', '', '5', '1467363203', '1')
    ,('0', '关于博客', '/articleCategory/about.html', '关于博客', '_blank', 'fa fa-info-circle icon-nav icon-about', '', '', '', '', '', '', '', '6', '1467363203', '1')
    ,('0', '登录', '/user/login.html', '登录', '_blank', 'fa fa-user icon-nav icon-login', '', '', '', '', 'nav-login', '', '', '7', '1467363203', '1')
    ,('0', '注册', '/user/register.html', '注册', '_blank', 'fa fa-user-plus icon-nav icon-register', '', '', '', '', '', '', '', '8', '1467363203', '1')
;

#================================================网站文章相关数据导入=============================================#
/**
 * @doc 文章分类数据
 * @author Heanes
 * @time 2016-07-06 17:51:25 周三
 */
truncate `heanes.com`.`pre_article_category`;
insert into `heanes.com`.`pre_article_category` (
    `parent_id`, `name`, `code`, `template_id`, `a_href`, `a_title`
    , `icon_class`, `img_src`, `img_src_hover`, `img_src_active`, `style_class`, `style_class_hover`, `style_class_acitve`
    , `seo_keywords`, `seo_description`, `description`
    , `user_role_id`, `user_rank`, `access_password`, `order_number`
    , `insert_time`, `create_user`
)
values
    (0, '技术专题', 'technique', 0, '', '技术专题，各种技术文章', '', '', '', '', '', '', '', '技术专题', '技术专题，钻研各类技术问题', '技术专题，钻研各类技术问题', 0, 0, '', 0, 1467363203, 1)
    ,(0, '文字专栏', 'write', 0, '', '文字专栏', '', '', '', '', '', '', '', '文字专栏', '文字专栏', '文字专栏', 0, 0, '', 0, 1467363203, 1)
;

/**
 * @doc 文章数据
 * @author Heanes
 * @time 2016-07-06 19:50:59 周三
 */
truncate `heanes.com`.`pre_article`;
insert into `heanes.com`.`pre_article` (
    `category_id`, `title`, `subtitle`, `cover_img_src`
    , `user_id`, `user_link`, `author`, `publish_time`, `editor`, `origin_source`
    , `content`, `keywords`, `tags`, `semantic_a_href`, `a_href`, `a_title`
    , `title_bg_color`, `content_bg_color`, `template_id`
    , `is_new`, `is_recommend`, `is_top`, `is_great`
    , `allow_comment`, `comment_count`, `comment_score`
    , `read_count`, `click_count`, `thumbs_up_count`, `collect_count`
    , `seo_title`, `seo_keywords`, `seo_description`
    , `user_role_id`, `user_rank`, `access_password`
    , `order_number`, `insert_time`, `create_user`
)
values
    (2, '你好世界', 'hello world', '', '1', '', 'Heanes', 1467363203, 'Heanes', 'heanes.com', '<style>.article-content h2.title-text{font-size:22px;padding:20px 0;}.article-content h3.title-text{padding:14px 0;text-indent:2em;}.article-content p{text-indent:2em;font-size:14px;}.article-content .placeholder{line-height:1.8em;}.article-content .placeholder:before{content:"章节内容正文内容章节内容正文内容章节内容正文内容章节内容正文内容章节内容正文内容章节内容正文内容章节内容正文内容章节内容正文内容章节内容正文内容章节内容正文内容章节内容正文内容章节内容正文内容章节内容正文内容"}.article-content .placeholder.ph-large{height:400px;}.article-content .placeholder.ph-mini{height:50px;}</style><h2 class="title-text">第一章</h2><p class="placeholder ph-large">内容</p><h2 class="title-text">第二章</h2><p class="placeholder ph-mini"></p><h3 class="title-text">第二章第一节</h3><p class="placeholder ph-large">内容</p><h3 class="title-text">第二章第二节</h3><p class="placeholder ph-large">内容</p><h2 class="title-text">第三章</h2><p class="placeholder ph-large">内容</p><h3 class="title-text">第三章第一节</h3><p class="placeholder ph-large">内容</p><h3 class="title-text">第三章第二节</h3><p class="placeholder ph-large">内容</p><h3 class="title-text">第三章第三节</h3><p class="placeholder ph-large">内容</p><h2 class="title-text">第四章</h2><p class="placeholder ph-large">内容</p><h3 class="title-text">第四章第一节</h3><p class="placeholder ph-large">内容</p><h3 class="title-text">第四章第二节</h3><p class="placeholder ph-large">内容</p><h3 class="title-text">第四章第三节</h3><p class="placeholder ph-large">内容</p><h2 class="title-text">第五章</h2><p class="placeholder ph-large">内容</p><h3 class="title-text">第五章第一节</h3><p class="placeholder ph-large">内容</p><h3 class="title-text">第五章第二节</h3><p class="placeholder ph-large">内容</p><h3 class="title-text">第三章第三节</h3><p class="placeholder ph-large">内容</p>', 'hello world', '', '', '', '你好世界', '', '', 1, 1, 0, 0, 0, 1, 0, 5, 12, 11, 0, 0, '你好世界', '你好世界', '你好世界', 0, 0, '', 0, 1467363203, '1')
;

/**
 * @doc 友情链接
 * @author Heanes
 * @time 2016-11-20 20:01:57 周日
 */
truncate `heanes.com`.`pre_friend_link`;
insert into `heanes.com`.`pre_friend_link`(
    name, email, a_href, a_title, a_target, img_src, img_title, description
    , order_number, insert_time, create_user
)
values
    ('津乐网', 'heanes.com', 'http://www.ejinle.com/', '津乐网', '0', '', '津乐网', '津乐网', 1, 1467363203, 1)
;
    