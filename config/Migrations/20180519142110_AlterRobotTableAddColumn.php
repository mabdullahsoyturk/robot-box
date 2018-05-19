<?php
use Migrations\AbstractMigration;

class AlterRobotTableAddColumn extends AbstractMigration
{

    public function up()
    {
        $this->table('user_groups')
            ->dropForeignKey([], 'user_groups_ibfk_1')
            ->dropForeignKey([], 'user_groups_ibfk_2')
            ->removeIndexByName('user_id')
            ->update();

        $this->table('robots')
            ->addColumn('is_public_robot', 'boolean', [
                'after' => 'name',
                'default' => '0',
                'length' => null,
                'null' => false,
            ])
            ->update();

        $this->table('user_groups')
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'group_id',
                'groups',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();
    }

    public function down()
    {
        $this->table('user_groups')
            ->dropForeignKey(
                'user_id'
            )
            ->dropForeignKey(
                'group_id'
            );

        $this->table('user_groups')
            ->addIndex(
                [
                    'user_id',
                ],
                [
                    'name' => 'user_id',
                ]
            )
            ->update();

        $this->table('robots')
            ->removeColumn('is_public_robot')
            ->update();

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
    }
}

