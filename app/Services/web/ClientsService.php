<?php

declare(strict_types=1);

namespace App\Services\web;

use App\Models\Client;
use App\Models\Plaque;
use Carbon\Carbon;
use DOMDocument;
use Exception;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use Webklex\IMAP\Facades\Client as IMAPClient;

class ClientsService
{

    static public function getClients($client_name, $client_sip, $client_status, $technicien, $start_date, $end_date)
    {
        return Client::with('city', 'technicien.user')
            ->where(function ($q) use ($client_name) {
                $q->where('name', 'like', '%' . $client_name . '%');
            })
            ->where(function ($q) use ($client_sip) {
                $q->where('sip', 'like', '%' . $client_sip . '%');
            })
            ->when($client_status, function ($q, $client_status) {
                $q->where('status', $client_status);
            })
            ->when($start_date && $end_date, function ($q) use ($start_date, $end_date) {
                $q->whereBetween('created_at', [Carbon::parse($start_date)->startOfDay(), Carbon::parse($end_date)->endOfDay()]);
            })
            ->when($technicien, function ($q, $technicien) {
                $q->where('technicien_id', $technicien);
            })
            ->orderByDesc('created_at');
    }

    static public function getClientsStatistic()
    {
        $clients = Client::query();
        return [
            'allClients' => $clients->count(),
            'clientsOfTheDay' => $clients->whereDate('created_at', today())->count(),
            'clientsB2B' => Client::where('type', 'B2B')->count(),
            'clientsB2C' => Client::where('type', 'B2C')->count(),
        ];
    }

    static public function importsClients($content)
    {
        preg_match('/Adresse d�installation\s*:\s*(.*)/', $content, $client_address);
        preg_match('/Client\s*:\s*(\D*)Contact/', $content, $client_fullname);
        preg_match('/Offre\s*:\s*(\d*)/', $content, $client_debit);
        preg_match('/Login SIP\s*:\s*(\d*)/', $content, $client_sip);
        preg_match('/Contact Client\s*:\s*(\d*)/', $content, $client_phone);
        preg_match('/CODE\s*(.{7})/', $content, $plaque);
        preg_match('/CODE\s*(.{2})/', $content, $city);


        $plaque = Plaque::with('city')->where('code_plaque', $plaque[1])->first();

        return [
            'name' => $client_fullname[1],
            'address' => $client_address[1],
            'debit' => $client_debit[1],
            'lat' => 0,
            'lng' => 0,
            'sip' => $client_sip[1],
            'plaque' => $plaque->id ?? 114,
            'city' => $plaque->city->id ?? 12,
            'phone' => $client_phone[1],
        ];
    }

    static public function importAuto()
    {
        $client = IMAPClient::account('default');
        $client->connect();

        $inbox = $client->getFolder('Inbox');
        $unseenMessages = $inbox->query()->unseen()->get(); // ** Get All the unseen mails

        foreach ($unseenMessages as $message) {
            $content = $message->getHTMLBody(true); // ** Return the message body as HTML [CLIENT]
            $client = self::importsClients($content); // ** Import the client
            // TODO : Add the map survey Here
            $message->moveToFolder('Archive');
        }
    }

    static public function mapSurvey($new_clients)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://mapsurvey.orange.ma/login');
        $getcsrftoken = $response->getBody()->getContents();
        $headerSetCookies = $response->getHeader('Set-Cookie');

        foreach ($headerSetCookies as $headerSetCookie) {
            $cookie = SetCookie::fromString($headerSetCookie);
            $cookie->setDomain('mapsurvey.orange.ma');
            $cookie[] = $cookie;
        }

        $cookieJar = new CookieJar(false, $cookie);
        $dom = new DOMDocument();
        $dom->loadHTML($getcsrftoken, LIBXML_NOERROR);
        $xpath = new \DOMXPath($dom);
        $csrf = $xpath->query('//meta[@name="csrf-token"]')->item(0)->attributes->getNamedItem('value')->nodeValue;

        $response = $client->post(
            'https://mapsurvey.orange.ma/login',
            [
                'form_params' => [
                    '_username' => 'rn08425',
                    '_password' => 'Orange_2019',
                    '_csrf_token' => $csrf,
                ],
                'cookies' => $cookieJar,
            ]
        );

