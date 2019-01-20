<?php

use Phinx\Migration\AbstractMigration;

class PeopleTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('people', ['id' => false, 'primary_key' => 'id']);
        $table
            ->addColumn('id', 'biginteger', ['identity' => true])
            ->addColumn('region_id', 'biginteger',['signed' => false])
            ->addColumn('name', 'char', ['limit' => 20])
            ->create();

        $table
            ->changeColumn('id', 'biginteger', ['signed' => false, 'identity' => true])
            ->update();

        $table
            ->addForeignKey('region_id', 'region')
            ->update();
    }

    public function down()
    {
        $table = $this->table('people');
        $table->drop();
    }
}
