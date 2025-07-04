<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebinarQuestion extends Model
{
    use HasFactory;
       public function registration()
    {
        return $this->belongsTo(WebinarRegistration::class, 'webinar_registration_id');
    }
}
