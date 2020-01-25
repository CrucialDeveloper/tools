<?php

namespace App\Http\Controllers;

use App\Client;
use App\Comment;
use App\Project;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Client $client, Project $project)
    {

        $comment = new Comment([
            'user_id' => auth()->user()->id,
            'body' => $request->body
        ]);

        $project->comments()->save($comment);
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'body' => $request->body
        ]);
    }

    public function destroy(Request $request, Comment $comment)
    {
        $comment->delete();
    }
}
