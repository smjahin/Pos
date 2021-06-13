<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $fillable = [
      'title',
  ];

  public function product()
  {
    return $this->hasMany(Product::class);
  }

  public static function arrayForSelect()
  {
    $arr = [];
    $categories = Category::all();

    foreach ($categories as $category) {
      $arr[$category->id] = $category->title;
    }
    return $arr;
  }
}
