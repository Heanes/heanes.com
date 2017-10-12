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
    `user_name`, `user_pwd`, `user_email`, `create_time`)
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
    , ('1', 'web_name', '网站名称', '', 'text', null, 'Heanes的博客', '1', '1')
    # 网站标题
    , ('1', 'web_title', '网站标题', '', 'text', null, 'Heanes的博客', '1', '1')
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
    , ('1', 'web_theme_admin', '网站主题-后台', '', 'text', '网站主题-后台', 'default', '1', '1')
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
    , `style_class`, `style_class_hover`, `style_class_acitve`, `order_number`, `create_time`, `create_user`
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
    , `create_time`, `create_user`
)
values
    (0, '关于', 'about', 0, '', '关于本站', '', '', '', '', '', '', '', '关于本站', '关于本站', '关于本站', 0, 0, '', 0, 1467363203, 1)
    ,(0, '技术专题', 'technique', 0, '', '技术专题，各种技术文章', '', '', '', '', '', '', '', '技术专题', '技术专题，钻研各类技术问题', '技术专题，钻研各类技术问题', 0, 0, '', 0, 1467363203, 1)
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
    , `content_id`, `keywords`, `tags`, `semantic_a_href`, `a_href`, `a_title`
    , `title_bg_color`, `content_bg_color`, `template_id`
    , `is_new`, `is_recommend`, `is_top`, `is_great`
    , `allow_comment`, `comment_count`, `comment_score`
    , `read_count`, `click_count`, `thumbs_up_count`, `collect_count`
    , `seo_title`, `seo_keywords`, `seo_description`
    , `user_role_id`, `user_rank`, `access_password`
    , `order_number`, `create_time`, `create_user`
)
values
    (1, '你好世界', 'hello world', '', '1', '', 'Heanes', 1467363203, 'Heanes', 'heanes.com', 1, 'hello world', '', '', '', '你好世界', '', '', 1, 1, 0, 0, 0, 1, 0, 5, 12, 11, 0, 0, '你好世界', '你好世界', '你好世界', 0, 0, '', 0, 1467363203, '1')
    , (1, '关于本站', 'about us', '', '1', '', 'Heanes', 1467363205, 'Heanes', 'heanes.com', 2, 'about us', '', '', '', '关于本站', '', '', 1, 1, 0, 0, 0, 1, 0, 5, 12, 11, 0, 0, '关于本站', '关于本站', '关于本站', 0, 0, '', 0, 1467363203, '1')
    , (3, '第一篇文', 'first article', '', '1', '', 'Heanes', 1467363205, 'Heanes', 'heanes.com', 2, 'first article', '', '', '', '第一篇文', '', '', 1, 1, 0, 0, 0, 1, 0, 5, 12, 11, 0, 0, '第一篇文', '第一篇文', '第一篇文', 0, 0, '', 0, 1467363203, '1')
    , (1, '关于站长', 'about author', '', '1', '', 'Heanes', 1467363205, 'Heanes', 'heanes.com', 2, 'about me', '', '', '', '关于站长', '', '', 1, 1, 0, 0, 0, 1, 0, 5, 12, 11, 0, 0, '关于站长', '关于站长', '关于站长', 0, 0, '', 0, 1467363203, '1')
    , (3, '留下汗水，才有收获的期待', 'about author', '', '1', '', 'Heanes', 1467363205, 'Heanes', 'heanes.com', 2, '汗水 期待 收货', '', '', '', '留下汗水，才有收获的期待', '', '', 1, 1, 0, 0, 0, 1, 0, 5, 12, 11, 0, 0, '留下汗水，才有收获的期待', '汗水 期待 收货', '汗水 期待 收货', 0, 0, '', 0, 1467363203, '1')
;

/**
 * @doc 文章内容数据
 * @author Heanes
 * @time 2016-07-06 19:50:59 周三
 */
