<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class FaAdminGroup extends Migrator
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
        $table = $this->table('fa_admin_group', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '管理员组表' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('pid', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => false,'comment' => '父组别',])
			->addColumn('name', 'string', ['limit' => 100,'null' => false,'default' => '','signed' => true,'comment' => '组名',])
			->addColumn('auth_rules', 'text', ['limit' => MysqlAdapter::TEXT_REGULAR,'null' => false,'signed' => true,'comment' => '访问权限规则ID',])
			->addColumn('menu_rules', 'text', ['limit' => MysqlAdapter::TEXT_REGULAR,'null' => false,'signed' => true,'comment' => '菜单规则ID',])
			->addColumn('create_time', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => true,'signed' => true,'comment' => '创建时间',])
			->addColumn('update_time', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => true,'signed' => true,'comment' => '更新时间',])
			->addColumn('status', 'string', ['limit' => 30,'null' => true,'signed' => true,'comment' => '状态',])
            ->create();
    }
}
