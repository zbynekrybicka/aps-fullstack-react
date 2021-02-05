<?php
namespace App\Service;

use App\Request;
use App\Response;
use App\Resource\Rest;

class CampaignService
{
    private $rest;

    public static function get() {
        static $campaignService;
        if (!$campaignService) {
            $campaignService = new CampaignService();
        }
        return $campaignService;
    }

    public function __construct() {
        $this->rest = Rest::get();
    }

    public function putCampaign(Request $request) {
        return $this->rest->put('campaign', $request->data());
    }

}