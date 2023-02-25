<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|   example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|   https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|   $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|   $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|   $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|       my-controller/my-method -> my_controller/my_method
*/
// $route['test'] ='RegisterController/test';
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
$route['math'] = 'MathXml/MathXmlView';
$route['signup'] = 'RegisterController/showSignUp';
$route['signup/parent'] ='RegisterController/showSignUpPlan';
$route['signup/upper_level_student'] ='RegisterController/showSignUpPlan';
$route['signup/tutor'] ='RegisterController/showSignUpPlan';
$route['signup/school'] ='RegisterController/showSignUpPlan';
$route['signup/corporate'] ='RegisterController/showSignUpPlan';
 

// $route['select_country']='RegisterController/selectCountry';
$route['select_country/(:any)/(:any)']='RegisterController/selectCountry/$1/$2';
$route['select_course']='RegisterController/selectCourse';
$route['student_form']='RegisterController/student_form';
$route['signup_student_form']='RegisterController/signup_student_form';
$route['save_student']='RegisterController/save_student';
$route['signup_save_student']='RegisterController/signup_save_student';
$route['sure_data_save']='RegisterController/sure_data_save';

$route['trial'] = 'RegisterController/showSignUp';
$route['trial/parent'] ='RegisterController/showSignUpPlan';
$route['trial/upper_level_student']='RegisterController/showSignUpPlan';
$route['trial/tutor']='RegisterController/showSignUpPlan';
$route['trial/school'] ='RegisterController/showSignUpPlan';
$route['trial/corporate'] ='RegisterController/showSignUpPlan';

$route['redirect_url'] = 'RegisterController/redirect_url';


/* for paypal payment*/
$route['paypal_new']='RegisterController/show_paypal_form';
$route['signup-paypal']='RegisterController/show_signup_paypal_form';
$route['signup-upper-paypal']='RegisterController/signup_upper_paypal_form';
$route['go_paypal']='RegisterController/go_paypal';
$route['signup_go_paypal']='RegisterController/signup_go_paypal';
$route['signup_upper_go_paypal']='RegisterController/signup_upper_go_paypal';
$route['paypal_success']='PaypalController/paypal_success';
$route['paypal_cancel']='PaypalController/paypal_cancel';
$route['subscription/cancel']='PaypalController/cancelSubscription';
$route['paypal_notify']='PaypalController/paypal_notify';
$route['signup_paypal_notify']='PaypalController/signup_paypal_notify';
$route['signup_upper_paypal_notify']='PaypalController/signup_upper_paypal_notify';
$route['no_debit_paypal_notify']='PaypalController/no_debit_paypal_notify';
$route['signup_no_debit_paypal_notify']='PaypalController/signup_no_debit_paypal_notify';

// new added AS
$route['questionStorePaymentOption/(:any)']='Tutor/questionStorePaymentOption/$1';
$route['qusStorePaymentOption']='Tutor/qusStorePaymentOption';
$route['go_paypal_qusStore']='RegisterController/go_paypal_qusStore';
$route['no_debit_paypal_notify_qusStore']='PaypalController/no_debit_paypal_notify_qusStore';
$route['direct_debit_paypal_notify_qusStore']='PaypalController/direct_debit_paypal_notify_qusStore';


// added AS
$route['both_subscription_cancel']='Dashboard/subscription_cancel';
$route['subscription_renew']='Dashboard/subscription_renew';
$route['webhook']='WebhookController/stripeWebhook';
$route['paypalWebhook']='WebhookController/paypalWebhook';

$route['direct_deposit']='CardController/direct_deposit';
$route['signup_direct_deposit']='CardController/signup_direct_deposit';
$route['signup_upper_direct_deposit']='CardController/signup_upper_direct_deposit';
$route['direct_deposit_qus_store']='CardController/direct_deposit_qus_store';
$route['upper_student_free_reg']='RegisterController/upper_student_free_reg';



//upper_level_student
$route['upper_level_student_form']='RegisterController/upper_level_student_form';
$route['signup_upper_level_student_form']='RegisterController/signup_upper_level_student_form';
$route['save_upper_student']='RegisterController/save_upper_student';
$route['sure_upper_student_data_save']='RegisterController/sure_upper_student_data_save';