        foreach ($new_clients as $item) {
            $address = $item->client->address;
            $response_address = $client->get(
                'https://mapsurvey.orange.ma/ftth/search/address?input_search=' . $address,
                [
                    'cookies' => $cookieJar,
                    'headers' => [
                        'X-Requested-With' => 'XMLHttpRequest',
                    ],
                ],
            );
            $body = $response_address->getBody()->getContents();
            if (!empty($body)) {
                $dom = new DOMDocument();
                $dom->loadHTML($body, LIBXML_NOERROR);
                $xpath = new \DOMXPath($dom);
                $contents = $xpath->query('//li');
                foreach ($contents as $item) {
                    $gps = json_decode($item->attributes->getNamedItem('value')->nodeValue);
                }
            }
        }
    }

    static public function atestMapSurvey($newClient)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://mapsurvey.orange.ma/login');
        $getcsrftoken = $response->getBody()->getContents();
        $headerSetCookies = $response->getHeader('Set-Cookie');
        $cookie = [];

        foreach ($headerSetCookies as $headerSetCookie) {
            $cookie = SetCookie::fromString($headerSetCookie);
            $cookie->setDomain('mapsurvey.orange.ma');
            $cookie[] = $cookie;
        }

        $cookieJar = new CookieJar(false, $cookie);
        $dom = new DOMDocument();
        $dom->loadHTML($getcsrftoken, LIBXML_NOERROR);
        $xpath = new \DOMXPath($dom);
        $csrf = $xpath->query('//meta[@name="csrf-token"]')->item(0)->attributes->getNamedItem('value')->nodeValue;

        $response = $client->post(
            'https://mapsurvey.orange.ma/login',
            [
                'form_params' => [
                    '_username' => 'rn08425',
                    '_password' => 'Orange_2019',
                    '_csrf_token' => $csrf,
                ],
                'cookies' => $cookieJar,
            ]
        );
        $response_address = $client->get(
            'https://mapsurvey.orange.ma/ftth/search/address?input_search=' . $newClient->address,
            [
                'cookies' => $cookieJar,
                'headers' => [
                    'X-Requested-With' => 'XMLHttpRequest',
                ],
            ],
        );
        $body = $response_address->getBody()->getContents();
        if (!empty($body)) {
            $dom = new DOMDocument();
            $dom->loadHTML($body, LIBXML_NOERROR);
            $xpath = new \DOMXPath($dom);
            $contents = $xpath->query('//li');
            foreach ($contents as $item) {
                $gps = json_decode($item->attributes->getNamedItem('value')->nodeValue);
            }
        }
        return $gps;
    }

    static public function testMapSurvey($newClient)
    {
        try {
            // Create HTTP client object
            $client = new \GuzzleHttp\Client();

            // Send HTTP GET request to the login page to get the CSRF token and cookies
            $response = $client->get('https://mapsurvey.orange.ma/login');
            $getcsrftoken = $response->getBody()->getContents();
            $headerSetCookies = $response->getHeader('Set-Cookie');

            // Process the cookies received in the response headers
            $cookieJar = new CookieJar(false);
            foreach ($headerSetCookies as $headerSetCookie) {
                $cookie = SetCookie::fromString($headerSetCookie);
                $cookie->setDomain('mapsurvey.orange.ma');
                $cookieJar->setCookie($cookie);
            }

            // Extract the CSRF token from the HTML response
            $dom = new DOMDocument();
            $dom->loadHTML($getcsrftoken, LIBXML_NOERROR);
            $xpath = new \DOMXPath($dom);
            $csrf = $xpath->query('//meta[@name="csrf-token"]')->item(0)->attributes->getNamedItem('value')->nodeValue;

            // Send HTTP POST request to the login page with the username, password, and CSRF token
            $response = $client->post(
                'https://mapsurvey.orange.ma/login',
                [
                    'form_params' => [
                        '_username' => 'rn08425',
                        '_password' => 'Orange_2019',
                        '_csrf_token' => $csrf,
                    ],
                    'cookies' => $cookieJar,
                ]
            );

            // Send HTTP GET request to get the GPS coordinates of the given address
            $response_address = $client->get(
                'https://mapsurvey.orange.ma/ftth/search/address?input_search=' . $newClient->address,
                [
                    'cookies' => $cookieJar,
                    'headers' => [
                        'X-Requested-With' => 'XMLHttpRequest',
                    ],
                ],
            );

            // Parse the HTML response to extract the GPS coordinates
            $body = $response_address->getBody()->getContents();
            $gps = null;
            if (!empty($body)) {
                $dom = new DOMDocument();
                $dom->loadHTML($body);
                $xpath = new \DOMXPath($dom);
                $contents = $xpath->query('//li');
                foreach ($contents as $item) {
                    $gps = json_decode($item->attributes->getNamedItem('value')->value);
                }
            }

            dd(json_encode($gps));
        } catch (Exception $e) {
            // Handle exceptions thrown during HTTP requests or DOM manipulation
            dd($e->getMessage());
        }
    }
}
