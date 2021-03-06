<?php

namespace App\Services\Recipe\Helpers;

use App\Models\ComponentOnRecipe;
use App\Models\PhotoOnRecipe;
use App\Models\TagOnRecipe;

class RecipePropertiesAdder
{
    private TagHelper $tagHelper;
    private ComponentHelper $componentHelper;

    public function __construct(TagHelper $tagHelper, ComponentHelper $componentHelper)
    {
        $this->tagHelper = $tagHelper;
        $this->componentHelper = $componentHelper;
    }

    public function addTags(array $tags, int $recipeId): void
    {
        foreach ($tags as $tag){
            $tagId = $this->tagHelper->getOrCreateTag($tag)->id;
            TagOnRecipe::query()->create([
                "tag_id" => $tagId,
                "recipe_id" => $recipeId,
            ]);
        }
    }

    public function addComponents(array $components, int $recipeId): void
    {
        foreach ($components as $component){
            $componentId = $this->componentHelper->getOrCreateComponent($component["name"])->id;
            ComponentOnRecipe::query()->create([
                "component_id" => $componentId,
                "recipe_id" => $recipeId,
                "quantity" => $component["quantity"],
            ]);
        }
    }

    public function addPhotos(array $photos, int $recipeId)
    {
        foreach ($photos as $photo){
            PhotoOnRecipe::query()->create([
                "photo_id" => $photo,
                "recipe_id" => $recipeId,
            ]);
        }
    }
}