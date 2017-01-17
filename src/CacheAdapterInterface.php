<?php

/*
 * This file is part of the Rollerworks UriEncoder Component package.
 *
 * (c) Sebastiaan Stok <s.stok@rollerscapes.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Rollerworks\Component\UriEncoder;

@trigger_error('The '.__NAMESPACE__.'\CacheAdapterInterface class is deprecated since version 1.1, to be removed in 2.0.', E_USER_DEPRECATED);

/**
 * Interface for cache adapters.
 *
 * @deprecated since version 1.1, to be removed in 2.0.
 */
interface CacheAdapterInterface
{
    /**
     * Fetches an entry from the cache.
     *
     * @param string $id The id of the cache entry to fetch
     *
     * @return mixed The cached data or false, if no cache entry exists for the given id
     */
    public function fetch($id);

    /**
     * Tests if an entry exists in the cache.
     *
     * @param string $id The cache id of the entry to check for
     *
     * @return bool true if a cache entry exists for the given cache id, false otherwise
     */
    public function contains($id);

    /**
     * Puts data into the cache.
     *
     * @param string $id       The cache id
     * @param mixed  $data     The cache entry/data
     * @param int    $lifeTime The cache lifetime.
     *                         If != 0, sets a specific lifetime for this cache entry (0 => infinite lifeTime)
     *
     * @return bool true if the entry was successfully stored in the cache, false otherwise
     */
    public function save($id, $data, $lifeTime = 0);

    /**
     * Deletes a cache entry.
     *
     * @param string $id The cache id
     *
     * @return bool true if the cache entry was successfully deleted, false otherwise
     */
    public function delete($id);
}
