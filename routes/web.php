<?php
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PujaController;
use App\Http\Controllers\MuhurthamController;
use App\Http\Controllers\HoroscopeController;
use App\Http\Controllers\VedamController;
use App\Http\Controllers\OnlinePujaController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\GodanamController;
use App\Http\Controllers\SevaController;
use App\Http\Controllers\JobPortalController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AnnadanamController;

Route::view('/', 'welcome');
Auth::routes(['register' => false]);
Route::get('/', [FrontController::class,'index']);
Route::get('day',[FrontController::class,'day']);
Route::get('yesterday',[FrontController::class,'yesterday']);
Route::get('tomorrow',[FrontController::class,'tomorrow']);
Route::get('date/{date}',[FrontController::class,'date']);
Route::get('/calender', 'CalendarController@index')->name('calendar.index');
Route::get('/calender/{date}', 'CalendarController@show')->name('calendar.show');
//Route::get('/your-backend-endpoint', [FrontController::class, 'getDataForDate'])->name('fetch.data');
//Route::get('fetchdata', [FrontController::class, 'fetchData'])->name('fetch.data');
Route::get('/fetch-data/{date}', 'FrontController@getDataForDate')->name('fetch.data');
Route::get('/month-data/{month}', 'FrontController@MonthData')->name('month.data');
Route::get('cal',[CalendarController::class,'index']);
Route::get('calendar',[FrontController::class,'Calc']);
Route::get('blog_gallery',[FrontController::class,'BlogGallery']);
Route::get('blog',[FrontController::class,'Blog']);
Route::get('blog/{slug}',[FrontController::class,'BlogPage']);
Route::get('blog_page/{slug}',[FrontController::class,'BlogPageShow']);
Route::get('sankataharachaturthi',[FrontController::class,'bhagavth']);
Route::get('bhagavthgeetha/{slug}',[FrontController::class,'bhagavthshow']);
Route::get('bhakthigeethacategory',[FrontController::class,'bhakthicategory']);
Route::get('bhakthigeethacategory/{slug}',[FrontController::class,'bhakthi']);
Route::get('bhakthigeetam/{slug}',[FrontController::class,'bhakthishow']);
Route::get('ekadasi',[FrontController::class,'kathalu']);
Route::get('ekadasi/{slug}',[FrontController::class,'kathalushow']);
Route::get('pujalu',[FrontController::class,'pujalu']);
Route::get('pujalu/{slug}',[FrontController::class,'pujalushow']);
Route::get('sankalpalu',[FrontController::class,'sankalpalu']);
Route::get('sankalpalu/{slug}',[FrontController::class,'sankalpalushow']);
Route::get('puranalu',[FrontController::class,'puranalu']);
Route::get('tandc',[FrontController::class,'page']);
Route::get('tandc/{slug}',[FrontController::class,'page_show']);
Route::get('puranalu/{slug}',[FrontController::class,'puranalushow']);
Route::get('vrathalu',[FrontController::class,'vrathalu']);
Route::get('vrathalu/{slug}',[FrontController::class,'vrathalushow']);
Route::get('stotraluCategory',[FrontController::class,'sthotraluCategory']);
Route::get('stotralusubcat/{slug}',[FrontController::class,'sthothralusub']);
Route::get('stotralucat/{slug}',[FrontController::class,'sthotralu']);
Route::get('stotralu/{slug}',[FrontController::class,'sthotralushow']);
Route::get('AnubandhamCategory',[FrontController::class,'AnubandhamCategory']);
Route::get('Anubandhamsubcat/{slug}',[FrontController::class,'Anubandhamsub']);
Route::get('Anubandhamcat/{slug}',[FrontController::class,'Anubandham']);
Route::get('Anubandham/{slug}',[FrontController::class,'Anubandhamshow']);
Route::get('vedasukthuluCategory',[FrontController::class,'VedasukthuluCategory']);
Route::get('vedasukthulusubcat/{slug}',[FrontController::class,'Vedasukthulusub']);
Route::get('vedasukthulutitle/{slug}',[FrontController::class,'Vedasukthulu']);
Route::get('vedasukthulu/{slug}',[FrontController::class,'Vedasukthulushow']);
Route::get('panchangam',[FrontController::class,'panchangam']);
Route::get('muhurthalu',[FrontController::class,'month']);
Route::get('muhurthalu/{slug}',[FrontController::class,'muhurthalu']);
Route::get('selavalu',[FrontController::class,'selavalu']);
Route::get('pandugalu',[FrontController::class,'pandugalu']);
Route::get('service',[FrontController::class,'service']);
Route::get('about',[FrontController::class,'about']);
Route::get('muhurtham',[FrontController::class,'muhurtham']);
Route::get('horoscope',[FrontController::class,'horoscope']);
Route::get('vedam',[FrontController::class,'vedam']);
Route::get('onlinepuja',[FrontController::class,'onlinepuja']);
Route::get('donation',[FrontController::class,'donation']);
Route::get('annadanams',[FrontController::class,'annadanam']);
Route::get('godanam',[FrontController::class,'godanam']);
Route::get('seva',[FrontController::class,'seva']);
Route::get('jobportal',[FrontController::class,'portal']);
//Route::get('calendar',[FrontController::class,'cal']);
Route::resource('puja',PujaController::class);
Route::resource('muhurthams',MuhurthamController::class);
Route::resource('horoscopes',HoroscopeController::class);
Route::resource('vedas',VedamController::class);
Route::resource('onlinepujas',OnlinePujaController::class);
Route::resource('donations',DonationController::class);
Route::resource('annadanam',AnnadanamController::class);
Route::resource('godanams',GodanamController::class);
Route::resource('sevas',SevaController::class);
Route::resource('portals',JobPortalController::class);
Route::resource('event',EventController::class);
Route::get('galleries',[FrontController::class,'Gallery']);
Route::resource('gallery',GalleryController::class);
Route::get('event/{id}/delete',[EventController::class, 'destroy']);
Route::post('event-import', [EventController::class,'import'])->name('event.import');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Days
    Route::delete('days/destroy', 'DaysController@massDestroy')->name('days.massDestroy');
    Route::post('days/parse-csv-import', 'DaysController@parseCsvImport')->name('days.parseCsvImport');
    Route::post('days/process-csv-import', 'DaysController@processCsvImport')->name('days.processCsvImport');
    Route::resource('days', 'DaysController');

    // Month
    Route::delete('months/destroy', 'MonthController@massDestroy')->name('months.massDestroy');
    Route::post('months/parse-csv-import', 'MonthController@parseCsvImport')->name('months.parseCsvImport');
    Route::post('months/process-csv-import', 'MonthController@processCsvImport')->name('months.processCsvImport');
    Route::resource('months', 'MonthController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Bhagavathgeetha
    Route::delete('bhagavathgeethas/destroy', 'BhagavathgeethaController@massDestroy')->name('bhagavathgeethas.massDestroy');
    Route::post('bhagavathgeethas/media', 'BhagavathgeethaController@storeMedia')->name('bhagavathgeethas.storeMedia');
    Route::post('bhagavathgeethas/ckmedia', 'BhagavathgeethaController@storeCKEditorImages')->name('bhagavathgeethas.storeCKEditorImages');
    Route::post('bhagavathgeethas/parse-csv-import', 'BhagavathgeethaController@parseCsvImport')->name('bhagavathgeethas.parseCsvImport');
    Route::post('bhagavathgeethas/process-csv-import', 'BhagavathgeethaController@processCsvImport')->name('bhagavathgeethas.processCsvImport');
    Route::resource('bhagavathgeethas', 'BhagavathgeethaController');

    // Sankatahari
    Route::delete('sankataharis/destroy', 'SankatahariController@massDestroy')->name('sankataharis.massDestroy');
    Route::post('sankataharis/parse-csv-import', 'SankatahariController@parseCsvImport')->name('sankataharis.parseCsvImport');
    Route::post('sankataharis/process-csv-import', 'SankatahariController@processCsvImport')->name('sankataharis.processCsvImport');
    Route::resource('sankataharis', 'SankatahariController');

    // Ekadasi
    Route::delete('ekadasis/destroy', 'EkadasiController@massDestroy')->name('ekadasis.massDestroy');
    Route::post('ekadasis/parse-csv-import', 'EkadasiController@parseCsvImport')->name('ekadasis.parseCsvImport');
    Route::post('ekadasis/process-csv-import', 'EkadasiController@processCsvImport')->name('ekadasis.processCsvImport');
    Route::resource('ekadasis', 'EkadasiController');

    // Adds
    Route::delete('adds/destroy', 'AddsController@massDestroy')->name('adds.massDestroy');
    Route::post('adds/parse-csv-import', 'AddsController@parseCsvImport')->name('adds.parseCsvImport');
    Route::post('adds/process-csv-import', 'AddsController@processCsvImport')->name('adds.processCsvImport');
    Route::resource('adds', 'AddsController');

    // Blog Category
    Route::delete('blog-categories/destroy', 'BlogCategoryController@massDestroy')->name('blog-categories.massDestroy');
    Route::post('blog-categories/parse-csv-import', 'BlogCategoryController@parseCsvImport')->name('blog-categories.parseCsvImport');
    Route::post('blog-categories/process-csv-import', 'BlogCategoryController@processCsvImport')->name('blog-categories.processCsvImport');
    Route::resource('blog-categories', 'BlogCategoryController');

    // Blog
    Route::delete('blogs/destroy', 'BlogController@massDestroy')->name('blogs.massDestroy');
    Route::post('blogs/media', 'BlogController@storeMedia')->name('blogs.storeMedia');
    Route::post('blogs/ckmedia', 'BlogController@storeCKEditorImages')->name('blogs.storeCKEditorImages');
    Route::post('blogs/parse-csv-import', 'BlogController@parseCsvImport')->name('blogs.parseCsvImport');
    Route::post('blogs/process-csv-import', 'BlogController@processCsvImport')->name('blogs.processCsvImport');
    Route::resource('blogs', 'BlogController');

      // Bhakthigeetam
      Route::delete('bhakthigeetams/destroy', 'BhakthigeetamController@massDestroy')->name('bhakthigeetams.massDestroy');
      Route::post('bhakthigeetams/media', 'BhakthigeetamController@storeMedia')->name('bhakthigeetams.storeMedia');
      Route::post('bhakthigeetams/ckmedia', 'BhakthigeetamController@storeCKEditorImages')->name('bhakthigeetams.storeCKEditorImages');
      Route::post('bhakthigeetams/parse-csv-import', 'BhakthigeetamController@parseCsvImport')->name('bhakthigeetams.parseCsvImport');
      Route::post('bhakthigeetams/process-csv-import', 'BhakthigeetamController@processCsvImport')->name('bhakthigeetams.processCsvImport');
      Route::resource('bhakthigeetams', 'BhakthigeetamController');

    // Bhakthi Geetha Category
    Route::delete('bhakthi-geetha-categories/destroy', 'BhakthiGeethaCategoryController@massDestroy')->name('bhakthi-geetha-categories.massDestroy');
    Route::post('bhakthi-geetha-categories/parse-csv-import', 'BhakthiGeethaCategoryController@parseCsvImport')->name('bhakthi-geetha-categories.parseCsvImport');
    Route::post('bhakthi-geetha-categories/process-csv-import', 'BhakthiGeethaCategoryController@processCsvImport')->name('bhakthi-geetha-categories.processCsvImport');
    Route::resource('bhakthi-geetha-categories', 'BhakthiGeethaCategoryController');

    // Kathalu
    Route::delete('kathalus/destroy', 'KathaluController@massDestroy')->name('kathalus.massDestroy');
    Route::post('kathalus/media', 'KathaluController@storeMedia')->name('kathalus.storeMedia');
    Route::post('kathalus/ckmedia', 'KathaluController@storeCKEditorImages')->name('kathalus.storeCKEditorImages');
    Route::post('kathalus/parse-csv-import', 'KathaluController@parseCsvImport')->name('kathalus.parseCsvImport');
    Route::post('kathalus/process-csv-import', 'KathaluController@processCsvImport')->name('kathalus.processCsvImport');
    Route::resource('kathalus', 'KathaluController');

    // Pujalu
    Route::delete('pujalus/destroy', 'PujaluController@massDestroy')->name('pujalus.massDestroy');
    Route::post('pujalus/media', 'PujaluController@storeMedia')->name('pujalus.storeMedia');
    Route::post('pujalus/ckmedia', 'PujaluController@storeCKEditorImages')->name('pujalus.storeCKEditorImages');
    Route::post('pujalus/parse-csv-import', 'PujaluController@parseCsvImport')->name('pujalus.parseCsvImport');
    Route::post('pujalus/process-csv-import', 'PujaluController@processCsvImport')->name('pujalus.processCsvImport');
    Route::resource('pujalus', 'PujaluController');

    // Puranalu
    Route::delete('puranalus/destroy', 'PuranaluController@massDestroy')->name('puranalus.massDestroy');
    Route::post('puranalus/media', 'PuranaluController@storeMedia')->name('puranalus.storeMedia');
    Route::post('puranalus/ckmedia', 'PuranaluController@storeCKEditorImages')->name('puranalus.storeCKEditorImages');
    Route::post('puranalus/parse-csv-import', 'PuranaluController@parseCsvImport')->name('puranalus.parseCsvImport');
    Route::post('puranalus/process-csv-import', 'PuranaluController@processCsvImport')->name('puranalus.processCsvImport');
    Route::resource('puranalus', 'PuranaluController');

    // Vrathalu
    Route::delete('vrathalus/destroy', 'VrathaluController@massDestroy')->name('vrathalus.massDestroy');
    Route::post('vrathalus/media', 'VrathaluController@storeMedia')->name('vrathalus.storeMedia');
    Route::post('vrathalus/ckmedia', 'VrathaluController@storeCKEditorImages')->name('vrathalus.storeCKEditorImages');
    Route::post('vrathalus/parse-csv-import', 'VrathaluController@parseCsvImport')->name('vrathalus.parseCsvImport');
    Route::post('vrathalus/process-csv-import', 'VrathaluController@processCsvImport')->name('vrathalus.processCsvImport');
    Route::resource('vrathalus', 'VrathaluController');

    // Sthotralu Category
    Route::delete('sthotralu-categories/destroy', 'SthotraluCategoryController@massDestroy')->name('sthotralu-categories.massDestroy');
    Route::post('sthotralu-categories/parse-csv-import', 'SthotraluCategoryController@parseCsvImport')->name('sthotralu-categories.parseCsvImport');
    Route::post('sthotralu-categories/process-csv-import', 'SthotraluCategoryController@processCsvImport')->name('sthotralu-categories.processCsvImport');
    Route::resource('sthotralu-categories', 'SthotraluCategoryController');


    // Sthothralu Sub Category
    Route::delete('sthothralu-sub-categories/destroy', 'SthothraluSubCategoryController@massDestroy')->name('sthothralu-sub-categories.massDestroy');
    Route::post('sthothralu-sub-categories/parse-csv-import', 'SthothraluSubCategoryController@parseCsvImport')->name('sthothralu-sub-categories.parseCsvImport');
    Route::post('sthothralu-sub-categories/process-csv-import', 'SthothraluSubCategoryController@processCsvImport')->name('sthothralu-sub-categories.processCsvImport');
    Route::resource('sthothralu-sub-categories', 'SthothraluSubCategoryController');

    // Sthotralu
    Route::delete('sthotralus/destroy', 'SthotraluController@massDestroy')->name('sthotralus.massDestroy');
    Route::post('sthotralus/media', 'SthotraluController@storeMedia')->name('sthotralus.storeMedia');
    Route::post('sthotralus/ckmedia', 'SthotraluController@storeCKEditorImages')->name('sthotralus.storeCKEditorImages');
    Route::post('sthotralus/parse-csv-import', 'SthotraluController@parseCsvImport')->name('sthotralus.parseCsvImport');
    Route::post('sthotralus/process-csv-import', 'SthotraluController@processCsvImport')->name('sthotralus.processCsvImport');
    Route::resource('sthotralus', 'SthotraluController');

    // Puja Bookings
    Route::delete('puja-bookings/destroy', 'PujaBookingsController@massDestroy')->name('puja-bookings.massDestroy');
    Route::post('puja-bookings/parse-csv-import', 'PujaBookingsController@parseCsvImport')->name('puja-bookings.parseCsvImport');
    Route::post('puja-bookings/process-csv-import', 'PujaBookingsController@processCsvImport')->name('puja-bookings.processCsvImport');
    Route::resource('puja-bookings', 'PujaBookingsController');

    // Muhurthambookings
    Route::delete('muhurthambookings/destroy', 'MuhurthambookingsController@massDestroy')->name('muhurthambookings.massDestroy');
    Route::post('muhurthambookings/parse-csv-import', 'MuhurthambookingsController@parseCsvImport')->name('muhurthambookings.parseCsvImport');
    Route::post('muhurthambookings/process-csv-import', 'MuhurthambookingsController@processCsvImport')->name('muhurthambookings.processCsvImport');
    Route::resource('muhurthambookings', 'MuhurthambookingsController');

     // Horoscopedetails
     Route::delete('horoscopedetails/destroy', 'HoroscopedetailsController@massDestroy')->name('horoscopedetails.massDestroy');
     Route::post('horoscopedetails/parse-csv-import', 'HoroscopedetailsController@parseCsvImport')->name('horoscopedetails.parseCsvImport');
     Route::post('horoscopedetails/process-csv-import', 'HoroscopedetailsController@processCsvImport')->name('horoscopedetails.processCsvImport');
     Route::resource('horoscopedetails', 'HoroscopedetailsController');

    // Onlinepujadetails
    Route::delete('onlinepujadetails/destroy', 'OnlinepujadetailsController@massDestroy')->name('onlinepujadetails.massDestroy');
    Route::post('onlinepujadetails/parse-csv-import', 'OnlinepujadetailsController@parseCsvImport')->name('onlinepujadetails.parseCsvImport');
    Route::post('onlinepujadetails/process-csv-import', 'OnlinepujadetailsController@processCsvImport')->name('onlinepujadetails.processCsvImport');
    Route::resource('onlinepujadetails', 'OnlinepujadetailsController');

    // Vedas Details
    Route::delete('vedas-details/destroy', 'VedasDetailsController@massDestroy')->name('vedas-details.massDestroy');
    Route::post('vedas-details/parse-csv-import', 'VedasDetailsController@parseCsvImport')->name('vedas-details.parseCsvImport');
    Route::post('vedas-details/process-csv-import', 'VedasDetailsController@processCsvImport')->name('vedas-details.processCsvImport');
    Route::resource('vedas-details', 'VedasDetailsController');

    // Donation Details
    Route::delete('donation-details/destroy', 'DonationDetailsController@massDestroy')->name('donation-details.massDestroy');
    Route::post('donation-details/parse-csv-import', 'DonationDetailsController@parseCsvImport')->name('donation-details.parseCsvImport');
    Route::post('donation-details/process-csv-import', 'DonationDetailsController@processCsvImport')->name('donation-details.processCsvImport');
    Route::resource('donation-details', 'DonationDetailsController');

    // Godanam Details
    Route::delete('godanam-details/destroy', 'GodanamDetailsController@massDestroy')->name('godanam-details.massDestroy');
    Route::post('godanam-details/parse-csv-import', 'GodanamDetailsController@parseCsvImport')->name('godanam-details.parseCsvImport');
    Route::post('godanam-details/process-csv-import', 'GodanamDetailsController@processCsvImport')->name('godanam-details.processCsvImport');
    Route::resource('godanam-details', 'GodanamDetailsController');

    // gallery Details
    Route::delete('gallery/destroy', 'GalleryController@massDestroy')->name('gallery.massDestroy');
    Route::post('gallery/parse-csv-import', 'GalleryController@parseCsvImport')->name('gallery.parseCsvImport');
    Route::post('gallery/process-csv-import', 'GalleryController@processCsvImport')->name('gallery.processCsvImport');
    Route::resource('gallery', 'GalleryController');

    // Seva Details
    Route::delete('seva-details/destroy', 'SevaDetailsController@massDestroy')->name('seva-details.massDestroy');
    Route::post('seva-details/parse-csv-import', 'SevaDetailsController@parseCsvImport')->name('seva-details.parseCsvImport');
    Route::post('seva-details/process-csv-import', 'SevaDetailsController@processCsvImport')->name('seva-details.processCsvImport');
    Route::resource('seva-details', 'SevaDetailsController');


    // Job Category
    Route::delete('job-categories/destroy', 'JobCategoryController@massDestroy')->name('job-categories.massDestroy');
    Route::post('job-categories/parse-csv-import', 'JobCategoryController@parseCsvImport')->name('job-categories.parseCsvImport');
    Route::post('job-categories/process-csv-import', 'JobCategoryController@processCsvImport')->name('job-categories.processCsvImport');
    Route::resource('job-categories', 'JobCategoryController');

    // Job Role
    Route::delete('job-roles/destroy', 'JobRoleController@massDestroy')->name('job-roles.massDestroy');
    Route::post('job-roles/parse-csv-import', 'JobRoleController@parseCsvImport')->name('job-roles.parseCsvImport');
    Route::post('job-roles/process-csv-import', 'JobRoleController@processCsvImport')->name('job-roles.processCsvImport');
    Route::resource('job-roles', 'JobRoleController');

    // Job Creation
    Route::delete('job-creations/destroy', 'JobCreationController@massDestroy')->name('job-creations.massDestroy');
    Route::post('job-creations/parse-csv-import', 'JobCreationController@parseCsvImport')->name('job-creations.parseCsvImport');
    Route::post('job-creations/process-csv-import', 'JobCreationController@processCsvImport')->name('job-creations.processCsvImport');
    Route::resource('job-creations', 'JobCreationController');

    // Job Application
    Route::delete('job-applications/destroy', 'JobApplicationController@massDestroy')->name('job-applications.massDestroy');
    Route::post('job-applications/media', 'JobApplicationController@storeMedia')->name('job-applications.storeMedia');
    Route::post('job-applications/ckmedia', 'JobApplicationController@storeCKEditorImages')->name('job-applications.storeCKEditorImages');
    Route::post('job-applications/parse-csv-import', 'JobApplicationController@parseCsvImport')->name('job-applications.parseCsvImport');
    Route::post('job-applications/process-csv-import', 'JobApplicationController@processCsvImport')->name('job-applications.processCsvImport');
    Route::resource('job-applications', 'JobApplicationController');

    // Month Mis
    Route::delete('month-mis/destroy', 'MonthMisController@massDestroy')->name('month-mis.massDestroy');
    Route::post('month-mis/media', 'MonthMisController@storeMedia')->name('month-mis.storeMedia');
    Route::post('month-mis/ckmedia', 'MonthMisController@storeCKEditorImages')->name('month-mis.storeCKEditorImages');
    Route::post('month-mis/parse-csv-import', 'MonthMisController@parseCsvImport')->name('month-mis.parseCsvImport');
    Route::post('month-mis/process-csv-import', 'MonthMisController@processCsvImport')->name('month-mis.processCsvImport');
    Route::resource('month-mis', 'MonthMisController');

    // Crm Status
    Route::delete('crm-statuses/destroy', 'CrmStatusController@massDestroy')->name('crm-statuses.massDestroy');
    Route::resource('crm-statuses', 'CrmStatusController');

    // Crm Customer
    Route::delete('crm-customers/destroy', 'CrmCustomerController@massDestroy')->name('crm-customers.massDestroy');
    Route::resource('crm-customers', 'CrmCustomerController');

    // Crm Note
    Route::delete('crm-notes/destroy', 'CrmNoteController@massDestroy')->name('crm-notes.massDestroy');
    Route::resource('crm-notes', 'CrmNoteController');

    // Crm Document
    Route::delete('crm-documents/destroy', 'CrmDocumentController@massDestroy')->name('crm-documents.massDestroy');
    Route::post('crm-documents/media', 'CrmDocumentController@storeMedia')->name('crm-documents.storeMedia');
    Route::post('crm-documents/ckmedia', 'CrmDocumentController@storeCKEditorImages')->name('crm-documents.storeCKEditorImages');
    Route::resource('crm-documents', 'CrmDocumentController');

    // Muhurthalu
    Route::delete('muhurthalus/destroy', 'MuhurthaluController@massDestroy')->name('muhurthalus.massDestroy');
    Route::post('muhurthalus/parse-csv-import', 'MuhurthaluController@parseCsvImport')->name('muhurthalus.parseCsvImport');
    Route::post('muhurthalus/process-csv-import', 'MuhurthaluController@processCsvImport')->name('muhurthalus.processCsvImport');
    Route::resource('muhurthalus', 'MuhurthaluController');

    // Annadanam
    Route::delete('annadanams/destroy', 'AnnadanamController@massDestroy')->name('annadanams.massDestroy');
    Route::post('annadanams/parse-csv-import', 'AnnadanamController@parseCsvImport')->name('annadanams.parseCsvImport');
    Route::post('annadanams/process-csv-import', 'AnnadanamController@processCsvImport')->name('annadanams.processCsvImport');
    Route::resource('annadanams', 'AnnadanamController');

    // Sankalpalu
    Route::delete('sankalpalus/destroy', 'SankalpaluController@massDestroy')->name('sankalpalus.massDestroy');
    Route::post('sankalpalus/media', 'SankalpaluController@storeMedia')->name('sankalpalus.storeMedia');
    Route::post('sankalpalus/ckmedia', 'SankalpaluController@storeCKEditorImages')->name('sankalpalus.storeCKEditorImages');
    Route::post('sankalpalus/parse-csv-import', 'SankalpaluController@parseCsvImport')->name('sankalpalus.parseCsvImport');
    Route::post('sankalpalus/process-csv-import', 'SankalpaluController@processCsvImport')->name('sankalpalus.processCsvImport');
    Route::resource('sankalpalus', 'SankalpaluController');


    // Event
    Route::delete('events/destroy', 'EventController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::post('events/parse-csv-import', 'EventController@parseCsvImport')->name('events.parseCsvImport');
    Route::post('events/process-csv-import', 'EventController@processCsvImport')->name('events.processCsvImport');
    Route::resource('events', 'EventController');


    // Scategory
    Route::delete('scategories/destroy', 'ScategoryController@massDestroy')->name('scategories.massDestroy');
    Route::post('scategories/parse-csv-import', 'ScategoryController@parseCsvImport')->name('scategories.parseCsvImport');
    Route::post('scategories/process-csv-import', 'ScategoryController@processCsvImport')->name('scategories.processCsvImport');
    Route::resource('scategories', 'ScategoryController');

    // Ssub Category
    Route::delete('ssub-categories/destroy', 'SsubCategoryController@massDestroy')->name('ssub-categories.massDestroy');
    Route::post('ssub-categories/parse-csv-import', 'SsubCategoryController@parseCsvImport')->name('ssub-categories.parseCsvImport');
    Route::post('ssub-categories/process-csv-import', 'SsubCategoryController@processCsvImport')->name('ssub-categories.processCsvImport');
    Route::resource('ssub-categories', 'SsubCategoryController');

     //PopUp
     Route::delete('popup/destroy', 'PopUpController@massDestroy')->name('popup.massDestroy');
     Route::post('popup/parse-csv-import', 'PopUpController@parseCsvImport')->name('popup.parseCsvImport');
     Route::post('popup/process-csv-import', 'PopUpController@processCsvImport')->name('popup.processCsvImport');
     Route::resource('popup', 'PopUpController');


    // Sthothralu Copy
    Route::delete('sthothralu-copies/destroy', 'SthothraluCopyController@massDestroy')->name('sthothralu-copies.massDestroy');
    Route::post('sthothralu-copies/media', 'SthothraluCopyController@storeMedia')->name('sthothralu-copies.storeMedia');
    Route::post('sthothralu-copies/ckmedia', 'SthothraluCopyController@storeCKEditorImages')->name('sthothralu-copies.storeCKEditorImages');
    Route::post('sthothralu-copies/parse-csv-import', 'SthothraluCopyController@parseCsvImport')->name('sthothralu-copies.parseCsvImport');
    Route::post('sthothralu-copies/process-csv-import', 'SthothraluCopyController@processCsvImport')->name('sthothralu-copies.processCsvImport');
    Route::resource('sthothralu-copies', 'SthothraluCopyController');


    // Vedasukthulu Category
    Route::delete('vedasukthulu-categories/destroy', 'VedasukthuluCategoryController@massDestroy')->name('vedasukthulu-categories.massDestroy');
    Route::post('vedasukthulu-categories/parse-csv-import', 'VedasukthuluCategoryController@parseCsvImport')->name('vedasukthulu-categories.parseCsvImport');
    Route::post('vedasukthulu-categories/process-csv-import', 'VedasukthuluCategoryController@processCsvImport')->name('vedasukthulu-categories.processCsvImport');
    Route::resource('vedasukthulu-categories', 'VedasukthuluCategoryController');

    // Vedasukthulu Sub Category
    Route::delete('vedasukthulu-sub-categories/destroy', 'VedasukthuluSubCategoryController@massDestroy')->name('vedasukthulu-sub-categories.massDestroy');
    Route::post('vedasukthulu-sub-categories/parse-csv-import', 'VedasukthuluSubCategoryController@parseCsvImport')->name('vedasukthulu-sub-categories.parseCsvImport');
    Route::post('vedasukthulu-sub-categories/process-csv-import', 'VedasukthuluSubCategoryController@processCsvImport')->name('vedasukthulu-sub-categories.processCsvImport');
    Route::resource('vedasukthulu-sub-categories', 'VedasukthuluSubCategoryController');

    // Vedasukthulu
    Route::delete('vedasukthulus/destroy', 'VedasukthuluController@massDestroy')->name('vedasukthulus.massDestroy');
    Route::post('vedasukthulus/media', 'VedasukthuluController@storeMedia')->name('vedasukthulus.storeMedia');
    Route::post('vedasukthulus/ckmedia', 'VedasukthuluController@storeCKEditorImages')->name('vedasukthulus.storeCKEditorImages');
    Route::post('vedasukthulus/parse-csv-import', 'VedasukthuluController@parseCsvImport')->name('vedasukthulus.parseCsvImport');
    Route::post('vedasukthulus/process-csv-import', 'VedasukthuluController@processCsvImport')->name('vedasukthulus.processCsvImport');
    Route::resource('vedasukthulus', 'VedasukthuluController');

    // Nelalu
    Route::delete('nelalus/destroy', 'NelaluController@massDestroy')->name('nelalus.massDestroy');
    Route::post('nelalus/parse-csv-import', 'NelaluController@parseCsvImport')->name('nelalus.parseCsvImport');
    Route::post('nelalus/process-csv-import', 'NelaluController@processCsvImport')->name('nelalus.processCsvImport');
    Route::resource('nelalus', 'NelaluController');


});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Days
    Route::delete('days/destroy', 'DaysController@massDestroy')->name('days.massDestroy');
    Route::resource('days', 'DaysController');

    // Month
    Route::delete('months/destroy', 'MonthController@massDestroy')->name('months.massDestroy');
    Route::resource('months', 'MonthController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Bhagavathgeetha
    Route::delete('bhagavathgeethas/destroy', 'BhagavathgeethaController@massDestroy')->name('bhagavathgeethas.massDestroy');
    Route::post('bhagavathgeethas/media', 'BhagavathgeethaController@storeMedia')->name('bhagavathgeethas.storeMedia');
    Route::post('bhagavathgeethas/ckmedia', 'BhagavathgeethaController@storeCKEditorImages')->name('bhagavathgeethas.storeCKEditorImages');
    Route::resource('bhagavathgeethas', 'BhagavathgeethaController');

    // Bhakthigeetam
    Route::delete('bhakthigeetams/destroy', 'BhakthigeetamController@massDestroy')->name('bhakthigeetams.massDestroy');
    Route::post('bhakthigeetams/media', 'BhakthigeetamController@storeMedia')->name('bhakthigeetams.storeMedia');
    Route::post('bhakthigeetams/ckmedia', 'BhakthigeetamController@storeCKEditorImages')->name('bhakthigeetams.storeCKEditorImages');
    Route::resource('bhakthigeetams', 'BhakthigeetamController');

    // Kathalu
    Route::delete('kathalus/destroy', 'KathaluController@massDestroy')->name('kathalus.massDestroy');
    Route::post('kathalus/media', 'KathaluController@storeMedia')->name('kathalus.storeMedia');
    Route::post('kathalus/ckmedia', 'KathaluController@storeCKEditorImages')->name('kathalus.storeCKEditorImages');
    Route::resource('kathalus', 'KathaluController');

    // Pujalu
    Route::delete('pujalus/destroy', 'PujaluController@massDestroy')->name('pujalus.massDestroy');
    Route::post('pujalus/media', 'PujaluController@storeMedia')->name('pujalus.storeMedia');
    Route::post('pujalus/ckmedia', 'PujaluController@storeCKEditorImages')->name('pujalus.storeCKEditorImages');
    Route::resource('pujalus', 'PujaluController');

    // Puranalu
    Route::delete('puranalus/destroy', 'PuranaluController@massDestroy')->name('puranalus.massDestroy');
    Route::post('puranalus/media', 'PuranaluController@storeMedia')->name('puranalus.storeMedia');
    Route::post('puranalus/ckmedia', 'PuranaluController@storeCKEditorImages')->name('puranalus.storeCKEditorImages');
    Route::resource('puranalus', 'PuranaluController');

    // Vrathalu
    Route::delete('vrathalus/destroy', 'VrathaluController@massDestroy')->name('vrathalus.massDestroy');
    Route::post('vrathalus/media', 'VrathaluController@storeMedia')->name('vrathalus.storeMedia');
    Route::post('vrathalus/ckmedia', 'VrathaluController@storeCKEditorImages')->name('vrathalus.storeCKEditorImages');
    Route::resource('vrathalus', 'VrathaluController');


    // Puja Bookings
    Route::delete('puja-bookings/destroy', 'PujaBookingsController@massDestroy')->name('puja-bookings.massDestroy');
    Route::resource('puja-bookings', 'PujaBookingsController', ['except' => ['edit', 'update', 'show']]);

    // Muhurthambookings
    Route::delete('muhurthambookings/destroy', 'MuhurthambookingsController@massDestroy')->name('muhurthambookings.massDestroy');
    Route::resource('muhurthambookings', 'MuhurthambookingsController', ['except' => ['edit', 'update', 'show']]);

    // Horoscopedetails
    Route::delete('horoscopedetails/destroy', 'HoroscopedetailsController@massDestroy')->name('horoscopedetails.massDestroy');
    Route::resource('horoscopedetails', 'HoroscopedetailsController', ['except' => ['edit', 'update', 'show']]);

    // Onlinepujadetails
    Route::delete('onlinepujadetails/destroy', 'OnlinepujadetailsController@massDestroy')->name('onlinepujadetails.massDestroy');
    Route::resource('onlinepujadetails', 'OnlinepujadetailsController', ['except' => ['edit', 'update', 'show']]);

    // Vedas Details
    Route::delete('vedas-details/destroy', 'VedasDetailsController@massDestroy')->name('vedas-details.massDestroy');
    Route::resource('vedas-details', 'VedasDetailsController', ['except' => ['edit', 'update', 'show']]);

    // Donation Details
    Route::delete('donation-details/destroy', 'DonationDetailsController@massDestroy')->name('donation-details.massDestroy');
    Route::resource('donation-details', 'DonationDetailsController', ['except' => ['edit', 'update', 'show']]);

    // Godanam Details
    Route::delete('godanam-details/destroy', 'GodanamDetailsController@massDestroy')->name('godanam-details.massDestroy');
    Route::resource('godanam-details', 'GodanamDetailsController', ['except' => ['edit', 'update', 'show']]);

    // Seva Details
    Route::delete('seva-details/destroy', 'SevaDetailsController@massDestroy')->name('seva-details.massDestroy');
    Route::resource('seva-details', 'SevaDetailsController', ['except' => ['edit', 'update', 'show']]);

    // Job Category
    Route::delete('job-categories/destroy', 'JobCategoryController@massDestroy')->name('job-categories.massDestroy');
    Route::resource('job-categories', 'JobCategoryController');

    // Job Role
    Route::delete('job-roles/destroy', 'JobRoleController@massDestroy')->name('job-roles.massDestroy');
    Route::resource('job-roles', 'JobRoleController');

    // Job Creation
    Route::delete('job-creations/destroy', 'JobCreationController@massDestroy')->name('job-creations.massDestroy');
    Route::resource('job-creations', 'JobCreationController');

    // Job Application
    Route::delete('job-applications/destroy', 'JobApplicationController@massDestroy')->name('job-applications.massDestroy');
    Route::post('job-applications/media', 'JobApplicationController@storeMedia')->name('job-applications.storeMedia');
    Route::post('job-applications/ckmedia', 'JobApplicationController@storeCKEditorImages')->name('job-applications.storeCKEditorImages');
    Route::resource('job-applications', 'JobApplicationController', ['except' => ['edit', 'update', 'show']]);

    // Month Mis
    Route::delete('month-mis/destroy', 'MonthMisController@massDestroy')->name('month-mis.massDestroy');
    Route::post('month-mis/media', 'MonthMisController@storeMedia')->name('month-mis.storeMedia');
    Route::post('month-mis/ckmedia', 'MonthMisController@storeCKEditorImages')->name('month-mis.storeCKEditorImages');
    Route::resource('month-mis', 'MonthMisController');

    // Crm Status
    Route::delete('crm-statuses/destroy', 'CrmStatusController@massDestroy')->name('crm-statuses.massDestroy');
    Route::resource('crm-statuses', 'CrmStatusController');

    // Crm Customer
    Route::delete('crm-customers/destroy', 'CrmCustomerController@massDestroy')->name('crm-customers.massDestroy');
    Route::resource('crm-customers', 'CrmCustomerController');

    // Crm Note
    Route::delete('crm-notes/destroy', 'CrmNoteController@massDestroy')->name('crm-notes.massDestroy');
    Route::resource('crm-notes', 'CrmNoteController');

    // Crm Document
    Route::delete('crm-documents/destroy', 'CrmDocumentController@massDestroy')->name('crm-documents.massDestroy');
    Route::post('crm-documents/media', 'CrmDocumentController@storeMedia')->name('crm-documents.storeMedia');
    Route::post('crm-documents/ckmedia', 'CrmDocumentController@storeCKEditorImages')->name('crm-documents.storeCKEditorImages');
    Route::resource('crm-documents', 'CrmDocumentController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
