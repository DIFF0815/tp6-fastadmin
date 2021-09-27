<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class FaAdminAuthRule extends Migrator
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
        $table = $this->table('fa_admin_auth_rule', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '节点表' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('type', 'enum', ['values' => ['menu','file']])
			->addColumn('pid', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => false,'comment' => '父ID',])
			->addColumn('name', 'string', ['limit' => 100,'null' => true,'signed' => true,'comment' => '规则名称',])
			->addColumn('title', 'string', ['limit' => 50,'null' => true,'signed' => true,'comment' => '规则名称',])
			->addColumn('icon', 'string', ['limit' => 50,'null' => true,'signed' => true,'comment' => '图标',])
			->addColumn('url', 'string', ['limit' => 255,'null' => true,'signed' => true,'comment' => '规则URL',])
			->addColumn('condition', 'string', ['limit' => 255,'null' => true,'signed' => true,'comment' => '条件',])
			->addColumn('remark', 'string', ['limit' => 255,'null' => true,'signed' => true,'comment' => '备注',])
			->addColumn('ismenu', 'boolean', ['null' => false,'default' => 0,'signed' => false,'comment' => '是否为菜单',])
			->addColumn('menutype', 'enum', ['values' => ['addtabs','blank','dialog','ajax']])
			->addColumn('extend', 'string', ['limit' => 255,'null' => true,'signed' => true,'comment' => '扩展属性',])
			->addColumn('py', 'string', ['limit' => 30,'null' => true,'signed' => true,'comment' => '拼音首字母',])
			->addColumn('pinyin', 'string', ['limit' => 100,'null' => true,'signed' => true,'comment' => '拼音',])
			->addColumn('createtime', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => true,'signed' => true,'comment' => '创建时间',])
			->addColumn('updatetime', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => true,'signed' => true,'comment' => '更新时间',])
			->addColumn('weigh', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => true,'comment' => '权重',])
			->addColumn('status', 'string', ['limit' => 30,'null' => true,'signed' => true,'comment' => '状态',])
			->addIndex(['name'], ['unique' => true,'name' => 'name'])
			->addIndex(['weigh'], ['name' => 'weigh'])
			->addIndex(['pid'], ['name' => 'pid'])
            ->create();
    }
}
