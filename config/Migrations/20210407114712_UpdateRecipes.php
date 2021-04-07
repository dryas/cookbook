<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class UpdateRecipes extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('recipes');
        $table
            ->addColumn('ingridients', 'text', [
                'default' => null,
                'after' => 'slug',
                'null' => false
            ])
            ->addColumn('preparations', 'text', [
                'default' => null,
                'after' => 'ingridients',
                'null' => false
            ])
            ->addColumn('source', 'string', [
                'default' => null,
                'after' => 'preparations',
                'limit' => 255,
                'null' => true
            ])
            ->save();
    }

    public function down()
    {
        $table = $this->table('recipes');
	$table
	    ->removeColumn('ingridients')
	    ->removeColumn('preparation')
	    ->removeColumn('source')
	    ->save();
    }
}
