<?php

use App\Http\Controllers\API\StationImageController;
use App\Http\Controllers\LineUserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\UserLocationController;
use App\Models\Station;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/', function () {
    //IMAGES
    $images = [
        'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_1.jpg',
        'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_38.jpg',
        'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_65.jpg',
        'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_78.jpg',
        'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_147.jpg',
        'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_137.jpg',
    ];
    //BLOG
    $response = Http::get('https://ckartisan.com/api/medium/feed/thungsong-th');
    $blogObject = $response->json();
    //WL + RAIN
    $response = Http::get(url('api/now/wl'));
    $wl = $response->json();
    $wl = array_filter($wl, function ($item) {
        if (!isset($item['station']['tele_station_lat'])) return false;
        return $item['station']['tele_station_lat'] >= 8.174971;
    });
    $response = Http::get(url('api/now/rain'));
    $rain = $response->json();
    $rain = array_filter($rain, function ($item) {
        return $item['station']['tele_station_lat'] >= 8.174971;
    });
    return view('home', compact('blogObject', 'images', 'wl', 'rain'));
});
Route::get('/about', function () {
    //IMAGES
    $images = [
        'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_1.jpg',
        'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_38.jpg',
        'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_65.jpg',
        'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_78.jpg',
        'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_147.jpg',
        'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_137.jpg',
    ];
    $profiles = [
        (object)["image" => "https://sci.vru.ac.th/assets/images/people/IMG_20230513_104518_edit.jpg", "name" => "รศ.ดร.นิสา พักตร์วิไล", "position" => "หัวหน้าทีมวิจัย", "organization" => "สาขาวิทยาศาสตร์และเทคโนโลยีสิ่งแวดล้อม คณะวิทยาศาสตร์และเทคโนโลยี มหาวิทยาลัยราชภัฏวไลยอลงกรณ์ ในพระบรมราชูปถัมภ์"],
        (object)["image" => "https://disastervru.wordpress.com/wp-content/uploads/2021/04/222-2.jpg", "name" => "อ.นิธิพนธ์ น้อยเผ่า", "position" => "ผู้ร่วมวิจัย", "organization" => "สาขาวิชาการจัดการสาธารณภัย คณะวิทยาศาสตร์และเทคโนโลยีสุขภาพ มหาวิทยาลัยนวมินทราธิราช"],
        (object)["image" => "https://sci.vru.ac.th/assets/images/people/IMG_20230513_090317_edit.jpg", "name" => "อ.ชวลิต โควีระวงศ์", "position" => "ผู้ร่วมวิจัย", "organization" => "สาขาวิทยาการคอมพิวเตอร์ คณะวิทยาศาสตร์และเทคโนโลยี มหาวิทยาลัยราชภัฏวไลยอลงกรณ์ ในพระบรมราชูปถัมภ์"],
        (object)["image" => "https://sci.vru.ac.th/assets/images/people/IMG_20230513_091252_edit.jpg", "name" => "อ.สมคิด ตันเก็ง", "position" => "ผู้ร่วมวิจัย", "organization" => "สาขาการจัดการภัยพิบัติ คณะวิทยาศาสตร์และเทคโนโลยี มหาวิทยาลัยราชภัฏวไลยอลงกรณ์ ในพระบรมราชูปถัมภ์"],
        (object)["image" => "https://sci.vru.ac.th/assets/images/people/IMG_20230513_102620_edit.jpg", "name" => "อ.ศิรภัสสร พันธะสา", "position" => "ผู้ร่วมวิจัย", "organization" => "สาขาการจัดการภัยพิบัติ คณะวิทยาศาสตร์และเทคโนโลยี มหาวิทยาลัยราชภัฏวไลยอลงกรณ์ ในพระบรมราชูปถัมภ์"],
        (object)["image" => "http://www.wre.eng.ku.ac.th/upload/user/user_33_0847.png", "name" => "อ.ดร.เดชพล จิตรวัฒน์ลศิริ", "position" => "ผู้ร่วมวิจัย", "organization" => "ภาควิชาวิศวกรรมทรัพยากรน้ำ คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเกษตรศาสตร์"],
    ];
    return view('about', compact('profiles', 'images'));
});
Route::get('/statistic', function () {
    $response = Http::get(url('api/now/wl'));
    $wl = $response->json();
    $wl = array_filter($wl, function ($item) {
        if (!isset($item['station']['tele_station_lat'])) return false;
        return $item['station']['tele_station_lat'] >= 8.174971;
    });
    $response = Http::get(url('api/now/rain'));
    $rain = $response->json();
    $rain = array_filter($rain, function ($item) {
        return $item['station']['tele_station_lat'] >= 8.174971;
    });
    return view('statistic', compact('wl', 'rain'));
});
Route::get('/predict', function () {
    return view('predict');
});
Route::get('/blog', function () {
    $response = Http::get('https://ckartisan.com/api/medium/feed/thungsong-th');
    $blogObject = $response->json();
    return view('blog', compact('blogObject'));
});

Route::get('/gallery', function () {
    $images = ['LINE_ALBUM_Nakhon Sri _day 1_160222_220914_1.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_105.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_119.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_12.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_137.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_146.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_147.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_149.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_158.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_162.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_166.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_29.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_30.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_38.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_46.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_65.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_78.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_8.jpg', 'LINE_ALBUM_Nakhon Sri _day 1_160222_220914_85.jpg', 'LINE_ALBUM_Nakhon Sri_day_2 170222_221202_17.jpg', 'LINE_ALBUM_Nakhon Sri_day_2 170222_221202_36.jpg', 'LINE_ALBUM_Nakhon Sri_day_2 170222_221202_42.jpg', 'LINE_ALBUM_Nakhon Sri_day_2 170222_221202_64.jpg', 'LINE_ALBUM_Nakhon Sri_day_2 170222_221202_8.jpg', 'LINE_ALBUM_Nakhon Sri_day_2 170222_221202_9.jpg'];
    return view('gallery', compact('images'));
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/chart', function () {
    return view('chart');
});
Route::get('/testmap', function () {
    return view('m');
});

Route::get('livewire', function () {
    return view('livewire');
});

Route::get('place/{station_id}', function ($station_id) {
    $data = [
        "wl" => [],
        "rain" => [],
    ];
    foreach ($data as $key => $value) {
        $url = url("api/now/{$key}?station_id={$station_id}");
        $response = Http::get($url);
        $v = $response->json();
        $data[$key] = $v;
    }
    if ( $data["wl"] && $data["rain"] == false ) {
        abort(404);
    }
    $data["station"] = $data["wl"] ? $data["wl"][0]["station"] : $data["rain"][0]["station"];
    $data["geocode"] = $data["wl"] ? $data["wl"][0]["geocode"] : $data["rain"][0]["geocode"];
    $images = Http::get("https://picsum.photos/v2/list")->json();
    $station = Station::where('code', $station_id)->firstOrFail();
    return view('place', compact('data','images','station'));
})->name('place.show');


Route::resource('post', PostController::class);
Route::resource('product', ProductController::class);
Route::resource('station', StationController::class);
Route::resource('station-image', StationImageController::class);

Route::resource('user-location', UserLocationController::class);
Route::resource('line-user', LineUserController::class);