//tutor
$route['tutor_form']='RegisterController/tutor_form';
$route['save_tutor']='RegisterController/save_tutor';
$route['sure_save_tutor']='RegisterController/sure_save_tutor';
$route['student_progress']='Student_Progress/viewStudentProgress';
$route['student_progress/(:any)']='Student_Progress/viewStudentProgress/$1';
$route['student_progress_course/(:any)']='Student_Progress/student_progress_course/$1';


$route['check_student_copy/(:any)/(:any)/(:any)/(:any)']='Student_Copy/check_student_copy/$1/$2/$3/$4';
$route['check_student_copy/(:any)/(:any)/(:any)']='Student_Copy/check_student_copy/$1/$2/$3';

$route['st_progress_update_answer_workout_quiz']='Student_Copy/st_progress_update_answer_workout_quiz';
$route['st_progress_image_update_answer_workout_quiz']='Student_Copy/st_progress_image_update_answer_workout_quiz';
$route['tutor-progress-type'] = 'Tutor/tutor_progress_type';
$route['tutor_student_progress']='Student_Progress/viewTutorStudentProgress';
//messaging
//$route['message/type'] = 'Message/selectMessageType';
$route['message/type'] = 'Message/showAllTopics';
$route['message/topics'] = 'Message/showAllTopics';
$route['message/topics/add'] = 'Message/addMessageTopic';
$route['message/topics/delete/(:any)'] = 'Message/DeleteMessageTopic/$1';
$route['message/set'] = 'Message/setMessage';
$route['proceed_email'] = 'Message/proceed_email';
$route['show_all_message/(:any)'] = 'Message/show_all_message/$1';
$route['edit_message/(:any)'] = 'Message/edit_message/$1';
$route['add_message/(:any)'] = 'Message/add_message/$1';
$route['message/delete/(:any)'] = 'Message/delete_message/$1';

//school
$route['school_form']='RegisterController/school_form';
$route['save_school']='RegisterController/save_school';
$route['sure_school_data_save']='RegisterController/sure_school_data_save';


//corporate
$route['corporate_form']='RegisterController/corporate_form';
$route['save_corporate']='RegisterController/save_corporate';
$route['sure_corporate_data_save']='RegisterController/sure_corporate_data_save';


//mail-temlete_parent
$route['parent_trial_mail']='RegisterController/parent_trial_mail';
$route['parent_signup_mail']='RegisterController/parent_signup_mail';


//mail-temlete_upper_student
$route['upper_student_trial_mail']='RegisterController/upper_student_trial_mail';
$route['upper_student_signup_mail']='RegisterController/upper_student_signup_mail';


//mail-temlete_tutor
$route['tutor_trial_mail']='RegisterController/tutor_trial_mail';
$route['tutor_signup_mail']='RegisterController/tutor_signup_mail';


//mail-temlete_school
$route['school_mail']='RegisterController/school_mail';


//mail-temlete_corporate
$route['corporate_mail']='RegisterController/corporate_mail';


//after-registration
$route['home_page']='RegisterController/home_page';


//parent-setting
$route['parent_setting']='Parents/parent_setting';
$route['my_details']='Parents/my_details';
$route['update_my_details']='Parents/update_my_details';
$route['upload_photo']='Parents/upload_photo';
$route['file-upload']='Parents/parent_dropzone_file';

