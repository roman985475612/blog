<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;
use Exception;

class Post extends Model
{
    use HasFactory, Sluggable;

    const IS_DRAFT = 0;
    const IS_PUBLIC = 1;
    const IS_STANDART = 0;
    const IS_FEATURED = 1;

    protected $fillable = ['title', 'content', 'date'];

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
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
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
        $this->removeImage();
        $this->delete();
    }

    public function uploadImage($image)
    {
        if (is_null($image)) { return; }
        
        $filename = $this->generateFilename($image);
        
        $image->storeAs('uploads', $filename);
        
        $this->removeImage();
        $this->image = $filename;
        $this->save();

    }

    public function generateFilename($image)
    {
        return md5_file($image) . '.' . $image->extension();
    }

    public function getImage()
    {
        $filename = (is_null($this->image)) ? 'no-image.png' : $this->image;

        return '/uploads/' . $filename;
    }

    public function removeImage()
    {           
        if (!is_null($this->image)) {
            Storage::delete('uploads/' . $this->image);
        }
    }

    public function getCategoryTitle()
    {
        return ( $this->category !== null ) ? $this->category->title : null;
    }

    public function getTagsTitle()
    {
        return $this->tags->pluck('title')->all();
    }

    public function setCategory($category_id)
    {
        if (is_null($category_id)) return;

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

    public function setDateAttribute($value)
    {
        $date = Carbon::createFromFormat('d/m/y', $value)->format('Y-m-d');

        $this->attributes['date'] = $date;
    }
}
