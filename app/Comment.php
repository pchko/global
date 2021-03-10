<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

	protected $primaryKey = 'idComment';

	protected $fillable = ['owner', 'comment', 'idArticle'];

	protected $dates = ['created_at', 'updated_at'];

	protected $casts = [
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

    public function article(){
        return $this->belongsTo(Article::class, 'idArticle', 'idArticle');
    }
}
