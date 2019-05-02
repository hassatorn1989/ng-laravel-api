<?php

namespace App\Http\Controllers;
use App\Comment;
use Illuminate\Http\Request;
class CommentController extends Controller
{
    public function create(Request $request) {
      $request->validate(array(
        'comment_text' => 'required',
      ));
      $q = new Comment;
      $q->comment_text = $request->comment_text;
      $q->post_id = $request->post_id;
      $q->save();
        return response()->json(Comment::select('id','comment_text')->latest()->first());
    }
    public function update(Request $request , $id) {
      $request->validate(array(
        'comment_text' => 'required',
      ));
      $q = Comment::find($id);
      $q->comment_text = $request->comment_text;
      $q->save();
      return response()->json($q);
    }
    public function delete($id) {
        $comment = Comment::where('id',$id)->delete();
        return response()->json($comment);
    }
}
