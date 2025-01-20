<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection as IlluminateCollection;
use Statamic\Entries\Collection;
use Statamic\Stache\Repositories\CollectionRepository as StatamicCollectionRepository;
use Statamic\Stache\Stache;
use Tdwesten\StatamicBuilder\BaseCollection;

class CollectionRepository extends StatamicCollectionRepository
{
    /**
     * @var IlluminateCollection
     */
    private $collections;

    public function __construct(Stache $stache)
    {
        parent::__construct($stache);

        $this->initializeCollections();
    }

    private function initializeCollections()
    {
        $collections = collect(config('statamic.builder.collections', []));

        $this->collections = collect();

        $collections->each(function (string $collection): void {
            if (class_exists($collection, true)) {
                $this->collections->put($collection::handle(), $collection);
            }
        });
    }

    public function getCollectionByHandle($handle): ?BaseCollection
    {
        $collection = $this->collections->get($handle, null);

        if ($collection) {
            return new $collection;
        }

        return null;
    }

    public function all(): IlluminateCollection
    {
        $keys = $this->store->paths()->keys();

        // add custom collections
        $keys = $this->collections->keys()->filter(fn ($collection) => $this->getCollectionByHandle($collection)->visible())->merge($keys);

        return $this->store->getItems($keys, $this->collections);
    }

    public function findByHandle($handle): ?Collection
    {
        $collection = $this->collections->get($handle);

        if ($collection) {
            return (new $collection)->register();
        }

        return parent::findByHandle($handle);
    }
}
