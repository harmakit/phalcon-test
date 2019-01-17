<?php


use Phinx\Migration\AbstractMigration;

class RegionTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('region', ['id' => false, 'primary_key' => 'id']);
        $table
            ->addColumn('id', 'biginteger', ['identity' => true])
            ->addColumn('parent_id', 'biginteger')
            ->addColumn('name', 'char', ['limit' => 20])
            ->create();

        $table
            ->addForeignKey('parent_id', 'region')
            ->save();
    }

    public function down()
    {
        $table = $this->table('region');
        $table->drop();
    }
}
