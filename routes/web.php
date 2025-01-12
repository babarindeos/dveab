<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuth;

use App\Http\Controllers\Admin\Admin_AuthController;
use App\Http\Controllers\Admin\Admin_DashboardController;
use App\Http\Controllers\Admin\Admin_CollegeController;
use App\Http\Controllers\Admin\Admin_DepartmentController;
use App\Http\Controllers\Admin\Admin_StaffController;
use App\Http\Controllers\Admin\Admin_DeanController;
use App\Http\Controllers\Admin\Admin_DirectorateController;
use App\Http\Controllers\Admin\Admin_AdminDocumentController;
use App\Http\Controllers\Admin\Admin_DocumentController;
use App\Http\Controllers\Admin\Admin_AdminCategoryTypeController;
use App\Http\Controllers\Admin\Admin_AdminCategoryController;

use App\Http\Controllers\Admin\Admin_ProfileController;

use App\Http\Controllers\Admin\Admin_TrackerController;
use App\Http\Controllers\Admin\Admin_AnalyticsController;


use App\Http\Controllers\Admin\Admin_DivisionController;
use App\Http\Controllers\Admin\Admin_BranchController;
use App\Http\Controllers\Admin\Admin_SectionController;
use App\Http\Controllers\Admin\Admin_UnitController;

use App\Http\Controllers\Admin\Admin_FinancialYearController;
use App\Http\Controllers\Admin\Admin_VaultController;

use App\Http\Controllers\Staff\Staff_AuthController;
use App\Http\Controllers\Staff\Staff_DashboardController;
use App\Http\Controllers\Staff\Staff_DocumentController;
use App\Http\Controllers\Staff\Staff_WorkflowController;
use App\Http\Controllers\Staff\Staff_GeneralMessageController;
use App\Http\Controllers\Staff\Staff_PrivateMessageController;

use App\Http\Controllers\Staff\Staff_ProfileController;



use App\Http\Controllers\Staff\Staff_CategoryController;
use App\Http\Controllers\Staff\Staff_AdminDocumentController;

use App\Http\Controllers\PDFController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);


Route::post('/', [Staff_AuthController::class, 'login'])->name('staff.auth.login');



Route::get('/admin', [Admin_AuthController::class, 'index'])->name('admin.auth.index');
Route::post('/admin', [Admin_AuthController::class, 'login'])->name('admin.auth.login');


