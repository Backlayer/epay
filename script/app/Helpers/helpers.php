<?php

use App\Models\Tax;
use App\Models\Menu;
use App\Models\User;
use App\Models\Level;
use App\Models\Order;
use App\Models\Option;
use App\Models\Wallet;
use App\Models\Gateway;
use App\Models\Currency;
use App\Models\Follower;
use App\Models\LevelUser;
use App\Models\FrontendData;
use App\Models\Message;
use App\Models\Storefront;
use Illuminate\Support\Carbon;
use Illuminate\Support\Optional;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Foundation\Application;

if (!function_exists('disquscomment')) {
    /**
     * Get Disqus Comment Section
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    function disquscomment(): Factory|\Illuminate\Contracts\View\View|Application
    {
        return view('components.disquss');
    }
}

if (!function_exists('is_following')) {
    function is_following($id)
    {
        return Follower::where('user_id', $id)->where('follower_id', auth()->id() ?? 0)->exists();
    }
}

if (!function_exists('get_store')) {
    function get_store($id)
    {
        return Storefront::find($id);
    }
}

if (!function_exists('is_subscribed')) {
    function is_subscribed($id)
    {
        if (auth()->check()) {
            return LevelUser::where('owner_id', $id)->where('will_expire', '>', now())->where('user_id', auth()->id())->exists();
        } else {
            return 0;
        }
    }
}

if (!function_exists('get_option')) {
    /**
     * Get Settings From Database
     * @param $key
     * @param bool $decode
     * @param $locale
     * @return mixed
     */
    function get_option($key, bool $decode = false, $locale = false, $associative = false): mixed
    {
        $option = cache_remember($key, function () use ($key, $locale) {
            return $model = Option::where(['key' => $key, 'lang' => $locale ?? current_locale()])->first();
        });

        return $decode ? json_decode($option, $associative)->value ?? null : $option->value ?? null;
    }
}


if (!function_exists('get_frontend_data')) {
    /**
     * Get Settings From Database
     * @param $key
     * @param bool $decode
     * @param $locale
     * @return mixed
     */
    function get_frontend_data($key, bool $decode = false, $locale = null, $associative = false): mixed
    {
        $option = cache_remember($key, function () use ($key, $locale) {
            return $model = FrontendData::where(['key' => $key, 'lang' => $locale ?? current_locale()])->first();
        });

        return $decode ? json_decode($option, $associative)->value ?? null : $option->value ?? null;
    }
}


if (!function_exists('imageSizes')) {
    /**
     * Get Conversation Image Sizes
     * @return string
     */
    function imageSizes(): string
    {
        $sizes = '[{"key":"small","height":"80","width":"80"}]';
        return $sizes;
    }
}

/**
 * Show Dropzone Media Uploader Section
 * @param $array
 * @param $blade_name
 * @return Factory|\Illuminate\Contracts\View\View|Application
 */
function mediasection($array = [], $blade_name = "flatmedia"): Factory|\Illuminate\Contracts\View\View|Application
{
    $title = $array['title'] ?? 'Image';
    $preview_class = $array['preview_class'] ?? 'input_preview';
    $preview = $array['preview'] ?? 'admin/img/img/placeholder.png';
    $input_id = $array['input_id'] ?? 'preview';
    $input_class = $array['input_class'] ?? 'input_image';
    $input_name = $array['input_name'] ?? 'preview';
    $value = $array['value'] ?? '';
    return view('components.media.' . $blade_name, compact('title', 'preview_class', 'preview', 'input_id', 'input_class', 'input_name', 'value'));
}

/**
 * Include Dropzone Media Uploader Modal
 * @return Factory|\Illuminate\Contracts\View\View|Application
 */
function mediasingle($view = 'mediamodal'): Factory|\Illuminate\Contracts\View\View|Application
{

    return view('components.media.' . $view);
}

/**
 * Displaying Unescaped Data
 * @param $data
 * @return Factory|\Illuminate\Contracts\View\View|Application
 */
function content_format($data): Factory|\Illuminate\Contracts\View\View|Application
{
    return view('components.content', compact('data'));
}

