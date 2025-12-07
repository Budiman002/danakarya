<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransWebhookController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function handle(Request $request)
    {
        try {
            $notification = new Notification();

            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;
            $orderId = $notification->order_id;

            // Extract donation ID from order_id (format: DONATION-{id}-{timestamp})
            preg_match('/DONATION-(\d+)-/', $orderId, $matches);
            
            if (!isset($matches[1])) {
                return response()->json(['message' => 'Invalid order ID format'], 400);
            }

            $donationId = $matches[1];
            $donation = Donation::find($donationId);

            if (!$donation) {
                return response()->json(['message' => 'Donation not found'], 404);
            }

            // Handle different transaction statuses
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $this->updateDonationSuccess($donation);
                }
            } elseif ($transactionStatus == 'settlement') {
                $this->updateDonationSuccess($donation);
            } elseif ($transactionStatus == 'pending') {
                $donation->update(['status' => 'pending']);
            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                $donation->update(['status' => 'failed']);
            }

            return response()->json(['message' => 'Notification handled successfully']);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error processing notification',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function updateDonationSuccess($donation)
    {
        // Update donation status
        $donation->update(['status' => 'paid']);

        // Update campaign current_amount
        $campaign = Campaign::find($donation->campaign_id);
        if ($campaign) {
            $campaign->increment('current_amount', $donation->amount);

            // Check if campaign reached target
            if ($campaign->current_amount >= $campaign->target_amount) {
                $campaign->update(['status' => 'funded']);
            }
        }
    }
}