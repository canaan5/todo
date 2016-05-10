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
        $client = new \Google_Client();
        $client->setAuthConfigFile(base_path().'/client_secret.json');
        $client->setAccessType('offline');
        $client->setScopes(['https://www.googleapis.com/auth/calendar']);

        if ( \Session::has('access_token')) {
            $client->setAccessToken(\Session::get('access_token'));

            $cal = new \Google_Service_Calendar($client);

            $opts = [
                'maxResults' => 20,
                'timeMin' => date('c')
            ];

            $events = $cal->events->listEvents('primary', $opts);
            return $events;
        }

        return redirect('sync/authenticate');
    }

    /**
     * Open Id authentication / access
     *
     * @return boolean
     */
    public function authenticate()
    {
        $client = new \Google_Client();
        $client->setAuthConfigFile(base_path().'/client_secret.json');
        $client->setAccessType('offline');
        $client->setScopes(['https://www.googleapis.com/auth/calendar']);
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
}