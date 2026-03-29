<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key, or return default.
     * Use static cache to avoid repeated DB hits within the same request.
     */
    protected static $cache = [];

    /**
     * Load all settings into cache in a single query.
     */
    public static function loadAll()
    {
        if (empty(self::$cache)) {
            self::$cache = self::pluck('value', 'key')->toArray();
        }
    }

    public static function get($key, $default = null)
    {
        if (array_key_exists($key, self::$cache)) {
            return self::$cache[$key];
        }

        $setting = self::where('key', $key)->first();
        self::$cache[$key] = $setting ? $setting->value : $default;

        return self::$cache[$key];
    }

    /**
     * Set a setting value by key.
     */
    public static function set($key, $value)
    {
        $setting = self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
        
        self::$cache[$key] = $value;
        
        return $setting;
    }
}
