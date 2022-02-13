<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FourtuneEvents extends Model{
    protected $table = 'fourtune_events';
    protected $fillable = ['event_name', 'event_date','event_description','price','event_featured_image','event_location','created_at'];
}
