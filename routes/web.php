<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// OAuth Routes
Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::get('/', 'Frontend\FrontendController@home')->name('home');

Route::group(
    ['middleware' => 'guest'], function () {
        Route::get('/login/twofactor', 'Auth\TwoFactorLoginController@index')->name('login.twofactor.index');
        Route::post('/login/twofactor', 'Auth\TwoFactorLoginController@verify')->name('login.twofactor.verify');
    }
);

/*
 * Account
 */
Route::group(
    ['prefix' => 'account', 'middleware' => ['auth'], 'as' => 'account.', 'namespace' => 'Account'], function () {
        Route::group(
            ['middleware' => ['auth', 'subscription.notcancelled']], function () {
                Route::get('/', 'DashboardController@index')->name('dashboard');
                Route::post('appointment_data', 'DashboardController@appointment_data')->name('appointment_data');
                 Route::post('appointment_update', 'DashboardController@appointment_update')->name('dashboard.appointment_update');
                Route::post('all_record', 'DashboardController@all_record')->name('all_record');
                Route::post('graph_data', 'DashboardController@graph_data')->name('graph_data');


                 /*
                * Email
                */
                Route::get('email', 'CpanelController@emails')->name('email.index');
                Route::post('emails', 'CpanelController@add_email')->name('cpanel_add_email');
                Route::post('emails/change-password', 'CpanelController@change_email_password')->name('cpanel_email_change_password');
                Route::delete('emails/delete', 'CpanelController@delete_email')->name('cpanel_delete_email');

                /*
                * Download
                */
                Route::get('download', 'DownloadController@index')->name('download.index');
                Route::post('download', 'DownloadController@store')->name('download.store');
                Route::get('download_file/{file}', 'DownloadController@download')->name('download.download');

                /*
                * Messages
                */
                Route::get('message', 'MessageController@index')->name('message.index');
                Route::post('message', 'MessageController@store')->name('message.store');
            }
        );

        /*
        * Settings
        */
        Route::group(
            ['prefix' => '', 'namespace' => 'Setting', 'middleware' => []], function () {
                Route::get('/download-invoice/{id}', 'AccountController@downloadInvoice')->name('download-invoice');

                Route::get('overview', 'AccountController@index')->name('overview');

                /*
                * Profile
                */
                Route::get('profile', 'ProfileController@index')->name('profile.index');
                Route::post('profile', 'ProfileController@store')->name('profile.store');

                /*
                * Password
                */
                Route::get('password', 'PasswordController@index')->name('password.index');
                Route::post('password', 'PasswordController@store')->name('password.store');

                /*
                * Deactivate
                */
                Route::get('deactivate', 'DeactivateController@index')->name('deactivate.index');
                Route::post('deactivate', 'DeactivateController@store')->name('deactivate.store');

                /*
                * Two factor
                */
                Route::group(
                    [], function () {
                        Route::get('/twofactor', 'TwoFactorController@index')->name('twofactor.index');
                        Route::post('/twofactor', 'TwoFactorController@store')->name('twofactor.store');
                        Route::post('/twofactor/verify', 'TwoFactorController@verify')->name('twofactor.verify');
                        Route::delete('/twofactor', 'TwoFactorController@destroy')->name('twofactor.destroy');
                    }
                );
            }
        );

        /*
        * Subscription
        */
        Route::group(
            ['prefix' => 'subscription', 'namespace' => 'Subscription', 'middleware' => []], function () {
                /*
                * Cancel
                */
                Route::group(
                    ['middleware' => 'subscription.notcancelled'], function () {
                        Route::get('/cancel', 'SubscriptionCancelController@index')->name('subscription.cancel.index');
                        Route::post('/cancel', 'SubscriptionCancelController@store')->name('subscription.cancel.store');
                    }
                );

                /*
                * Resume
                */
                Route::group(
                    ['middleware' => 'subscription.cancelled'], function () {
                        Route::get('/resume', 'SubscriptionResumeController@index')->name('subscription.resume.index');
                        Route::post('/resume', 'SubscriptionResumeController@store')->name('subscription.resume.store');
                    }
                );

                /*
                * Swap
                */
                Route::group(
                    ['middleware' => 'subscription.notcancelled'], function () {
                        Route::get('/swap', 'SubscriptionSwapController@index')->name('subscription.swap.index');
                        Route::post('/swap', 'SubscriptionSwapController@store')->name('subscription.swap.store');
                    }
                );

                /*
                * Card
                */
                Route::group(
                    ['middleware' => 'subscription.notcancelled'], function () {
                        Route::get('/card', 'SubscriptionCardController@index')->name('subscription.card.index');
                        Route::post('/card', 'SubscriptionCardController@store')->name('subscription.card.store');
                    }
                );
            }
        );

        /*
        * Appointments
        */
        Route::group(
            ['prefix' => 'appointment', 'namespace' => 'Appointment', 'middleware' => ['subscription.notcancelled']], function () {
                Route::get('availability', 'AvailabilityController@index')->name('appointments.availability');
                Route::post('availability', 'AvailabilityController@store')->name('appointments.availability_store');
                Route::post('availability/delete', 'AvailabilityController@delete')->name('appointments.availability_delete');
                Route::post('availability/update', 'AvailabilityController@update')->name('appointments.availability_update');
                Route::get('calendar', 'CalendarController@index')->name('appointments.calendar');
                Route::get('event', 'CalendarController@event')->name('appointments.event');
                Route::get('event_add', 'CalendarController@eventAdd')->name('appointments.event.add');
                Route::get('overview', 'OverviewController@index')->name('appointments.overview');
                Route::post('getAppointmentById', 'OverviewController@getAppointmentById')->name('appointments.getAppointmentById');
                Route::post('deleteAppointmentById', 'OverviewController@deleteAppointmentById')->name('appointments.deleteAppointmentById');
                Route::post('updateAppointment', 'OverviewController@updateAppointment')->name('appointments.updateAppointment');
                Route::post('addAppointment', 'OverviewController@addAppointment')->name('appointments.addAppointment');
                Route::get('appointments-change-status/{id}', 'OverviewController@change_status')->name('appointments.change_status');
                Route::get('reviews', 'ReviewController@index')->name('appointments.reviews');
                Route::get('scheduler', 'SchedulerController@index')->name('appointments.scheduler');
                Route::post('scheduler', 'SchedulerController@store')->name('appointments.store');
                Route::post('update_scheduler', 'SchedulerController@update_scheduler')->name('appointments.update_scheduler');
                Route::get('schedulers', 'SchedulerController@schedulers')->name('appointments.schedulers');
                Route::get('all_schedulers', 'SchedulerController@getAllSchedulers')->name('appointments.all_schedulers');
                Route::get('appointments_avail', 'SchedulerController@appointments_avail')->name('appointments.appointments_avail');
                Route::get('appointments_calendar', 'SchedulerController@appointments_calendar')->name('appointments.appointments_calendar');
                Route::get('services', 'ServiceController@index')->name('appointments.services');
                Route::post('services', 'ServiceController@store')->name('services.store');
                Route::post('getServiceById', 'ServiceController@getServiceById')->name('services.getServiceById');
                Route::post('deleteServiceById', 'ServiceController@deleteServiceById')->name('services.deleteServiceById');
                Route::post('updateService', 'ServiceController@updateService')->name('services.updateService');
                Route::get('change_status/{id}', 'ServiceController@change_status')->name('services.change_status');
            }
        );

        /*
        * Website Management
        */
        Route::group(
            ['prefix' => 'website', 'namespace' => 'Website', 'middleware' => ['subscription.notcancelled', 'website.nosetup']], function () {
                Route::get('blog', 'BlogController@index')->name('website.blog');
                Route::get('new-blog', 'BlogController@create')->name('website.createBlog');
                Route::get('edit-blog/{id}', 'BlogController@edit')->name('website.editBlog');
                Route::get('change_status/{id}', 'BlogController@change_status')->name('website.change_status');
                Route::post('addblog', 'BlogController@addBlog')->name('website.addblog');
                Route::post('getBlogById', 'BlogController@getBlogById')->name('website.getBlogById');
                Route::post('deleteBlogById', 'BlogController@deleteBlogById')->name('website.deleteBlogById');
                Route::post('updateBlog', 'BlogController@updateBlog')->name('website.updateBlog');

                Route::get('leads', 'LeadController@index')->name('website.leads');
                Route::get('leadChangeStatus/{id}', 'LeadController@change_status')->name('website.leadChangeStatus');
                Route::post('addLead', 'LeadController@addLead')->name('website.addLead');
                Route::post('updateLead', 'LeadController@updateLead')->name('website.updateLead');
                Route::post('getLeadById', 'LeadController@getLeadById')->name('website.getLeadById');
                Route::post('deleteLeadById', 'LeadController@deleteLeadById')->name('website.deleteLeadById');
                Route::group(
                    ['prefix' => 'settings'], function () {
                        Route::get('general', 'SettingController@general')->name('website.settings.general');
                        Route::post('general', 'SettingController@generalSettingStore')->name('website.generalsetting.store');

                        Route::get('site', 'SettingController@site')->name('website.settings.site');
                        Route::post('site', 'SettingController@siteSettingStore')->name('website.sitesetting.store');

                        Route::get('tag', 'SettingController@tag')->name('website.settings.tag');
                        Route::post('tag', 'SettingController@tagSettingStore')->name('website.tagsetting.store');
                        
                        Route::get('mail', 'SettingController@mail')->name('website.settings.mail');
                        Route::post('mail', 'SettingController@mailSettingStore')->name('website.mailsetting.store');                        
                    }
                );
                Route::group(
                    ['prefix' => 'sitebuilder'], function () {
                        Route::get('/', 'SitebuilderController@getDashboard')->name('sitebuilder.dashboard');
                        Route::get('/site/trash/{site_id}', ['uses' => 'SitebuilderController@getTrash','as' => 'sitebuilder.trash']);
                        Route::get('/site-create', ['uses' => 'SitebuilderController@getSiteCreate','as' => 'sitebuilder.create']);
                        Route::get('/site/{site_id}', ['uses' => 'SitebuilderController@getSite','as' => 'sitebuilder.site']);
                        Route::post('/site/save', ['uses' => 'SitebuilderController@postSave','as' => 'sitebuilder.site-save']);
                        Route::post('get_contact_data', 'SitebuilderController@get_contact_data')->name('sitebuilder.contact_data');
                        Route::get('/site/getframe/{frame_id}', ['uses' => 'SitebuilderController@getFrame','as' => 'sitebuilder.getframe']);
                        Route::get('/siteData', ['uses' => 'SitebuilderController@getSiteData','as' => 'sitebuilder.siteData']);
                        Route::get('/siteAjax/{site_id}', ['uses' => 'SitebuilderController@getSiteAjax','as' => 'sitebuilder.siteAjax']);
                        Route::get('/site/getRevisions/{site_id}/{page}', ['uses' => 'SitebuilderController@getRevisions','as' => 'sitebuilder.getRevisions']);
                        Route::get('/site/rpreview/{site_id}/{datetime}/{page}', ['uses' => 'SitebuilderController@getRevisionPreview','as' => 'sitebuilder.revision.preview']);
                        Route::get('/deleterevision/{site_id}/{datetime}/{page}', ['uses' => 'SitebuilderController@getRevisionDelete','as' => 'sitebuilder.revision.delete']);
                        Route::get('/restorerevision/{site_id}/{datetime}/{page}', ['uses' => 'SitebuilderController@getRevisionRestore','as' => 'sitebuilder.revision.restore']);
                        Route::post('/site/export', ['uses' => 'SitebuilderController@postExport','as' => 'sitebuilder.export']);
                        Route::post('/site/publish/{type?}', ['uses' => 'SitebuilderController@postPublish','as' => 'sitebuilder.publish']);
                        Route::post('/site/connect', ['uses' => 'SitebuilderController@postFTPConnect','as' => 'sitebuilder.ftp.connect']);
                        Route::post('/site/ftptest', ['uses' => 'SitebuilderController@postFTPTest','as' => 'sitebuilder.ftp.test']);
                        Route::get('/test', ['uses' => 'SitebuilderController@getTest','as' => 'sitebuilder.test']);
                        Route::post('/site/live/preview', ['uses' => 'SitebuilderController@postLivePreview','as' => 'sitebuilder.live.preview']);
                        Route::post('/siteAjaxUpdate', ['uses' => 'SitebuilderController@postAjaxUpdate','as' => 'sitebuilder.siteAjaxUpdate']);
                        Route::post('/updatePageData', ['uses' => 'SitebuilderController@postUpdatePageData','as' => 'sitebuilder.updatePageData']);
                        Route::get('/assets', ['uses' => 'SitebuilderAssetController@getAsset','as' => 'sitebuilder.assets']);
                        Route::post('/upload-image', ['uses' => 'SitebuilderAssetController@uploadImage','as' => 'sitebuilder.upload.image']);
                        Route::post('/image-upload-ajax', ['uses' => 'SitebuilderAssetController@imageUploadAjax','as' => 'sitebuilder.image.upload.ajax']);
                        Route::post('/delImage', ['uses' => 'SitebuilderAssetController@delImage','as' => 'sitebuilder.delImage']);
                    }
                );
                Route::get('seo-tools', 'SeoToolController@index')->name('website.seo_tools');
            }
        );
        Route::group(
            ['prefix' => 'website', 'namespace' => 'Website', 'middleware' => ['subscription.notcancelled']], function () {
                Route::get('wizard', 'WizardController@index')->name('website.wizard');
                Route::post('wizard/post', 'WizardController@post')->name('website.wizard.post');
            }
        );

        /*
        * Support
        */
        Route::group(
            ['prefix' => 'support', 'namespace' => 'Support', 'middleware' => []], function () {
                Route::get('faq', 'FaqController@index')->name('support.faq');
                Route::get('helpdesk', 'HelpdeskController@index')->name('support.helpdesk');
                Route::post('submitQuery', 'HelpdeskController@submitQuery')->name('support.submitquery');
            }
        );
    }
);

