<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 15:42:20 +0000.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Include
 * 
 * @property int $id
 * @property string $page
 * @property string $file
 * @property string $title
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Inclusion extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table='includes';

	protected $fillable = [
		'page',
		'file',
		'title'
	];
}