Route::prefix('staff')->middleware(['auth', 'staff'])->group(function(){
    Route::get('/dashboard', [Staff_DashboardController::class, 'index'])->name('staff.dashboard.index');
    Route::post('/logout', [Staff_AuthController::class, 'logout'])->name('staff.auth.logout');

    Route::get('/documents', [Staff_DocumentController::class, 'index'])->name('staff.document.index');
    Route::get('/documents/create', [Staff_DocumentController::class, 'create'])->name('staff.documents.create');
    Route::post('/documents/store', [Staff_DocumentController::class, 'store'])->name('staff.documents.store');
    
    Route::get('/documents/{document}/show', [Staff_DocumentController::class, 'show'])->name('staff.documents.show');
    Route::get('/documents/mydocuments', [Staff_DocumentController::class, 'mydocuments'])->name('staff.documents.mydocuments');

    // Admin Document
    Route::get('/admin_documents', [Staff_AdminDocumentController::class, 'index'])->name('staff.admin_documents.index');
    

    
    
    Route::get('/workflows/{document}/flow', [Staff_WorkflowController::class, 'flow'])->name('staff.workflows.flow');
    Route::get('/workflows/{document}/add_contributor',[Staff_WorkflowController::class, 'add_contributor'])->name('staff.workflows.add_contributor');
    Route::post('/workflows/{document}/post_add_contributor', [Staff_WorkflowController::class, 'post_add_contributor'])->name('staff.workflows.post_add_contributor');

    Route::post('/workflows/{document}/search_staff', [Staff_WorkflowController::class, 'search_staff'])->name('staff.workflows.search_staff');
    Route::post('/workflows/{document}/forward_document', [Staff_WorkflowController::class, 'forward_document'])->name('staff.workflows.forward_document');

    Route::get('/workflows/{workflow}/notification_update', [Staff_WorkflowController::class, 'notification_update'])->name('staff.workflows.notification_update');

    
    Route::get('/workflows/{document}/general_message', [Staff_GeneralMessageController::class, 'index'])->name('staff.workflows.general_message');
    Route::post('/workflows/{document}/general_message', [Staff_GeneralMessageController::class, 'store'])->name('staff.workflows.general_message.store');

    Route::get('/workflows/{document}/private_messages/{recipient}/my_private_messages', [Staff_PrivateMessageController::class, 'my_private_messages'])->name('staff.workflows.private_messages.my_private_messages');
    Route::get('/workflows/{document}/private_message/{recipient}', [Staff_PrivateMessageController::class, 'index'])->name('staff.workflows.private_message.index');
    Route::get('/workflows/{document}/private_message/{sender}/{recipient}/{chat_uuid}/chat', [Staff_PrivateMessageController::class, 'chat'])->name('staff.workflows.private_message.chat');

    Route::post('/workflows/{document}/private_message/{sender}/{recipient}/{chat_uuid}/chat', [Staff_PrivateMessageController::class, 'store'])->name('staff.workflows.private_message.store');

    Route::get('/profile/create', [Staff_ProfileController::class, 'create'])->name('staff.profile.create');
    Route::post('/profile/create', [Staff_ProfileController::class, 'store'])->name('staff.profile.store');
    Route::post('/profile/upload_avatar', [Staff_ProfileController::class, 'upload_avatar'])->name('staff.profile.upload_avatar');

    Route::get('/profile/myprofile', [Staff_ProfileController::class, 'myprofile'])->name('staff.profile.myprofile');
    
    Route::get('/profile/myprofile/edit', [Staff_ProfileController::class, 'edit'])->name('staff.profile.myprofile.edit');
    Route::post('/profile/myprofile/update', [Staff_ProfileController::class, 'update'])->name('staff.profile.myprofile.update');

    Route::post('/profile/myprofile/update_avatar', [Staff_ProfileController::class, 'update_avatar'])->name('staff.profile.myprofile.update_avatar');
    
    Route::get('/profile/user/{fileno}', [Staff_ProfileController::class, 'user_profile'])->name('staff.profile.user_profile');
    Route::get('/profile/user/{email}/user_profile', [Staff_ProfileController::class, 'email_user_profile'])->name('staff.profile.email_user_profile');
    
    Route::get('/profile/change_password', [Staff_ProfileController::class, 'change_password'])->name('staff.profile.change_password');
    Route::post('/profile/update_password', [Staff_ProfileController::class, 'update_password'])->name('staff.profile.update_password');

    Route::get('/profile/my_signature', [Staff_ProfileController::class, 'my_signature'])->name('staff.profile.my_signature');
    Route::post('/profile/my_signature', [Staff_ProfileController::class, 'upload_signature'])->name('staff.profile.upload_signature');
    Route::post('/profile/update_signature', [Staff_ProfileController::class, 'update_signature'])->name('staff.profile.update_signature');

    // Categories
    Route::get('/categories/create', [Staff_CategoryController::class, 'create'])->name('staff.categories.create');
    Route::post('/categories/store', [Staff_CategoryController::class, 'store'])->name('staff.categories.store');


  
});



