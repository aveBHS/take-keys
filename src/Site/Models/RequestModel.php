<?php

namespace Site\Models;

/**
 * @property string phone
 * @property string email
 * @property float lat
 * @property float lng
 * @property int price_min
 * @property int price_max
 * @property string address
 * @property int object_type
 * @property int distance
 * @property int purchased
 */
class RequestModel extends Model
{
    protected $fields = [
        'email', 'phone', 'object_type', 'price_min', 'price_max',
        'distance', 'address', 'lat', 'lng', 'purchased',
        'is_free', 'recommendations', 'favorites', 'status'
    ];
}