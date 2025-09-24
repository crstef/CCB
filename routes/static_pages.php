use Illuminate\Support\Facades\Route;

// Pagini statice pentru meniuri și footer
Route::view('/misiunea', 'themes.anchor.pages.misiunea')->name('page.misiunea');
Route::view('/rescue', 'themes.anchor.pages.rescue')->name('page.rescue');
Route::view('/despre-noi', 'themes.anchor.pages.despre-noi')->name('page.despre-noi');