if (!function_exists('id')) {
    /**
     * Get Static ID
     * @return string
     */
    function id(): string
    {
        return "39613665";
    }
}

if (!function_exists('RenderMenu')) {
    /**
     * Get Dynamic Menu From Database
     * @param $position
     * @param string $path
     * @return Factory|\Illuminate\Contracts\View\View|Application
     */
    function RenderMenu($position, string $path = 'components.menu'): Factory|\Illuminate\Contracts\View\View|Application
    {
        $locale = App::getLocale();

        $menus = cache_remember($position . $locale, function () use ($position, $locale) {
            $menus = Menu::where('position', $position)->where('lang', $locale)->first();
            $data['data'] = json_decode($menus->data ?? '');
            $data['name'] = $menus->name ?? '';
            return $data;
        });

        return view($path . '.parent', compact('menus'));
    }
}

if (!function_exists('amount_format')) {
    /**
     * This function will return number format
     * EX: 100.00
     * @param int $value
     * @return int|float
     */
    function amount_format(int $value = 0): int|float
    {
        {
            return number_format($value, 2);
        }
    }
}

if (!function_exists('get_gravatar')) {

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param int|string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boolean $img True to return a complete IMG tag False for just the URL
     * @param array $attr Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     **/
    function get_gravatar(string $email, int|string $s = 80, string $d = 'mp', string $r = 'g', bool $img = false, array $attr = array()): string
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($attr as $key => $val) $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }
}

if (!function_exists('previous_route_name')) {
    /**
     * Get Previous Visited Route Name from previous url
     * @return string|null
     */
    function previous_route_name(): ?string
    {
        return app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
    }
}

if (!function_exists('formatted_date')) {
    /**
     * Format the Date
     * @param string|null $date
     * @param string $format
     * @return string|null
     */
    function formatted_date(string $date = null, string $format = 'd M, Y'): ?string
    {
        return !empty($date) ? Date::parse($date)->format($format) : null;
    }
}

if (!function_exists('current_plan')) {
    /**
     * Get Current Active Plan from Authenticated user
     * @return Level|Optional|mixed|null
     */
    function current_plan(): mixed
    {
        return optional(Auth::user()->plan);
    }
}

if (!function_exists('check_expire')) {
    /**
     * Check User Activated Plan Expiry
     * @return bool
     */
    function check_expire(): bool
    {
        return Auth::user()->will_expire >= date('Y-m-d');
    }

}

if (!function_exists('pending_order')) {
    /**
     * Check User Activated Order Pending
     *
     */
    function pending_order()
    {
        return Order::where('user_id', auth()->user()->id)->where('payment_status', '2')->latest()->first();
    }

}

if (!function_exists('cache_remember')) {
    /**
     * This function will remember the cache
     * @param string $key
     * @param callable $callback
     * @param integer $ttl
     * @return mixed
     */
    function cache_remember(string $key, callable $callback, int $ttl = 1800): mixed
    {
        return cache()->remember($key, env('CACHE_LIFETIME', $ttl), $callback);
    }
}

if (!function_exists('current_locale')) {
    /**
     * Get Current Locale
     * Return current locale|lang
     * @return string|null
     */
    function current_locale()
    {
        return app()->getLocale();
    }
}

if (!function_exists('map_iframe')) {
    /**
     * @param string|null $url
     * @param $width
     * @param $height
     * @param string $loading
     * @param $style
     * @return string
     */
    function map_iframe(string $url = null, $width = 600, $height = 450, string $loading = 'lazy', $style = null): string
    {
        return Blade::render('<iframe width="' . $width . '" height="' . $height . '" style="border:0" loading="' . $loading . '" allowfullscreen src="' . $url . '"></iframe>');
    }
}

if (!function_exists('get_reserved_slugs')) {
    /**
     * Get reserved slugs by registered route
     * @return Collection
     */
    function get_reserved_slugs(): Collection
    {
        $routeCollection = Route::getRoutes()->get();

        $segments = [];
        foreach ($routeCollection as $value) {
            $firstSegment = str($value->uri())->explode('/')[0];
            $segments[$firstSegment] = $firstSegment;
        }

        return collect($segments)->keys();
    }
}


