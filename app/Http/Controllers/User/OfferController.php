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
        $qrcode = QrCode::size(150)->generate(route('offers.pdf_download', ['id' => $id, 'preview_type' => 'stream']));
        $code = (string) $qrcode;
        $data['qr_code'] = substr($code, 38);
        return view('user.offers.show', $data);
    }


    /**
     * Downlaod offer pdf document
     */
    public function downloadPdf(Request $request, $id)
    {
        $data['user'] = getAuthUser($request->query('guard', 'web'));
        $data['offer'] = Offer::query()->findOrFail(decrypt($id));
        if ($data['user']->offers()->where('offer_id' , $data['offer']->id)->exists()) {
            $data['lang'] = app()->getLocale();
            $qrcode = QrCode::size(150)->generate(route('offers.pdf_download', ['id' => $id, 'preview_type' => 'stream']));
            $code = (string) $qrcode;
            $data['qr_code'] = substr($code, 38);
            $pdf = PDF::loadView('user.offers.pdf', $data);
            $download_or_stream = $request->query('preview_type', 'stream');
            return response()->$download_or_stream($pdf->stream($data['offer']->name . '.pdf'));
        } else {
            return back();
        }
    }

}
