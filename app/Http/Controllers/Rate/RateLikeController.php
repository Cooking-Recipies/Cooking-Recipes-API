<?php

namespace App\Http\Controllers\Rate;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use App\Services\Like\Contracts\LikeCreator;
use App\Services\Like\Contracts\LikeDeleter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RateLikeController extends Controller
{
    public function create(Rate $rate, Request $request, LikeCreator $creator): JsonResponse
    {
        $creator->create($rate, $request->user());

        return response()->json([
            "message" => __("resources.created"),
        ], Response::HTTP_OK);
    }

    public function delete(Rate $rate, Request $request, LikeDeleter $deleter): JsonResponse
    {
        $deleter->delete($rate, $request->user());

        return response()->json([
            "message" => __("resources.deleted"),
        ], Response::HTTP_OK);
    }
}