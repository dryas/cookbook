<h1><?= h($recipe->title) ?></h1>
<p><b>Tags:</b> <?= h($recipe->tag_string) ?></p>
<p><?= h($recipe->ingridients) ?></p>
<p><?= h($recipe->preparations) ?></p>
<p><small>Created: <?= $recipe->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $recipe->slug]) ?></p>