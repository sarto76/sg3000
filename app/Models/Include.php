<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Include
 * 
 * @property int $id
 * @property string $page
 * @property string $file
 * @property string $title
 *
 * @package App\Models
 */
class Include extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'page',
		'file',
		'title'
	];
}
