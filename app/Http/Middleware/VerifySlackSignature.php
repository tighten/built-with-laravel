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

        if (! $signingSecret) {
            abort(500, 'Slack signing secret is not configured.');
        }

        $timestamp = $request->header('X-Slack-Request-Timestamp');
        $slackSignature = $request->header('X-Slack-Signature');

        if (! $timestamp || ! $slackSignature) {
            abort(403, 'Missing Slack signature headers.');
        }

        // Reject requests older than 5 minutes to prevent replay attacks
        if (abs(time() - (int) $timestamp) > 300) {
            abort(403, 'Slack request timestamp is too old.');
        }

        $sigBaseString = "v0:{$timestamp}:{$request->getContent()}";
        $mySignature = 'v0=' . hash_hmac('sha256', $sigBaseString, $signingSecret);

        if (! hash_equals($mySignature, $slackSignature)) {
            abort(403, 'Invalid Slack signature.');
        }

        return $next($request);
    }
}
