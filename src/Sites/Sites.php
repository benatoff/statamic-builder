<?php

namespace Tdwesten\StatamicBuilder\Sites;

use Illuminate\Support\Facades\Cache;
use Statamic\Sites\Sites as StatamicSites;

class Sites extends StatamicSites
{
    protected function getSavedSites()
    {
        $sites = config('statamic.builder.sites');

        if ($sites === null) {
            return parent::getSavedSites();
        }

        return Cache::rememberForever('statamic.builder.sites', function () {
            $sitesFromConfigFile = collect(config('statamic.builder.sites'))
                ->mapWithKeys(function ($site) {
                    $site = new $site;

                    return [$site->handle() => $site->toArray()];
                });

            return $sitesFromConfigFile->isNotEmpty() ? $sitesFromConfigFile->toArray() : $this->getFallbackConfig();
        });
    }
}
