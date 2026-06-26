<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key.
     */
    public static function get(string $key, $default = null)
    {
        $setting = static::find($key);
        return $setting ? $setting->value : $default;
    }

    /**
     * Set a setting value.
     */
    public static function set(string $key, $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    /**
     * Check if registration is open.
     */
    public static function isRegistrationOpen(): bool
    {
        return static::get('registration_open', '1') === '1';
    }
}