truncate `heanes.com`.`pre_article_content`;
insert into `heanes.com`.`pre_article_content` (
    `article_id`, `content`, `create_time`, `create_user`
)
values
    (1, '<p>第一篇文章。</p>', 1467363203, 1)
    , (2, '<p>关于本站。</p>', 1467363203, 1)
    , (3, '<p>时光如水，静静的不易察觉。</p><p><a href="http://ww4.sinaimg.cn/large/ac4ae42fjw1dv04zt7glsj.jpg"><img class=" wp-image-98   alignnone" title="ali" src="http://ww4.sinaimg.cn/large/ac4ae42fjw1dv04zt7glsj.jpg" alt="" width="680" height="425" /></a></p><p>至此，发现许多事情，都应该在要做的时候及时的去做去完成。</p><p>许多的人，人的许多，都在这等待中渐变，分离。</p><p>好好的走每一步路。</p><p><a href="http://ww2.sinaimg.cn/large/ac4ae42fjw1dv050sirf0j.jpg"><img class=" wp-image-99  alignnone" style="border: 2px solid black;" title="timeandninght" src="http://ww2.sinaimg.cn/large/ac4ae42fjw1dv050sirf0j.jpg" alt="" width="830" height="466" /></a>', 1467363203, 1)
    , (4, '<p>[dewplayer:http://boxstr.net/files/5291875_6zjz3/%E4%BA%BA%E8%B4%A8-%E5%BC%A0%E6%83%A0%E5%A6%B9.mp3]</p><p>关于本站：</p><p>本站可以也叫随意录</p><p>共享各类软件，关于IT的新闻资讯，同时也顺便记录生活，分享生活，如此。</p><p>为什么要叫“挨挨踢”？ 取之I IT，爱IT，挨快速发展的IT的踢，╮(╯▽╰)╭</p><p>关于Heanes：</p><p>男未婚，海拔请目测，年龄不定（o(╯□╰)o）。喜欢计算机及网络，喜欢细碎的、零星的东西。有搜集癖，轻微强迫症。</p><p>联系Heanes：</p><p>QQ：137845848 <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=137845848&amp;site=qq&amp;menu=yes" target="_blank"><img title="点击这里给我发消息" src="http://wpa.qq.com/pa?p=2:137845848:41" alt="点击这里给我发消息" border="0" /></a></p><p>E-mail：<span style="color: #0000ff;"><a href="mailto:heanes@163.com"><span style="color: #0000ff;">heanes@163.com</span></a></span></p><p>腾讯微博：<span style="color: #0000ff;"><a href="http://t.qq.com/heanes"><span style="color: #0000ff;">http://t.qq.com/heanes</span></a></span></p><p>新浪微博：<span style="color: #0000ff;"><a href="http://weibo.com/heanes"><span style="color: #0000ff;">http://weibo.com/heanes</span></a></span></p><p>如有需要，请在此页面留言。', 1467363203, 1)
    , (5, '<p>很喜欢这种汗如雨下的感觉，是奔跑带给我的。</p><p>这种畅快淋漓的痛快以及带一点嘶声力竭的悲凉还有用尽全力的放开自己，都是如此的让人舒畅。</p><p>在这个炎热的夏天里，每天的白天都有放肆的阳光奔洒而下，倾泄在路上的人们的头上身上，燥热难耐。</p><p>起得不是很早，从宿舍到图书馆的路上，只有寥寥几个路人，在暑假学校里也确实没有多少人，留下的是或培训或考研的同学，都是忙忙碌碌的，在成长的路上，做着不同的准备。</p><p>我们将走向不同的人生路，以不同的姿态，接受自己所选择的生活。</p><p>我多少希望现在能多克制自己，不要那么贪玩和嗜睡，而去好好安静的坐下来，做自己该做的事，想自己该想的东西。</p><p>我是一个为了目的而不择手段不挠不休的人，不知道这是好是坏。只是自己在想要的东西面前，会变得固执，从小就是这样——5岁那年，看上了一个5元玩具飞机，可是爸爸不让一个小孩子奢侈的花费5元钱去买一个没有什么价值的东西，至少是在大人的面前一个玩具是没有什么价值的，而且当年5元钱也不是一个小数目。我清楚的记得我用了多种手段迫使大人们最后给我买了想要的东西：哭闹不起作用，就拉着大人的衣服，还不心软，就用头撞墙。当时小小的我，就能忍受这样的痛苦，自然我相信这个夏天乃至明年一月份，我都可以坚持下来。</p><p>在奔跑中，呼吸急促，血液流转，有种生命的勃发在体内，我喜欢这种感觉。这是一种在看似无尽的跑道上拼搏的劲道，想想在有着点点星光的晚上，在人不多的跑道上，眼前一点点光亮，顺着跑道永远不停跨动自己的双脚，冲向更远方。风声从耳边吹过，也带着头脑刮过些许思考,这真是一种很完美的感觉。</p><p>现在身上已留下满身的汗水，而我还要跑向更远。
<p style="text-align: center;"><a href="http://blog.heanes.com/wp-content/uploads/8.jpg"><img class="aligncenter  wp-image-173" title="run" src="http://blog.heanes.com/wp-content/uploads/8.jpg" alt="" width="922" height="576" /></a></p>
&nbsp;', 1467363203, 1)
;

/**
 * @doc 文章标签库数据
 * @author Heanes
 * @time 2017-09-16 13:42:20 周六
 */
truncate `heanes.com`.`pre_article_tag_lib`;
insert into `heanes.com`.`pre_article_tag_lib` (
    `name`, `create_time`, `create_user`
)
values
    ('关于', 1467363203, 1)
    , ('后端', 1467363203, 1)
    , ('前端', 1467363203, 1)
    , ('数据库', 1467363203, 1)
    , ('生活情绪', 1467363203, 1)
    , ('php', 1467363203, 1)
    , ('java', 1467363203, 1)
    , ('javascript', 1467363203, 1)
    , ('sql', 1467363203, 1)
;

/**
 * @doc 文章标签
 * @author Heanes
 * @time 2017-09-16 13:42:20 周六
 */
truncate `heanes.com`.`pre_article_tag`;
insert into `heanes.com`.`pre_article_tag` (
    `article_id`, `tag_id`, `create_time`, `create_user`
)
values
    (1, 1, 1467363203, 1)
    , (2, 1, 1467363203, 1)
;

#================================================网站友情链接数据导入=============================================#
/**
 * @doc 友情链接
 * @author Heanes
 * @time 2016-11-20 20:01:57 周日
 */
truncate `heanes.com`.`pre_friend_link`;
insert into `heanes.com`.`pre_friend_link`(
    name, email, a_href, a_title, a_target, img_src, img_title, description
    , order_number, create_time, create_user
)
values
    ('津乐网', 'heanes@163.com', 'http://www.ejinle.com/', '津乐网', '0', '', '津乐网', '津乐网', 1, 1467363203, 1)
    , ('谷歌翻译', 'heanes@163.com', 'http://translate.google.cn/', '谷歌翻译', '0', '', '谷歌翻译', '谷歌翻译', 1, 1467363203, 1)
;
    