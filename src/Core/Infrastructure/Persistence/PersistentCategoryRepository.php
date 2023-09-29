<?php

namespace Core\Infrastructure\Persistence;

use Core\Application\Repositories\CategoryRepository;
use Core\Domain\Entities\Category;

class PersistentCategoryRepository implements CategoryRepository
{

    public function createCategory(Category $category): ?Category
    {
        // TODO: Implement createCategory() method.
        return null;

    }

    public function getCategoryById(int $category_id): ?Category
    {
        // TODO: Implement getCategoryById() method.
        return null;

    }

    public function updateCategory(Category $category): ?Category
    {
        // TODO: Implement updateCategory() method.
        return null;

    }

    public function deleteCategoryById(int $category_id)
    {
        // TODO: Implement deleteCategoryById() method.
        return null;

    }
}