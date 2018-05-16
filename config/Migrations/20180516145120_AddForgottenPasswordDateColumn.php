<?php
use Migrations\AbstractMigration;

class AddForgottenPasswordDateColumn extends AbstractMigration
{

    public function up()
    {

        $this->table('users')
            ->addColumn('forgotten_password_date', 'datetime', [
                'after' => 'forgotten_password_code',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('users')
            ->removeColumn('forgotten_password_date')
            ->update();
    }
}

