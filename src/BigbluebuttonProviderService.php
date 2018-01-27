<?php

namespace Abiodunjames\Bigbluebutton;

use Abiodunjames\Bigbluebutton\Contracts\Meeting;
use BigBlueButton\BigBlueButton;
use Illuminate\Support\ServiceProvider;

class BigbluebuttonProviderService extends ServiceProvider
{
    public function boot()
    {
        //Merge Config
        $this->publishes([__DIR__.'/Config/bigbluebutton.php' => config_path('bigbluebutton.php')], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/Config/bigbluebutton.php', 'bigbluebutton');
        $server_base_url = $this->app['config']->get('bigbluebutton.BBB_SERVER_BASE_URL');
        $server_salt = $this->app['config']->get('bigbluebutton.BBB_SECURITY_SALT');

        putenv("BBB_SERVER_BASE_URL=$server_base_url");
        putenv("BBB_SECURITY_SALT=$server_salt");

        $this->app->bind('bigbluebutton', function ($app) {
            return new BigBlueButton();
        });

        $this->app->alias('bigbluebutton', BigBlueButton::class);

        $this->app->bind('bigbluebutton_meeting', function ($app) {
            return new BigbluebuttonMeeting($app['bigbluebutton']);
        });

        $this->app->bind(Meeting::class, function($app){
            return new BigbluebuttonMeeting($app['bigbluebutton']);
        });
    }
}