//student-setting
$route['student_progress_step'] = 'Student/student_progress_step';
$route['student_progress_step_7'] = 'Student/student_progress_step_7';
$route['student_setting'] = 'Student/student_setting';
$route['student_details'] = 'Student/student_details';
$route['update_student_details'] = 'Student/update_student_details';
$route['my_enrollment'] = 'Student/my_enrollment';
$route['get_ref_link'] = 'Student/get_ref_link';
$route['save_ref_link'] = 'Student/save_ref_link';
$route['student_upload_photo'] = 'Student/student_upload_photo';
$route['sure_student_photo_upload'] = 'Student/sure_student_photo_upload';
$route['q_study_course'] = 'Student/q_study_course';
$route['tutorial/(:any)'] = 'Student/tutorial/$1';
$route['tutor_course'] = 'Student/tutor_course';
$route['all_module_by_type/(:any)/(:any)'] = 'Student/all_module_by_type/$1/$2';
$route['video_link/(:any)/(:any)'] = 'Student/video_link/$1/$2';
$route['ans_the_wrong_question/(:any)/(:any)/(:any)'] = 'Student/ans_the_wrong_question/$1/$2/$3';
$route['all_tutors_by_type/(:any)/(:any)/(:any)'] = 'Student/all_tutors_by_type/$1/$2/$3';
$route['all_tutors_by_type/(:any)/(:any)'] = 'Student/all_tutors_by_type/$1/$2';
//change here
$route['finish_all_module_question/(:any)/(:any)'] = 'Student/finish_all_module_question/$1/$2';


//u-level-student-setting
$route['u_level_studen_setting']='Upper_level/u_level_studen_setting';
$route['u_level_student_details']='Upper_level/u_level_student_details';
$route['update_u_level_student_details']='Upper_level/update_u_level_student_details';
$route['u_level_upload_photo']='Upper_level/u_level_upload_photo';
$route['u_level_file-upload']='Upper_level/u_level_file_upload';
$route['u_level_enrollment']='Upper_level/u_level_enrollment';


//tutor
$route['tutor_setting']='Tutor/tutor_setting';
$route['tutor_details']='Tutor/tutor_details';
$route['update_tutor_details']='Tutor/update_tutor_details';
$route['tutor_upload_photo']='Tutor/tutor_upload_photo';
$route['tutor_file-upload']='Tutor/tutor_file_upload';

// add new by AS
$route['tutor_bank_details']='Tutor/tutor_bank_details';
$route['bank_details_submit_form']='Tutor/bank_details_submit_form';

//find tutor,show,update profile
$route['tutor/profile/update'] = 'Tutor/updateProfile';
$route['tutor/profile/(:any)'] = 'CommonAccess/showTutorProfile/$1';
$route['tutor/search'] = 'CommonAccess/searchTutor';
$route['tutor/account/settings'] = 'Tutor/accountSettings';

//school
$route['school_setting']='School/school_setting';
$route['school_info_details']='School/school_info_details';
$route['update_school_details']='School/update_school_details';
$route['school_logo']='School/school_logo';
$route['school_logo_upload']='School/school_logo_upload';


//corportae
$route['corporate_setting']='corporate/corporate_setting';
$route['corporate_details']='corporate/corporate_details';
$route['update_corporate_details']='corporate/update_corporate_details';
$route['corporate_logo']='corporate/corporate_logo';
$route['corporate_logo_upload']='corporate/corporate_logo_upload';
/* for card payment*/
$route['card_form_submit']='CardController/card_form_submit';
$route['signup_card_form_submit']='CardController/signup_card_form_submit';
$route['signup_upper_card_form_submit']='CardController/signup_upper_card_form_submit';
$route['card_form_submit_qus_store']='CardController/card_form_submit_qus_store';
// end

//login
$route['loginChk']='Login/loginChk';
$route['logout']='Logout';
// Added AS
$route['parent_password_check']='Login/parent_password_check';
 
//Settings
$route['cancel_subscription']='dashboard/cancel_subscription';
$route['cancel_confirm']='dashboard/cancel_confirm';

//************           Module Section         ***********
$route['view-course']='dashboard/view_course';
$route['course/country']='qstudy/courseCountrySelect';
$route['all-module']='Module/all_module';
$route['assign-subject']='Module/assign_subject';
$route['add-module']='Module/add_module';
$route['reorder-module']='Module/reorderModule';
$route['edit-module/(:any)']='Module/editModule/$1';
$route['module_preview/(:any)/(:any)']="Module/module_preview/$1/$2";

$route['getStudentByGradeCountry']='Module/getStudentByGradeCountry';
$route['getIndividualStudent']='Module/getIndividualStudent';
$route['module/repetition/(:any)'] = 'Module/setRepetitionDays/$1';
$route['module/types'] = 'Module/allModuleType';
$route['module/search'] = 'Module/searchModule';
$route['module/tutor_list/(:any)'] = 'Module/tutorList/$1'; //tutor_list/module_type
$route['module_creative_quiz_ans_matching'] = 'Module/module_creative_quiz_ans_matching';

