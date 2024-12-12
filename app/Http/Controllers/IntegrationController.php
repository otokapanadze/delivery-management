<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IntegrationController extends Controller
{
    /**
     * Redirect to Shopify OAuth.
     */
    public function redirectToShopify(Request $request)
    {
        $shop = $request->query('shop');

        if (!$shop) {
            return redirect()->back()->with('error', 'Shop domain is required.');
        }

        $apiKey = config('services.shopify.key');
        $redirectUri = route('integration.shopify.callback');
        $scopes = 'read_orders,write_orders';

        $oauthUrl = "https://{$shop}/admin/oauth/authorize?client_id={$apiKey}&scope={$scopes}&redirect_uri={$redirectUri}";

        return redirect($oauthUrl);
    }

    /**
     * Handle Shopify OAuth Callback.
     */
    public function handleShopifyCallback(Request $request)
    {
        $shop = $request->query('shop');
        $code = $request->query('code');

        if (!$shop || !$code) {
            return redirect()->route('filament.app.resources.integrations.index')->with('error', 'Invalid OAuth request.');
        }

        $response = Http::post("https://{$shop}/admin/oauth/access_token", [
            'client_id' => config('services.shopify.key'),
            'client_secret' => config('services.shopify.secret'),
            'code' => $code,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            $integration = Integration::where('content->shop_domain', $shop)->first();

            if (!$integration) {
                $integration = new Integration;
            }

            $integration->name = $integration->name ?? $shop;
            $integration->type = 'shopify';
            $integration->access_token = $data['access_token'];
            $integration->content = ['shop_domain' => $shop];
            $integration->save();

            return redirect()->route('filament.app.resources.integrations.index')->with('success', 'Shopify integration successful.');
        }

        return redirect()->route('filament.app.resources.integrations.index')->with('error', 'Failed to integrate with Shopify.');
    }
}
