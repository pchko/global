<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentRequest $request)
    {
        //
        $fields = $request->validated();

        $newComment = Comment::create($fields);

        $comment = Comment::with(['article'])->find($newComment->idComment);

        return [
            'code' => 1,
            'message' => 'success',
            'comment' => $comment
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($idComment = NULL)
    {
        //
        $comments = is_null($idComment) ? Comment::with(['article'])->get() : Comment::with(['article'])->find($idComment);

         return [
            'code' => 1,
            'message' => 'success',
            'comments' => $comments
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request,$idComment)
    {
        //
        $fields = $request->validated();

        $comment = Comment::find($idComment);

        if(is_null($comment)) return ['code' => 0, 'message' => 'Not found Comment'];

        $comment->update($fields);

         return [
            'code' => 1,
            'message' => 'success',
            'comment' => $comment
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($idComment)
    {
        //
        $comment =  Comment::find($idComment);

         return [
            'code' => !is_null($comment) ? 1 : 0,
            'message' => is_null($comment) ? false : $comment->delete(),
        ];
    }
}
