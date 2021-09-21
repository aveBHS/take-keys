<?php

namespace Site\Models;

/**
 * @property string phone
 * @property string email
 * @property float lat
 * @property float lng
 * @property int price
 * @property string address
 * @property int object_type
 * @property int distance
 */
class Request extends Model
{
    protected $fields = [
        'email', 'phone', 'object_type', 'price', 'distance', 'address',
        'lat', 'lng', 'min_send_time', 'max_send_time'
    ];
}