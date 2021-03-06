<?php
namespace App\Controller;

use App\Controller\AppController;

class RecipesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
    }

    public function index()
    {
        $this->Authorization->skipAuthorization();

        $recipes = $this->Paginator->paginate($this->Recipes->find());
        $this->set(compact('recipes'));
    }

    public function view($slug = null)
    {
        $this->Authorization->skipAuthorization();

        $recipe = $this->Recipes
            ->findBySlug($slug)
            ->contain('Tags')
            ->firstOrFail();
        $this->set(compact('recipe'));
    }

    public function add()
    {
        $recipe = $this->Recipes->newEmptyEntity();
        $this->Authorization->authorize($recipe);

        if ($this->request->is('post')) {
            $recipe = $this->Recipes->patchEntity($recipe, $this->request->getData());

            $recipe->user_id = $this->request->getAttribute('identity')->getIdentifier();

            if ($this->Recipes->save($recipe)) {
                $this->Flash->success(__('Your recipe has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your recipe.'));
        }
        $tags = $this->Recipes->Tags->find('list')->all();
        $this->set(compact('recipe', 'tags'));
    }

    public function edit($slug)
    {
        $recipe = $this->Recipes
            ->findBySlug($slug)
            ->contain('Tags') // load associated Tags
            ->firstOrFail();
        $this->Authorization->authorize($recipe);

        if ($this->request->is(['post', 'put'])) {
            $this->Recipes->patchEntity($recipe, $this->request->getData(), [
                // Added: Disable modification of user_id.
                'accessibleFields' => ['user_id' => false]
            ]);
            if ($this->Recipes->save($recipe)) {
                $this->Flash->success(__('Your recipe has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your recipe.'));
        }
        $tags = $this->Recipes->Tags->find('list')->all();
        $this->set(compact('recipe', 'tags'));
    }

    public function delete($slug)
    {
        $this->request->allowMethod(['post', 'delete']);

        $recipe = $this->Recipes->findBySlug($slug)->firstOrFail();
        $this->Authorization->authorize($recipe);
        if ($this->Recipes->delete($recipe)) {
            $this->Flash->success(__('The {0} recipe has been deleted.', $recipe->title));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function tags()
    {
        $this->Authorization->skipAuthorization();

        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $tags = $this->request->getParam('pass');

        // Use the RecipesTable to find tagged articles.
        $recipes = $this->Recipes->find('tagged', [
                'tags' => $tags
            ])
            ->all();

        // Pass variables into the view template context.
        $this->set([
            'recipes' => $recipes,
            'tags' => $tags
        ]);
    }
}