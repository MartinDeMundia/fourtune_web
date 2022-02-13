<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FourtuneImages extends Model{
    protected $table = 'fourtune_images';
    protected $fillable = ['image_path', 'parent_id','image_type','created_at'];
}
