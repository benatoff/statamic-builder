<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use Statamic\Http\Controllers\CP\Collections\CollectionBlueprintsController as StatamicCollectionBlueprintsController;
use Statamic\Http\Controllers\CP\Fields\ManagesBlueprints;
use Tdwesten\StatamicBuilder\Repositories\BlueprintRepository;

class CollectionBlueprintsController extends StatamicCollectionBlueprintsController
{
    use ManagesBlueprints;

    public function edit($collection, $blueprint)
    {
        $blueprint = $collection->entryBlueprint($givenBlueprint = $blueprint);

        $builderBlueprint = BlueprintRepository::findBlueprint($blueprint->namespace(), $blueprint->handle());

        if ($builderBlueprint) {
            $blueprintPath = BlueprintRepository::findBlueprintPath($blueprint->namespace(), $blueprint->handle());

            return view('statamic-builder::not-editable', [
                'type' => 'Blueprint',
                'isLocal' => config('app.env') === 'local' || config('app.env') === 'development',
                'filePath' => $blueprintPath,
            ]);
        }

        return parent::edit($collection, $givenBlueprint);
    }
}
