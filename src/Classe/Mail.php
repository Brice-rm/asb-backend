<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;


class Mail {

    private $api_key = 'f9e80aebd4b597e6838990407aebca76';
    private $api_key_secret = '9bafd8941dd3fbd2e822b136c5295d6d';

    public function send($to_email, $to_name, $subject, $content){

        $mj = new Client($this->api_key, $this->api_key_secret,true,['version' => 'v3.1']); // on instancie l'objet Mailjet
        $body = [
            // Corps du mail
            'Messages' => [
                [
                    'From' => [
                        'Email' => "bricerome77@gmail.com", // boite mail utilisé par mailjet pour envoyer les messages
                        'Name' => "Client ASB"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email, // boite mail qui recois les messages
                            'Name' => $to_name 
                        ]
                    ],
                    'TemplateID' => 2839446, // id de mon template créé sur le site mailjet
                    'TemplateLanguage' => true,
                    'Subject' => $subject, // objet
                    'Variables' => [
                        'content' => $content, // contenu de mon mail
                    ]
                ]
            ]
        ];
$response = $mj->post(Resources::$Email, ['body' => $body]); // méthode afin de l'envoyer
 $response->success(); //&& var_dump($response->getData());

    }
}

?>