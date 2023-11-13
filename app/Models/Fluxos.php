<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fluxos extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'value'];

    public function rules(){
        return [
            'title' => 'required',
            'description' => 'required',
            'value' => 'required'
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo: attribute é obrigatorio'
        ];

    }
}
