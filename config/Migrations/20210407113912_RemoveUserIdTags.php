<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class RemoveUserIdTags extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('tags');
        $table->removeColumn('user_id')
              ->save();
    }

    public function down()
    {
        $table = $this->table('tags');
        $table
            ->addColumn('user_id', 'integer', [
                'default' => 1,
                'limit' => 11,
                'after' => 'id',
                'null' => false
            ])
            ->save();
    }

}