/*
 * Account activation.
 */
Route::group(
    ['prefix' => 'activation', 'as' => 'activation.', 'middleware' => ['guest']], function () {
        Route::get('/resend', 'Auth\ActivationResendController@index')->name('resend');
        Route::post('/resend', 'Auth\ActivationResendController@store')->name('resend.store');
        Route::get('/{confirmation_token}', 'Auth\ActivationController@activate')->name('activate');
    }
);

/*
 * Subscription plans.
 */
Route::group(
    ['prefix' => 'plans', 'as' => 'plans.', 'middleware' => 'subscription.inactive'], function () {
        Route::get('/', 'Subscription\PlanController@index')->name('index');

    }
);

/*
 * Subscription
 */
Route::group(
    ['prefix' => 'subscription', 'as' => 'subscription.', 'middleware' => ['subscription.inactive']], function () {
        Route::get('/', 'Subscription\SubscriptionController@index')->name('index');
        Route::post('/', 'Subscription\SubscriptionController@store')->name('store');
        Route::post('/validate_email', 'Subscription\SubscriptionController@validate_email')->name('validate_email');
    }
);

/// Frontend section
Route::group(
    ['prefix' => '', 'as' => '', 'middleware' => []], function () {
        Route::get('/features', 'Frontend\FrontendController@features')->name('features');

        Route::get('/about-us', 'Frontend\FrontendController@aboutUs')->name('about_us');
        Route::get('/terms-of-service', 'Frontend\FrontendController@terms')->name('terms');
        Route::get('/privacy-policy', 'Frontend\FrontendController@privacyPolicy')->name('privacy_policy');
        Route::get('/acceptable-use-policy', 'Frontend\FrontendController@acceptableUsePolicy')->name('acceptable_use_policy');
        Route::get('/pricing', 'Frontend\FrontendController@pricing')->name('pricing');
        Route::get('/designs', 'Frontend\FrontendController@designs')->name('designs');
        Route::any('/support/{page?}', 'Frontend\KnowledgeBaseController@index')->name('knowledge_base')->where('page', '[1-9]+');
        Route::any('/support/search/{page?}', 'Frontend\KnowledgeBaseController@search')->name('knowledge_base_search')->where('page', '[1-9]+');
        Route::get('/support/{alias}', 'Frontend\KnowledgeBaseController@knowledge_base_post');
        Route::get('/support/category/{alias}', 'Frontend\KnowledgeBaseController@knowledge_category')->name('knowledge_base_category');
        Route::get('/careers', 'Frontend\FrontendController@careers')->name('careers');
        Route::get('/faq', 'Frontend\FrontendController@faq')->name('faq');
        Route::any('/blog/{id?}', 'Frontend\FrontendController@blog')->name('blog')->where('id', '[1-9]')->middleware('blogpaginate');
        Route::get(
            '/blog/{slug}', [
            'as' => 'app.blog.view',
            'uses' => 'Frontend\FrontendController@blogPost',
            ]
        );
        Route::get('/contact', 'Frontend\FrontendController@contact')->name('contact');
        Route::post('/contact', 'Frontend\FrontendController@store')->name('contact.store');
        Route::post('/reCaptcha', 'Frontend\FrontendController@reCaptcha')->name('reCaptcha');
        Route::get('/policy', 'Frontend\FrontendController@policy')->name('policy');        

        // Call to Actions
        Route::post('/cta/start-lead', 'Frontend\CtaController@storeLead')->name('cta_store_lead');
        Route::post('/cta/update-lead', 'Frontend\CtaController@updateLead')->name('cta_update_lead');
    }
);

