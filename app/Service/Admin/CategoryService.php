<?php

namespace App\Service\Admin;

use App\Models\Category;

class CategoryService
{
    public function store($data)
    {
        return Category::create([
            'category_name' => $data['category_name'],
            'slug' => strtolower(str_replace(' ', '-', $data['category_name']))
        ]);
    }

    public function update($category_id ,$data)
    {

        return Category::findOrFail($category_id)->update([
            'category_name' => $data['category_name'],
            'slug' => strtolower(str_replace(' ', '-', 'category_name'))
        ]);
    }
}
