<?php

use App\Enums\VatType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

function saveImage($path, $file)
{
    $filename = time() . $file->getClientOriginalName();
    $full_stored_image_path = Storage::disk('public')->putFileAs($path, $file, $filename);
    return $full_stored_image_path;
}

function storeImage($path, $file)
{
    $imageName = Str::random() . '.' . $file->getClientOriginalExtension();
    Storage::disk('public')->putFileAs($path, $file, $imageName);
    return $imageName;
}

function editImage($path, $file, $oldImage)
{
    deleteImage($oldImage);

    $imageName = Str::random() . '.' . $file->getClientOriginalExtension();
    Storage::disk('public')->putFileAs($path, $file, $imageName);
    return $imageName;
}

function deleteImage($oldImage)
{
    $exists = Storage::disk('public')->exists($oldImage);
    if ($exists) {
        $exists = Storage::disk('public')->delete($oldImage);
        return true;
    }
}


function getImageUrl($image)
{
    $exists = Storage::disk('public')->exists($image);
    if ($exists) {
        return Storage::url($image);
    } else {
        return asset('dist/img/product-placeholder.webp');
    }
}

/**
 * Generate Response
 * @param  bool $status
 * @param string $redirect
 * @param string $modal_to_hide
 * @param  string $row_to_delete
 * @param  bool $reset_form
 */
if (!function_exists('generateResponse')) {
    function generateResponse(
        $status,
        $redirect = null,
        $modal_to_hide = null,
        $row_to_delete = null,
        $reset_form = false,
        $reload = false,
        $table_reload = false,
        $table = null,
        $is_deleted = false,
        $message = null
    ) {
        $response_message = !is_null($message) ? ($message) : ($status ? __('general.response_messages.success') : __('general.response_messages.error'));
        return [
            'status' => $status,
            'message' => $response_message,
            'redirect' => $redirect ? $redirect : null,
            'modal_to_hide' => $modal_to_hide,
            'row_to_delete' => $row_to_delete,
            'reset_form' => $reset_form,
            'code' => $status ? 200 : 500,
            'reload' => $reload,
            'reload_table' => $table_reload,
            'table' => $table,
            'is_deleted' => $is_deleted,
        ];
    }
}
/**
 * Generate Api Response
 * @param  bool $status
 * @param numeric $code
 * @param array $data
 */
if (!function_exists('generateApiResoponse')) {
    function generateApiResoponse($status, $code, $data = [], $message = null)
    {
        $response = [
            'code' => $code,
            'status' => $status,
            'data' => $data,
        ];
        if ($message) {
            $response['message'] = $message;
        }
        return response()->json($response, $code);
    }
}



/**
 * get avilable locales
 * @return array
 */
if (!function_exists('getAvilableLocales')) {
    function getAvilableLocales()
    {
        return config('translatable.locales') ?? [];
    }
}
/**
 * Hash the given value
 * @param mixed $value
 * @return mixed
 */
if (!function_exists('makeHash')) {
    function makeHash($value)
    {
        return Hash::make($value);
    }
}


/**
 * Hash the given value
 * @param mixed $value
 * @return mixed
 */
if (!function_exists('getAuthUser')) {
    function getAuthUser($guard = 'web')
    {
        return Auth::guard($guard)->user();
    }
}


if (!function_exists('generateUniqueRandomNumber')) {

    function generateUniqueRandomNumber($model, $column, $length)
    {
        // Generate a random number based on current year and random digits
        $current_year = date('Y');
        $remaining_length = $length - strlen($current_year);
        mt_srand();
        $random_number = $current_year . generateRandomDigits($remaining_length);
        if (columnValueExists($model, $column, $random_number)) {
            mt_srand();
            return generateUniqueRandomNumber($model, $column, $length);
        }
        return $random_number;
    }
}


if (!function_exists('generateRandomDigits')) {
    function generateRandomDigits($length)
    {
        $digits = '';
        for ($i = 0; $i < $length; $i++) {
            $digits .= mt_rand(0, 9);
        }
        return str_shuffle(str_shuffle($digits));
    }
}


if (!function_exists('columnValueExists')) {
    function columnValueExists($model, $column, $value)
    {
        return $model::where($column, $value)->exists();
    }
}


/**
 * get system only currency "SAR"
 * @return string
 */
if (!function_exists('getSystemCurrency')) {
    function getSystemCurrency()
    {
        return app()->getLocale() == 'ar' ? 'ريال' : 'SAR';
    }
}


/**
 * Format Price
 * @param double $price
 */

if (!function_exists('formatPrice')) {
    function formatPrice($price , $with_currency = true)
    {
        $format_price = number_format($price, 2, '.', ','); // 2 decimal places, decimal point is '.', thousands separator is ','

        return $with_currency ?  ( $format_price . ' ' . getSystemCurrency() ) : ($format_price) ; // You can change the currency symbol as needed
    }
}


/**
 * return good formated club sbuscribe text to display in club details
 * @param \App\Models\Club $club
 */

if (!function_exists('getClubSubscribeText')) {
    function getClubSubscribeText($club)
    {
        return $club->prev_price > $club->price ?
            __('general.subscribe_with_discount', ['discount' => getClubDiscountedPrice(club: $club, return_type: VatType::PERCENT->value, with_currency: false)])
            :
            __('general.subscribe_now');
    }
}


/**
 * return good formated club sbuscribe text to display in club details
 * @param \App\Models\Club $club
 * @param bool $with_currency
 */

if (!function_exists('getClubDiscountedPrice')) {
    function getClubDiscountedPrice($club, $return_type, $with_currency = true)
    {
        if ($club->prev_price > $club->price) {
            $total_discount_value = $club->prev_price - $club->price;
            if ($return_type == VatType::PERCENT->value) {
                $result = ($total_discount_value / $club->prev_price) * 100;
            } else {
                $result = $total_discount_value;
            }
            return $with_currency ?
                $result . ' ' . getSystemCurrency()
                :
                $result . '%';
        } else {
            return 0;
        }
    }
}


/**
 * return club vat
 * @param \App\Models\Club $club
 */

if (!function_exists('getFormatedClubVat')) {
    function getFormatedClubVat($club)
    {
        $percent_or_flat = $club->vat_type == VatType::PERCENT->value ? '%' : getSystemCurrency();
        return $club->vat . $percent_or_flat;
    }
}


