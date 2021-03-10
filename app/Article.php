<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $primaryKey = 'idArticle';

	protected $fillable = ['owner', 'article', 'photo'];

	protected $dates = ['created_at', 'updated_at'];

	protected $casts = [
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	public function comments(){
        return $this->hasMany(Comment::class, 'idComment', 'idComment');
    }
}
