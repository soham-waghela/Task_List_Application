<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'long_description'];

    // public function toggleComplete()
    // {
    //     $this->completed =!$this->completed;
    //     $this->save();
    // }

    public function toggleComplete()
    {
        $this->completed = !$this->completed;
        $this->save();
    }
    
}
