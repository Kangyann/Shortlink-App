<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mailtrap\Config;
use Mailtrap\EmailHeader\CategoryHeader;
use Mailtrap\MailtrapClient;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class Verify extends Model
{
    use HasFactory;
    protected $fillable = ['token', 'username', 'user_id', 'expires_at'];
    protected $hidden = ['token'];

    public static function sendMail($data)
    {
        $apiKey = '9f28e4a202125f7d4d884706259fc2c5';
        $mailtrap = new MailtrapClient(new Config($apiKey));
        $email = (new Email())
            ->from(new Address('support@rizal-pedia.my.id', 'Support'))
            ->to(new Address($data['email']))
            ->subject($data['category'])
            ->text($data['text']);
        $email->getHeaders()
            ->add(new CategoryHeader($data['category']));
        $response = $mailtrap->sending()->emails()->send($email);
        return $response;
    }
}
