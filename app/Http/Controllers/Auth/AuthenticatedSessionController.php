<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    // function generateRandomString($length = 10) {
    //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     $charactersLength = strlen($characters);
    //     $randomString = '';
    //     for ($i = 0; $i < $length; $i++) {
    //         $randomString .= $characters[random_int(0, $charactersLength - 1)];
    //     }
    //     return $randomString;
    // }

    // public function googleAuthQR() {
    //     $googleauth_secret_code = $this->generateRandomString();
        
    //     $cURLConnection = curl_init('https://www.authenticatorapi.com/pair.aspx?AppName=jobaggregator&AppInfo=TallalJamshed&SecretCode='.$googleauth_secret_code);
    //     curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    //     $apiResponse = curl_exec($cURLConnection);
    //     curl_close($cURLConnection);
        
    //     $dom = new \DomDocument();
    //     $test=$apiResponse;
    
    //     $dom->loadHTML($test);
        
    //     $xpath = new \DOMXpath($dom);
    //     $qrkey = parsekey($xpath);
        
    //     // $message = "QR Not Saved";
        
    //     if($qrkey != ""){
    //         $newEmail = "admin@applytab.com";
    //         $user = User::where('email',$newEmail)->update(['google_authenticator_key'=>$googleauth_secret_code]);
    //         // $user = User::where('id',auth()->user()->id)->update(['google_authenticator_key'=>$googleauth_secret_code]);
    //         if ($user) {
    //             session()->flash('status','QR Saved in Database');
    //             $message = "QR Saved in Database";
    //         }
    //     }

    //     return view('auth.qrshow' , compact(['apiResponse','message']));
    // }

    // function parsekey($xpath)
    //     {
    //         $key="";
    //         $xpathquery = "//a/@title";
    //         $elements = $xpath->query($xpathquery);
        
    //         if (!is_null($elements)) {
    //             foreach ($elements as $element) {
    //                 if(strpos($element->value, 'Manually pair with') !== false){
    //                     $key = str_replace("Manually pair with","",$element->value);
    //                     $key = trim($key);
    //                 }
    //             }
    //         }
    //         return $key;
    //     }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        if (Auth::check() && \Auth::user()->hasRole('superadmin|customer')) {
            return redirect()->route('backend.dashboard');
        }elseif(Auth::check() && auth()->user()->hasRole('endUser')) {
            /* return redirect()->route('enduser.profile.index'); */
            return redirect()->to(session('url.intended'));
        }
        /* return redirect()->intended(RouteServiceProvider::HOME); */
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $manager = app('impersonate');
        /* dd($manager->isImpersonating()); */
        if ($manager->isImpersonating()) {
            Auth::user()->leaveImpersonation();
            return redirect()->route('backend.adsListing');
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()->route('login');
    }
}
