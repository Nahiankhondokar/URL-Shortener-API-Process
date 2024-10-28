<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\VisitorCountResource;
use App\Models\ShortUrl;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VisitorController extends Controller
{
    use ApiResponse;
    
    public function index()
    {
        $url = ShortUrl::query()->get();
        return $this->successApiResponse(VisitorCountResource::collection($url), 'Visitor counts of shorten URL.');
    }

    public function visitorCount($url)
    {
        $url = env('APP_URL').'/'.$url;
        $urlCheck = ShortUrl::query()->where('shorten_url', $url)->first();

        if($urlCheck){
            $urlCheck->visitor_count = $urlCheck->visitor_count + 1;
            $urlCheck->update();
            
            return redirect($urlCheck->original_url);
        }

        return response()->json('Data not found!');
    }
}