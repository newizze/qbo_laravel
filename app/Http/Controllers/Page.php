<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\QBO\Qbo;

class Page extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $qbo;

    public function __construct()
    {
        $this->qbo = new \App\QBO\Qbo;
    }

    public function index(Request $request )
    {
        $amount = null;
        $employee = null;
        $accessToken = null;
        if(!empty(session('sessionAccessToken'))) {
            //Customer authorized and I'm taking Token data from session
            $accessToken = unserialize(session('sessionAccessToken'));

            //Setting current access token data to QBO SDK
            $this->qbo->setTokenObject($accessToken);
            $this->qbo->updateOAuth2Token();

            //Getting all employees
            $employee = $this->qbo->getAllEmployee();

            if($request->has('invoiceAmount')) {
                $amount = $request->input('invoiceAmount');
            }

        }

        return view('welcome', Array('qbo' => $this->qbo, 'amount' => $amount, 'employee' => $employee, 'accessToken' => $accessToken));
    }

    public function newInvoice() {
        //Creating new invoice
        $amount = $this->qbo->createInvoice();
        return redirect('/?invoiceAmount='.$amount);
    }

    public function callback(Request $request) {

        //Getting answer from QBO with Access Token Data
        if($request->has('state')) {

            $state = $request->input('state');
        }

        if($request->has('code')) {

            $code = $request->input('code');
            $this->qbo->setAccessToken($code);
        }

        if($request->has('realmId')) {

            $realmId = $request->input('realmId');

            $this->qbo->setRealmId($realmId);
            $this->qbo->setAccessDataToQBOSDK();
            $token = $this->qbo->getTokenObject();

            //Saving Token Data to session
            session('sessionAccessToken', serialize($token));
        }

        return redirect('/');
    }

}
