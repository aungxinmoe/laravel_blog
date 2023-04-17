<?php
namespace App\Models;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use App\Models\UrlEncrypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;  
class Blog{
public $title;
public $slug;
public $intro;
public $body;
public $date;
public function __construct($title,$slug,$intro,$body,$date){
  $this->title=$title;
  $this->slug=$slug;
  $this->intro=$intro;
  $this->body=$body;
  $this->date=$date;

}

public static function all()
{


return collect(File::files(resource_path('blogs')))->map(function($file){
    $obj=YamlFrontMatter::parseFile($file);
  return new Blog($obj->title,$obj->slug,$obj->intro,$obj->body(),$obj->date);
})->sortByDesc('date');

}

public static function find($slug)
{
  $blogs=static::all();
return $blogs->firstWhere('slug',$slug);

}

public static function findOrFail($slug)
{

$blog=static::find($slug);
if(!$blog){
	throw new ModelNotFoundException();
}
return $blog;
}
}

// $url=UrlEncrypt::sign_bcdn_url(
//   "https://awsvideo.b-cdn.net/Videos/how%20to%20upgrade%20awstv2.5.0.mp4", // Url to sign
//   "e5a54248-1420-4fd7-bc9d-b11877f01772", // Token Key
//   60, // Expiration time in seconds/ Place user IP here
//  false, // Directory token 
//   "/");
// dd($url);
// return $url;
//         $path=resource_path("blogs/$slug.html");
//     if(!file_exists($path)){
//       abort(404);
//     }
// return cache()->remember('posts.$slug',5, function () use($path) {
//     return file_get_contents($path);
// });