//Qstudy Module instraction  Multiple Video section
$route['module_instruction_video/(:any)'] = 'Module/module_instruction_video/$1';
$route['module_instruction_video_list/(:any)'] = 'Module/module_instruction_video_list/$1';
$route['save_module_instract_video'] = 'Module/save_module_instract_video';
$route['update_module_instract_video'] = 'Module/update_module_instract_video';
$route['delete_module_instruction_video'] = 'Module/delete_module_instruction_video';
$route['edit_module_instruction_video/(:any)/(:any)'] = 'Module/edit_module_instruction_video/$1/$2';
$route['qstudy_module_video_preview'] = 'Module/qstudy_module_video_preview';




//Get Course By Usertype
$route['get_course'] = 'Module/get_course';

$route['course/data_input']='qstudy/data_input';

$route['course/data_input_personal/(:any)']='qstudy/data_input_personal/$1';

// Whiteboard section 
$route['whiteboard-items']='tutor/whiteboard_items';
$route['std-whiteboard-items']='student/whiteboard_items';
$route['tutor-question-store']='tutor/tutor_question_store';
$route['std-question-store']='student/std_question_store';
$route['download_question_store/(:any)']='student/download_question_store/$1';
$route['download_tutor_question_store/(:any)']='tutor/download_tutor_question_store/$1';

//************           Question Section         ***********
$route['question-list']='tutor/question_list';
$route['question-store']='tutor/question_store';
$route['save_question_store_data']='tutor/save_question_store_data';
$route['search_question_store_info']='tutor/search_question_store_info';
$route['order_question_store']='tutor/order_question_store';
$route['edit_question_store']='tutor/edit_question_store';
$route['update_question_store_data']='tutor/update_question_store_data';
$route['delete-store']='tutor/delete_store';
$route['delete_store_chapter/(:any)']='tutor/delete_store_chapter/$1';
$route['delete_store_subject/(:any)']='tutor/delete_store_subject/$1';
$route['update-store-subject-name']='tutor/update_store_subject_name';
// $route['question_duplicate/(:any)']='Question/duplicateQuestion/$1';
$route['question_duplicate']='Question/duplicateQuestion';
$route['send_to_qStudy']='Question/send_to_q_Study';
$route['question_delete/(:any)']='Question/deleteQuestion/$1';
$route['create-question/(:any)']='tutor/create_question/$1';
$route['add_subject_name']='tutor/add_subject_name';
$route['get_chapter_name']='tutor/get_chapter_name';
$route['get_subject']='tutor/get_subject';
$route['get-vocabulary-word-data']='tutor/get_vocabulary_word_data';
$route['add_question_tutorial']='tutor/add_question_tutorial';
$route['question_tutorial_preview']='Student/question_tutorial_preview';

$route['subject/all']='Subject/showAllSubject';
$route['update-subject-name']='Subject/update_subject_name';
$route['subject/delete/(:any)']='Subject/deleteSubject/$1';
$route['chapter/delete/(:any)']='Subject/deleteChapter/$1';

$route['add_chapter']='tutor/add_chapter';
$route['save_question_data']='tutor/save_question_data';
$route['imageUpload']='CommonAccess/imageUpload';
//q-dictionary
$route['q-dictionary/add'] = 'Question/addDictionaryWord';
$route['q-dictionary/search'] = 'CommonAccess/searchDictionaryWord';
$route['q-dictionary/view'] = 'CommonAccess/viewDictionaryWord';
$route['q-dictionary/wordlist'] = 'Admin/dictionaryWordList';
$route['q-dictionary/approve/(:any)'] = 'Admin/dicWordApprovePage/$1';
$route['q-dictionary/reject/(:any)'] = 'Admin/wordReject/$1';
$route['q-dictionary/payment'] = 'Admin/dictionaryPayment';
$route['search_dictionary_word'] = 'CommonAccess/searchWord_';

