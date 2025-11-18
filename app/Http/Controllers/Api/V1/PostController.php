<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
// use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = PostResource::collection(
                Post::with('author')->paginate()
            );
            return response()->json(
                [
                    "message" => "Posts list",
                    "data" => $posts
                ]
            );
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao listar posts',
                'erro' => $th
            ], 500);
        }
    }


    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['author_id'] = 1;
        $post = Post::create($data);

        return response()->json(
            [
                "message" => "Post created sucessfully!",
                "data" => new PostResource($post)
            ],
            201
        );
    }

    public function show(Post $post)
    {
        try {
            return response()->json(
                [
                    "message" => "Post",
                    "data" => new PostResource($post)
                ]
            );
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao mostrar post',
                'erro' => $th
            ], 500);
        }
    }

    public function update(StorePostRequest $request, Post $post)
    {

        try {
            $data = $request->validated();
            $post->update($data);
            return new PostResource($post);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao atualizar post',
                'erro' => $th
            ], 500);
        }
    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return response()->noContent();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao eliminar post',
                'erro' => $th
            ], 500);
        }
    }
}
