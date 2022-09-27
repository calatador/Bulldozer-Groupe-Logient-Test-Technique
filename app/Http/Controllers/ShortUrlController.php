<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShortRequest;
use App\Models\ShortUrl;
use Location;

class ShortUrlController extends Controller
{
    public function short(ShortRequest $request)
    {
        if ($request->original_url) {
            $count = auth()->user()->links()->count();
            if( $count >= 5){
                return redirect()->back()->with('warning',__('You have already reached the maximum of 5 short URLs'));
            }
            $new_url = auth()->user()->links()->create([
                'original_url' => $request->original_url
            ]);
            if ($new_url) {
                $short_url = base_convert($new_url->id, 10, 36);
                $new_url->update([
                    'short_url' => $short_url
                ]);
                ShortUrl::latest()->where('id', '<', $new_url->id-19)->delete();
                return redirect()->back()->with('success_message', __('Your Short url:') .' <b><a href="'. url($short_url) .'">'. url($short_url) .'</a></b>');
            }
        }
        return back();
    }
    public function show(Request $request , $code)
    {
        $short_url = ShortUrl::where('short_url', $code)->first();

        if ($short_url) {
            $short_url->increment('visits');


            $ip = $request->ip();

            if  ($ip == '127.0.0.1'){
                $country = "localhost";
            } else {
                $data = \Location::get($ip);
                $country = $data->countryName;
            }


            $log = $short_url->log()->create([
                'url' => 'http://'. $request->server('HTTP_HOST') . $request->server('REQUEST_URI'),
                'user_id' => (auth()->user() ? auth()->user()->id : null)  ,
                'ip' => $request->ip(),
                'country' => $country,
                'user_agent' => $request->server('HTTP_USER_AGENT')
             ]);
            return redirect()->to(url($short_url->original_url));
        }
        return redirect()->to(url('/'));
    }

    public function delete($id)
    {
        $short_url = ShortUrl::where('user_id','=', auth()->user()->id)->where('id' , '=' , $id)->first();
        if( $short_url instanceof ShortUrl){
            $short_url->delete();
            return redirect()->back()->with('success_message', 'Short Url removed with success');
        }
        return redirect()->back()->with('warning', '404 not found');

    }
    public function showLog($lang , $id)
    {
        $short_url = ShortUrl::where('user_id','=', auth()->user()->id)->where('id' , '=' , $id)->first();
        if( $short_url instanceof ShortUrl){
        $logs = $short_url->log()->paginate(10);
        return view('log', compact('logs'));
        }else{
            return redirect()->back()->with('warning', '404 not found');

        }

    }

}