//************           Preview Section         ***********
$route['question_preview/(:any)/(:any)']='Preview/question_preview/$1/$2';
$route['question/preview/(:any)/(:any)']='IDontLikeIt/question_preview/$1/$2';//to avoid conflict of .... I dont know whats wrong.
$route['answer_matching']='Preview/answer_matching';
$route['preview_vocubulary/(:any)']='Preview/preview_vocubulary/$1';
$route['answer_multiple_matching']='Preview/answer_multiple_matching';
$route['answer_matching_true_false']='Preview/answer_matching_true_false';
$route['answer_matching_vocabolary']='Preview/answer_matching_vocabolary';
$route['answer_matching_multiple_choice']='Preview/answer_matching_multiple_choice';
$route['answer_matching_multiple_response']='Preview/answer_matching_multiple_response';
$route['answer_creative_quiz'] = 'Preview/answer_creative_quiz';
$route['answer_times_table'] = 'Preview/answer_times_table';
$route['answer_algorithm'] = 'Preview/answer_algorithm';
$route['answer_workout_quiz'] = 'Preview/answer_workout_quiz';
$route['creative_quiz_ans_matching'] = 'Preview/creative_quiz_ans_matching';
$route['answer_matching_StoryWrite']='Preview/answer_matching_StoryWrite';
$route['answer_sentence_matching']='Preview/answer_sentence_matching';
$route['answer_word_memorization']='Preview/answer_word_memorization';
$route['answer_matching_comprehension']='Preview/answer_matching_comprehension';

// Just preview
$route['question_answer_matching_comprehension']='Preview/question_answer_matching_comprehension';
$route['question_answer_matching_grammer']='Preview/question_answer_matching_grammer';
$route['question_answer_matching_glossary']='Preview/question_answer_matching_glossary';
$route['question_answer_matching_image_quiz']='Preview/question_answer_matching_image_quiz';

// Module preview 
$route['module_answer_matching_comprehension']='Preview/module_answer_matching_comprehension';
$route['module_answer_matching_grammer']='Preview/module_answer_matching_grammer';




//************           Question Edit Section         ***********
$route['question_edit/(:any)/(:any)']='tutor/question_edit/$1/$2';
$route['question_edit/(:any)/(:any)/(:any)']='tutor/question_edit/$1/$2/$3';
$route['question_edit/(:any)/(:any)/(:any)/(:any)']='tutor/question_edit/$1/$2/$3/$4';
$route['update_question_data']='tutor/update_question_data';
$route['view_edit_idea'] = 'Tutor/view_edit_idea';

//added by sobuj

$route['get_tutor_tutorial_module/(:any)/(:any)']='Student/get_tutor_tutorial_module/$1/$2';

$route['st_answer_matching']='Student/st_answer_matching';
$route['st_answer_matching_vocabolary']='Student/st_answer_matching_vocabolary';
$route['st_answer_matching_true_false']='Student/st_answer_matching_true_false';
$route['st_answer_matching_multiple_choice']='Student/st_answer_matching_multiple_choice';
$route['st_answer_matching_multiple_response']='Student/st_answer_matching_multiple_response';
$route['st_answer_multiple_matching']='Student/st_answer_multiple_matching';
$route['st_answer_assignment']='Student/st_answer_assignment';
$route['st_answer_creative_quiz']='Student/st_answer_creative_quiz';
$route['st_answer_times_table']='Student/st_answer_times_table';
$route['st_answer_algorithm']='Student/st_answer_algorithm';
$route['student_creative_quiz_ans_matching']='Student/student_creative_quiz_ans_matching';
$route['st_answer_sentence_matching']='Student/st_answer_sentence_matching';
$route['st_answer_word_memorization']='Student/st_answer_word_memorization';
$route['st_answer_comprehension']='Student/st_answer_comprehension';
$route['st_answer_grammer']='Student/st_answer_grammer';
$route['st_answer_glossary']='Student/st_answer_glossary';
$route['st_answer_image_quiz']='Student/st_answer_image_quiz';

$route['show_tutorial_result/(:any)']='Student/show_tutorial_result/$1';




