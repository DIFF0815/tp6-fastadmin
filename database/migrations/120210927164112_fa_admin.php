<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class FaAdmin extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('fa_admin', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '管理员表' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('username', 'string', ['limit' => 20,'null' => true,'signed' => true,'comment' => '用户名',])
			->addColumn('nickname', 'string', ['limit' => 50,'null' => true,'signed' => true,'comment' => '昵称',])
			->addColumn('password', 'string', ['limit' => 32,'null' => true,'signed' => true,'comment' => '密码',])
			->addColumn('salt', 'string', ['limit' => 30,'null' => true,'signed' => true,'comment' => '密码盐',])
			->addColumn('avatar', 'string', ['limit' => 255,'null' => true,'signed' => true,'comment' => '头像',])
			->addColumn('email', 'string', ['limit' => 100,'null' => true,'signed' => true,'comment' => '电子邮箱',])
			->addColumn('login_failure', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '失败次数',])
			->addColumn('login_time', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => true,'signed' => true,'comment' => '登录时间',])
			->addColumn('login_ip', 'string', ['limit' => 50,'null' => true,'signed' => true,'comment' => '登录IP',])
			->addColumn('create_time', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => true,'signed' => true,'comment' => '创建时间',])
			->addColumn('update_time', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => true,'signed' => true,'comment' => '更新时间',])
			->addColumn('token', 'string', ['limit' => 59,'null' => true,'signed' => true,'comment' => 'Session标识',])
			->addColumn('status', 'string', ['limit' => 30,'null' => false,'default' => 'normal','signed' => true,'comment' => '状态',])
			->addColumn('admin_group_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => true,'signed' => true,'comment' => '管理员组id',])
			->addIndex(['username'], ['unique' => true,'name' => 'username'])
            ->create();
    }
}
