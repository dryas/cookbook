<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class RecipesTags extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('recipes_tags');
        $table
            ->addColumn('recipe_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('tag_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false
            ])
            ->addIndex(['recipe_id', 'tag_id'])
            ->addForeignKey('tag_id', 'tags', 'id')
            ->addForeignKey('recipe_id', 'recipes', 'id')
            ->create();
        $table->changeColumn('id', 'integer', ['signed' => true, 'identity' => true])->update();
    }

    public function down()
    {
        $this->table('recipes_tags')->drop()->save();
    }
}
