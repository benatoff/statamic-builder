<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use Statamic\Http\Controllers\CP\Taxonomies\TaxonomyBlueprintsController as StatamicTaxonomyBlueprintsController;
use Tdwesten\StatamicBuilder\Repositories\BlueprintRepository;

class TaxonomyBlueprintsController extends StatamicTaxonomyBlueprintsController
{
    public function edit($taxonomy, $blueprint)
    {
        $blueprint = $taxonomy->termBlueprint($givenBlueprint = $blueprint);

        $builderBlueprint = BlueprintRepository::findBlueprint($blueprint->namespace(), $blueprint->handle());

        if ($builderBlueprint) {
            $blueprintPath = BlueprintRepository::findBlueprintPath($blueprint->namespace(), $blueprint->handle());

            return view('statamic-builder::not-editable', [
                'type' => 'Blueprint',
                'isLocal' => config('app.env') === 'local' || config('app.env') === 'development',
                'filePath' => $blueprintPath,
            ]);
        }

        return parent::edit($taxonomy, $givenBlueprint);
    }
}
