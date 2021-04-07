<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Recipe;
use Authorization\IdentityInterface;

/**
 * Recipe policy
 */
class RecipePolicy
{
    /**
     * Check if $user can add Recipe
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Recipe $recipe
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Recipe $recipe)
    {
        // All logged in users can create articles.
        return true;
    }

    /**
     * Check if $user can edit Recipe
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Recipe $recipe
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Recipe $recipe)
    {
        // logged in users can edit their own articles.
        return $this->isAuthor($user, $recipe);
    }

    /**
     * Check if $user can delete Recipe
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Recipe $recipe
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Recipe $recipe)
    {
        // logged in users can delete their own articles.
        return $this->isAuthor($user, $recipe);
    }

    /**
     * Check if $user can view Recipe
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Recipe $recipe
     * @return bool
     */
    public function canView(IdentityInterface $user, Recipe $recipe)
    {
    }

    protected function isAuthor(IdentityInterface $user, Recipe $recipe)
    {
        return $recipe->user_id === $user->getIdentifier();
    }
}
