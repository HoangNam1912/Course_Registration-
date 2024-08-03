<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;

class Course extends Model
{

    
    use HasFactory;

    /**
     * Các thuộc tính có thể gán (mass assignable).
     *
     * @var array
     */
    protected $fillable = [
        'course_name',
        'course_code',
    ];

    /**
     * Các thuộc tính được ẩn đi khi xuất ra JSON.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Các kiểu dữ liệu của các thuộc tính.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user');
    }
    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
}
