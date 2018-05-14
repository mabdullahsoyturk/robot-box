<?php
use Migrations\AbstractMigration;

class AlterRobotTable extends AbstractMigration
{

    public function up()
    {

        $this->table('robots')
            ->addColumn('name', 'string', [
                'after' => 'id',
                'default' => null,
                'length' => 100,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('robots')
            ->removeColumn('name')
            ->update();
    }
}

