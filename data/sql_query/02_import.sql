use `heanes.com`;
set FOREIGN_KEY_CHECKS = 0;

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
    ('admin', 'd6f19b13cc75b70cabe99ca6d92e5de7', 'heanes@163.com', '1425922473');

#================================================网站设置类数据导入=============================================#
truncate `heanes.com`.`pre_setting_common`;
insert into `heanes.com`.`pre_setting_common` (
    `parent_id`, `code`, `input_type`, `input_range`, `store_value`, `order_number`, `can_edit`)
values
    # 默认管理员
    ('1', 'default_admin', 'text', null, 'admin', '1', '0')
    #-------------------------------------------网站信息设置
    # 网站名称
    , ('1', 'site_name', 'text', null, '海利系统', '1', '1')
    # 网站logo
    , ('1', 'web_logo', 'file', null, 'logo.jpg', '1', '1')
    # 网站版权申明
    , ('1', 'web_copyright', 'text', null, '<div style=\"text-align:center;\">\r\n<span style=\"line-height:1.5;\">版权所有&copy;Heanes Soft 京ICP备123456</span> \r\n</div>', '1', '1')
    # 网站关键字
    , ('1', 'web_keywords', 'text', null, '软件|商务|原创|开发|后端|php|java', '1', '1')
    # 网站描述
    , ('1', 'web_description', 'textarea', null, '海利系统软件，多模块支持', '1', '1')
    # 网站名称
    , ('1', 'web_name', 'text', null, '海利系统', '1', '1')
    # 网站标题
    , ('1', 'web_title', 'text', null, '海利系统', '1', '1')
    # 网站联系地址-国家
    , ('1', 'web_country', 'text', null, '中国', '1', '1')
    # 网站联系地址-省
    , ('1', 'web_province', 'text', null, '北京', '1', '1')
    # 网站联系地址-市
    , ('1', 'web_city', 'text', null, '海淀', '1', '1')
    # 网站联系地址-区
    , ('1', 'web_region', 'text', null, '中关村', '1', '1')
    # 网站详细地址
    , ('1', 'service_address', 'text', null, '北京市海淀区中关村', '1', '1')
    # 网站服务邮箱
    , ('1', 'service_email', 'text', null, 'service@heanes.com', '1', '1')
    # 网站备案信息
    , ('1', 'icp_number', 'text', null, '京ICP证 123456号', '1', '1')
    # 网站备案文件
    , ('1', 'icp_file', 'file', '网站备案的证书文件', 'cert.png', '1', '1')
    #-------------------------------------------网站功能设置
    # 是否支持注册
    , ('1', 'enable_register', 'select', '1,0', '1', '1', '1')
    # 是否开启验证码
    , ('1', 'captcha_enable', 'select', '0,1', '是否启用登录验证码', '1', '1')
    # 尝试多少次后验证验证码
    , ('1', 'theme_web', 'text', '网站主题', 'default', '1', '1')
    # 网站是否关闭
    , ('1', 'web_close', 'select', '0,1', '0', '1', '1')
    # 网站关闭原因
    , ('1', 'web_close_description', 'textarea', null, '网站暂时关闭，敬请耐心等待', '1', '1')
    # 网站语言
    , ('1', 'lang', 'select', 'zh_cn,en_us', 'zh_cn', '1', '1')
    # 网站图片水印
    , ('1', 'watermark', 'file', null, 'watermark.png', '1', '1')
    # 网站水印位置
    , ('1', 'watermark_place', 'text', '0,1,2,3,4,5', '水印位置', '1', '1')
    # 网站水印透明度
    , ('1', 'watermark_alpha', 'text', null, '10', '1', '1')
    # rewrite重写功能
    , ('1', 'rewrite', 'select', '0,1,2', '1', '1', '1')
    # 文件上传大小限制
    #------------------------------------------网站显示设置
    , ('1', 'upload_size_limit', 'text', '-1,0,64,128,256,512,1024,2048,4096', '4096', '1', '1')
    # 首页文章显示条数
    , ('1', 'home_article_num', 'text', '5', '首页文章显示条数', '1', '1')
    # 首页友情链接是否显示图片
    , ('1', 'friendly_link_logo', 'text', '0,1', '尾部友情链接是否显示图片，0-不显示，1-显示', '1', '1')
    #-----------------------------------------网站开发信息
    # 网站安装时间
    , ('1', 'web_install_time', 'text', '', '网站安装时间，不可更改，作为参考信息', '1', '1')
    # 网站运营时间
    , ('1', 'web_run_time', 'text', '2年', '网站运营时间，可以更改', '1', '1');

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
    ,('0', '精选推荐', '/articleCategory/great', '精选推荐', '_blank', 'fa fa-modx icon-nav icon-great', '', '', '', '', '', '', '', '2', '1467363203', '1')
    ,('0', '技术专题', '/articleCategory/technique', '技术专题', '_blank', 'fa fa-hashtag icon-nav icon-technique', '', '', '', '', '', '', '', '3', '1467363203', '1')
    ,('0', '文字专栏', '/articleCategory/write', '文字专栏', '_blank', 'fa fa-edit icon-nav icon-write', '', '', '', '', '', '', '', '4', '1467363203', '1')
    ,('0', '原创作品', '/articleCategory/selfWork', '原创作品', '_blank', 'fa fa-diamond icon-nav icon-self-work', '', '', '', '', '', '', '', '5', '1467363203', '1')
    ,('0', '关于博客', '/articleCategory/about', '关于博客', '_blank', 'fa fa-info-circle icon-nav icon-about', '', '', '', '', '', '', '', '6', '1467363203', '1')
    ,('0', '登录', '/user/login', '登录', '_blank', 'fa fa-user icon-nav icon-login', '', '', '', '', 'nav-login', '', '', '7', '1467363203', '1')
    ,('0', '注册', '/user/register', '注册', '_blank', 'fa fa-user-plus icon-nav icon-register', '', '', '', '', '', '', '', '8', '1467363203', '1')
;