/**
 * Convert number to amount
 * @param $amount
 * @param $type
 * @return string
 */
function currency_format($amount, $type = "icon", $customIcon = null, $decimals = 2, $currency = null)
{
    $amount = number_format($amount, $decimals);
    $currency = $currency ?? default_currency();
    $symbol = $customIcon ?? $currency->symbol;

    if ($type == "icon" || $type == "symbol") {
        if ($currency->position == "right") {
            return $amount . $symbol;
        } else {
            return $symbol . $amount;
        }
    } else {
        if ($currency->position == "right") {
            return $amount . ' ' . $currency->code;
        } else {
            return $currency->code . ' ' . $amount;
        }
    }
}

if (!function_exists('will_expire')) {
    function will_expire($plan)
    {
        if (empty($plan)) {
            return Carbon::now()->addDays(9999)->toDateString();
        } elseif ($plan->duration == -1) {
            return Carbon::now()->addDays(9999)->toDateString();
        } else {
            return Carbon::now()->addDays($plan->duration)->toDateString();
        }
    }
}

if (!function_exists('get_currency')) {
    /**
     * @param string $code Currency ISO Code
     * @return mixed
     */
    function get_currency(string $code): mixed
    {
        return cache_remember('currency.' . $code, function () use ($code) {
            return Currency::whereStatus(1)->whereCode($code)->firstOrFail();
        });
    }
}

if (!function_exists('default_currency')) {
    /**
     * Get default currency
     * @param null $key
     */
    function default_currency($key = null, Currency $currency = null): object|int|string
    {
        $currency = $currency ?? cache_remember('default_currency', function () {
                $currency = Currency::whereIsDefault(1)->first();

                if (!$currency) {
                    $currency = (object)['name' => 'US Dollar', 'code' => 'USD', 'rate' => 1, 'symbol' => '$', 'position' => 'left', 'status' => true, 'is_default' => true,];
                }

                return $currency;
            });

        return $key ? $currency->$key : $currency;
    }
}

if (!function_exists('get_currency_rate')) {
    /**
     * Get Default Currency Rate based on Base currency rate
     * @param $rate
     * @return float|int
     */
    function get_currency_rate($rate): float|int
    {
        return (default_currency()->rate * $rate);
    }
}

if (!function_exists('get_money')) {
    /**
     * Get money
     * @param $amount
     * @param $rate
     * @return string
     */
    function get_money($amount, $rate): string
    {
        return number_format($amount * get_currency_rate($rate), 2);
    }
}

if (!function_exists('calculate_taxes')) {
    function calculate_taxes(int $amount, $withAmount = true)
    {
        $taxes = Tax::whereStatus(1)->get();

        $totalPercentage = 0;
        $totalFixed = 0;
        foreach ($taxes as $tax) {
            if ($tax->type == 'percentage') {
                $totalPercentage += $tax->rate;
            } elseif ($tax->type == 'fixed') {
                $totalFixed += $tax->rate;
            }
        }

        $totalPercentageAmount = ($amount / 100) * $totalPercentage;
        return $withAmount ? ($amount + $totalPercentageAmount + $totalFixed) : ($totalPercentageAmount + $totalFixed);
    }
}

if (!function_exists('calculate_extra_charge')) {
    function calculate_extra_charge(int $amount, $chargeName, $withAmount = false)
    {
        $option = get_option('charges')[$chargeName] ?? ['rate' => 0, 'type' => 'percentage'];

        $cal = $option['type'] == 'percentage' ? ($amount / 100) * $option['rate'] : $option['rate'];

        return $withAmount ? $cal + $amount : $cal;
    }
}

if (!function_exists('get_charge')) {
    function get_charge($key, $amount)
    {
        $option = get_option('charges');
        $charge = $option[$key]['rate'];
        if ($option[$key]['type'] == 'percentage') {
            $charge = ($amount / 100) * $option[$key]['rate'];
        }
        return $charge;
    }
}

/**
 * @param float|int $amount Provide Default Currency Amount
 * @param Gateway $gateway
 * @return float|int
 */
