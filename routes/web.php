<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminTripController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\Gateways\PaytmController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\ManageBookingController;
use App\Http\Controllers\Admin\ManageEmployeeController;
use App\Http\Controllers\Admin\ManageGatewayController;
use App\Http\Controllers\Admin\ManageLanguageController;
use App\Http\Controllers\Admin\ManageProviderController;
use App\Http\Controllers\Admin\ManageSectionController;
use App\Http\Controllers\Admin\ManageServiceController;
use App\Http\Controllers\Admin\ManageSubscriptionController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\BonusController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\AgentCustomerRegController;
use App\Http\Controllers\Agent\AgentVendorRegController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\VendorRegistrationController;
use App\Http\Controllers\Employee\CustomerRegistrationController;

use App\Http\Controllers\Admin\ManageWithdrawController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SubAdminController;
use App\Http\Controllers\Auth\ForgotPasswordController as AuthForgotPasswordController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaypalPaymentController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\User\Customer\CustomerTripController;
use App\Http\Controllers\User\Provider\ProviderTripController;
use App\Http\Controllers\DistrictUnionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorksheetController;
use App\Http\Controllers\Admin\CouponController;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

Route::get('coin', [PaymentController::class, 'coinPayments']);
Route::middleware('demo')->group(function () {
    Route::get('/admin', function () {
        return redirect()->route('admin.login');
    });

    Route::get('/getDistricts/{division_id}', [DistrictUnionController::class, 'getDistricts']);
    Route::get('/getUpazilas/{district_id}', [DistrictUnionController::class, 'getUpazila']);
    Route::get('/getUnions/{upazila_id}', [DistrictUnionController::class, 'getUnion']);
    Route::post('/ajax-request', [DistrictUnionController::class, 'handleRequest']);


    Route::name('admin.')->prefix('admin')->group(function () {

        Route::get('login', [LoginController::class, 'login'])->name('login');
        Route::post('login', [LoginController::class, 'loggedIn'])->withoutMiddleware('demo');

        Route::get('forgot/password', [ForgotPasswordController::class, 'index'])->name('forgot.password');
        Route::post('forgot/password', [ForgotPasswordController::class, 'sendVerification']);
        Route::get('verify/code', [ForgotPasswordController::class, 'verify'])->name('auth.verify');
        Route::post('verify/code', [ForgotPasswordController::class, 'verifyCode']);
        Route::get('reset/password', [ForgotPasswordController::class, 'reset'])->name('reset.password');
        Route::post('reset/password', [ForgotPasswordController::class, 'resetPassword']);



        Route::middleware(['admin'])->group(function () {
            Route::get('dashboard', [AdminController::class, 'home'])->name('dashboard');

            Route::get('change/lang/{code?}', [AdminController::class, 'changeLang'])->name('change');

            Route::post('clear/database', [AdminController::class, 'clearDatabase'])->name('db.clear');

            Route::get('logout', [LoginController::class, 'logout'])->name('logout');

            Route::get('profile', [AdminController::class, 'profile'])->name('profile');
            Route::post('profile', [AdminController::class, 'profileUpdate'])->name('profile.update');

            Route::get('revenue-log', [AdminController::class, 'revenue'])->name('log');

            Route::get('login/setting', [AdminController::class, 'loginPage'])->name('login.setting');
            Route::post('login/setting', [AdminController::class, 'loginPageUpdate']);

            Route::post('change/password', [AdminController::class, 'changePassword'])->name('change.password');


            //Trips

            Route::get('trips', [AdminTripController::class, 'index'])->name('trips.index');
            Route::get('bidding', [AdminTripController::class, 'bidding'])->name('trips.bidding');
            Route::get('show_provider/trips/{bidding}', [AdminTripController::class, 'show_provider'])->name('trips.show_provider');
            Route::get('show_provider/bidding/{id}', [AdminTripController::class, 'show_provider_bidding'])->name('trips.show_provider_bidding');
            // Route::get('bidding/search',  [AdminTripController::class, 'index'])->name('bidding.search');

            //Work sheet
            Route::get('worksheet', [WorksheetController::class, 'admin_index'])->name('worksheet.index');
            //set target by admin
            Route::get('set_target/{id}', [WorksheetController::class, 'set_target'])->name('set_target.edit');
            //update target
            Route::post('update/target/{id}', [WorksheetController::class, 'update_target'])->name('target.update');
            //    Employee image preview
            Route::get('preview_image/{id}', [WorksheetController::class, 'image_view'])->name('image.view');
            Route::get('worksheet/{employee}', [WorksheetController::class, 'worksheet'])->name('worksheet.view');



            // Providers

            Route::get('providers', [ManageProviderController::class, 'index'])->name('provider');
            Route::get('providers/pending-provider', [ManageProviderController::class, 'pendingProvider'])->name('PendingProvider');
            Route::post('provider/send/mail/{provider}', [ManageProviderController::class, 'sendProviderMail'])->name('send.provider.mail')->middleware('subAdmin');
            Route::post('provider/update/{provider}', [ManageProviderController::class, 'providerUpdate'])->name('provider.update')->middleware('subAdmin');
            Route::get('provider/status/{id}', [ManageProviderController::class, 'providerStatus'])->name('providerStatus')->middleware('subAdmin');

            Route::get('providers/details/{provider}', [ManageProviderController::class, 'providerDetails'])->name('provider.details');
            Route::get('providers/search', [ManageProviderController::class, 'index'])->name('provider.search');
            Route::get('providers/featured', [ManageProviderController::class, 'featuredProvider'])->name('provider.featured');


            // Sub Admin

            Route::resource('sub-admin', SubAdminController::class)->middleware('subAdmin');

            // User

            Route::get('users', [ManageUserController::class, 'index'])->name('user');
            Route::get('new-users', [ManageUserController::class, 'newUser'])->name('newUser');

            Route::get('users/details/{user}', [ManageUserController::class, 'userDetails'])->name('user.details');
            Route::post('users/update/{user}', [ManageUserController::class, 'userUpdate'])->name('user.update')->middleware('subAdmin');
            Route::post('users/mail/{user}', [ManageUserController::class, 'sendUserMail'])->name('user.mail')->middleware('subAdmin');
            Route::get('users/search', [ManageUserController::class, 'index'])->name('user.search');
            Route::get('users/disabled', [ManageUserController::class, 'disabled'])->name('user.disabled')->middleware('subAdmin');

            Route::middleware(['subAdmin'])->group(function () {

                //Set Bonus
                Route::get('set', [BonusController::class, 'setbonus'])->name('set');
                Route::get('set/edit/{email}', [BonusController::class, 'edit_bonus'])->name('set.edit');
                Route::post('set/update/{id}', [BonusController::class, 'update'])->name('set.update');

                // Manage Agent
                Route::get('agents', [AgentController::class, 'index'])->name('agent');
                Route::get('agents/create', [AgentController::class, 'create'])->name('agent.create');
                Route::post('agents/store', [AgentController::class, 'store'])->name('agent.store');
                Route::get('agents/show/{agent}', [AgentController::class, 'show'])->name('agent.show');
                Route::get('agents/edit/{agent}', [AgentController::class, 'edit'])->name('agent.edit');
                Route::put('agents/update/{agent}', [AgentController::class, 'update'])->name('agent.update');
                Route::delete('agents/delete/{agent}', [AgentController::class, 'destroy'])->name('agent.destroy');
                Route::get('get-district/{id}', [AgentController::class, 'getDistrictByDivisionId'])->name('get-district');


                // Manage Employee

                Route::get('employees', [ManageEmployeeController::class, 'index'])->name('employee');
                Route::get('employees/create', [ManageEmployeeController::class, 'create'])->name('employee.create');
                Route::post('employees/store', [ManageEmployeeController::class, 'store'])->name('employee.store');
                Route::get('employees/edit/{id}', [ManageEmployeeController::class, 'edit'])->name('employee.edit');
                Route::get('employees/show/{employee}', [ManageEmployeeController::class, 'show'])->name('employee.show');
                Route::put('employees/update/{employee}', [ManageEmployeeController::class, 'update'])->name('employee.update');
                Route::delete('employees/delete/{employee}', [ManageEmployeeController::class, 'destroy'])->name('employee.destroy');
                Route::get('employees/crm', [ManageEmployeeController::class, 'crm'])->name('employee.crm');
                Route::get('employees/search', [ManageEmployeeController::class, 'search'])->name('employee_crm.search');
                Route::get('employees/view/crm/{id}', [ManageEmployeeController::class, 'view'])->name('employee_crm.view');
            }); //subadmin//

            //Reports

            Route::get('report/top-service', [ReportController::class, 'topService'])->name('topService');
            Route::get('report/trip-sale', [ReportController::class, 'tripReport'])->name('tripReport');

            Route::get('report/due_payment', [ReportController::class, 'duereport'])->name('dueReport');
            Route::get('report/due_payment/search', [ReportController::class, 'duereport'])->name('dueReport.search');


            Route::get('report/daily_due', [ReportController::class, 'dailyDue'])->name('dailydueReport');
            Route::get('report/daily_due/search', [ReportController::class, 'dailyDue'])->name('dailydueReport.search');
            Route::get('report/trip-sale/search', [ReportController::class, 'tripReport'])->name('tripReport.search');
            Route::get('report/agent-trip-sale', [ReportController::class, 'agentTripReport'])->name('agentTripReport');
            Route::get('report/agent-trip-sale/search', [ReportController::class, 'agentTripReport'])->name('agentTripReport.search');

            Route::get('report/vendor_due', [ReportController::class, 'vendorWiseReport'])->name('vendorWiseReport');

            Route::get('report/employee-trip-sale', [ReportController::class, 'employeeTripReport'])->name('employeeTripReport')->middleware('subAdmin');
            Route::get('report/employee-trip-sale/search', [ReportController::class, 'employeeTripReport'])->name('employeeTripReport.search')->middleware('subAdmin');
            Route::get('report/self-sale-report', [ReportController::class, 'selfSalesReport'])->name('selfSalesReport')->middleware('subAdmin');
            Route::get('report/self-sale-report/search', [ReportController::class, 'selfSalesReport'])->name('selfSalesReport.search')->middleware('subAdmin');
            Route::get('report/transaction-report', [ReportController::class, 'transactionReport'])->name('transactionReport')->middleware('subAdmin');
            Route::get('report/transaction-report/search', [ReportController::class, 'transactionReport'])->name('transactionReport.search')->middleware('subAdmin');
            Route::get('report/total-earning-report', [ReportController::class, 'totalEarningReport'])->name('totalEarningReport')->middleware('subAdmin');
            Route::get('report/total-earning-report/search', [ReportController::class, 'totalEarningReport'])->name('totalEarningReport.search')->middleware('subAdmin');


            // Manage Service

            Route::get('service', [ManageServiceController::class, 'index'])->name('service');
            Route::get('service/search', [ManageServiceController::class, 'index'])->name('service.search');
            Route::get('service/review/{service}', [ManageServiceController::class, 'reviewMessage'])->name('service.message');
            Route::post('service/review/{service}', [ManageServiceController::class, 'reviewMessageUpdate']);
            Route::post('service/accept/{service}', [ManageServiceController::class, 'acceptService'])->name('service.accept');
            Route::post('service/reject/{service}', [ManageServiceController::class, 'rejectService'])->name('service.reject');

            Route::get('blog/comments', [AdminController::class, 'blogComment'])->name('blog.comment');
            Route::post('blog/comments/{comment}', [AdminController::class, 'blogCommentUpdate'])->name('blog.comment.update');

            Route::middleware(['subAdmin'])->group(function () {
                // bookings

                Route::get('bookings', [ManageBookingController::class, 'index'])->name('bookings');
                Route::get('bookings/search', [ManageBookingController::class, 'index'])->name('bookings.search');
                Route::get('bookings/completed', [ManageBookingController::class, 'completed'])->name('bookings.completed');
                Route::get('bookings/incomplete', [ManageBookingController::class, 'inCompleted'])->name('bookings.incomplete');
                Route::post('bookings/complete/{booking}', [ManageBookingController::class, 'bookingComplete'])->name('bookings.complete');
                Route::post('bookings/delete/{booking}', [ManageBookingController::class, 'bookingDelete'])->name('bookings.delete');
                Route::get('bookings/job/end', [ManageBookingController::class, 'endJobs'])->name('bookings.end.job');

                Route::post('booking/contract/{booking}', [ManageBookingController::class, 'bookingEndContract'])->name('bookings.end.contract');

                // Category
                Route::resource('category', CategoryController::class);

                //Coupon History
                Route::get('coupon/index', [CouponController::class, 'index'])->name('coupon.index');
                Route::get('coupon/create', [CouponController::class, 'coupon_create'])->name('coupon.create');
                Route::post('coupon/store', [CouponController::class, 'store'])->name('coupon.store');
                Route::get('coupon/{id}/edit', [CouponController::class, 'edit'])->name('coupon.edit');
                Route::delete('coupon/{id}', [CouponController::class, 'destroy'])->name('coupon.destroy');
                Route::put('update/coupon/{id}', [CouponController::class, 'update'])->name('coupon.update');



                // frontend section

                Route::get('pages', [PagesController::class, 'index'])->name('frontend.pages');
                Route::get('pages/create', [PagesController::class, 'pageCreate'])->name('frontend.pages.create');
                Route::post('pages/create', [PagesController::class, 'pageInsert']);
                Route::get('pages/edit/{page}', [PagesController::class, 'pageEdit'])->name('frontend.pages.edit');
                Route::post('pages/edit/{page}', [PagesController::class, 'pageUpdate']);
                Route::get('pages/search', [PagesController::class, 'index'])->name('frontend.search');
                Route::post('pages/delete/{page}', [PagesController::class, 'pageDelete'])->name('frontend.pages.delete');


                Route::get('manage/section', [ManageSectionController::class, 'index'])->name('frontend.section');

                Route::get('manage/section/{name}', [ManageSectionController::class, 'section'])->name('frontend.section.manage');
                Route::post('manage/section/{name}', [ManageSectionController::class, 'sectionContentUpdate']);

                Route::get('manage/element/{name}', [ManageSectionController::class, 'sectionElement'])->name('frontend.element');

                Route::get('manage/element/{name}/search', [ManageSectionController::class, 'section'])->name('frontend.element.search');

                Route::post('manage/element/{name}', [ManageSectionController::class, 'sectionElementCreate']);
                Route::get('edit/{name}/element/{element}', [ManageSectionController::class, 'editElement'])->name('frontend.element.edit');
                Route::post('edit/{name}/element/{element}', [ManageSectionController::class, 'updateElement']);

                Route::post('delete/{name}/element/{element}', [ManageSectionController::class, 'deleteElement'])->name('frontend.element.delete');

                Route::get('blog-category', [ManageSectionController::class, 'blogCategory'])->name('frontend.blog');
                Route::post('blog-category', [ManageSectionController::class, 'blogCategoryStore']);
                Route::post('blog-category/{blog}', [ManageSectionController::class, 'blogCategoryUpdate'])->name('frontend.blog.update');
                Route::post('blog-category/delete/{blog}', [ManageSectionController::class, 'blogCategoryDelete'])->name('frontend.blog.delete');

                Route::get('faq-category', [ManageSectionController::class, 'faqCategory'])->name('frontend.faq');
                Route::post('faq-category', [ManageSectionController::class, 'faqCategoryStore']);
                Route::post('faq-category/{faq}', [ManageSectionController::class, 'faqCategoryUpdate'])->name('frontend.faq.update');
                Route::post('faq-category/delete/{faq}', [ManageSectionController::class, 'faqCategoryDelete'])->name('frontend.faq.delete');

                Route::get('banner/chenge', [GeneralSettingController::class, 'banner'])->name('banner.chenge');
                Route::post('/save-banner', [GeneralSettingController::class, 'saveBanner'])->name('save.banner');

                Route::get('general/setting', [GeneralSettingController::class, 'index'])->name('general.setting');
                Route::post('general/setting', [GeneralSettingController::class, 'generalSettingUpdate']);



                Route::get('general/preloader', [GeneralSettingController::class, 'preloader'])->name('general.preloader');
                Route::post('general/preloader', [GeneralSettingController::class, 'preloaderUpdate']);

                Route::get('general/analytics', [GeneralSettingController::class, 'analytics'])->name('general.analytics');
                Route::post('general/analytics', [GeneralSettingController::class, 'analyticsUpdate']);


                Route::get('general/cookie/consent', [GeneralSettingController::class, 'cookieConsent'])->name('general.cookie');
                Route::post('general/cookie/consent', [GeneralSettingController::class, 'cookieConsentUpdate']);

                Route::get('general/google/rechaptcha', [GeneralSettingController::class, 'rechaptcha'])->name('general.rechaptcha');
                Route::post('general/google/rechaptcha', [GeneralSettingController::class, 'rechaptchaUpdate']);

                Route::get('general/live/chat', [GeneralSettingController::class, 'liveChat'])->name('general.live.chat');
                Route::post('general/live/chat', [GeneralSettingController::class, 'liveChatUpdate']);


                Route::get('general/seo/manage', [GeneralSettingController::class, 'seoManage'])->name('general.seo');
                Route::post('general/seo/manage', [GeneralSettingController::class, 'seoManageUpdate']);
            }); //SubadminMiddleware//

            // payment Section

            Route::get('gateway/bank', [ManageGatewayController::class, 'bank'])->name('payment.bank');
            Route::post('gateway/bank', [ManageGatewayController::class, 'bankUpdate']);

            Route::get('gateway/paypal', [ManageGatewayController::class, 'paypal'])->name('payment.paypal');
            Route::post('gateway/paypal', [ManageGatewayController::class, 'paypalUpdate']);

            Route::get('gateway/stripe', [ManageGatewayController::class, 'stripe'])->name('payment.stripe');
            Route::post('gateway/stripe', [ManageGatewayController::class, 'stripeUpdate']);

            Route::get('gateway/coin', [ManageGatewayController::class, 'coin'])->name('payment.coin');
            Route::post('gateway/coin', [ManageGatewayController::class, 'coinUpdate']);

            Route::get('gateway/razorpay', [ManageGatewayController::class, 'razorpay'])->name('payment.razorpay');
            Route::post('gateway/razorpay', [ManageGatewayController::class, 'razorpayUpdate']);

            Route::get('gateway/flutterwave', [ManageGatewayController::class, 'flutterwave'])->name('payment.flutterwave');
            Route::post('gateway/flutterwave', [ManageGatewayController::class, 'flutterwaveUpdate']);

            Route::get('gateway/paystack', [ManageGatewayController::class, 'paystack'])->name('payment.paystack');
            Route::post('gateway/paystack', [ManageGatewayController::class, 'paystackUpdate']);

            Route::get('gateway/mollie', [ManageGatewayController::class, 'mollie'])->name('payment.mollie');
            Route::post('gateway/mollie', [ManageGatewayController::class, 'mollieUpdate']);

            Route::get('gateway/instamojo', [ManageGatewayController::class, 'instamojo'])->name('payment.instamojo');
            Route::post('gateway/instamojo', [ManageGatewayController::class, 'instamojoUpdate']);

            Route::get('gateway/paymongo', [ManageGatewayController::class, 'paymongo'])->name('payment.paymongo');
            Route::post('gateway/paymongo', [ManageGatewayController::class, 'paymongoUpdate']);


            Route::get('manual/payments', [ManageGatewayController::class, 'manualPayment'])->name('manual');
            Route::get('manual/payments/{trx}', [ManageGatewayController::class, 'manualPaymentDetails'])->name('manual.trx');
            Route::post('manual/payments/accept/{trx}', [ManageGatewayController::class, 'manualPaymentAccept'])->name('manual.accept');
            Route::post('manual/payments/reject/{trx}', [ManageGatewayController::class, 'manualPaymentReject'])->name('manual.reject');

            // withdraw Module

            Route::get('withdraw/method', [ManageWithdrawController::class, 'index'])->name('withdraw');
            Route::get('withdraw/method/search', [ManageWithdrawController::class, 'index'])->name('withdraw.search');
            Route::post('withdraw/method', [ManageWithdrawController::class, 'withdrawMethodCreate']);
            Route::post('withdraw/edit/{method}', [ManageWithdrawController::class, 'withdrawMethodUpdate'])->name('withdraw.update');
            Route::post('withdraw/delete/{method}', [ManageWithdrawController::class, 'withdrawMethodDelete'])->name('withdraw.delete');

            Route::get('withdraw/pending', [ManageWithdrawController::class, 'pending'])->name('withdraw.pending');
            Route::get('withdraw/accepted', [ManageWithdrawController::class, 'accepted'])->name('withdraw.accepted');
            Route::get('withdraw/rejected', [ManageWithdrawController::class, 'rejected'])->name('withdraw.rejected');

            Route::post('withdraw/accept/{withdraw}', [ManageWithdrawController::class, 'withdrawAccept'])->name('withdraw.accept');
            Route::post('withdraw/reject/{withdraw}', [ManageWithdrawController::class, 'withdrawReject'])->name('withdraw.reject');

            //Email Configure Section

            Route::get('email/config', [EmailTemplateController::class, 'emailConfig'])->name('email.config');
            Route::post('email/config', [EmailTemplateController::class, 'emailConfigUpdate']);

            Route::get('email/templates', [EmailTemplateController::class, 'emailTemplates'])->name('email.templates');

            Route::get('email/templates/{template}', [EmailTemplateController::class, 'emailTemplatesEdit'])->name('email.templates.edit');
            Route::post('email/templates/{template}', [EmailTemplateController::class, 'emailTemplatesUpdate']);

            // transaction

            Route::get('transaction', [AdminController::class, 'transaction'])->name('transaction');

            // Subscription

            Route::get('subscription', [ManageSubscriptionController::class, 'index'])->name('subscription');
            Route::post('subscription/email/all', [ManageSubscriptionController::class, 'sendEmailToAll'])->name('subscription.all');
            Route::post('subscription/email/single/{id}', [ManageSubscriptionController::class, 'sendEmailSubscriber'])->name('subscription.single');
            Route::post('subscription/delete/{id}', [ManageSubscriptionController::class, 'deleteSubscriber'])->name('subscription.delete');

            Route::get('navbar', [ManageLanguageController::class, 'navbarText'])->name('language.navbar');
            Route::post('navbar', [ManageLanguageController::class, 'navbarTextUpdate']);
            Route::get('website-text', [ManageLanguageController::class, 'websiteText'])->name('language.website');
            Route::post('website-text', [ManageLanguageController::class, 'websiteTextUpdate']);

            Route::get('validation-text', [ManageLanguageController::class, 'validationText'])->name('language.validation');
            Route::post('validation-text', [ManageLanguageController::class, 'validationTextUpdate']);
        });
    });

    Route::middleware(['agentemployee'])->group(function () {
        //Agent
        Route::get('agent-dashboard', [AgentDashboardController::class, 'dashboard'])->name('agent.dashboard');
        Route::get('agent/Profile', [AgentDashboardController::class, 'profile'])->name('agent.profile');
        Route::get('agent-Profile/{id}/edit', [AgentDashboardController::class, 'edit_profile'])->name('agent.editProfile');
        Route::put('agent-profile-update/{id}}', [AgentDashboardController::class, 'profile_update'])->name('agent.updateProfile');
        Route::get('agent-change-pass', [AgentDashboardController::class, 'password'])->name('agent.password');
        Route::post('agent-change-pass', [AgentDashboardController::class, 'changePassword'])->name('agent.changePassword');

        Route::resource('agent-customer', AgentCustomerRegController::class);
        Route::resource('agent-vendor', AgentVendorRegController::class);

        Route::get('agent/search', [AgentDashboardController::class, 'search'])->name('agent.search');
        Route::get('agent/src', [AgentDashboardController::class, 'agentindex'])->name('agent.index1');

        Route::get('agent/confirm-order', [AgentDashboardController::class, 'confirm_order'])->name('agent.confirmOrder');
        Route::get('agent/running-order', [AgentDashboardController::class, 'running_order'])->name('agent.runningOrder');
        Route::get('agent/cancel-order', [AgentDashboardController::class, 'cancel_order'])->name('agent.cancelOrder');
        Route::get('agent/performance', [AgentDashboardController::class, 'performance'])->name('agent.performance');
        Route::get('agent/reg-link', [AgentDashboardController::class, 'reg_link'])->name('agent.regLink');
        Route::get('agent/workshit', [AgentDashboardController::class, 'workshit'])->name('agent.workshit');


        Route::get('employee-dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
        Route::get('employee/Profile', [EmployeeController::class, 'profile'])->name('employee.profile');
        Route::get('employee/Profile/{id}/edit', [EmployeeController::class, 'edit_profile'])->name('employee.editProfile');
        Route::put('profile-update/{id}', [EmployeeController::class, 'profile_update'])->name('employee.updateProfile');
        Route::get('change-pass', [EmployeeController::class, 'password'])->name('password');
        Route::post('change-pass', [EmployeeController::class, 'changePassword'])->name('changePassword');
        Route::get('employee/search-employee', [EmployeeController::class, 'searchEmployee'])->middleware('check.employee.role')->name('search.employee');
        Route::get('employee/employee-search', [EmployeeController::class, 'searchindex'])->middleware('check.employee.role')->name('employee.search_index');
        Route::get('employee/worksheet', [EmployeeController::class, 'worksheet'])->name('employee.worksheet');
        Route::get('employee/todays-reg', [EmployeeController::class, 'todaysReg'])->name('employee.todaysReg');
        Route::get('employee/total-reg', [EmployeeController::class, 'totalReg'])->name('employee.totalReg');
        // upload.selfie
        Route::post('selfie_upload/{id}', [EmployeeController::class, 'uploadSelfie'])->name('upload.selfie');
        Route::get('upload_selfie/{id}', [EmployeeController::class, 'uploadpage'])->name('upload2.selfie');
        Route::get('preview_image/{id}', [EmployeeController::class, 'image_view'])->name('view.image');



        Route::resource('vendor', VendorRegistrationController::class);
        Route::resource('employee-customer', CustomerRegistrationController::class);
        Route::get('employee/confirm-order', [EmployeeController::class, 'confirm_order'])->name('employee.confirmOrder');
        Route::get('employee/running-order', [EmployeeController::class, 'running_order'])->name('employee.runningOrder');
        Route::get('employee/cancel-order', [EmployeeController::class, 'cancel_order'])->name('employee.cancelOrder');
        Route::get('employee/performance', [EmployeeController::class, 'performance'])->name('employee.performance');
        Route::get('employee/reg-link', [EmployeeController::class, 'reg_link'])->name('employee.regLink');
        Route::get('employee/working-days', [EmployeeController::class, 'working_days'])->name('employee.workingDays');
        Route::get('employee/vendor-customer-location', [EmployeeController::class, 'vendor_customer_location'])->name('employee.vendorcustomerLocation');
    });


    Route::name('user.')->prefix('user')->group(function () {

        Route::get('payment/verification', [PaymentController::class, 'verifyPayment'])->name('verify_payment');

        Route::middleware('guest')->group(function () {
            Route::get('register', [RegisterController::class, 'index'])->name('register')->middleware('reg_off');
            Route::post('register', [RegisterController::class, 'register'])->middleware('reg_off');
            Route::get('login', [AuthLoginController::class, 'index'])->name('login');
            Route::post('login', [AuthLoginController::class, 'login'])->withoutMiddleware('demo');
            Route::get('mobile-otp-verification/{token}', [RegisterController::class, 'mobileVerification']);
            Route::post('mobile-otp-verified', [RegisterController::class, 'mobileVerifed']);
            Route::post('mobile-otp-resend', [RegisterController::class, 'mobileotpresend']);

            Route::get('forgot/password', [AuthForgotPasswordController::class, 'index'])->name('forgot.password');
            Route::post('forgot/password', [AuthForgotPasswordController::class, 'sendVerification']);
            Route::get('verify/code', [AuthForgotPasswordController::class, 'verify'])->name('auth.verify');
            Route::post('verify/code', [AuthForgotPasswordController::class, 'verifyCode']);
            Route::get('reset/password', [AuthForgotPasswordController::class, 'reset'])->name('reset.password');
            Route::post('reset/password', [AuthForgotPasswordController::class, 'resetPassword']);

            Route::get('verify/email', [AuthLoginController::class, 'emailVerify'])->name('email.verify');
            Route::post('verify/email', [AuthLoginController::class, 'emailVerifyConfirm'])->name('email.verify');
        });


        Route::middleware(['auth', 'profile_is_update', 'inactive'])->group(function () {
            Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');



            Route::get('logout', [RegisterController::class, 'signOut'])->name('logout')->withoutMiddleware('profile_is_update');

            Route::get('profile/setting', [UserController::class, 'profile'])->name('profile')->withoutMiddleware('profile_is_update');
            Route::put('profile/setting/{id}', [UserController::class, 'profileUpdate'])->name('profile.update')->withoutMiddleware('profile_is_update');

            Route::get('change/password', [UserController::class, 'changePassword'])->name('change.password');
            Route::post('change/password', [UserController::class, 'changePasswordUpdate']);

            Route::post('booking/{service}', [BookingController::class, 'booking'])->name('booking');

            Route::get('bookings', [BookingController::class, 'allBookings'])->name('bookings');
            Route::get('bookings/search', [BookingController::class, 'allBookings'])->name('bookings.search');
            Route::post('bookings/complete/{id}', [BookingController::class, 'bookingCompleted'])->name('bookings.complete');

            Route::get('payment/{booking}', [PaymentController::class, 'gateways'])->name('pay.bill');
            Route::post('payment/{booking}', [PaymentController::class, 'payment']);

            Route::post('payment/{booking}/{stripe}', [PaymentController::class, 'stripePost'])->name('stripe.post');
            Route::post('paypal/payment/{booking}/{paypal}', [PaymentController::class, 'paypalPost'])->name('paypal.post');
            Route::get('paypal', [PaypalPaymentController::class, 'ipn'])->name('paypal');

            Route::post('coin/payment/{booking}/{coinpayments}', [PaymentController::class, 'coinPost'])->name('coin.post');
            Route::post('coin/pay', [PaymentController::class, 'coinPay'])->name('coin.pay');
            Route::get('transaction', [UserController::class, 'transaction'])->name('transaction');

            Route::post('bank/payment/{booking}/{bank}', [PaymentController::class, 'bankPayment'])->name('bank.post');

            Route::post('pay-with-razorpay/{booking_id}', [PaymentController::class, 'payWithRazorpay'])->name('pay.with.razorpay');

            Route::post('pay-with-flutterwave', [PaymentController::class, 'payWithFlutterwave'])->name('pay.with.flutterwave');
            Route::post('pay-with-paystack', [PaymentController::class, 'payWithPaystack'])->name('pay.with.paystack');


            Route::get('mollie-payment/{id}', [PaymentController::class, 'molliePayment'])->name('mollie-payment');
            Route::get('/mollie-payment-success', [PaymentController::class, 'molliePaymentSuccess'])->name('mollie-payment-success');
            Route::get('/pay-with-instamojo/{id}', [PaymentController::class, 'payWithInstamojo'])->name('pay-with-instamojo');
            Route::get('/instamojo-response', [PaymentController::class, 'instamojoResponse'])->name('instamojo-response');

            Route::get('/paymongo/{booking_id}', [PaymentController::class, 'paymongoPage'])->name('paymongo');
            Route::post('/pay-with-paymongo/{id}', [PaymentController::class, 'payWithPaymongo'])->name('pay-with-paymongo');
            Route::get('/pay-with-grab-pay/{id}', [PaymentController::class, 'payWithPaymongoGrabPay'])->name('pay-with-grab-pay');
            Route::get('/pay-with-gcash/{id}', [PaymentController::class, 'payWithPaymongoGcash'])->name('pay-with-gcash');
            Route::get('/paymongo-payment-success', [PaymentController::class, 'paymongoPaymentSuccess'])->name('paymongo-payment-success');
            Route::get('/paymongo-payment-cancled', [PaymentController::class, 'paymongoPaymentCancled'])->name('paymongo-payment-cancled');


            //Trip ip Infonfo

            Route::get('trip-info', [CustomerTripController::class, 'index'])->name('trip-info.index');
            Route::get('trip-info/show-bidding/{id}', [CustomerTripController::class, 'show'])->name('trip-info.show');
            Route::get('all-bid', [CustomerTripController::class, 'allBid'])->name('allBid');
            Route::get('see-bidding/{vehicle_id}', [CustomerTripController::class, 'seeBidding'])->name('seeBidding');

            Route::post('trip-info/create-step-one', [CustomerTripController::class, 'postCreateStepOne'])->name('trip-info.create-step-one.post')->withoutMiddleware(['auth', 'profile_is_update', 'inactive']);
            Route::get('trip-info/create-step-two', [CustomerTripController::class, 'createStepTwo'])->name('trip-info.create-step-two');
            Route::post('trip-info/create-step-two', [CustomerTripController::class, 'postCreateStepTwo'])->name('trip-info.create-step-two.post');
            Route::post('trip-info/create-step-two-bike', [CustomerTripController::class, 'postCreateStepTwoBikeBrand'])->name('trip-info.create-step-two-bike-brand.post');
            // Route::post('trip-info/create-step-two-bike-brand', [CustomerTripController::class, 'postCreateBikeBrand'])->name('trip-info.create-bike-brand.post');

            Route::get('trip-info/accept-bid/{trip_id}/{bidding_id}', [CustomerTripController::class, 'acceptBid'])->name('trip-info.accept-bid');

            Route::get('trip-info/reject-bid/{trip_id}/{bidding_id}', [CustomerTripController::class, 'rejectBid'])->name('trip-info.reject-bid');

            Route::middleware('service_provider')->group(function () {

                Route::get('chat/provider/{transaction}', [UserController::class, 'chatProvider'])->name('chat.provider');
                Route::post('chat/provider/{transaction}', [UserController::class, 'chatSendProvider'])->name('chat.provider');
                // Route::get('verify/payment', [PaymentController::class, 'verifyPayment'])->name('verify_payment');

                // Provider Trip
                Route::get('provider-trip/bid-confirm/{id}', [ProviderTripController::class, 'confirm_bid'])->name('provider-trip-bid-confirm');
                Route::post('provider-trip/bid-confirm/bid/{id}', [ProviderTripController::class, 'bidding'])->name('trip.provider.bidding');
                Route::post('provider-trip/payment-confirm/{id}', [ProviderTripController::class, 'payment'])->name('trip.provider.payment');
                Route::resource('provider-trip', ProviderTripController::class);

                //provider dashboard
                Route::get('dashboard/{vehicle_id}', [UserController::class, 'vehicleDashboard'])->name('vehicle.dashboard');
                Route::get('dashboard/trips/{vehicle_id}', [UserController::class, 'vehicleTripDashboard'])->name('vehicle.trip_dashboard');
                Route::get('dashboard/bid-trips/{vehicle_id}', [UserController::class, 'vehicleBidTrips'])->name('vehicle.bid_trips');

                Route::get('service/all', [ServiceProviderController::class, 'index'])->name('service');
                Route::get('service/create/{vehicle_id}', [ServiceProviderController::class, 'createService'])->name('service.create');
                Route::post('service/create', [ServiceProviderController::class, 'storeService'])->name('service.store');

                Route::get('service/edit/{service}', [ServiceProviderController::class, 'serviceEdit'])->name('service.edit');
                Route::put('service/edit/{service}', [ServiceProviderController::class, 'serviceUpdate'])->name('service.serviceUpdate');
                Route::post('service/delete/{service}', [ServiceProviderController::class, 'serviceDelete'])->name('service.delete');

                Route::get('service/search', [ServiceProviderController::class, 'index'])->name('service.search');

                Route::get('service/schedule', [ServiceProviderController::class, 'schedule'])->name('service.schedule');
                Route::post('service/schedule', [ServiceProviderController::class, 'scheduleCreate']);
                Route::post('service/schedule/{schedule}/update', [ServiceProviderController::class, 'scheduleUpdate'])->name('service.schedule.update');
                Route::post('service/schedule/{schedule}/delete', [ServiceProviderController::class, 'scheduleDelete']);

                Route::get('service/booking', [BookingController::class, 'serviceBooking'])->name('provider.booking');
                Route::get('service/booking/search', [BookingController::class, 'serviceBooking'])->name('provider.booking.search');
                Route::post('service/booking/{booking}/accept', [BookingController::class, 'serviceBookingAccept'])->name('service.booking.accept');
                Route::post('service/booking/{booking}/reject', [BookingController::class, 'serviceBookingReject'])->name('service.booking.reject');
                Route::post('contract/end/{booking}', [BookingController::class, 'endContract'])->name('end.contract');


                Route::get('withdraw', [UserController::class, 'withdraw'])->name('withdraw');
                Route::get('withdraw/all', [UserController::class, 'allWithdraw'])->name('withdraw.all');
                Route::get('withdraw/pending', [UserController::class, 'pendingWithdraw'])->name('withdraw.pending');
                Route::post('withdraw', [UserController::class, 'withdrawCompleted']);
                Route::get('withdraw/fetch/{id}', [UserController::class, 'withdrawFetch'])->name('withdraw.fetch');

                Route::get('chat/{transaction}', [UserController::class, 'chat'])->name('chat');
                Route::post('chat/{transaction}', [UserController::class, 'chatSend'])->name('chat');
            });
        });
    });


    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('upcoming', [HomeController::class, 'upcoming'])->name('upcoming');

    Route::get('service/{name}', [HomeController::class, 'serviceRedirecting'])->name('home.service');

    Route::post('subscribe', [HomeController::class, 'subscribe'])->name('subscribe');

    Route::get('contact', [HomeController::class, 'contact'])->name('contact');

    Route::post('contact', [HomeController::class, 'contactSend'])->name('contact');

    //customer trip create form
    Route::get('trip-info/create-step-one', [CustomerTripController::class, 'createStepOne'])->name('user.trip-info.create-step-one');

    Route::get('experts/{user}', [HomeController::class, 'userDetails'])->name('service.provider.details');

    Route::get('blog/{blog}-{slug}', [HomeController::class, 'blogDetails'])->name('blog.details');
    Route::get('blog/category/{category}', [HomeController::class, 'blogCategory'])->name('blog.category');
    Route::post('blog/comment/{id}', [HomeController::class, 'blogComment'])->name('blog.comment');



    Route::get('service/{id}', [HomeController::class, 'serviceDetails'])->name('service.details');


    Route::get('search/experts', [HomeController::class, 'searchExperts'])->name('experts.search');

    Route::get('category', [HomeController::class, 'categoryAll'])->name('category.all');


    Route::get('policy/{policy}', [HomeController::class, 'policy'])->name('policy');

    Route::get('category/{slug}', [HomeController::class, 'categoryDetails'])->name('category.details');



    Route::post('send/provider/{id}', [HomeController::class, 'sendproviderMail'])->name('send.provider.email');

    Route::post('write/review/{service}', [HomeController::class, 'writeReview'])->name('review');

    Route::get('{pagename}', [HomeController::class, 'pages'])->name('pages');
});
