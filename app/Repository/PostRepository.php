<?php

namespace App\Repository;

use App\Http\Requests\SearchPostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PostRepository
{
    /**
     * build the right url with queries about the user search
     *
     * @param string[] $routeParameters
     * @return string[]
     */
    public function urlBuilder(array $routeParameters): array
    {
        if (session()->has('previous_url')) {
            $previousUrl = session('previous_url');
        } else {
            $previousUrl = URL::previous() ?: null;
        }
        if (Str::contains($previousUrl, '?')) {
            $previousQueries = explode('&', explode('?', $previousUrl)[1]);
            foreach ($previousQueries as $previousQuery) {
                $parts = explode('=', $previousQuery);
                if (!in_array($parts[0], array_keys($routeParameters)) && $parts[1]) {
                    $routeParameters[$parts[0]] = $parts[1];
                }
            }
        }
        foreach ($routeParameters as $key => $value) {
            if ($value === 'all') {
                unset($routeParameters[$key]);
            }
        }
        return $routeParameters;
    }

    public function redirectQuery(SearchPostRequest $request, array $previousParameters): ?RedirectResponse
    {
        $routeParameters = $this->urlBuilder($previousParameters);
        if ($previousParameters !== $routeParameters && session('redirect') <= 1) {
            if (session()->has('redirect')) {
                $counter = session('redirect');
                $counter++;
            } else {
                $counter = 1;
            }
            session(['previous_url' => $request->fullUrl(), 'redirect' => $counter]);
            return to_route('post.index', $routeParameters);
        }
        if (session()->has('previous_url')) {
            session()->forget('previous_url');
            session()->forget('redirect');
        }
        return null;
    }
}
