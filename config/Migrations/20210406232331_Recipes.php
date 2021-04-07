<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class Recipes extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('recipes');
        $table
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('slug', 'string', [
                'default' => null,
                'limit' => 191,
                'null' => false
            ])
            ->addColumn('created', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true
            ])
            ->addIndex('title', array('unique' => true))
            ->addForeignKey('user_id', 'users', 'id')
            ->create();
        $table->changeColumn('id', 'integer', ['signed' => true, 'identity' => true])->update();
    }

    public function down()
    {
        $this->table('recipes')->drop()->save();
    }
}
