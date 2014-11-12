<?php

return [
    /*
    |--------------------------------------------------------------------------
    | The column containing the tenant_id in the models
    |--------------------------------------------------------------------------
    |
    | This is the column that separates the tenant data in each table
    |
    */

    'column' => 'franchise_id',

    /*
    |--------------------------------------------------------------------------
    | The models to observe
    |--------------------------------------------------------------------------
    |
    | Specify the namespaced paths to the Eloquent Models
    | that you would like to be observed and the column above
    | set to the tenant_id you have set
    */

    'models' => [
          'h4d\Owners\Owner',
          'h4d\Carers\Carer',
          'h4d\Holidays\Holiday',
          'h4d\OfficeActions\OfficeAction',
    ]
];