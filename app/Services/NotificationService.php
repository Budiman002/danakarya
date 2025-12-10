<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    public static function send(User $user, string $type, string $title, string $message, array $data = [])
    {
        return Notification::create([
            'user_id' => $user->id,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public static function sendToMultiple(array $users, string $type, string $title, string $message, array $data = [])
    {
        $notifications = [];
        foreach ($users as $user) {
            $notifications[] = [
                'user_id' => $user->id,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'data' => $data,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Notification::insert($notifications);
    }

    public static function welcome(User $user)
    {
        return self::send(
            $user,
            'welcome',
            '🎉 Welcome to DanaKarya!',
            'Thank you for joining DanaKarya. Start exploring campaigns or create your own!',
            ['user_id' => $user->id]
        );
    }

    public static function newDonation($donation)
    {
        return self::send(
            $donation->campaign->user,
            'new_donation',
            '💰 New Donation Received!',
            "{$donation->user->name} just donated Rp " . number_format($donation->amount, 0, ',', '.') . " to your campaign: {$donation->campaign->title}",
            [
                'donation_id' => $donation->id,
                'campaign_id' => $donation->campaign_id,
                'amount' => $donation->amount,
                'donor_name' => $donation->user->name,
            ]
        );
    }

    public static function donationSuccess($donation)
    {
        return self::send(
            $donation->user,
            'donation_success',
            '✅ Donation Successful!',
            "Your donation of Rp " . number_format($donation->amount, 0, ',', '.') . " to {$donation->campaign->title} was successful. Thank you for your support!",
            [
                'donation_id' => $donation->id,
                'campaign_id' => $donation->campaign_id,
                'campaign_slug' => $donation->campaign->slug,
                'amount' => $donation->amount,
            ]
        );
    }

    public static function campaignApproved($campaign)
    {
        return self::send(
            $campaign->user,
            'campaign_approved',
            '✅ Campaign Approved!',
            "Great news! Your campaign '{$campaign->title}' has been approved and is now live!",
            [
                'campaign_id' => $campaign->id,
                'campaign_slug' => $campaign->slug,
            ]
        );
    }

    public static function campaignRejected($campaign, string $reason)
    {
        return self::send(
            $campaign->user,
            'campaign_rejected',
            '❌ Campaign Rejected',
            "Your campaign '{$campaign->title}' was not approved. Reason: {$reason}",
            [
                'campaign_id' => $campaign->id,
                'reason' => $reason,
            ]
        );
    }

    public static function campaignUpdate($update, array $backers)
    {
        return self::sendToMultiple(
            $backers,
            'campaign_update',
            '📢 New Campaign Update',
            "The campaign '{$update->campaign->title}' you supported has posted a new update: {$update->title}",
            [
                'update_id' => $update->id,
                'campaign_id' => $update->campaign_id,
                'campaign_slug' => $update->campaign->slug,
            ]
        );
    }

    public static function withdrawalApproved($withdrawal)
    {
        return self::send(
            $withdrawal->campaign->user,
            'withdrawal_approved',
            '💰 Withdrawal Approved',
            "Your withdrawal request of Rp " . number_format($withdrawal->amount, 0, ',', '.') . " has been approved and will be processed soon.",
            [
                'withdrawal_id' => $withdrawal->id,
                'campaign_id' => $withdrawal->campaign_id,
                'amount' => $withdrawal->amount,
            ]
        );
    }
}
