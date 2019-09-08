<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Post
 *
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post query()
 * @mixin \Eloquent
 */
class Post extends Model
{
	protected $fillable = ['user_id', 'title', 'body', 'cover_image'];

	// Overriding delete method
	public function delete()
	{
		\Illuminate\Support\Facades\Storage::delete('public/'.$this->cover_image);
	    parent::delete();
	}

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'title';
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
