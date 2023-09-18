<?php

namespace App\Http\Controllers\User;

use App\Enums\OfferStatus;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user'] = getAuthUser('web');
        $data['offers'] = $data['user']->offers()->status(OfferStatus::ACTIVE->value)->get();
        return view('user.offers.index', $data);
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user'] = getAuthUser('web');
        $data['offer'] = Offer::query()->find(decrypt($id));
        return view('user.offers.show', $data);
    }


    /**
     * Downlaod offer pdf document
     */
    public function downloadPdf(Request $request, $id)
    {
        $data['user'] = getAuthUser('web');
        $data['offer'] = Offer::query()->findOrFail(decrypt($id));
        $data['lang'] = app()->getLocale();
        $qrcode = QrCode::size(150)->generate('A basic example of QR code!');
        $code = (string) $qrcode;
        $data['qr_code'] = substr($code, 38);
        $pdf = PDF::loadView('user.offers.pdf', $data);
        return response()->file($pdf->stream($data['offer']->name . '.pdf'));
    }

}
