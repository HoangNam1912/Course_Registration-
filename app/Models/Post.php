<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   // Quan hệ
   public function user()
   {
       return $this->belongsTo(User::class);
   }

   // Mutator / Cast
   protected $casts = [
       'is_published' => 'boolean',
   ];

   // Serialization
   protected $hidden = [
       'secret_field',
   ];
}