//**********     Admin Section      *********
$route['course_theme'] = 'admin/course_theme';
$route['save_theme'] = 'admin/save_theme';
$route['all_area'] = 'admin/all_area';
$route['contact-mail'] = 'admin/contact_mail';
$route['contact-info'] = 'admin/contact_info';
//User Info
$route['user_list'] = 'admin/user_list/$1/$2/$3';
$route['user_add'] = 'Admin/userAdd';
$route['edit_user/(:any)'] = 'Admin/edit_user/$1';
$route['tutor_create_50_vocabulary'] = 'admin/tutor_create_50_vocabulary';
$route['tutor_with_10_students'] = 'admin/tutor_with_10_students';
//Country Info
$route['country_list'] = 'admin/country_list';
$route['save_country'] = 'admin/save_country';
$route['update_country'] = 'admin/update_country';
$route['delete_country/(:any)'] = 'admin/delete_country/$1';
//Country Wise Course
$route['country_wise'] = 'admin/country_wise';
$route['course_schedule/(:any)'] = 'admin/course_schedule/$1';
$route['save_course_schedule'] = 'admin/save_course_schedule';
$route['save_trial_course_schedule'] = 'admin/save_trial_course_schedule';
$route['delete_course'] = 'admin/delete_course';
//find tutor
$route['trial_period'] = 'admin/trial_period';
//faqs
$route['faq/add'] = 'Faq/addFaq';
$route['faq/all'] = 'Faq/allFaq';
$route['faq/edit/(:any)'] = 'Faq/editFaq/$1';
$route['faq/delete/(:any)'] = 'Faq/deleteFaq/$1';
$route['faq/view/(:any)'] = 'CommonAccess/viewFaq/$1';
$route['faq/add/other'] = 'Faq/addLandPageItems';
$route['faq/view/other/(:any)'] = 'CommonAccess/viewLandPageItem/$1';
$route['faq/video/upload'] = 'Faq/landPagevideoUpload';
$route['faq/video/list'] = 'Faq/landPagevideoList';
$route['contact_us'] = 'CommonAccess/contactUs';

$route['send_feedback'] = 'CommonAccess/send_feedback';
$route['feedbackfileUpload'] = 'CommonAccess/feedbackfileUpload';

$route['faq/serialize/(:any)/(:any)/(:any)'] = 'Faq/serialize/$1/$2/$3';

//dialogue
$route['dialogue/add'] = 'Admin/addDialogue';
$route['dialogue/all'] = 'Admin/allDialogue';
$route['dialogue/delete/(:any)'] = 'Admin/deleteDialogue/$1';
$route['add-auto-repeat'] = 'Admin/add_auto_repeat';

//forgot password section
$route['forgot_password'] = 'Login/forgotPassView';
$route['pass_reset_link'] = 'Login/sendResetPassEmail';
$route['set_password'] = 'Login/saveNewPass';
$route['emailCheck'] = 'Login/emailCheck';

//suspended user
$route['suspended'] = 'CommonAccess/suspendUserRedirection';
//payment defaulter
$route['payment_defaulter'] = 'CommonAccess/paymentDefaulterRedirection';

//find tutor
$route['tutor/search'] = 'CommonAccess/searchTutor';
$route['sms_api/add'] = 'Admin/smsApiAdd';
$route['sms_message/add'] = 'Admin/sms_message';

$route['student/organization'] = 'Student/organization';
$route['student/studyType/(:any)'] = 'Student/studyType/$1';

$route['video'] = 'welcome/vdHowItWorks';
$route['sub_mail'] = 'Cron_Controller/subscription_mail';

$route['story_Upload']='Tutor/upload_photos_control';
$route['edit_storyWriteParts']='Tutor/edit_storyWriteParts';
$route['remove_storyWriteParts']='Tutor/remove_storyWriteParts';
$route['st_answer_matching_storyWrite']='Student/st_answer_matching_storyWrite';

$route['WhiteBoardTutor']='Tutor/WhiteBoardTutor';
$route['insertClass']='Tutor/insertClass';
$route['yourClassRoom/(:any)']='Student/yourClassRoom/$1';
$route['yourClassRoomTutor/(:any)']='Tutor/yourClassRoom/$1';
$route['removeClass']='Tutor/removeClass';

