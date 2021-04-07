<h1>Edit Recipe</h1>
<?php
    echo $this->Form->create($recipe);
    echo $this->Form->control('title');
    echo $this->Form->control('tag_string', ['type' => 'text']);
    echo $this->Form->control('ingridients', ['rows' => '5']);
    echo $this->Form->control('preparations', ['rows' => '10']);
    echo $this->Form->button(__('Save Recipe'));
    echo $this->Form->end();
?>