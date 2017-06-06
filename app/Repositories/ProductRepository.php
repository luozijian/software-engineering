<?php

namespace App\Repositories;

use App\Models\Channel;
use App\Models\Product;
use InfyOm\Generator\Common\BaseRepository;

class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'type',
        'supplier',
        'plan',
        'year',
        'year_period_count',
        'year_period'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product::class;
    }

    public function create(array $attribute)
    {
        \DB::beginTransaction();

        $product = $this->model->create($attribute);

        $channels = Channel::all();

        $attribute['product_id'] = $product->id;
        foreach ($channels as $key => $channel){

            $channel->channelProducts()->create($attribute);
        }

        \DB::commit();
    }
}
