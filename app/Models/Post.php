<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    const IS_DRAFT = 0;
    const IS_PUBLIC = 1;
    const IS_STANDART = 0;
    const IS_FEATURED = 1;

    protected $fillable = ['title', 'content'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function author()
    {
        return $this->hasOne(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'posts_tags',
            'post_id',
            'tag_id'
        );
    }

    public static function add($fields)
    {
        $obj = new static;
        $obj->fill($fields);
        $obj->user_id = 1;
        $obj->save();

        return $obj;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove()
    {
        $this->deleteImageIfExists();
        $this->delete();
    }

    public function uploadImage($image)
    {
        if ($image === null) { return; }

        $filename = str_random(10) . '.' . $image->extends;
        
        $image->saveAS('uploads', $filename);
        
        $this->deleteImageIfExists();
        $this->image = $filename;
        $this->save();

    }

    public function getImage()
    {
        return ($this->image) ? "/uploads/$this->image" : "https://fakeimg.pl/200x100/CCCCCC/?text=No%20image";
    }

    public function deleteImageIfExists()
    {           
        if ($this->image !== null) {
            Storage::delete('uploads/' . $this->image);
        }
    }

    public function setCategory($category_id)
    {
        if ($category_id === null) { return; }

        $this->category_id = $category_id;
        $this->save();
    }

    public function setTags($tags_list)
    {
        if ($tags_list === null) { return; }

        $this->tags()->sync($tags_list);
    }

    public function setDraft()
    {
        $this->status = Post::IS_DRAFT;
        $this->save();
    }

    public function setPublic()
    {
        $this->status = Post::IS_PUBLIC;
        $this->save();
    }

    public function toggleStatus($value)
    {
        if ($value === null) {
            return $this->setDraft();
        }

        return $this->setPublic();
    }

    public function setFeatured()
    {
        $this->is_featured = Post::IS_FEATURED;
        $this->save();
    }

    public function setStandart()
    {
        $this->is_featured = Post::IS_STANDART;
        $this->save();
    }

    public function toggleFeatured($value)
    {
        if ($value === null) {
            return $this->setStandart();
        }

        return $this->setFeatured();
    }
}
