use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Aqui ficam suas rotas web. Se não for usar nenhuma, deixe só o fallback
*/

Route::fallback(function () {
    abort(404);
});
