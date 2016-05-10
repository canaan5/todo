<?php
/**
 * Created by Canaan Etaigbenu
 * User: canaan5
 * Date: 5/10/16
 * Time: 2:31 PM
 */

namespace Canaan\Repo\Remote;

use Canaan\Repo\Contracts\CalenderInterface;

class GoogleCalender implements CalenderInterface
{

    /**
     * Get Event from external sources e.g google calender
     *
     * @return array
     */
    public function sync()
    {
        // create an instance of Google API Client
        $client = $this->getGoogleClient();

        // Check if user is already authenticated to google calender
        // if user is, instantiate the calender service and return the calender events
        if ( \Session::has('access_token')) {
            $client->setAccessToken(\Session::get('access_token'));

            // calender service instance
            $cal = new \Google_Service_Calendar($client);

            // custom event options
            $opts = [
                'maxResults' => 20,
                'timeMin' => date('c')
            ];

            $events = $cal->events->listEvents('primary', $opts);
            return $events;
        }

        return redirect('/sync/authenticate');
    }

    /**
     * Open Id authentication / access
     *
     * @return boolean
     */
    public function authenticate()
    {
        // create an instance of Google API Client
        $client = $this->getGoogleClient();
        $client->setRedirectUri('http://todo.dev/sync/authenticate');

        $code = request('code') ?: '';

        if (!$code) {
            $authUrl = $client->createAuthUrl();
            return redirect($authUrl);
        }

        $client->authenticate($code);
        \Session::set('access_token', $client->getAccessToken());

        return redirect('/calender');
    }

    /**
     * instantiate google client and set some config
     *
     * @return \Google_Client object
     */
    public function getGoogleClient()
    {
        $client = new \Google_Client();
        $client->setAuthConfigFile(base_path().'/client_secret.json');
        $client->setAccessType('offline');
        $client->setScopes(['https://www.googleapis.com/auth/calendar']);

        return $client;
    }
}