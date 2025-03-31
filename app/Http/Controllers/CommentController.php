<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    /**
     * Display a listing of the comments.
     *
     * @param $id
     * @return JsonResponse
     */
    public function index($id)
    {
        $comments = Comment::where('product_id', $id)->get();
        return response()->json($comments);
    }


    /**
     * Store created comment in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
      public function store(Request $request)
      {
          $user = Auth::user();
           $validated = $request->validate([
               'content' => 'required|string',
               'product_id' => 'required|integer',
           ]);
          $validated['user_id'] = $user->id;

           $comment = Comment::create($validated);

           return response()->json($comment);
      }


    /**
     * Remove the specified comment from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
      public function destroy($id)
      {
          $comment = Comment::find($id);
          if (!$comment) {
              return response()->json(['message' => 'Comment not found'], 404);
          }
          $comment->delete();

          return response()->json(['message' => 'Comment deleted']);
      }
}

