<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class Tags extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('tags');
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
            ->create();
        $table->changeColumn('id', 'integer', ['signed' => true, 'identity' => true])->update();
    }

    public function down()
    {
        $this->table('tags')->drop()->save();
    }
}
