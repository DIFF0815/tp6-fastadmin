# 说明

## 访问
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

    生成文件
    php think migration:generate
### 数据库迁移工具
    引入工具（官方的）
    composer require topthink/think-migration

    引入工具（网友维护的 一般比较新 https://github.com/NHZEX/think-phinx）
    composer require nhzex/think-phinx

    //生成数据库
    php think migrate:run
