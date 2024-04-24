<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserDataService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchUserData($page, $count, $currentPage)
    {
        $response = $this->client->request('GET', config('api.user_list_url'), [
            'query' => [
                'page' => $page,
                'count' => $count,
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        if ($data['success']) {
            $pagination = $data['links'];
            $pagination['total_pages'] = $data['total_pages'];
            $data['count'] = $count;
            $pagination['current_page'] = $currentPage;
            $pagination['prev_url'] = ($page > 1) ? route('fetch-users', ['page' => $page - 1, 'count' => $count]) : null;
            $pagination['next_url'] = route('fetch-users', ['page' => $page + 1, 'count' => $count]) ?? null;

            return [
                'users' => $data,
                'pagination' => $pagination,
                'count' => $count,
                'currentPage' => $currentPage
            ];
        } else {
            return null;
        }
    }

    public function getPositions()
    {
        $response = $this->client->request('GET', config('api.positions_url'));
        $positions = json_decode($response->getBody()->getContents(), true);

        return $positions['positions'];
    }

    public function prepareUserData(Request $request, $accessToken, $imagePath)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'position_id' => 'required|integer',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        return [
            'headers' => [
                'Accept' => 'application/json',
                'Token' => $accessToken,
            ],
            'multipart' => [
                ['name' => 'name', 'contents' => $validatedData['name']],
                ['name' => 'email', 'contents' => $validatedData['email']],
                ['name' => 'phone', 'contents' => $validatedData['phone']],
                ['name' => 'position_id', 'contents' => $validatedData['position_id']],
                ['name' => 'photo', 'contents' => fopen($imagePath, 'r'), 'filename' => 'optimized.jpg'],
            ],
        ];
    }
}