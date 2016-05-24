<?php

namespace Application\Http\Zendesk;

/**
 * Class Ticket
 * @package Application\Http\Zendesk
 */
class Ticket
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var User
     */
    protected $requester;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $theme;

    /**
     * @var string
     */
    protected $subtheme;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $created_at;

    /**
     * @var string
     */
    protected $updated_at;

    public function __construct(array $data)
    {
        $this->id           = isset($data['id'])         ? $data['id']         : null;
        $this->requester    = isset($data['requester'])  ? $data['requester']  : null;
        $this->type         = isset($data['type'])       ? $data['type']       : null;
        $this->theme        = isset($data['theme'])      ? $data['theme']      : null;
        $this->subtheme     = isset($data['subtheme'])   ? $data['subtheme']   : null;
        $this->subject      = isset($data['subject'])    ? $data['subject']    : null;
        $this->body         = isset($data['body'])       ? $data['body']       : null;
        $this->status       = isset($data['status'])     ? $data['status']     : null;
        $this->created_at   = isset($data['created_at']) ? $data['created_at'] : null;
        $this->updated_at   = isset($data['updated_at']) ? $data['updated_at'] : null;
    }

    public static function create($obj)
    {
        return new Ticket([
            'id'         => $obj->id,
            'type'       => $obj->type,
            'theme'      => isset($obj->theme) ? $obj->theme : '',
            'subtheme'   => isset($obj->subtheme) ? $obj->subtheme : '',
            'subject'    => $obj->subject,
            'body'       => $obj->description,
            'status'     => $obj->status,
            'created_at' => $obj->created_at,
            'updated_at' => $obj->updated_at,
        ]);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $requester = isset($this->requester) ? $this->requester->toArray() : null;

        return [
            'id'          => $this->getId(),
            'requester'   => $requester,
            'type'        => $this->getType(),
            'theme'       => $this->getTheme(),
            'subtheme'    => $this->getSubtheme(),
            'subject'     => $this->getSubject(),
            'body'        => $this->getBody(),
            'status'      => $this->getStatus(),
            'created_at'  => $this->getCreatedAt(),
            'updated_at'  => $this->getUpdatedAt(),
        ];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getRequester()
    {
        return $this->requester;
    }

    /**
     * @param User $requester
     */
    public function setRequester($requester)
    {
        $this->requester = $requester;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param string $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    /**
     * @return string
     */
    public function getSubtheme()
    {
        return $this->subtheme;
    }

    /**
     * @param string $subtheme
     */
    public function setSubtheme($subtheme)
    {
        $this->subtheme = $subtheme;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

}