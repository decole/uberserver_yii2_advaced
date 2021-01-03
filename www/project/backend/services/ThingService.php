<?php

namespace backend\services;

use backend\forms\BoxForm;
use backend\forms\RackForm;
use backend\forms\ThingForm;
use backend\models\WarehouseBox;
use backend\models\WarehouseRack;
use backend\models\WarehouseThing;

class ThingService
{
    public function addThing(ThingForm $model): void
    {
        $thing = new WarehouseThing();
        $thing->box_id = $model->box_id;
        $thing->name = $model->name;
        $thing->sum = $model->sum;
        $thing->description = $model->description;
        $thing->created_at = time();
        $thing->updated_at = time();

        if ($model->upload()) {
            $thing->photo = $model->photo_path;
        }

        $thing->save();
    }

    public function addBox(BoxForm $modelBox): void
    {
        $box = new WarehouseBox();
        $box->name = $modelBox->name;
        $box->rack_id = $modelBox->rack_id;
        $box->created_at = time();
        $box->save();
    }

    public function addRack(RackForm $modelRack): void
    {
        $rack = new WarehouseRack();
        $rack->name = $modelRack->name;
        $rack->created_at = time();
        $rack->save();
    }
}
