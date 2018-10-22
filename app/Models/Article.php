<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 15:42:20 +0000.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 * 
 * @property int $id
 * @property int $author
 * @property string $text
 * @property string $title
 * @property string $caption
 * @property string $url
 * @property string $image
 * @property int $active
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Article extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'author' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'author',
		'text',
		'title',
		'caption',
		'url',
		'image',
		'active'
	];
}
