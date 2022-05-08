<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * This is a helper class to link many threats to many controls.
 * It's here as a helper for retrieving models from the database without specifying the table name.
 */
class ControlThreat extends Pivot
{
    //
}
