<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\Response;

class EnsureSlugPostIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Post $post */
        $post = $request->post;
        if($post->slug !== $request->slug) return to_route('post.show', ['slug' => $post->slug, 'post' => $post]);
        return $next($request);
    }
}
