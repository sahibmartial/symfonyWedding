<?php
namespace App\Classe;
use Mailjet\Resources;
use Mailjet\Client;
 /**
  * 
  */
 class Mail 
 {
 	
 	private $api_key='411eb9077b5603415b40b9894cea5e1c';
	private $api_secret='6ca5b185e43bcf8749797376678f6595';
   /*
  This call sends a message to the given recipient with vars and custom vars.
  */
 	public function send($to_email,$to_name,$subject,$content)
 	{
 	
  
  $mj= new Client($this->api_key,$this->api_secret,true,['version' => 'v3.1']);
 // $mj = new MailjetClient(getenv('MJ_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'),true,['version' => 'v3.1']);
  $body = [
    'Messages' => [
      [
        'From' => [
          'Email' => "company.maya1@gmail.com",
          'Name' => "TEAM_MAYA"
        ],
        'To' => [
          [
            'Email' =>$to_email,
            'Name' => $to_name
          ]
        ],
        'TemplateID' => 2288417,
        'TemplateLanguage' => true,
        'Subject' =>$subject,
        'Variables' => [
        	'content'=>$content
        ]
      ]
    ]
  ];
  $response = $mj->post(Resources::$Email, ['body' => $body]);
  $response->success();
//&& dd($response->getData())
 	}

 		 /*
  This call sends a message to the given recipient with vars and custom vars.
  */
	 public function sendContact($to_email,$to_name,$subject,$content)
	{
		$mj = new Client($this->api_key,$this->api_secret,true,['version' => 'v3.1']);
		
		//$mj = new MailjetClient(getenv('MJ_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'),true,['version' => 'v3.1']);
		//alixya09@gmail.com,"weddingalixmartial@gmail.com",
		//"Mail de confirmation de votre invitation au mariage du duo parfait"
		$body = [
			'Messages' => [
				[
					'From' => [
						'Email' => "company.maya1@gmail.com",
						'Name' => "TEAM_MAYA"
					],
					'To' => [
						[
							'Email' => $to_email,
							'Name' => $to_name
						]
					],
					'TemplateID' => 2295318,
					'TemplateLanguage' => true,
					'Subject' => $subject ,
					'Variables' => [
                    'content' => $content,
                    
                    ]
					
				]
			]
		];
		$response = $mj->post(Resources::$Email, ['body' => $body]);

		
		$response->success();
		//dd($response->getData());
	}


 }