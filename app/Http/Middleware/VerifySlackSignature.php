<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifySlackSignature
{
    public function handle(Request $request, Closure $next): Response
    {
        $signingSecret = config('services.slack.signing_secret');

        abort_unless($signingSecret, 500, 'Slack signing secret is not configured.');

        $timestamp = $request->header('X-Slack-Request-Timestamp');
        $slackSignature = $request->header('X-Slack-Signature');

        abort_if(! $timestamp || ! $slackSignature, 403, 'Missing Slack signature headers.');

        // Reject requests older than 5 minutes to prevent replay attacks
        abort_if(abs(time() - (int) $timestamp) > 300, 403, 'Slack request timestamp is too old.');

        $sigBaseString = "v0:{$timestamp}:{$request->getContent()}";
        $mySignature = 'v0=' . hash_hmac('sha256', $sigBaseString, $signingSecret);

        abort_unless(hash_equals($mySignature, $slackSignature), 403, 'Invalid Slack signature.');

        return $next($request);
    }
}
