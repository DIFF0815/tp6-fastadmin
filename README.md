# 说明

## 部署
* 域名指向 /public
* nginx uri 重写
  ```shell
  location / {
      try_files $uri $uri/ =404;
      if (!-e $request_filename) {
      rewrite  ^(.*)$  /index.php?s=/$1  last;
      break;
      }
  }
  ```
## 访问
### 目录说明
  * app/admin   后台
  * app/api   接口
  * app/index   前台
  * app/common   公共模块

### 地址
  * 后台
    域名/admin/index/login
  * 前台
    域名/index/index/index
  * 接口
    域名/api/index/index

## 数据库迁移
### Migration Generator-逆向迁移文件生成
    引入工具
    composer require jaguarjack/migration-generator:dev-master

    生成文件(生成的文件目录 /database/migrations/)
    php think migration:generate
### 数据库迁移工具
    引入工具（官方的）
    composer require topthink/think-migration

    引入工具（网友维护的 一般比较新 https://github.com/NHZEX/think-phinx）
    composer require nhzex/think-phinx

    //生成数据库
    php think migrate:run
