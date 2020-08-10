<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\ControlPadRepository;
use App\Repositories\ShippingEasyRepository;


class ShippingEasyController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * NOTE: If necessary, this logic can be easily moved into a Job queue.
     */
    public function notifyShipped(Request $request, $client)
    {
        if($request->shipment){

            $authConfig = config('auths.SHIPPINGEASY'.$client);

            if (!$authConfig) {
                \Log::warning('ShippingEasyController::notifyShipped client config not found', ['client' => $client]);
                abort(409, 'Client not configured');
            }

            //generate the tracking url

            /*
            $url = $request->resource_url;

            $shipStation = new ShipStationModelController($authConfig);
            $controlPad = new ControlPadRepository($authConfig, null, null);

            $trackingItems = $shipStation->getTrackingResources($url);
            $ids = collect($trackingItems)->pluck('order_id')->toArray();
            /***************************************************************/

            //Add tracking
            //$controlPad->addTracking($trackingItems->toArray());

            //Update control pad orders
            //$controlPad->patch($ids, 'fulfilled');
        }

        return response()->json(['message' => 'Notify shipped']);
    }

    public function testConnection(){

        \Log::info("Running tests");

        return response()->json(['message' => 'Test Connection Successful']);
    }
}