//groupboard
$route['add-groupboard'] = 'admin/add_groupboard';
$route['store-groupboard'] = 'faq/store_groupboard';
$route['all-groupboard'] = 'faq/all_groupboard';
$route['edit-groupboard/(:any)'] = 'faq/edit_groupboard/$1';

$route['update-groupboard'] = 'faq/update_groupboard';
$route['direct-request'] = 'CardController/derect_request';
$route['signup-direct-request'] = 'CardController/signup_derect_request';
$route['finish'] = 'RegisterController/upper_student_signup_mail';

$route['preview-dictionary'] = 'Question/PreviewDictionary';

$route['sms_templetes'] = 'Admin/sms_templetes';
$route['sms_templetes_status'] = 'Admin/sms_templetes_status';
$route['edit-templete/(:any)'] = 'Admin/edit_templete/$1';

$route['assign-module/(:any)'] = 'Tutor/assignModule/$1';

$route['module/school/tutor_list/(:any)'] = 'Module/SchooltutorList/$1'; 
$route['module/corporate/tutor_list/(:any)'] = 'Module/CorporatetutorList/$1'; 

//product list
$route['product_list'] = 'Admin/product_list';
$route['add_product'] = 'Admin/product_add';
$route['edit_product/(:any)'] = 'Admin/edit_product/$1';
$route['product_point_admin'] = 'Admin/product_point_admin';


//price section for student

$route['price_dashboard']='Student/price_dashboard';
$route['product/price']='Student/product_price';
$route['product/get/address']='Student/get_product_prize_address';
$route['product/prize/get']='Student/get_products_prize';
$route['product/prize/address/edit']='Student/product_prize_address_edit';

// country wise new add
$route['country_users_list/(:any)'] = 'Admin/country_users_list/$1';
$route['userSummary/(:any)'] = 'Admin/userSummary/$1';
//download

$route['download_feedback_file/(:any)']='Admin/download_feedback_file/$1';


$route['see-compose-message'] = 'CommonAccess/getsendMessage';
$route['directDepositSetting/(:any)'] = 'Admin/directDepositSetting/$1';

// route/shukriti---------------- 
$route['save_idea'] = 'Question/save_idea';
$route['edit_idea'] = 'Question/edit_idea';
$route['edit_save_idea'] = 'Question/edit_save_idea';
$route['save_image_idea'] = 'Question/save_image_idea';
$route['check_idea_short_question'] = 'Question/check_idea_short_question';
$route['get_idea'] = 'Question/get_idea'; 
$route['search_idea'] = 'Question/search_idea';
$route['search_image_idea'] = 'Question/search_image_idea';
$route['getUserInfos'] = 'Question/getUserInfos';
$route['save_more_idea'] = 'Question/save_more_idea';  
$route['update_short_question'] = 'Question/update_short_question';

$route['profile_update'] = 'Student/profile_update';
$route['add_profile_info'] = 'Student/add_profile_info';
$route['st_creative_ans_save'] = 'Student/st_creative_ans_save';
$route['admin_correction_report_save'] = 'Admin/correction_report_save';
$route['correction_report_save'] = 'Tutor/correction_report_save';
$route['submited_student_idea'] = 'Student/submited_student_idea';
$route['submited_tutor_idea'] = 'Student/submited_tutor_idea';
$route['submit_student_grade'] = 'Student/submit_student_grade';
$route['check_student_grade'] = 'Student/check_student_grade';
$route['all_tutors_by_types/(:any)/(:any)'] = 'Tutor/all_tutors_by_type/$1/$2';
$route['get_preview_idea_info'] = 'Preview/get_preview_idea_info';
$route['student_word_get'] = 'Student/student_word_get';

// Tutor
$route['short_image_upload'] = 'Question/short_image_upload';

// Admin
$route['set_allow_idea'] = 'Admin/set_allow_idea';
$route['set_serial_no'] = 'Admin/set_serial_no';

// route/Rafi
$route['student_report/(:any)/(:any)/(:any)/(:any)'] = 'Student/student_progress_report/$1/$2/$3/$4';

