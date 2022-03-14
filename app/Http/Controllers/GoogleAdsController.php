<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Ads\GoogleAds\Lib\V9\GoogleAdsClient;

class GoogleAdsController extends Controller
{
    private const CAMPAIGN_ID = '15588679567';

    public function index(GoogleAdsClient $googleAdsClient){

        $customer_id = parse_ini_file(config('app.google_ads_php_path'))['loginClientId'];
        $campaignId = self::CAMPAIGN_ID;
        $date = date('yy-m-d');

        $googleAdsServiceClient = $googleAdsClient->getGoogleAdsServiceClient();
        // Creates a query that retrieves all ad groups.
        $query = "SELECT campaign.id, campaign.name, ad_group.id, ad_group.name, metrics.impressions, metrics.clicks, metrics.cost_micros, metrics.absolute_top_impression_percentage, ad_group.status FROM ad_group  WHERE campaign.id = '".$campaignId ."' AND segments.date = '".$date."'";

        // Issues a search request by specifying page size.
        $response =
            $googleAdsServiceClient->search($customer_id, $query);

        // Iterates over all rows in all pages and prints the requested field values for
        // the ad group in each row.
        $adgroupArr = [];
        foreach ($response->iterateAllElements() as $key => $googleAdsRow) {
            /** @var GoogleAdsRow $googleAdsRow */
            $adgroupArr[$googleAdsRow->getAdGroup()->getId()]['adgroup_id'] = $googleAdsRow->getAdGroup()->getId();
            $adgroupArr[$googleAdsRow->getAdGroup()->getId()]['adgroup_status'] = $googleAdsRow->getAdGroup()->getstatus();
            $adgroupArr[$googleAdsRow->getAdGroup()->getId()]['adgroup_name'] = $googleAdsRow->getAdGroup()->getName();
            $adgroupArr[$googleAdsRow->getAdGroup()->getId()]['campaign_id'] = $googleAdsRow->getCampaign()->getId();
            $adgroupArr[$googleAdsRow->getAdGroup()->getId()]['campaign_name'] = $googleAdsRow->getCampaign()->getName();
            $adgroupArr[$googleAdsRow->getAdGroup()->getId()]['impressions'] = $googleAdsRow->getMetrics()->getImpressions();
            $adgroupArr[$googleAdsRow->getAdGroup()->getId()]['clicks'] = $googleAdsRow->getMetrics()->getClicks();
            $adgroupArr[$googleAdsRow->getAdGroup()->getId()]['cost_micros'] = $googleAdsRow->getMetrics()->getCostMicros()/1000000;
            $adgroupArr[$googleAdsRow->getAdGroup()->getId()]['abstopimp'] = round(($googleAdsRow->getMetrics()->getAbsoluteTopImpressionPercentage())*100, 2);
        }

      return view('google-ads-demo.index', compact('adgroupArr'));
    }
}
