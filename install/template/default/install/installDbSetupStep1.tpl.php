<?php defined('InHeanes') or exit('Access Invalid!'); ?>
<div class="main-content w-wrap">
    <div class="install-setup-title">
        <h1 class="install-title">海利系统安装程序</h1>
    </div>
    <div class="install-setup-block">
        <form action="" method="post" class="install-setup-form">
            <div class="input-row">
                <div class="input-field">
                    <label for="db_name">数据库名</label>
                    <input type="text" name="db_name" id="db_name" value="heanes.com" class="install-normal-input" title="数据库名" placeholder="数据库名" required/>
                </div>
                <div class="input-tips">
                    <span class="tips">将系统安装到哪个数据库？</span>
                </div>
            </div>
            <div class="input-row">
                <div class="input-field">
                    <label for="db_user">用户名</label>
                    <input type="text" name="db_user" id="db_user" value="root" class="install-normal-input" title="用户名<" placeholder="用户名" required/>
                </div>
                <div class="input-tips">
                    <span class="tips">你的MySQL用户名</span>
                </div>
            </div>
            <div class="input-row">
                <div class="input-field">
                    <label for="db_pwd">密码</label>
                    <input type="text" name="db_pwd" id="db_pwd" value="7316" class="install-normal-input" title="密码" placeholder="密码" required/>
                </div>
                <div class="input-tips">
                    <span class="tips">数据库密码</span>
                </div>
            </div>
            <div class="input-row">
                <div class="input-field">
                    <label for="db_host">数据库主机</label>
                    <input type="text" name="db_host" id="db_host" value="localhost" class="install-normal-input" title="数据库主机" placeholder="localhost" required/>
                </div>
                <div class="input-tips">
                    <span class="tips">如果填写localhost之后不能正常工作，请向主机服务提供商搜索数据库信息</span>
                </div>
            </div>
            <div class="input-row">
                <div class="input-field">
                    <label for="db_host">数据库端口</label>
                    <input type="text" name="db_port" id="db_port" value="3306" class="install-normal-input" title="数据库端口" placeholder="3306" required/>
                </div>
                <div class="input-tips">
                    <span class="tips">数据库连接端口，windows上默认为3306</span>
                </div>
            </div>
            <div class="input-row">
                <div class="input-field">
                    <label for="db_table_pre">表前缀</label>
                    <input type="text" name="db_table_pre" id="db_table_pre" class="install-normal-input" title="表前缀" placeholder="pre_" value="pre_" required/>
                </div>
                <div class="input-tips">
                    <span class="tips">将系统安装到哪个数据库？</span>
                </div>
            </div>
            <div class="form-handle">
                <div class="form-handle-field">
                    <input type="submit" name="install_setup_step1" class="setup-submit" value="提交"/>
                </div>
            </div>
        </form>

    </div>
</div>