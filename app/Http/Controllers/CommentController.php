<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::all();
        return response()->json($query);
    }
      public function store(Request $request, $id)
      {
           $validated = $request->validate([
               'content' => 'required|string',
               'user_id' => 'required|integer',
               'product_id' => 'required|integer',
           ]);

           $comment = Comment::create([$validated]);

           response()->json($comment);
      }

      public function destroy($id)
      {
          $comment = Comment::find($id);
          if (!$comment) {
              return response()->json(['message' => 'Product not found'], 404);
          }
          $comment->delete();

          return response()->json(['message' => 'Product deleted']);
      }
}

