<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Album
 * 
 * @property int $id
 * @property int $vis
 * @property string $loc
 * @property int $begd
 * @property int $endd
 * @property string $title
 * @property string $dir
 *
 * @package App\Models
 */
class Album extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'vis' => 'int',
		'begd' => 'int',
		'endd' => 'int'
	];

	protected $fillable = [
		'vis',
		'loc',
		'begd',
		'endd',
		'title',
		'dir'
	];
}
