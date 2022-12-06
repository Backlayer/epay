<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
class EnvController extends Controller
{
    public function index()
    {
        $countries= base_path('lang/langlist.json');
        $countries= json_decode(file_get_contents($countries),true);

        return view('admin.settings.env',compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_account_credentials' => 'mimes:json,txt|max:100',
        ]);

        if ($request->hasFile('service_account_credentials')) {
            $file = $request->file('service_account_credentials');
            $name = 'service-account-credentials.json';
            $path = 'uploads/';
            $file->move($path, $name);
        }

        $APP_URL_WITHOUT_WWW=str_replace('www.','', url('/'));
         $APP_NAME = Str::slug($request->APP_NAME);
$txt ="APP_NAME=".$APP_NAME."
APP_ENV=local
APP_KEY=".env('APP_KEY')."
APP_DEBUG=".$request->APP_DEBUG."
APP_URL=".url('/')."
SITE_KEY=".env('SITE_KEY')."
AUTHORIZED_KEY=".env('AUTHORIZED_KEY')."

CONTENT_EDITOR=".$request->CONTENT_EDITOR."
ANALYTICS_VIEW_ID=".$request->ANALYTICS_VIEW_ID."
GA_MEASUREMENT_ID=".$request->GA_MEASUREMENT_ID."
KYC_MUST_VERIFIED=".$request->KYC_MUST_VERIFIED."
KYC_MUST_VERIFIED_MIN_DAY=".$request->KYC_MUST_VERIFIED_MIN_DAY."
FORCE_USER_TO_PURCHASE_PLAN=".$request->FORCE_USER_TO_PURCHASE_PLAN."
UNSUBSCRIBE_AFTER_DAYS=".$request->UNSUBSCRIBE_AFTER_DAYS."


DB_CONNECTION=".env("DB_CONNECTION")."
DB_HOST=".env("DB_HOST")."
DB_PORT=".env("DB_PORT")."
DB_DATABASE=".env("DB_DATABASE")."
DB_USERNAME=".env("DB_USERNAME")."
DB_PASSWORD=".env("DB_PASSWORD")."



QUEUE_MAIL=".$request->QUEUE_MAIL."
".$request->MAIL_DRIVER_TYPE."=".$request->MAIL_DRIVER."
MAIL_DRIVER_TYPE=".$request->MAIL_DRIVER_TYPE."
MAIL_HOST=".$request->MAIL_HOST."
MAIL_PORT=".$request->MAIL_PORT."
MAIL_USERNAME=".$request->MAIL_USERNAME."
MAIL_PASSWORD=".$request->MAIL_PASSWORD."
MAIL_ENCRYPTION=".$request->MAIL_ENCRYPTION."
MAIL_FROM_ADDRESS=".$request->MAIL_FROM_ADDRESS."
MAIL_TO=".$request->MAIL_TO."
MAIL_FROM_NAME='".$request->MAIL_FROM_NAME."'


MAILCHIMP_DRIVER=".$request->MAILCHIMP_DRIVER."
MAILCHIMP_APIKEY=".$request->MAILCHIMP_APIKEY."
MAILCHIMP_LIST_ID=".$request->MAILCHIMP_LIST_ID."

NOCAPTCHA_SECRET=".$request->NOCAPTCHA_SECRET."
NOCAPTCHA_SITEKEY=".$request->NOCAPTCHA_SITEKEY."

BROADCAST_DRIVER=pusher
CACHE_DRIVER=".$request->CACHE_DRIVER."
QUEUE_CONNECTION=database
SESSION_DRIVER=".$request->SESSION_DRIVER."
SESSION_LIFETIME=".$request->SESSION_LIFETIME."

PUSHER_APP_ID=".$request->PUSHER_APP_ID."
PUSHER_APP_KEY=".$request->PUSHER_APP_KEY."
PUSHER_APP_SECRET=".$request->PUSHER_APP_SECRET."
PUSHER_APP_CLUSTER=".$request->PUSHER_APP_CLUSTER."
PUSHER_SCHEME=https
MIX_PUSHER_APP_KEY=".'${PUSHER_APP_KEY}'."
MIX_PUSHER_APP_CLUSTER=".'${PUSHER_APP_CLUSTER}'."

REDIS_HOST=".$request->REDIS_HOST."
REDIS_PORT=".$request->REDIS_PORT."
REDIS_URL=".$request->REDIS_URL."
REDIS_PASSWORD=".$request->REDIS_PASSWORD."

MEMCACHED_HOST=".$request->MEMCACHED_HOST."
MEMCACHED_PORT=".$request->MEMCACHED_PORT."
MEMCACHED_PERSISTENT_ID=".$request->MEMCACHED_PERSISTENT_ID."
MEMCACHED_USERNAME=".$request->MEMCACHED_USERNAME."
MEMCACHED_PASSWORD=".$request->MEMCACHED_PASSWORD."


AWS_ACCESS_KEY_ID=".$request->AWS_ACCESS_KEY_ID."
AWS_SECRET_ACCESS_KEY=".$request->AWS_SECRET_ACCESS_KEY."
AWS_DEFAULT_REGION=".$request->AWS_DEFAULT_REGION."
AWS_BUCKET=".$request->AWS_BUCKET."

WAS_ACCESS_KEY_ID=".$request->WAS_ACCESS_KEY_ID."
WAS_SECRET_ACCESS_KEY=".$request->WAS_SECRET_ACCESS_KEY."
WAS_DEFAULT_REGION=".$request->WAS_DEFAULT_REGION."
WAS_BUCKET=".$request->WAS_BUCKET."
WAS_ENDPOINT=".$request->WAS_ENDPOINT."


GOOGLE_CLIENT_ID=".$request->GOOGLE_CLIENT_ID."
GOOGLE_CLIENT_SECRET=".$request->GOOGLE_CLIENT_SECRET."


FACEBOOK_CLIENT_ID=".$request->FACEBOOK_CLIENT_ID."
FACEBOOK_CLIENT_SECRET=".$request->FACEBOOK_CLIENT_SECRET."

GITHUB_CLIENT_ID=".$request->GITHUB_CLIENT_ID."
GITHUB_CLIENT_SECRET=".$request->GITHUB_CLIENT_SECRET."

DISCUSS_COMMENT_KEY=".$request->DISCUSS_COMMENT_KEY."

LOG_CHANNEL=stack
LOG_LEVEL=debug
CACHE_LIFETIME=".$request->CACHE_LIFETIME."
TIMEZONE=".$request->TIMEZONE."

DEFAULT_LANG=".$request->DEFAULT_LANG."
DISCUSS_COMMENT_KEY=".$request->DISCUSS_COMMENT_KEY."

FILESYSTEM_DISK=".$request->FILESYSTEM_DISK."

VITE_PUSHER_APP_KEY=".'${PUSHER_APP_KEY}'."
VITE_PUSHER_HOST=".'${PUSHER_HOST}'."
VITE_PUSHER_PORT=".'${PUSHER_PORT}'."
VITE_PUSHER_SCHEME=".'${PUSHER_SCHEME}'."
VITE_PUSHER_APP_CLUSTER=".'${PUSHER_APP_CLUSTER}'."

APILAYER_API_KEY=".$request->APILAYER_API_KEY."

";

  File::put(base_path('.env'),$txt);
       return response()->json("System Updated");
    }
}
