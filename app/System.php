<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'system';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Return the value of the property
     *
     * @param $key string
     * @return mixed
     */
    public static function getProperty($key)
    {
        $cacheKey = 'system_property_' . $key;

        return cache()->remember($cacheKey, 86400 * 180, function () use ($key) { // Cache for 6 months
            $row = System::where('key', $key)
                    ->first();

            if (isset($row->value)) {
                return $row->value;
            } else {
                return null;
            }
        });
    }

    /**
     * Return the value of the multiple properties
     *
     * @param $keys array
     * @return array
     */
    public static function getProperties($keys, $pluck = false)
    {
        // Use cache to prevent N+1 queries
        $cacheKey = 'system_properties_' . md5(serialize($keys)) . '_' . ($pluck ? 'pluck' : 'array');

        return cache()->remember($cacheKey, 86400 * 180, function () use ($keys, $pluck) { // Cache for 6 months
            if ($pluck == true) {
                return System::whereIn('key', $keys)
                    ->pluck('value', 'key');
            } else {
                return System::whereIn('key', $keys)
                    ->get()
                    ->toArray();
            }
        });
    }

    /**
     * Return the system default currency details
     *
     * @param void
     * @return object
     */
    public static function getCurrency()
    {
        // Return static TND currency (ID 142) to reduce database load
        return Currency::getTndCurrency();
    }

    /**
     * Set the property
     *
     * @param $key
     * @param $value
     * @return void
     */
    public static function setProperty($key, $value)
    {
        System::where('key', $key)
            ->update(['value' => $value]);

        // Clear related cache entries
        self::clearSystemCache();
    }

    /**
     * Remove the specified property
     *
     * @param $key
     * @return void
     */
    public static function removeProperty($key)
    {
        System::where('key', $key)
            ->delete();

        // Clear related cache entries
        self::clearSystemCache();
    }

    /**
     * Add a new property, if exist update the value
     *
     * @param $key
     * @param $value
     * @return void
     */
    public static function addProperty($key, $value)
    {
        System::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        // Clear related cache entries
        self::clearSystemCache();
    }

    /**
     * Clear all system properties cache
     *
     * @return void
     */
    private static function clearSystemCache()
    {
        // Since these values are updated rarely, we can be more aggressive with cache clearing
        // Clear all cache entries related to system properties
        $cache = cache();

        try {
            // Try to use cache tags if supported
            $cache->tags(['system_properties'])->flush();
        } catch (\Exception $e) {
            // If tags are not supported, clear common cache patterns
            // Clear all system property caches by getting all system keys
            $allKeys = System::pluck('key')->toArray();

            // Clear individual property caches
            foreach ($allKeys as $key) {
                $cache->forget('system_property_' . $key);
            }

            // Clear common multi-property caches
            $commonKeysets = [
                ['additional_js', 'additional_css'],
                ['superadmin_enable_register_tc', 'superadmin_register_tc'],
                ['enable_welcome_email', 'welcome_email_subject', 'welcome_email_body']
            ];

            foreach ($commonKeysets as $keyset) {
                $cache->forget('system_properties_' . md5(serialize($keyset)) . '_pluck');
                $cache->forget('system_properties_' . md5(serialize($keyset)) . '_array');
            }
        }
    }
}
