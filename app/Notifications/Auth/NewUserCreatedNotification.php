<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class NewUserCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = $this->createUrl($notifiable);

        return (new MailMessage())
                    ->subject(Lang::get("Welcome {$notifiable->first_name}"))
                    ->greeting(Lang::get("Dear {$notifiable->first_name}"))
                    ->line(Lang::get("Welcome to Leave calculator. To activate this account, please click on the button below."))
                    ->action(Lang::get('Verify Account'), $url)
                    ->line(Lang::get('This link will expire in :count hours.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')/60]))
                    ->line(Lang::get('If you are not sure about this then no further action is required.'))
                    ->line(Lang::get("Best Regards, Leave Calculator Team."));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => "New Account",
            'message' => "Account for {$notifiable->getEmailForVerification()} created successfully."
        ];
    }

    private function createUrl($notifiable)
    {
        return config('app.frontend_url') . '/auth/verify-account' . '?token=' . $this->token . '&email=' . $notifiable->getEmailForVerification();
    }
}
