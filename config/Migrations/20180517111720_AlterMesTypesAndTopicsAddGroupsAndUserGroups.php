<?php
use Migrations\AbstractMigration;

class AlterMesTypesAndTopicsAddGroupsAndUserGroups extends AbstractMigration
{

    public function up()
    {

        $this->table('groups')
            ->addColumn('tag', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addIndex(
                [
                    'name',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('user_groups', ['id' => false, 'primary_key' => ['user_id', 'group_id']])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('group_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(
                [
                    'group_id',
                ]
            )
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $this->table('user_groups')
            ->addForeignKey(
                'group_id',
                'groups',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('mes_types')
            ->addColumn('is_public_message_type', 'boolean', [
                'after' => 't_par',
                'default' => '0',
                'length' => null,
                'null' => false,
            ])
            ->update();

        $this->table('topics')
            ->addColumn('is_public_topic', 'boolean', [
                'after' => 'mes_id',
                'default' => '0',
                'length' => null,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {
        $this->table('user_groups')
            ->dropForeignKey(
                'group_id'
            )
            ->dropForeignKey(
                'user_id'
            );

        $this->table('mes_types')
            ->removeColumn('is_public_message_type')
            ->update();

        $this->table('topics')
            ->removeColumn('is_public_topic')
            ->update();

        $this->dropTable('groups');

        $this->dropTable('user_groups');
    }
}

