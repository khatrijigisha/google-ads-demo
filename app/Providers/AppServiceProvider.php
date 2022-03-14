<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Google\Ads\GoogleAds\Lib\V9\GoogleAdsClientBuilder;
use Google\Ads\GoogleAds\Lib\OAuth2TokenBuilder;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Binds the Google Ads API client.
       $this->app->singleton('Google\Ads\GoogleAds\Lib\V9\GoogleAdsClient', function () {
           // Constructs a Google Ads API client configured from the properties file.
           return (new GoogleAdsClientBuilder())
               ->fromFile(config('app.google_ads_php_path'))
               ->withOAuth2Credential((new OAuth2TokenBuilder())
                   ->fromFile(config('app.google_ads_php_path'))
                   ->build())
               ->build();
       });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
