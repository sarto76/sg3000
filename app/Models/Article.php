<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

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
 * @property bool $active
 *
 * @package App\Models
 */
class Article extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'author' => 'int',
		'active' => 'bool'
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
