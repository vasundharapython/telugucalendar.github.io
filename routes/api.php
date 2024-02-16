<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Days
    Route::apiResource('days', 'DaysApiController');

    // Month
    Route::apiResource('months', 'MonthApiController');

    // Bhagavathgeetha
    Route::post('bhagavathgeethas/media', 'BhagavathgeethaApiController@storeMedia')->name('bhagavathgeethas.storeMedia');
    Route::apiResource('bhagavathgeethas', 'BhagavathgeethaApiController');

    // Bhakthigeetam
    Route::post('bhakthigeetams/media', 'BhakthigeetamApiController@storeMedia')->name('bhakthigeetams.storeMedia');
    Route::apiResource('bhakthigeetams', 'BhakthigeetamApiController');

    // Kathalu
    Route::post('kathalus/media', 'KathaluApiController@storeMedia')->name('kathalus.storeMedia');
    Route::apiResource('kathalus', 'KathaluApiController');

    // Pujalu
    Route::post('pujalus/media', 'PujaluApiController@storeMedia')->name('pujalus.storeMedia');
    Route::apiResource('pujalus', 'PujaluApiController');

    // Puranalu
    Route::post('puranalus/media', 'PuranaluApiController@storeMedia')->name('puranalus.storeMedia');
    Route::apiResource('puranalus', 'PuranaluApiController');

    // Vrathalu
    Route::post('vrathalus/media', 'VrathaluApiController@storeMedia')->name('vrathalus.storeMedia');
    Route::apiResource('vrathalus', 'VrathaluApiController');

    // Puja Bookings
    Route::apiResource('puja-bookings', 'PujaBookingsApiController', ['except' => ['show', 'update']]);

    // Muhurthambookings
    Route::apiResource('muhurthambookings', 'MuhurthambookingsApiController', ['except' => ['show', 'update']]);

    // Horoscopedetails
    Route::apiResource('horoscopedetails', 'HoroscopedetailsApiController', ['except' => ['show', 'update']]);

    // Onlinepujadetails
    Route::apiResource('onlinepujadetails', 'OnlinepujadetailsApiController', ['except' => ['show', 'update']]);

    // Vedas Details
    Route::apiResource('vedas-details', 'VedasDetailsApiController', ['except' => ['show', 'update']]);

    // Donation Details
    Route::apiResource('donation-details', 'DonationDetailsApiController', ['except' => ['show', 'update']]);

    // Godanam Details
    Route::apiResource('godanam-details', 'GodanamDetailsApiController', ['except' => ['show', 'update']]);

    // Seva Details
    Route::apiResource('seva-details', 'SevaDetailsApiController', ['except' => ['show', 'update']]);

    // Job Category
    Route::apiResource('job-categories', 'JobCategoryApiController');

    // Job Role
    Route::apiResource('job-roles', 'JobRoleApiController');

    // Job Creation
    Route::apiResource('job-creations', 'JobCreationApiController');

    // Job Application
    Route::post('job-applications/media', 'JobApplicationApiController@storeMedia')->name('job-applications.storeMedia');
    Route::apiResource('job-applications', 'JobApplicationApiController', ['except' => ['show', 'update']]);

    // Month Mis
    Route::post('month-mis/media', 'MonthMisApiController@storeMedia')->name('month-mis.storeMedia');
    Route::apiResource('month-mis', 'MonthMisApiController');
});
