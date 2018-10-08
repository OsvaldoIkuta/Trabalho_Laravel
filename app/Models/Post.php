<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title', 'user_id', 'category_id', 'image','description', 'date', 'hour', 'featured', 'status'
    ];

    public function rules($id = '')
    {
        return [
            'title'          => 'required|min:3|max:100',
            'user_id'        => '',
            'category_id'    => 'required',
            'image'          => 'image',
            'description'    => 'required|min:100',
            'date'    => 'required|date:Y-m-d',
            'hour'    => 'required',
            'featured'    => 'required|min:1|max:1',
            'status'    => 'required|min:1|max:1'
        ];
    }
}
