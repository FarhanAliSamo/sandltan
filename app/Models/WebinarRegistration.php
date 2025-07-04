<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebinarRegistration extends Model
{
    use HasFactory;


       public function questions()
    {
        return $this->hasMany(WebinarQuestion::class, 'webinar_registration_id');
    }
}