// Webook
Route::post('/webhooks/stripe', 'Webhooks\StripeWebhookController@handleWebhook')->name('webhooks');


/*
 * Account
 */
Route::group(
    ['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.', 'namespace' => 'Admin'], function () {
        Route::get('/', 'AdminController@dashboard')->name('dashboard');
        Route::get('/blog', 'BlogController@index')->name('blog');
        Route::post('/blog_search_image', 'BlogController@search_image')->name('blog.search_image');
        Route::get('/blog/create', 'BlogController@create')->name('blog.create');
        Route::post('/blog/store', 'BlogController@store')->name('blog.store');
        Route::get('/blog/edit/{slug}', 'BlogController@edit')->name('blog.edit');
        Route::post('/blog/edit/{slug}', 'BlogController@update')->name('blog.update');
        Route::delete('blog/destroy', 'BlogController@destroy')->name('blog.destroy');
        Route::post('blog/activate', 'BlogController@activate')->name('blog.activate');
        Route::post('blog/deactivate', 'BlogController@deactivate')->name('blog.deactivate');
        Route::get('blog/autocomplete/', 'BlogController@autocomplete');
        Route::post('blog/search/', 'BlogController@search')->name('admin_blog_search');
        Route::post('blog/massdestroy', 'BlogController@massDestroy')->name('blog.massdestroy');
        Route::post('blog/deleteImage/{id}', 'BlogController@deleteFeatured');
        Route::get('settings/site', 'AdminController@site')->name('settings.site');
        Route::get('settings/seo', 'AdminController@seo')->name('settings.seo');
        Route::get('settings/get_seo/{seo}', 'AdminController@get_seo')->name('settings.get_seo');
        Route::post('settings/seo', 'AdminController@postSeo')->name('settings.update_seo');
        Route::get('settings/language', 'AdminController@language')->name('settings.language');
        Route::get('settings/downloads', 'AdminController@downloads')->name('settings.downloads');
        Route::Get('settings/downloads/{download}', 'AdminController@singleDownload')->name('settings.single_download');
        Route::post('settings/downlaods/update', 'AdminController@updateDownload')->name('settings.update_download');
        Route::post('settings/downloads', 'AdminController@postDownload')->name('settings.add_downloads');
        Route::post('settings/get_language', 'AdminController@get_language')->name('settings.get_language');
        Route::post('settings/update_language', 'AdminController@update_language')->name('settings.update_language');
        Route::post('settings/get_settings', 'AdminController@get_settings')->name('settings.get_settings');
        Route::post('settings/update_setting', 'AdminController@update_setting')->name('settings.update_setting');
        Route::get('settings/categories', 'AdminController@categories')->name('settings.categories');
        Route::get('settings/knowledgebase', 'AdminController@knowledgebase')->name('settings.knowledgebase');
        Route::get('settings/themes', 'AdminController@themes')->name('settings.themes');
        Route::get('/user', 'UserController@index')->name('user');
        Route::get('/user/edit/{id}', 'UserController@edit')->name('user.edit');
        Route::post('/user/edit/{id}', 'UserController@update')->name('user.update');
    }
);
