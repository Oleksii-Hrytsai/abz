<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Services\ImageOptimizationService;
use App\Http\Services\UserDataService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
    private $userDataService;
    private $imageOptimizationService;

    public function __construct(UserDataService $userDataService, ImageOptimizationService $imageOptimizationService)
    {
        $this->userDataService = $userDataService;
        $this->imageOptimizationService = $imageOptimizationService;
    }

    public function fetchUsers(Request $request)
    {
        $page = $request->query('page', 1);
        $count = $request->query('count', 5);
        $currentPage = $page;

        $cacheKey = 'users_page_' . $page . '_count_' . $count;

        if (Cache::has($cacheKey)) {
            $userData = Cache::get($cacheKey);
        } else {
            $userData = $this->userDataService->fetchUserData($page, $count, $currentPage);

            Cache::put($cacheKey, $userData, 10);
        }

        if ($userData) {
            return view('index', $userData);
        } else {
            return view('error')->with('message', 'Помилка від сервера');
        }
    }
    public function createNewUser(Request $request)
    {
        try {
            $accessToken = $request->session()->get('api_token');
            $imagePath = $request->file('photo')->getPathname();

            $this->imageOptimizationService->optimizeImage($imagePath);

            $userData = $this->userDataService->prepareUserData($request, $accessToken, $imagePath);

            $client = new Client();
            $client->request('POST', config('api.user_creation_url'), $userData);

            return Redirect::to('/')->with('success', 'User created successfully!');
        } catch (\Throwable $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    public function showRegistrationForm()
    {
        $positions = $this->userDataService->getPositions();
        return view('users.register', ['positions' => $positions]);
    }
}