function payable(float|int $amount, Gateway $gateway, $withOutTax = false)
{
    if ($gateway->currency->code == default_currency('code')) {
        return $withOutTax ? ($amount + calculate_gateway_charge($gateway)) : (calculate_taxes($amount) + calculate_gateway_charge($gateway));
    } else {
        return (($withOutTax ? $amount : calculate_taxes($amount)) + calculate_gateway_charge($gateway)) * $gateway->currency->rate;
    }
}


if (!function_exists('calculate_payable')) {
    function calculate_payable(Gateway $gateway, $amount, $currency_format = false)
    {
        if ($gateway->currency->code == default_currency('code')) {
            $payable = calculate_taxes($amount) + $gateway->charge;
        } else {
            $payable = (calculate_taxes($amount) * $gateway->currency->rate) + $gateway->charge;
        }

        return $currency_format ? currency_format($payable, 'icon', $gateway->currency->symbol) : $payable;
    }
}

function convert_money($amount, $currency, $multiply = false)
{
    if ($currency->code == default_currency('code')) {
        return $amount;
    } else {
        if ($multiply) {
            return $amount * $currency->rate;
        } else {
            return $amount / $currency->rate;
        }
    }
}

function convert_money_direct(int|float|null $amount, null|Currency $baseCurrency, null|Currency $secondCurrency, $currencyFormat = false, $numberFormat = false) {
    if (!$amount || !$baseCurrency || !$secondCurrency){
        return 0;
    }

    $baseAmount = convert_money($amount, $baseCurrency);

    $amount = convert_money($baseAmount, $secondCurrency, true);
    if ($currencyFormat){
        return currency_format($amount, currency: $secondCurrency);
    }elseif ($numberFormat){
        return round($amount, 2, PHP_ROUND_HALF_ODD);
    }else{
        return $amount;
    }
}

function convert_money_by_rate($amount){

}

function my_balance($currency)
{
    $currency = Currency::find($currency);
    $wallet = Wallet::where('user_id', auth()->id())->where('currency_id', $currency->id)->first();
    $balance = $currency->symbol . $wallet->wallet;
    return $balance;
}

function calculate_gateway_charge(Gateway $gateway, $currencyFormat = false)
{
    if ($gateway->currency->code == default_currency('code')) {
        $amount = round($gateway->charge, 2);
        return $currencyFormat ? currency_format($amount) : $amount;
    } else {
        $amount = round($gateway->charge / $gateway->currency->rate, 2);
        return $currencyFormat ? currency_format($amount) : $amount;
    }
}

function base64_image_decode($encoded)
{
    $image_parts = explode(";base64,", $encoded);
    $image_type_aux = explode("data:image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);

    return ['type' => '.' . $image_type, 'content' => $image_base64];
}

function avatar(User $user = null)
{
    $user = $user ?? Auth::user();
    return $user->avatar ? asset($user->avatar) : get_gravatar($user->email);
}

function to_many_attempts($key, $perMinute = 5, $userId = null)
{
    $userId = $userId ?? (Auth::check() ? Auth::id() : null);

    if (RateLimiter::tooManyAttempts($key . ':' . $userId, $perMinute)) {
        if (request()->expectsJson()) {
            return response()->json(['message' => __('Too many attempts!')], 429);
        } else {
            abort(429, __('Too many attempts!'));
        }
    }
}

if (!function_exists('user_currency')) {
    function user_currency(User $customUser = null)
    {
        return $customUser ? $customUser->currency : Auth::user()->currency ?? default_currency();
    }
}

if (!function_exists('support_setting')){
    function support_setting(User $user){
        return $user->supportSetting;
    }
}

if (!function_exists('total_new_message')){
    function total_new_message() {
        return Message::where('reciever_id', auth()->id())->where('is_seen', 0)->count();
    }
}

if (!function_exists('get_percentage_change')){

    /**
     * * Calculates in percent, the change between 2 numbers.
     * e.g from 1000 to 500 = 50%
     * @param $oldNumber "The old number"
     * @param $newNumber "The new number"
     * @return float|int
     */
    function get_percentage_change($oldNumber, $newNumber): float|int
    {
        $newNumber++;
        $oldNumber++;
        $decreaseValue = $newNumber - $oldNumber;

        return ($decreaseValue / $newNumber) * 100;
    }
}
