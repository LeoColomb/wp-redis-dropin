<?php

if (
    (! defined('WP_REDIS_DISABLED') || ! WP_REDIS_DISABLED)
    && class_exists('WP_Redis_Object_Cache')
) :

    /**
     * Object Cache API
     *
     * @link https://codex.wordpress.org/Class_Reference/WP_Object_Cache
     *
     * @package    WordPress
     * @subpackage Cache
     */

    /**
     * Adds data to the cache, if the cache key doesn't already exist.
     *
     * @since 2.0.0
     *
     * @see    WP_Object_Cache::add()
     * @global WP_Object_Cache $wp_object_cache Object cache global instance.
     *
     * @param  int|string $key    The cache key to use for retrieval later.
     * @param  mixed      $data   The data to add to the cache.
     * @param  string     $group  Optional. The group to add the cache to. Enables the same key
     *                            to be used across groups. Default empty.
     * @param  int        $expire Optional. When the cache data should expire, in seconds.
     *                            Default 0 (no expiration).
     * @return bool False if cache key and group already exist, true on success.
     */
    function wp_cache_add($key, $data, $group = '', $expire = 0)
    {
        global $wp_object_cache;

        return $wp_object_cache->add($key, $data, $group, (int) $expire);
    }

    /**
     * Closes the cache.
     *
     * This function has ceased to do anything since WordPress 2.5. The
     * functionality was removed along with the rest of the persistent cache.
     *
     * This does not mean that plugins can't implement this function when they need
     * to make sure that the cache is cleaned up after WordPress no longer needs it.
     *
     * @since 2.0.0
     *
     * @return true Always returns true.
     */
    function wp_cache_close()
    {
        return true;
    }

    /**
     * Decrements numeric cache item's value.
     *
     * @since 3.3.0
     *
     * @see    WP_Object_Cache::decr()
     * @global WP_Object_Cache $wp_object_cache Object cache global instance.
     *
     * @param  int|string $key    The cache key to decrement.
     * @param  int        $offset Optional. The amount by which to decrement the item's value. Default 1.
     * @param  string     $group  Optional. The group the key is in. Default empty.
     * @return false|int False on failure, the item's new value on success.
     */
    function wp_cache_decr($key, $offset = 1, $group = '')
    {
        global $wp_object_cache;

        return $wp_object_cache->decr($key, $offset, $group);
    }

    /**
     * Removes the cache contents matching key and group.
     *
     * @since 2.0.0
     *
     * @see    WP_Object_Cache::delete()
     * @global WP_Object_Cache $wp_object_cache Object cache global instance.
     *
     * @param  int|string $key   What the contents in the cache are called.
     * @param  string     $group Optional. Where the cache contents are grouped. Default empty.
     * @return bool True on successful removal, false on failure.
     */
    function wp_cache_delete($key, $group = '')
    {
        global $wp_object_cache;

        return $wp_object_cache->delete($key, $group);
    }

    /**
     * Removes all cache items.
     *
     * @since 2.0.0
     *
     * @see    WP_Object_Cache::flush()
     * @global WP_Object_Cache $wp_object_cache Object cache global instance.
     *
     * @return bool False on failure, true on success
     */
    function wp_cache_flush()
    {
        global $wp_object_cache;

        return $wp_object_cache->flush();
    }

    /**
     * Retrieves the cache contents from the cache by key and group.
     *
     * @since 2.0.0
     *
     * @see    WP_Object_Cache::get()
     * @global WP_Object_Cache $wp_object_cache Object cache global instance.
     *
     * @param  int|string $key   The key under which the cache contents are stored.
     * @param  string     $group Optional. Where the cache contents are grouped. Default empty.
     * @param  bool       $force Optional. Whether to force an update of the local cache from the persistent
     *                           cache. Default false.
     * @param  bool       $found Optional. Whether the key was found in the cache (passed by reference).
     *                           Disambiguates a return of false, a storable value. Default null.
     * @return bool|mixed False on failure to retrieve contents or the cache
     *                    contents on success
     */
    function wp_cache_get($key, $group = '', $force = false, &$found = null)
    {
        global $wp_object_cache;

        return $wp_object_cache->get($key, $group, $force, $found);
    }

    /**
     * Retrieve multiple values from cache.
     *
     * Gets multiple values from cache, including across multiple groups
     *
     * Usage: array( 'group0' => array( 'key0', 'key1', 'key2', ), 'group1' => array( 'key0' ) )
     *
     * Mirrors the Memcached Object Cache plugin's argument and return-value formats
     *
     * @param array $groups Array of groups and keys to retrieve
     *
     * @global WP_Object_Cache $wp_object_cache
     *
     * @return bool|mixed           Array of cached values, keys in the format $group:$key. Non-existent keys false
     */
    function wp_cache_get_multi($groups)
    {
        global $wp_object_cache;

        return $wp_object_cache->get_multi($groups);
    }

    /**
     * Increment numeric cache item's value
     *
     * @since 3.3.0
     *
     * @see    WP_Object_Cache::incr()
     * @global WP_Object_Cache $wp_object_cache Object cache global instance.
     *
     * @param  int|string $key    The key for the cache contents that should be incremented.
     * @param  int        $offset Optional. The amount by which to increment the item's value. Default 1.
     * @param  string     $group  Optional. The group the key is in. Default empty.
     * @return false|int False on failure, the item's new value on success.
     */
    function wp_cache_incr($key, $offset = 1, $group = '')
    {
        global $wp_object_cache;

        return $wp_object_cache->incr($key, $offset, $group);
    }

    /**
     * Sets up Object Cache Global and assigns it.
     *
     * @since 2.0.0
     *
     * @global WP_Object_Cache $wp_object_cache
     *
     * @throws Exception
     */
    function wp_cache_init()
    {
        $GLOBALS['wp_object_cache'] = new WP_Redis_Object_Cache();
    }

    /**
     * Replaces the contents of the cache with new data.
     *
     * @since 2.0.0
     *
     * @see    WP_Object_Cache::replace()
     * @global WP_Object_Cache $wp_object_cache Object cache global instance.
     *
     * @param  int|string $key    The key for the cache data that should be replaced.
     * @param  mixed      $data   The new data to store in the cache.
     * @param  string     $group  Optional. The group for the cache data that should be replaced.
     *                            Default empty.
     * @param  int        $expire Optional. When to expire the cache contents, in seconds.
     *                            Default 0 (no expiration).
     * @return bool False if original value does not exist, true if contents were replaced
     */
    function wp_cache_replace($key, $data, $group = '', $expire = 0)
    {
        global $wp_object_cache;

        return $wp_object_cache->replace($key, $data, $group, (int) $expire);
    }

    /**
     * Saves the data to the cache.
     *
     * Differs from wp_cache_add() and wp_cache_replace() in that it will always write data.
     *
     * @since 2.0.0
     *
     * @see    WP_Object_Cache::set()
     * @global WP_Object_Cache $wp_object_cache Object cache global instance.
     *
     * @param  int|string $key    The cache key to use for retrieval later.
     * @param  mixed      $data   The contents to store in the cache.
     * @param  string     $group  Optional. Where to group the cache contents. Enables the same key
     *                            to be used across groups. Default empty.
     * @param  int        $expire Optional. When to expire the cache contents, in seconds.
     *                            Default 0 (no expiration).
     * @return bool False on failure, true on success
     */
    function wp_cache_set($key, $data, $group = '', $expire = 0)
    {
        global $wp_object_cache;

        return $wp_object_cache->set($key, $data, $group, (int) $expire);
    }

    /**
     * Switches the internal blog ID.
     *
     * This changes the blog id used to create keys in blog specific groups.
     *
     * @since 3.5.0
     *
     * @see    WP_Object_Cache::switch_to_blog()
     * @global WP_Object_Cache $wp_object_cache Object cache global instance.
     *
     * @param int $blog_id Site ID.
     */
    function wp_cache_switch_to_blog($blog_id)
    {
        global $wp_object_cache;

        $wp_object_cache->switch_to_blog($blog_id);
    }

    /**
     * Adds a group or set of groups to the list of global groups.
     *
     * @since 2.6.0
     *
     * @see    WP_Object_Cache::add_global_groups()
     * @global WP_Object_Cache $wp_object_cache Object cache global instance.
     *
     * @param string|array $groups A group or an array of groups to add.
     */
    function wp_cache_add_global_groups($groups)
    {
        global $wp_object_cache;

        $wp_object_cache->add_global_groups($groups);
    }

    /**
     * Adds a group or set of groups to the list of non-persistent groups.
     *
     * @since 2.6.0
     *
     * @param string|array $groups A group or an array of groups to add.
     */
    function wp_cache_add_non_persistent_groups($groups)
    {
        global $wp_object_cache;

        $wp_object_cache->add_non_persistent_groups($groups);
    }

    /**
     * Retrieve a value from the object cache. If it doesn't exist, run the $callback to generate and
     * cache the value.
     *
     * @param string   $key      The cache key.
     * @param callable $callback The callback used to generate and cache the value.
     * @param string   $group    Optional. The cache group. Default is empty.
     * @param int      $expire   Optional. The number of seconds before the cache entry should expire.
     *                           Default is 0 (as long as possible).
     *
     * @return mixed The value returned from $callback, pulled from the cache when available.
     */
    function wp_cache_remember($key, $callback, $group = '', $expire = 0)
    {
        global $wp_object_cache;

        return $wp_object_cache->remember($key, $callback, $group, (int) $expire);
    }

    /**
     * Retrieve and subsequently delete a value from the object cache.
     *
     * @param string $key     The cache key.
     * @param string $group   Optional. The cache group. Default is empty.
     * @param mixed  $default Optional. The default value to return if the given key doesn't
     *                        exist in the object cache. Default is null.
     *
     * @return mixed The cached value, when available, or $default.
     */
    function wp_cache_forget($key, $group = '', $default = null)
    {
        global $wp_object_cache;

        return $wp_object_cache->forget($key, $group, $default);
    }
endif;

if (defined('WP_CLI') && WP_CLI && class_exists('WP_Redis_CLI_Commands')) {
    \WP_CLI::add_command('redis', WP_Redis_CLI_Commands::class);
}
