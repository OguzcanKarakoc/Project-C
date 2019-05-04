<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'quantity',
        'supplier_id',
        'product_status_id',
    ];

    public static function search($product_name)
    {
        return self::where('title', 'like', '%' . $product_name . '%')->paginate(15);
    }

    public static function searchFilter($array, $tableName, $columnName, $builder = null)
    {


        if (is_null($builder)) {
            $builder = self::query();
        }


        if ($columnName == 'price') {
            is_null($array['min']) ? $array['min'] = 0 : false;
            is_null($array['max']) ? $array['max'] = 9000 : false;
            $priceCheck = ($array['min'] < $array['max'] ? true : false);
            if ($priceCheck) {
                $builder->where($columnName, '<', $array['max']);
                $builder->where($columnName, '>', $array['min']);
            }
            return $builder;
        }
        foreach ($array as $item => $value) {
            $builder->whereHas($tableName, function ($query) use ($value, $columnName) {
                if (is_object($value)) {
                    return $query->where($columnName, $value->id);
                }
                return $query->where($columnName, $value);
            });
        }
//        dd($array, $builder->toSql());

        return $builder;
    }

    // region: many to one
    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function productStatus()
    {
        return $this->belongsTo('App\ProductStatus');
    }
    // endregion:

    // region: many to many
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_products', 'product_id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tag_products', 'product_id', 'tag_id');
    }

    public function favorites()
    {
        return $this->belongsToMany('App\User', 'favorites', 'product_id', 'user_id');
    }
    // endregion:

    // region: one to many
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function productImages()
    {
        return $this->hasMany('App\ProductImage');
    }

    public function specifications()
    {
        return $this->hasMany('App\Specification');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }

    public function productForms()
    {
        return $this->hasMany('App\ProductForm');
    }
    // endregion:
}
