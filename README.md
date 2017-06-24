### 期末作业概述

+ 产品名称：财务
+ 项目代码：https://github.com/luozijian/software-engineering
+ 项目地址：http://software.luozijian.top/admin/login
+ 默认账户密码 username：1@qq.com  password：1

### 运行环境

- Nginx 1.8+
- PHP 5.6+
- Mysql 5.6+

### 开发环境部署/安装

本项目代码使用 PHP 框架 [Laravel 5.4](http://laravel-china.org/docs/5.4/) 开发，本地开发环境使用 [Laravel Homestead](http://laravel-china.org/docs/5.4/homestead)。

下文将在假定读者已经安装好了 Homestead 的情况下进行说明。如果您还未安装 Homestead，可以参照 [Homestead 安装与设置](http://laravel-china.org/docs/5.4/homestead#installation-and-setup) 进行安装配置。

#### 基础安装

1. 克隆仓库

   ```
   git clone https://github.com/luozijian/bilibili.git
   ```


2. 配置本地 Homestead 环境

   + 修改配置文件

     ```
     vi Homestead.yaml
     ```

   + 加入以下内容

     ```
      - map: bilibili.dev
           to: /home/vagrant/Code/software/public
     ```

   + 修改 host 文件

     ````
     sudo vi /etc/host
     //加入以下内容
     192.168.10.10   software.dev
     ````

   + `vargant up --provision` 重启 homestead 即可生效

3. 安装依赖包扩展

   ```
   composer install
   ```

4. 生成配置文件

   ```
   cp .env.example .env
   ```

5. 新增相应数据库（注意与.env设置名字一致），`db.sql` 文件在项目根目录 `public` 里面，也可以通过 `php artisan migrate --seed` 来迁移数据库
