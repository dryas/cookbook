<h1>Add Recipe</h1>
<?php
    echo $this->Form->create($recipe);
    // Hard code the user for now.
    echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
    echo $this->Form->control('title');
    echo $this->Form->control('tag_string', ['type' => 'text']);
    echo $this->Form->control('ingridients', ['rows' => '5']);
    echo $this->Form->control('preparations', ['rows' => '10']);
    echo $this->Form->button(__('Save Recipe'));
    echo $this->Form->end();
?>