<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Client;

/**
 * @class ApiController
 * @brief Manages information from third-party APIs
 *
 * Controller to manage the consumption of third-party APIs (npiregistry, usps, etc...),
 * and process the response obtained.
 *
 */
class ApiController extends Controller
{
    /**
     * Get the information associated with the NPI record
     *
     * @method getNPI
     *
     * @param  mixed $npi
     *
     * @return JsonResponse
     */
    public function getNpi($npi): JsonResponse
    {
        $client = new Client([
            'base_uri' => 'https://npiregistry.cms.hhs.gov/api',
            //'timeout'  => 2.0
        ]);
        try {
            $response = $client->request('GET', '?number=' . $npi . '&version=2.0');
        } catch (\Exception $e){
            return response()->json($e->getMessage(),500);
        }

        $data = json_decode($response->getBody());
        if (isset($data->Errors)) {
            return response()->json("Field contains special character(s) or wrong number of characters", 404);
        } else {
            $r = $data->results[0];
            foreach ($r->addresses as $address) {
                if ($address->address_purpose == 'MAILING') {
                    $mailingAddress = $address;
                    break;
                }
            }
            if (!isset($mailingAddress)) {
                $mailingAddress = $r->addresses[0];
            }
            $r->contact = [
                'phone'   => $mailingAddress->telephone_number,
                'email'   => '',
                'address' => $mailingAddress->address_1,
                'country' => $mailingAddress->country_name,
                'city'    => $mailingAddress->city,
                'state'   => $mailingAddress->state,
            ];

            unset($r->enumeration_type);
            unset($r->last_updated_epoch);
            unset($r->created_epoch);
            unset($r->other_names);
            unset($r->identifiers);
            unset($r->addresses);
            return response()->json($r);
        }
    }

    /**
     * Get the zipcode associated with the address registered with the USPS
     *
     * @method getZipCode
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function getZipCode(Request $request): JsonResponse
    {
        $client = new Client([
            'base_uri' => 'https://tools.usps.com/tools/app/ziplookup/zipByAddress',
            //'timeout'  => 2.0
        ]);
        try {
            $response = $client->request('POST', '', [
                'form_params' => $request->input()
            ]);
        } catch (\Exception $e){
            return response()->json($e->getMessage(),500);
        }
        $data = json_decode($response->getBody());

        if ($data->resultStatus == 'SUCCESS') {
            return response()->json([
                'status'  => $data->resultStatus,
                'zipCode' => $data->addressList[0]->zip5 . $data->addressList[0]->zip4
            ]);
        }
        return response()->json(['status' => $data->resultStatus], 404);
    }
}