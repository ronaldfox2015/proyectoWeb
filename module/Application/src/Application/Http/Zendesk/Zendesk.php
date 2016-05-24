<?php

namespace Application\Http\Zendesk;

use RuntimeException;
use Zendesk\API\Exceptions\ApiResponseException;
use Zendesk\API\HttpClient as ZendeskAPI;

class Zendesk
{
    /**
     * @var string
     */
    protected  $subdomain;

    /**
     * @var string
     */
    protected  $username;

    /**
     * @var string
     */
    protected  $token;

    /**
     * @var array
     */
    protected $customFields;

    /**
     * @var \Zendesk\API\HttpClient
     */
    protected $client;

    /**
     * @param string $subdomain
     * @param string $username
     * @param string $token
     */
    public function __construct($subdomain, $username, $token)
    {
        $this->subdomain = $subdomain;
        $this->username  = $username;
        $this->token     = $token;

        define("ZDAPIKEY", $this->token);
        define("ZDUSER", $this->username);
        define("ZDURL", "https://" . $this->subdomain. ".zendesk.com/api/v2");

        $this->client = $this->auth($subdomain, $username, $token);
    }

    /**
     * @param string $subdomain
     * @param string $username
     * @param string $token
     * @return \Zendesk\API\HttpClient
     */
    private function auth($subdomain, $username, $token)
    {
        $client = new ZendeskAPI($subdomain, $username);
        $client->setAuth('basic', [
            'username' => $username,
            'token'    => $token
        ]);

        return $client;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createTicket($params)
    {
        $this->validate(['subject', 'name', 'email', 'body', 'theme'], $params);

        try {
            $response = $this->client->tickets()->sideload(['users'])->create([
                'subject'   => $params['subject'],
                'requester' => [
                    'name'  => $params['name'],
                    'email' => $params['email']
                ],
                'comment'   => [
                    'body'  => $params['body']
                ],
                'priority'  => 'normal',
                'custom_fields' => [
                    [
                        'id'    => $this->getCustomFieldId('theme'),
                        'value' => $params['theme']
                    ],
                    /*
                    [
                        'id'    => $this->getCustomFieldId('subtheme'),
                        'value' => $params['subtheme']
                    ]
                    */
                ]
            ]);

            //$ticketRender = $this->searchThemeRender($response->ticket->custom_fields[0]->value);
            //$response->ticket->theme = $ticketRender['theme'];
            //$response->ticket->theme = $ticketRender['subtheme'];

            $newTicket = Ticket::create($response->ticket)->toArray();
            //$user = $this->getUser($response->ticket->requester_id);
            //$newTicket->setRequester(User::create($user));

            return $newTicket;
        } catch (ApiResponseException  $e) {
            return $e->getErrorDetails();
        }
    }

    /**
     * @param int $ticketId
     * @return array|mixed
     * @throws \Zendesk\API\Exceptions\MissingParametersException
     */
    public function getComments($ticketId)
    {
        try {
            $response = $this->client->tickets()->comments()->sideload(['users'])->findAll([
                'ticket_id' => $ticketId
            ]);

            $comments = [];

            foreach ($response->comments as $comment) {
                $newComment = Comment::create($comment);

                foreach($response->users as $user) {
                    if ($user->id == $comment->author_id) {
                        $newComment->setAuthor(User::create($user));
                        break;
                    }
                }

                array_push($comments, $newComment);
            }

            return $comments;

        } catch(ApiResponseException $e) {
            return $e->getErrorDetails();
        }
    }

    /**
     * @param array $ids
     * @return array|mixed
     * @throws \Zendesk\API\Exceptions\ApiResponseException
     */
    public function getTickets($ids)
    {
        try {
            $response = $this->client->tickets()->sideload(['users'])->findMany($ids);
            $tickets = [];
/*
            foreach ($response->tickets as $ticket) {
                $temp = [
                    'id' => $ticket->id,
                    'status' => $ticket->status,
                    'theme' =>  'THEME',
                    'subtheme' => 'SUBTHEME',
                    'created_at' => $ticket->created_at,
                    'updated_at' => $ticket->updated_at,
                ];
                array_push($tickets, $temp);
            }

            return $tickets;
*/

            foreach ($response->tickets as $ticket) {
                $themesRender = $this->searchThemeRender($ticket->custom_fields[0]->value);

                $ticket->theme = $themesRender['theme'];
                $ticket->subtheme = $themesRender['subtheme'];

                $newTicket = Ticket::create($ticket);

                foreach($response->users as $user) {
                    if ($user->id == $ticket->submitter_id) {
                        $newTicket->setRequester(User::create($user));
                        break;
                    }
                }
                array_push($tickets, $newTicket->toArray());
            }

            return $tickets;


        } catch(ApiResponseException $e) {
            return $e->getErrorDetails();
        }
    }

    /**
     * @param string $themeValue
     * @return string
     */
    public function searchThemeRender($themeValue)
    {
        $fieldsOptions = $this->getValuesFieldTicket($this->getCustomFieldId('theme'));
        $options = $fieldsOptions->ticket_field->custom_field_options;

        foreach ($options as $option) {
            if ($option->value == $themeValue) {
                return [
                    'theme' => explode('::', $option->raw_name)[0],
                    'subtheme' => explode('::', $option->raw_name)[1]
                ];
            }
        }

        return [
            'theme' => '',
            'subtheme' => ''
        ];
    }

    /**
     * @param string $theme
     * @param  int $id
     * @return string
     */
    public function searchSubthemeRender($theme, $id)
    {
        return 'THEME';
    }

    /**
     * @param int $id
     * @param string $status
     * @return mixed
     * @throws \Zendesk\API\Exceptions\ApiResponseException
     */
    public function updateStatus($id, $status)
    {
        try {
            $response = $this->client->tickets()->update($id, [
                'status' => $status
            ]);

            return $response;
        } catch (ApiResponseException $e) {
            return $e->getErrorDetails();
        }
    }

    public function getUser($id)
    {
        try {
            $response = $this->client->users()->find($id);
            return User::create($response->user)->toArray();
        } catch (ApiResponseException $e) {
            return $e->getErrorDetails();
        }
    }

    /**
     * @param $ids
     * @return array|mixed
     * @throws \Zendesk\API\Exceptions\ApiResponseException
     */
    public function getUsers($ids)
    {
        foreach ($ids as $id) {
            if (is_int($id)) {
                throw new \RuntimeException('Parameter ' . $id . ' required type int');
            }
        }

        try {
            $response = $this->client->users()->findMany(['ids' => $ids]);
            $users = [];

            foreach ($response->users as $user) {
                array_push($users, User::create($user));
            }

            return $users;
        } catch (ApiResponseException $e) {
            return $e->getErrorDetails();
        }
    }

    /**
     * Return all tickets
     *
     * @return mixed
     */
    public function getAllTickets()
    {
        try {
            $response = $this->client->tickets()->findAll([]);
            $tickets = [];

            foreach ($response->tickets as $ticket) {
                $newTicket = Ticket::create($ticket);
                array_push($tickets, $newTicket->toArray());
            }

            return $tickets;
        } catch (ApiResponseException $e) {
            return $e->getErrorDetails();
        }
    }

    /**
     * Retorna un field de tipo select personalizado de dos niveles
     *
     * @return \stdClass
     */
    public function getThemesValues()
    {
        $id = $this->getCustomFieldId('theme');

        try {
            $response = new \stdClass();
            $result = $this->getValuesFieldTicket($id);
            $options = $result->ticket_field->custom_field_options;

            // Search key themes
            $themes = array();
            foreach ($options as $option) {
                $currentKey = explode('::', $option->name)[0];
                if (! array_key_exists($currentKey, $themes)) {
                    $themes[$currentKey] = [
                        'name' => $currentKey,
                        'value' => $currentKey,
                        'subthemes' => []
                    ];
                }
            }

            // Add SubThemes
            foreach ($options as $option) {
                $currentKey = explode('::', $option->name)[0];
                $subthemes = $themes[$currentKey]['subthemes'];
                $subtheme = [
                    'id' => $option->id,
                    'name' => explode('::', $option->name)[1],
                    'value' => $option->value,
                    'theme' => $currentKey
                ];
                array_push($subthemes, $subtheme);
                $themes[$currentKey]['subthemes'] = $subthemes;
            }

            $response->code = 200;
            $response->data = $themes;

            return $response;
        } catch (\Exception $e) {
            $response->code = $e->getCode();
            $response->message = $e->getMessage();
            return $response;
        }
    }

    /**
     * Retorna la informacion de los campos del ticket
     *
     * @return mixed
     */
    public function getFieldsTicket()
    {
        try {
            $response = new \stdClass();
            $url = '/ticket_fields.json';
            $response = $this->curlWrap($url, null, 'GET');
            $response->code = 200;

            return $response;
        } catch (\Exception $e) {

            $response->code = $e->getCode();
            $response->message = $e->getMessage();
            return $response;
        }
    }

    /**
     * Retorna la informacion de un campo especifico del ticket
     *
     * @param int $id
     * @return mixed
     */
    public function getValuesFieldTicket($id)
    {
        try {
            $response = new \stdClass();
            $url = '/ticket_fields/' . $id . '.json';
            $response = $this->curlWrap($url, null, 'GET');
            $response->code = 200;

            return $response;
        } catch (\Exception $e) {
            $response->code = $e->getCode();
            $response->message = $e->getMessage();
            return $response;
        }
    }

    /**
     * @param string $url
     * @param array|null $json
     * @param string $action
     * @return mixed
     */
    public function curlWrap($url, $json, $action)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
        curl_setopt($ch, CURLOPT_URL, ZDURL.$url);
        curl_setopt($ch, CURLOPT_USERPWD, ZDUSER."/token:".ZDAPIKEY);
        switch($action){
            case "POST":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                break;
            case "GET":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                break;
            case "PUT":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                break;
            case "DELETE":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
            default:
                break;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $output = curl_exec($ch);
        curl_close($ch);
        $decoded = json_decode($output);

        return $decoded;
    }

    /**
     * @return string
     */
    public function getSubdomain()
    {
        return $this->subdomain;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param array $customFields
     */
    public function setCustomFields($customFields)
    {
        $this->customFields = $customFields;
    }

    /**
     * @param string $key
     * @return int
     */
    public function getCustomFieldId($key)
    {
        return $this->customFields[$key];
    }

    private function validate($keys, $params)
    {
        foreach ($keys as $key) {
            if (! isset($params[$key])) {
                throw new \RuntimeException('Parameter ' . $key . ' is required');
            }
        }
    }
}