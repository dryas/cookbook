<h1>Recipes</h1>
<?= $this->Html->link('Add Recipe', ['action' => 'add']) ?>
<table>
    <tr>
        <th>Title</th>
        <th>Created</th>
        <th>Action</th>
    </tr>

    <?php foreach ($recipes as $recipe): ?>
    <tr>
        <td>
            <?= $this->Html->link($recipe->title, ['action' => 'view', $recipe->slug]) ?>
        </td>
        <td>
            <?= $recipe->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Html->link('Edit', ['action' => 'edit', $recipe->slug]) ?>
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $recipe->slug],
                ['confirm' => 'Are you sure?'])
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>