<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeCategoryController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\TagController;
use Illuminate\Routing\Router;

$router = app(Router::class);

$router->post("/login", [AuthenticationController::class, "login"]);
$router->post("/register", [AuthenticationController::class, "register"]);

$router->middleware("auth:sanctum")->group(function (Router $router): void {
    $router->post("/photos", [PhotoController::class, "create"]);
    $router->get("/users/me/photos", [PhotoController::class, "index"]);
    $router->delete("/photos/{photo}", [PhotoController::class, "delete"])
        ->middleware("can:haveAccess,photo");

    $router->get("/profiles/me", [ProfileController::class, "showMe"]);
    $router->put("/profiles/me", [ProfileController::class, "update"]);

    $router->put("/users/me/change-password", [AccountController::class, "changePassword"]);
    $router->delete("/users/me", [AccountController::class, "delete"]);

    $router->post("/users/{user}/follows", [FollowController::class, "create"]);
    $router->delete("/users/{user}/follows", [FollowController::class, "delete"]);
    $router->get("/users/me/followers", [FollowController::class, "followersMeIndex"]);
    $router->get("/users/me/followings", [FollowController::class, "followingsMeIndex"]);

    $router->post("/recipes", [RecipeController::class, "create"]);
    $router->delete("/recipes/{recipe}", [RecipeController::class, "delete"])
        ->middleware("can:haveAccess,recipe");
});

$router->get("/components", [ComponentController::class, "index"]);
$router->get("/tags", [TagController::class, "index"]);
$router->get("/categories", [RecipeCategoryController::class, "index"]);

$router->get("/recipes/{recipe}", [RecipeController::class, "show"]);
$router->get("/recipes", [RecipeController::class, "index"]);


$router->get("/profiles/{profile}", [ProfileController::class, "show"]);
$router->get("/profiles", [ProfileController::class, "index"]);

$router->get("/users/{user}/followers", [FollowController::class, "followersIndex"]);
$router->get("/users/{user}/followings", [FollowController::class, "followingsIndex"]);
