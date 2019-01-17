<?php


use Phinx\Migration\AbstractMigration;

class PeopleTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('people', ['id' => false, 'primary_key' => 'id']);
        $table
            ->addColumn('id', 'biginteger', ['identity' => true])
            ->addColumn('region_id', 'biginteger')
            ->addColumn('name', 'char', ['limit' => 20])
            ->create();

        $table
            ->addForeignKey('region_id', 'region')
            ->save();
    }

    public function down()
    {
        $table = $this->table('people');
        $table->drop();
    }
}
