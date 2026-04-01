use App\Http\Controllers\Api\FuelController;
Route::get('/dashboard', [FuelController::class, 'index']);