<?php

namespace App\Http\Controllers\Recipe;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Http\Resources\Recipe\ShortVersion\ShortRecipeCollection;
use App\Http\Resources\Recipe\RecipeResource;
use App\Models\Recipe;
use App\Models\User;
use App\Services\Basic\Contracts\BasicDeleter;
use App\Services\Recipe\Contracts\RecipeCreator;
use App\Services\Recipe\Contracts\RecipeGetter;
use App\Services\Recipe\Contracts\RecipeUpdater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class RecipeController extends Controller
{

    public function show(Recipe $recipe, Request $request): JsonResource
    {
        return new RecipeResource($recipe, $request->user());
    }

    public function create(RecipeRequest $request, RecipeCreator $creator): JsonResponse
    {
        $creator->create($request->user(), $request->validated());

        return response()->json([
            "message" => __("resources.created"),
        ], Response::HTTP_OK);
    }

    public function update(Recipe $recipe, UpdateRecipeRequest $request, RecipeUpdater $updater): JsonResponse
    {
        $recipe = $updater->update($recipe, $request->validated());

        return response()->json([
            "message" => __("resources.updated"),
            "data" => new RecipeResource($recipe),
        ], Response::HTTP_OK);
    }

    public function searchIndex(Request $request, RecipeGetter $getter): ResourceCollection
    {
        $recipesWithPagination = $getter->getPaginatedBySearchOptions(
            $request->query("title"), $request->query("category"), $request->query("tag"),
            $request->query("component"), $request->query("per-page"));

        return new ShortRecipeCollection($recipesWithPagination);
    }

    public function userIndex(User $user, Request $request, RecipeGetter $getter): ResourceCollection
    {
        $recipesWithPagination = $getter->getPaginatedByUser($user, $request->query("per-page"));

        return new ShortRecipeCollection($recipesWithPagination);
    }

    public function meIndex(Request $request, RecipeGetter $getter): ResourceCollection
    {
        $recipesWithPagination = $getter->getPaginatedByUser($request->user(), $request->query("per-page"));

        return new ShortRecipeCollection($recipesWithPagination);
    }


    public function delete(Recipe $recipe, BasicDeleter $deleter): JsonResponse
    {
        $deleter->delete($recipe);

        return response()->json([
            "message" => __("resources.deleted"),
        ], Response::HTTP_OK);
    }


}