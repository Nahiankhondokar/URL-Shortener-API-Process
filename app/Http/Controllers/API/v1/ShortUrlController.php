<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShortUrlRequest;
use App\Models\ShortUrl;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{
    use ApiResponse;
    
    public function shortUrl(ShortUrlRequest $request)
    {
        $randomStr = findRandomStr();
        $shorUrlQuery = ShortUrl::query();
        
        $existsRandomStr = (clone $shorUrlQuery)->where('shorten_url', $randomStr)->exists(); // clone for make sure separate instace
        $url = $existsOrgUrl = (clone $shorUrlQuery)->where('original_url', $request->original_url)->first();

        if(!$existsOrgUrl){
            
            if($existsRandomStr){
                $randomStr = findRandomStr();
            }

            $url = ShortUrl::query()->create([
                'original_url'     => $request->original_url,
                'shorten_url'      => env('APP_URL').'/'.$randomStr,
            ]);
        }
       
        return $this->successApiResponse($url, 'Your shorten URL is ready.');
    }
}