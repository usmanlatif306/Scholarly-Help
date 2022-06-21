<?php
Route::prefix('admin')->group(function () {
	Route::post('dashboard/statistics', 'DashboardController@statistics')
		->name('dashboard_statistics');
	Route::get('dashboard/activities', 'DashboardController@fetchActivities')
		->name('dashboard_activities');

	Route::get('/orders', 'OrderController@index')
		->name('orders_list');

	Route::get('orders/{order}/follow', 'OrderController@follow')
		->name('orders_follow');

	Route::get('orders/{order}/unfollow', 'OrderController@unfollow')
		->name('orders_unfollow');

	Route::get('orders/{order}/archive', 'OrderController@archive')
		->name('orders_archive');

	Route::get('orders/{order}/unarchive', 'OrderController@unarchive')
		->name('orders_unarchive');


	Route::post('/datatable/orders', 'OrderController@datatable')
		->name('orders_datatable');

	Route::post('orders/{order}/status/change', 'OrderController@change_status')
		->name('order_change_status');

	Route::post('task/assign/{order}', 'TaskController@assign_task')
		->name('assign_task');

	Route::get('orders/{order}/destroy', 'OrderController@destroy')
		->name('orders_destroy');


	Route::get('/report/wallet/balance', 'ReportController@totalWalletBlance')
		->name('total_wallet_balance');

	Route::get('/report/statement/income', 'ReportController@income_statement')
		->name('income_statement');

	Route::post('/report/graph/income', 'ReportController@income_graph')
		->name('income_graph');

	Route::get('/activity/log', 'ReportController@activity_log')
		->name('activity_log');

	Route::post('/activity/log', 'ReportController@datatable_activity_log')
		->name('datatable_activity_log');

	Route::get('/activity/log/delete', 'ReportController@destroy_activity')
		->name('activity_log_delete');


	Route::prefix('users')->group(function () {

		Route::get('/', 'UserController@index')
			->name('users_list');

		Route::post('/paginate', 'UserController@paginate')
			->name('datatable_users');

		Route::get('/invitation', 'UserController@invitation')
			->name('user_invitation');

		Route::post('/invitation', 'UserController@send_invitation')
			->name('send_invitation');

		Route::get('/{user}/edit', 'UserController@edit')
			->name('users_edit')
			->where('user', '[0-9]+');

		Route::get('/{user}', 'UserController@show')
			->name('user_profile')
			->where('user', '[0-9]+');

		Route::post('/{user}/photo/change', 'UserController@change_photo')
			->name('users_change_photo')
			->where('user', '[0-9]+');

		Route::patch('/{user}', 'UserController@update')
			->name('users_update')
			->where('user', '[0-9]+');

		Route::delete('/{user}/delete', 'UserController@destroy')
			->name('users_destroy')
			->where('user', '[0-9]+');
		Route::get('/calculates', 'UserController@calculates')
			->name('user_calculates');
	});

	Route::prefix('bills')->group(function () {

		Route::get('/', 'BillController@index')
			->name('bills_list');

		Route::post('/paginate', 'BillController@datatable')
			->name('datatable_bills');

		Route::get('/{bill}', 'BillController@show')
			->name('bills_show');

		Route::post('/{bill}/status/change/paid', 'BillController@mark_as_paid')
			->name('bill_mark_as_paid');

		Route::post('/{bill}/status/change/unpaid', 'BillController@mark_as_unpaid')
			->name('bill_mark_as_unpaid');
	});

	Route::prefix('settings')->group(function () {

		Route::get('/cache', 'SettingsController@clear_cache_page')
			->name('clear_cache_page');

		Route::post('/cache', 'SettingsController@clear_cache')
			->name('post_clear_cache');

		Route::get('/', 'SettingsController@general_information')
			->name('settings_main_page');

		Route::patch('/', 'SettingsController@update_general_information')
			->name('patch_general_information');

		Route::get('email', 'SettingsController@email')
			->name('settings_email_page');

		Route::patch('email/update', 'SettingsController@update_email')
			->name('patch_settings_email');

		Route::get('/email/test', 'SettingsController@test_email')
			->name('send_test_email');

		Route::post('/email/test', 'SettingsController@send_test_email')
			->name('post_test_email');

		Route::get('google-analytics', 'SettingsController@google_analytics')
			->name('google_analytics');

		Route::patch('google-analytics', 'SettingsController@update_google_analytics')
			->name('patch_google_analytics');

		Route::get('seo', 'SettingsController@seo')
			->name('seo_page');

		Route::patch('seo', 'SettingsController@update_seo')
			->name('patch_seo');


		Route::get('/logo', 'SettingsController@logo_page')
			->name('settings_logo_page');

		Route::post('/logo', 'SettingsController@update_logo')
			->name('update_logo');

		// Guarantees
		Route::resource('guarantees', 'ChoiceController');

		// Services
		Route::resource('service', 'QualityController');

		// past works
		Route::resource('works', 'PastWorkController');
		Route::get('/delete/{work}', 'PastWorkController@destroy')
			->name('works_delete');
		Route::post('/works/paginate', 'PastWorkController@datatable')
			->name('works_datatable');

		// promo codes
		Route::resource('promos', 'PromoCodeController');
		Route::get('/generate', 'PromoCodeController@generateCode')->name('generate_promo_code');
		Route::get('promos/delete/{promo}', 'PromoCodeController@destroy')
			->name('promos_delete');
		Route::post('/promos/paginate', 'PromoCodeController@datatable')
			->name('promos_datatable');

		// Testimonial
		Route::resource('testimonials', 'TestimonialController');

		// Tutors
		Route::resource('tutors', 'TutorController');

		// FAQ's
		Route::get('faqs', 'SettingsController@faqs')
			->name('settings_show_faqs');
		Route::post('/paginate', 'SettingsController@faqDatatable')
			->name('faq_datatable');

		Route::get('faqs/create', 'SettingsController@createFaqs')
			->name('settings_create_faqs');
		Route::post('faqs/store', 'SettingsController@storeFaqs')
			->name('settings_store_faqs');
		Route::get('faqs/{faq}', 'SettingsController@editFaqs')
			->name('settings_edit_faqs');
		Route::put('faqs/{faq}', 'SettingsController@updateFaqs')
			->name('settings_update_faqs');
		Route::get('faqs/delete/{faq}', 'SettingsController@deleteFaq')
			->name('settings_delete_faqs');

		Route::get('content/{slug}', 'SettingsController@content')
			->name('settings_edit_content');

		Route::patch('content/{slug}', 'SettingsController@update_content')
			->name('settings_update_content');

		Route::get('/homepage', 'SettingsController@homepage')
			->name('settings_homepage');

		Route::patch('/homepage', 'SettingsController@update_homepage')
			->name('patch_settings_homepage');

		Route::post('/homepage/image', 'SettingsController@update_homepage_image')
			->name('update_homepage_image');

		Route::get('/currency', 'SettingsController@currency')
			->name('settings_currency_page');

		Route::patch('/currency', 'SettingsController@update_currency')
			->name('patch_settings_currency');

		Route::get('/staff', 'SettingsController@staff')
			->name('settings_staff_page');

		Route::patch('/staff', 'SettingsController@update_staff')
			->name('patch_settings_staff');

		Route::get('/social-links', 'SettingsController@social_links')
			->name('settings_social_links');

		Route::patch('/social-links', 'SettingsController@update_social_links')
			->name('patch_settings_social_links');

		Route::get('custom-script', 'SettingsController@website_custom_scripts')
			->name('custom_script_page');

		Route::patch('custom-script', 'SettingsController@update_website_custom_scripts')
			->name('patch_custom_script');

		Route::get('recruitment', 'SettingsController@recruitment')
			->name('settings_recruitment');

		Route::patch('recruitment', 'SettingsController@updateRecruitment')
			->name('patch_settings_recruitment');

		Route::get('writer/percentage', 'WriterController@writers')
			->name('writer_bid_percentage');
		Route::post('writer/percentage', 'WriterController@datatable')
			->name('datatable_percentage');
		Route::get('writer/percentage/{user}', 'WriterController@show')
			->name('show_writer_bid');
		Route::patch('writer/percentage/{user}', 'WriterController@update')
			->name('edit_writer_bid');



		// Services    
		Route::prefix('services')->group(function () {

			Route::get('/', 'ServiceController@index')
				->name('services_list');

			Route::post('/paginate', 'ServiceController@datatable')
				->name('datatable_services');

			Route::get('/create', 'ServiceController@create')
				->name('services_create');

			Route::post('/', 'ServiceController@store')
				->name('services_store');

			Route::get('/{service}/edit', 'ServiceController@edit')
				->name('services_edit')
				->where('service', '[0-9]+');

			Route::patch('/{service}/edit', 'ServiceController@update')
				->name('services_update');

			Route::get('/{service}', 'ServiceController@destroy')
				->name('services_delete')
				->where('service', '[0-9]+');

			// Sub Category    
			Route::prefix('sub_category')->group(function () {

				Route::get('/', 'SubCategoryController@index')
					->name('sub_category_list');

				Route::post('/paginate', 'SubCategoryController@datatable')
					->name('datatable_sub_category');

				Route::get('/create', 'SubCategoryController@create')
					->name('sub_category_create');

				Route::post('/', 'SubCategoryController@store')
					->name('sub_category_store');

				Route::get('/{subCategory}/edit', 'SubCategoryController@edit')
					->name('sub_category_edit')
					->where('subCategory', '[0-9]+');

				Route::patch('/{subCategory}/edit', 'SubCategoryController@update')
					->name('sub_category_update');

				Route::get('/{subCategory}', 'SubCategoryController@destroy')
					->name('sub_category_delete');
				// ->where('subCategory', '[0-9]+');
			});
			// Additional Services    
			Route::prefix('additional')->group(function () {

				Route::get('/', 'AdditionalServiceController@index')
					->name('additional_services_list');

				Route::post('/paginate', 'AdditionalServiceController@datatable')
					->name('datatable_additional_services');

				Route::get('/create', 'AdditionalServiceController@create')
					->name('additional_services_create');

				Route::post('/', 'AdditionalServiceController@store')
					->name('additional_services_store');

				Route::get('/{additional_service}/edit', 'AdditionalServiceController@edit')
					->name('additional_services_edit');

				Route::patch('/{additional_service}/edit', 'AdditionalServiceController@update')
					->name('additional_services_update')
					->where('additional_service', '[0-9]+');

				Route::get('/{additional_service}', 'AdditionalServiceController@destroy')
					->name('additional_services_delete')
					->where('additional_service', '[0-9]+');
			});
			// End of Additional Services  

		});
		// End of Services 


		// Urgencies    
		Route::prefix('urgencies')->group(function () {

			Route::get('/', 'UrgencyController@index')
				->name('urgencies_list');

			Route::post('/paginate', 'UrgencyController@datatable')
				->name('datatable_urgencies');

			Route::get('/create', 'UrgencyController@create')
				->name('urgencies_create');

			Route::post('/', 'UrgencyController@store')
				->name('urgencies_store');

			Route::get('/{urgency}/edit', 'UrgencyController@edit')
				->name('urgencies_edit');

			Route::patch('/{urgency}/edit', 'UrgencyController@update')
				->name('urgencies_update');

			Route::get('/{urgency}', 'UrgencyController@destroy')
				->name('urgencies_delete');
		});
		// End of Services 


		// Work Levels    
		Route::prefix('work-levels')->group(function () {

			Route::get('/', 'WorkLevelController@index')
				->name('work_levels_list');

			Route::post('/paginate', 'WorkLevelController@datatable')
				->name('datatable_work_levels');

			Route::get('/create', 'WorkLevelController@create')
				->name('work_levels_create');

			Route::post('/create', 'WorkLevelController@store')
				->name('work_levels_store');

			Route::get('/{work_level}/edit', 'WorkLevelController@edit')
				->name('work_levels_edit');

			Route::patch('/{work_level}/edit', 'WorkLevelController@update')
				->name('work_levels_update');

			Route::get('/{work_level}', 'WorkLevelController@destroy')
				->name('work_levels_delete');
		});
		// End of Work Levels 

		// Guarantees
		Route::prefix('guarantee')->group(function () {
			Route::get('/', 'GuaranteeController@index')
				->name('guarantee_list');

			Route::post('/paginate', 'GuaranteeController@datatable')
				->name('datatable_guarantees');

			Route::get('/create', 'GuaranteeController@create')
				->name('guarantees_list_create');

			Route::post('/create', 'GuaranteeController@store')
				->name('guarantees_store');

			Route::get('/{guarantee}/edit', 'GuaranteeController@edit')
				->name('guarantees_edit');

			Route::patch('/{guarantee}/edit', 'GuaranteeController@update')
				->name('guarantees_update');

			Route::get('/{guarantee}', 'GuaranteeController@destroy')
				->name('guarantees_delete');
		});
		// Subjects 
		Route::prefix('subjects')->group(function () {
			Route::get('/', 'SubjectController@index')
				->name('subject_list');

			Route::post('/paginate', 'SubjectController@datatable')
				->name('datatable_subjects');

			Route::get('/create', 'SubjectController@create')
				->name('subject_list_create');

			Route::post('/create', 'SubjectController@store')
				->name('subject_store');

			Route::get('/{subject}/edit', 'SubjectController@edit')
				->name('subject_edit');

			Route::patch('/{subject}/edit', 'SubjectController@update')
				->name('subject_update');

			Route::get('/{subject}', 'SubjectController@destroy')
				->name('subject_delete');
		});



		// Tags
		Route::prefix('tags')->group(function () {

			Route::get('/', 'TagController@index')
				->name('tags_list');

			Route::post('/paginate', 'TagController@datatable')
				->name('datatables_tags');

			Route::get('/create', 'TagController@create')
				->name('tags_create');

			Route::post('/', 'TagController@store')
				->name('tags_store');

			Route::get('/{tag}/edit', 'TagController@edit')
				->name('tags_edit');

			Route::patch('/{tag}/edit', 'TagController@update')
				->name('tags_update');

			Route::get('/{tag}', 'TagController@destroy')
				->name('tags_delete');
		});

		Route::get('system/update', 'SettingsController@updateSystemPage')
			->name('update_system_page');

		Route::post('system/update', 'SettingsController@updateSystem')
			->name('update_system');

		load_route('payment_settings');

		// Online class content
		Route::get('/online-class', 'AdminPageController@class')
			->name('online_class_settings');
		Route::put('/online-class', 'AdminPageController@update_class')
			->name('put_online_class_settings');
		Route::name('online_class.')->prefix('online-class')->group(function () {
			Route::resource('pages', 'OnlineClassPageController');
			Route::post('/paginate', 'OnlineClassPageController@datatable')
				->name('datatables');
			Route::get('/{page}/delete', 'OnlineClassPageController@destroy')
				->name('delete');
		});
		// Online exam content
		Route::get('/online-exam', 'AdminPageController@exam')
			->name('online_exam_settings');
		Route::put('/online-exam', 'AdminPageController@update_exam')
			->name('put_online_exam_settings');
		Route::name('online_exam.')->prefix('online-exam')->group(function () {
			Route::resource('pages', 'OnlineExamPageController');
			Route::post('/paginate', 'OnlineExamPageController@datatable')
				->name('datatables');
			Route::get('/{page}/delete', 'OnlineExamPageController@destroy')
				->name('delete');
		});

		// homework
		Route::get('/homework', 'AdminPageController@homework')
			->name('homework_settings');
		Route::put('/homework', 'AdminPageController@update_homework')
			->name('put_homework_settings');
		Route::name('homework.')->prefix('homework')->group(function () {
			Route::resource('pages', 'HomeWorkPageController');
			Route::post('/paginate', 'HomeWorkPageController@datatable')
				->name('datatables');
			Route::get('/{page}/delete', 'HomeWorkPageController@destroy')
				->name('delete');
		});
		// assignment
		Route::get('/assignment', 'AdminPageController@assignment')
			->name('assignment_settings');
		Route::put('/assignment', 'AdminPageController@update_assignment')
			->name('put_assignment_settings');
		Route::name('assignment.')->prefix('assignment')->group(function () {
			Route::resource('pages', 'AssignmentPageController');
			Route::post('/paginate', 'AssignmentPageController@datatable')
				->name('datatables');
			Route::get('/{page}/delete', 'AssignmentPageController@destroy')
				->name('page_delete');
		});

		// essay writig
		Route::get('/essay-writing', 'AdminPageController@essay')
			->name('essay_settings');
		Route::put('/essay-writing', 'AdminPageController@update_essay')
			->name('put_essay_settings');

		// about us
		Route::get('/about', 'AdminPageController@about')
			->name('about_settings');
		Route::put('/about', 'AdminPageController@update_about')
			->name('put_about_settings');
		// contact us
		Route::get('/contact-us', 'AdminPageController@contact')
			->name('contact_settings');
		Route::put('/contact-us', 'AdminPageController@update_contact')
			->name('put_contact_settings');
	});


	Route::prefix('payments')->group(function () {

		Route::get('/', 'Payments\PaymentController@index')
			->name('payments_list');

		Route::post('/', 'Payments\PaymentController@datatable')
			->name('datatable_payments');

		Route::get('pending/approvals', 'Payments\PendingPaymentsController@index')
			->name('pending_payment_approvals');

		Route::post('pending/approval/paginate', 'Payments\PendingPaymentsController@datatable')
			->name('datatable_pending_payment_approval');

		Route::get('pending/approvals/{approvedPayment}/approve', 'Payments\PendingPaymentsController@approvePendingPayment')
			->name('pending_payment_approve');

		Route::get('pending/approvals/{disapprovedPayment}/disapprove', 'Payments\PendingPaymentsController@disapprovePendingPayment')
			->name('pending_payment_disapprove');
	});

	Route::prefix('wallet/transactions')->group(function () {

		Route::get('/', 'WalletTransactionController@index')
			->name('wallet_transactions');

		Route::post('/', 'WalletTransactionController@datatable')
			->name('datatable_wallet_transactions');

		// Route::get('pending/approvals', 'Payments\PendingPaymentsController@index')
		// 	->name('pending_payment_approvals_wallet');

		// Route::post('pending/approval/paginate', 'Payments\PendingPaymentsController@datatable')
		// 	->name('datatable_pending_payment_approval');

		// Route::get('pending/approvals/{approvedPayment}/approve', 'Payments\PendingPaymentsController@approvePendingPayment')
		// 	->name('pending_payment_approve');

		// Route::get('pending/approvals/{disapprovedPayment}/disapprove', 'Payments\PendingPaymentsController@disapprovePendingPayment')
		// 	->name('pending_payment_disapprove');
	});


	Route::prefix('job')->group(function () {

		Route::get('applicants', 'ApplicantController@index')
			->name('job_applicants');

		Route::post('applicannts', 'ApplicantController@datatable')
			->name('datatable_job_applicannts');

		Route::post('applicants/{applicant}/status/change', 'ApplicantController@changeStatus')
			->name('applicant_change_status')
			->where('applicant', '[0-9]+');

		Route::delete('applicants/{applicant}/delete', 'ApplicantController@destroy')
			->name('applicant_delete')
			->where('applicant', '[0-9]+');

		Route::post('applicants/{applicant}/invite', 'ApplicantController@inviteToJoin')
			->name('applicant_invite_to_join')
			->where('applicant', '[0-9]+');

		Route::get('applicants/{applicant}', 'ApplicantController@show')
			->name('job_applicant_profile')
			->where('applicant', '[0-9]+');
	});
	// admin social links routes
	Route::prefix('social')->group(function () {
		Route::get('urls', 'AdminSocialController@index')->name('admin_social_urls');
		Route::patch('urls', 'AdminSocialController@edit')->name('admin_social_urls_update');
	});
	// admin message support
	Route::get('/messages', 'SettingsController@messages')
		->name('admin_messages_list');
	Route::post('/messages/paginate', 'SettingsController@messagesDatatable')
		->name('messages_datatable');
});
