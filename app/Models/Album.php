<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 15:42:20 +0000.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

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
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Album extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

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