$route['create-module'] = 'Module/createModule';
$route['create-module/(:any)'] = 'Module/createModule/$1';
// $route['details-module/(:any)'] = 'Module/detailsModule/$1';
$route['details-module'] = 'Module/detailsModule';
$route['details-module/(:any)'] = 'Module/detailsModule/$1';
$route['searchModuleByOptions'] = 'Module/searchModuleByOptions';

$route['question-list/(:any)'] = 'tutor/question_list/$1';
$route['question-list/(:any)/(:any)'] = 'tutor/question_list/$1/$2';
$route['question-list/(:any)/(:any)/(:any)'] = 'tutor/question_list/$1/$2/$3';
//module question
$route['module_question_delete/(:any)'] = 'Module/moduleQuestionDelete/$1';
$route['module_question_duplicate'] = 'Module/moduleDuplicateQuestion';
$route['module_question_sorting'] = 'Module/moduleQuestionSorting';
$route['edit_module_question_sorting'] = 'Module/EditmoduleQuestionSorting';

//module 
$route['save_new_module_question'] = 'Module/saveNewModuleQuestion';
$route['update_new_module_question'] = 'Module/updateNewModuleQuestion';

// $route['new_module_preview/(:any)/(:any)']="Module/newModulePreview/$1/$2";
$route['new_module_preview/(:any)/(:any)']="Module/newModulePreview/$1/$2";
$route['new_module_duplicate']="Module/newModuleDuplicate";
$route['new-edit-module/(:any)']='Module/newEditModule/$1';
$route['new-edit-module/(:any)/(:any)']='Module/newEditModule/$1/$2';
$route['delete_module_question/(:any)'] = 'Module/deleteModuleQuestion/$1';
$route['delete_edit_module_question/(:any)/(:any)'] = 'Module/deleteEditModuleQuestion/$1/$2';
$route['duplicate_module_question'] = 'Module/duplicateModuleQuestion';
$route['delete_new_module/(:any)'] = 'Module/deleteNewModule/$1';

$route['addCourseByModule'] = 'Module/addCourseByModule';
$route['save_module_info'] = 'Module/save_module_info';
$route['edit_module_info'] = 'Module/edit_module_info';
$route['assign_serial_to_module'] = 'Module/assign_serial_to_module';
$route['update_serial_to_module'] = 'Module/update_serial_to_module';
$route['addNewSubject'] = 'Module/addNewSubject';
$route['addNewChapter'] = 'Module/addNewChapter';
$route['deleteSubjectByModule'] = 'Module/deleteSubjectByModule';
$route['deleteChapterByModule'] = 'Module/deleteChapterByModule';
$route['editNewSubject'] = 'Module/editNewSubject';
$route['editNewChapter'] = 'Module/editNewChapter';
$route['update_serial_module_question'] = 'Module/update_serial_module_question';
$route['update_serial_module_question_create'] = 'Module/update_serial_module_question_create';


// Comprehension
$route['comprehension_image_upload'] = 'Question/comprehension_image_upload';
$route['glossary_image_upload'] = 'Question/glossary_image_upload';
$route['type_one_box_one_image_upload'] = 'Question/type_one_box_one_image_upload';
$route['type_one_box_one_hint_image_upload'] = 'Question/type_one_box_one_hint_image_upload';
$route['type_two_box_one_image_upload'] = 'Question/type_two_box_one_image_upload';
$route['type_three_box_one_image_upload'] = 'Question/type_three_box_one_image_upload';
$route['type_three_box_one_image_upload/(:any)'] = 'Question/type_three_box_one_image_upload/$1';

$route['html_text_to_array'] = 'Question/html_text_to_array';

/* Creative Quiz */ 
$route['tutor_student_idea_setting/(:any)/(:any)/(:any)/(:any)'] = 'Tutor/tutor_student_idea_setting/$1/$2/$3/$4';
$route['tutor_question_idea/(:any)/(:any)'] = 'Admin/tutor_question_idea/$1/$2';

$route['upload_idea_story_options'] = 'Tutor/upload_idea_story_options';
$route['get_chapter_info'] = 'Tutor/get_chapter_info';
$route['chapter_moved_to_question'] = 'Tutor/chapter_moved_to_question';