Route::prefix('admin')->middleware(['auth','admin'])->group(function(){
    
    Route::get('/dashboard', [Admin_DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::post('/logout', [Admin_AuthController::class, 'logout'])->name('admin.auth.logout');


    //college
    Route::get('/colleges', [Admin_CollegeController::class, 'index'])->name('admin.colleges.index');
    Route::get('/colleges/create', [Admin_CollegeController::class, 'create'])->name('admin.colleges.create');
    Route::post('colleges/store', [Admin_CollegeController::class, 'store'])->name('admin.colleges.store');

    Route::get('colleges/{college}/edit', [Admin_CollegeController::class, 'edit'])->name('admin.colleges.edit');
    Route::post('colleges/{college}/update', [Admin_CollegeController::class, 'update'])->name('admin.colleges.update');
    Route::delete('college/{college}/destroy', [Admin_CollegeController::class, 'destroy'])->name('admin.colleges.destroy');


    // directorates
    Route::get('/directorates', [Admin_DirectorateController::class, 'index'])->name('admin.directorates.index');
    Route::get('/directorates/create', [Admin_DirectorateController::class, 'create'])->name('admin.directorates.create');
    Route::post('/directorates/store', [Admin_DirectorateController::class, 'store'])->name('admin.directorates.store');
    
    Route::get('/directorates/{organ}/show', [Admin_DirectorateController::class, 'show'])->name('admin.directorates.show');
    Route::get('/directorates/{organ}/edit', [Admin_DirectorateController::class, 'edit'])->name('admin.directorates.edit');
    Route::post('/directorates/{organ}/update', [Admin_DirectorateController::class, 'update'])->name('admin.directorates.update');

    Route::get('/directorates/{organ}/confirm_delete', [Admin_DirectorateController::class, 'confirm_delete'])->name('admin.directorates.confirm_delete');
    Route::post('/directorates/{organ}/destroy', [Admin_DirectorateController::class, 'destroy'])->name('admin.directorates.destroy');

    
    // ministry
    Route::get('/ministries', [Admin_MinistryController::class, 'index'])->name('admin.ministries.index');
    Route::get('/ministries/create', [Admin_MinistryController::class, 'create'])->name('admin.ministries.create');
    Route::post('/ministries/store', [Admin_MinistryController::class, 'store'])->name('admin.ministries.store');
    
    Route::get('/ministries/{ministry}/show', [Admin_MinistryController::class, 'show'])->name('admin.ministries.show');
    Route::get('/ministries/{ministry}/edit', [Admin_MinistryController::class, 'edit'])->name('admin.ministries.edit');
    Route::post('/ministries/{ministry}/update', [Admin_MinistryController::class, 'update'])->name('admin.ministries.update');

    Route::get('/ministries/{ministry}/destroy', [Admin_MinistryController::class, 'destroy'])->name('admin.ministries.destroy');
    Route::post('/ministries/{ministry}/confirm_delete', [Admin_MinistryController::class, 'confirm_delete'])->name('admin.ministries.confirm_delete');


    
    // Department
    Route::get('/departments', [Admin_DepartmentController::class, 'index'])->name('admin.departments.index');
    Route::get('departments/create', [Admin_DepartmentController::class, 'create'])->name('admin.departments.create');
    Route::post('departments/store', [Admin_DepartmentController::class, 'store'])->name('admin.departments.store');
    
    Route::get('departments/{organ}/edit', [Admin_DepartmentController::class, 'edit'])->name('admin.departments.edit');
    Route::post('departments/{organ}/update', [Admin_DepartmentController::class, 'update'])->name('admin.departments.update');

    Route::get('departments/{organ}/confirm_delete', [Admin_DepartmentController::class, 'confirm_delete'])->name('admin.departments.confirm_delete');
    Route::post('/departments/{organ}/destroy', [Admin_DepartmentController::class, 'destroy'])->name('admin.departments.destroy');


    // Division
    Route::get('/divisions', [Admin_DivisionController::class, 'index'])->name('admin.divisions.index');
    Route::get('divisions/create', [Admin_DivisionController::class, 'create'])->name('admin.divisions.create');
    Route::post('divisions/store', [Admin_DivisionController::class, 'store'])->name('admin.divisions.store');
    
    Route::get('divisions/{organ}/show', [Admin_DivisionController::class, 'show'])->name('admin.divisions.show');
    Route::get('divisions/{organ}/edit', [Admin_DivisionController::class, 'edit'])->name('admin.divisions.edit');
    Route::post('divisions/{organ}/update', [Admin_DivisionController::class, 'update'])->name('admin.divisions.update');

    Route::get('divisions/{organ}/confirm_delete', [Admin_DivisionController::class, 'confirm_delete'])->name('admin.divisions.confirm_delete');
    Route::post('/divisions/{organ}/destroy', [Admin_DivisionController::class, 'destroy'])->name('admin.divisions.destroy');

    
    // Branch
    Route::get('/branches', [Admin_BranchController::class, 'index'])->name('admin.branches.index');
    Route::get('branches/create', [Admin_BranchController::class, 'create'])->name('admin.branches.create');
    Route::post('branches/store', [Admin_BranchController::class, 'store'])->name('admin.branches.store');
    
    Route::get('branches/{branch}/show', [Admin_BranchController::class, 'show'])->name('admin.branches.show');
    Route::get('branches/{branch}/edit', [Admin_BranchController::class, 'edit'])->name('admin.branches.edit');
    Route::post('branches/{branch}/update', [Admin_BranchController::class, 'update'])->name('admin.branches.update');

    Route::get('branches/{branch}/confirm_delete', [Admin_BranchController::class, 'confirm_delete'])->name('admin.branches.confirm_delete');
    Route::post('/branches/{branch}/destroy', [Admin_BranchController::class, 'destroy'])->name('admin.branches.destroy');


    // Section
    Route::get('/sections', [Admin_SectionController::class, 'index'])->name('admin.sections.index');
    Route::get('sections/create', [Admin_SectionController::class, 'create'])->name('admin.sections.create');
    Route::post('sections/store', [Admin_SectionController::class, 'store'])->name('admin.sections.store');
    
    Route::get('sections/{section}/show', [Admin_SectionController::class, 'show'])->name('admin.sections.show');
    Route::get('sections/{section}/edit', [Admin_SectionController::class, 'edit'])->name('admin.sections.edit');
    Route::post('sections/{section}/update', [Admin_SectionController::class, 'update'])->name('admin.sections.update');

    Route::get('sections/{section}/confirm_delete', [Admin_SectionController::class, 'confirm_delete'])->name('admin.sections.confirm_delete');
    Route::post('/sections/{section}/confirm_destroy', [Admin_SectionController::class, 'destroy'])->name('admin.sections.destroy');


    // Unit
    Route::get('/units', [Admin_UnitController::class, 'index'])->name('admin.units.index');
    Route::get('units/create', [Admin_UnitController::class, 'create'])->name('admin.units.create');
    Route::post('units/store', [Admin_UnitController::class, 'store'])->name('admin.units.store');
    
    Route::get('units/{unit}/show', [Admin_UnitController::class, 'show'])->name('admin.units.show');
    Route::get('units/{unit}/edit', [Admin_UnitController::class, 'edit'])->name('admin.units.edit');
    Route::post('units/{unit}/update', [Admin_UnitController::class, 'update'])->name('admin.units.update');

    Route::get('units/{unit}/confirm_delete', [Admin_UnitController::class, 'confirm_delete'])->name('admin.units.confirm_delete');
    Route::post('/units/{unit}/destroy', [Admin_UnitController::class, 'destroy'])->name('admin.units.destroy');





    // Staff
    Route::get('staff', [Admin_StaffController::class, 'index'])->name('admin.staff.index');
    Route::post('staff/select_organ', [Admin_StaffController::class, 'select_organ'])->name('admin.staff.select_organ');
    Route::get('staff/{organ}/create', [Admin_StaffController::class, 'create'])->name('admin.staff.create');
    Route::post('staff/store', [Admin_StaffController::class, 'store'])->name('admin.staff.store');

    Route::get('staff/{staff}/edit', [Admin_StaffController::class, 'edit'])->name('admin.staff.edit');
    Route::post('staff/{staff}/update', [Admin_StaffController::class, 'update'])->name('admin.staff.update');


    // Admin Document Category Type
    Route::get('admin_category_types', [Admin_AdminCategoryTypeController::class, 'index'])->name('admin.admin_category_types.index');
    Route::get('admin_category_types/create', [Admin_AdminCategoryTypeController::class, 'create'])->name('admin.admin_category_types.create');
    Route::post('admin_category_types/store', [Admin_AdminCategoryTypeController::class, 'store'])->name('admin.admin_category_types.store');
    Route::get('admin_category_types/{admin_category_type}/edit', [Admin_AdminCategoryTypeController::class, 'edit'])->name('admin.admin_category_types.edit');
    Route::post('admin_category_types/{admin_category_type}/update', [Admin_AdminCategoryTypeController::class, 'update'])->name('admin.admin_category_types.update');
    Route::get('admin_category_types/{admin_category_type}/show', [Admin_AdminCategoryTypeController::class, 'show'])->name('admin.admin_category_types.show');
    


    // Admin Categories
    Route::get('admin_categories', [Admin_AdminCategoryController::class, 'index'])->name('admin.admin_categories.index');
    Route::get('admin_categories/create', [Admin_AdminCategoryController::class, 'create'])->name('admin.admin_categories.create');
    Route::post('admin_categories/store', [Admin_AdminCategoryController::class, 'store'])->name('admin.admin_categories.store');
    Route::get('admin_categories/{admin_category}/edit', [Admin_AdminCategoryController::class, 'edit'])->name('admin.admin_categories.edit');
    Route::post('admin_categories/{admin_category}/update', [Admin_AdminCategoryController::class, 'update'])->name('admin.admin_categories.update');

    //  Admin Documents
    Route::get('admin_documents', [Admin_AdminDocumentController::class, 'index'])->name('admin.admin_documents.index');
 

    // Document
    Route::get('documents', [Admin_DocumentController::class, 'index'])->name('admin.documents.index');
    Route::get('document_details/{document}', [Admin_DocumentController::class, 'show'])->name('admin.documents.show');

    // User Profile
    Route::get('/profile/user/{fileno}', [Admin_ProfileController::class, 'user_profile'])->name('admin.profile.user_profile');

    // Tracker
    Route::get('tracker', [Admin_TrackerController::class, 'index'])->name('admin.tracker.index');
    Route::get('analytics', [Admin_AnalyticsController::class, 'index'])->name('admin.analytics.index');
    //Route::post('tracker', [Admin_TrackerController::class, 'index'])->name('admin.tracker.index');


    // Deans
    Route::get('deans', [Admin_DeanController::class, 'index'])->name('admin.deans.index');
    Route::get('dean/create', [Admin_DeanController::class, 'create'])->name('admin.deans.create');
    Route::post('dean/get_assigned_dean', [Admin_DeanController::class, 'get_assigned_dean'])->name('admin.deans.get_assigned_dean');

    Route::get('dean/assign_dean', [Admin_DeanController::class, 'assign_dean'])->name('admin.deans.assign_dean');
    Route::post('dean/assign_dean', [Admin_DeanController::class, 'store_assign_dean'])->name('admin.deans.store_assign_dean');


    // Financial Year
    Route::get('financial_years', [Admin_FinancialYearController::class, 'index'])->name('admin.financial_years.index');
    Route::get('financial_years/create', [Admin_FinancialYearController::class, 'create'])->name('admin.financial_years.create');
    Route::post('financial_years/store', [Admin_FinancialYearController::class, 'store'])->name('admin.financial_years.store');

    Route::get('financial_years/{financial_year}/show', [Admin_FinancialYearController::class, 'show'])->name('admin.financial_years.show');
    Route::get('financial_years/{financial_year}/edit', [Admin_FinancialYearController::class, 'edit'])->name('admin.financial_years.edit');
    Route::post('financial_years/{financial_year}/update', [Admin_FinancialYearController::class, 'update'])->name('admin.financial_years.update');

    Route::get('financial_years/{financial_year}/confirm_delete', [Admin_FinancialYearController::class, 'confirm_delete'])->name('admin.financial_years.confirm_delete');
    Route::delete('financial_years/{financial_year}/delete', [Admin_FinancialYearController::class, 'destroy'])->name('admin.financial_years.delete');

    Route::get('financial_years/{financial_year}/vaults/create', [Admin_VaultController::class, 'create'])->name('admin.financial_years.vaults.create');
    
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
