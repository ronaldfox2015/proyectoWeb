<?php

namespace Application\Http\Zendesk;


class Comment
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var User
     */
    protected $author;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var string
     */
    protected $created_at;

    private function __construct() {}

    /**
     * @param object $data
     * @return Comment
     */
    public static function create($data)
    {
        $comment = new Comment();
        $comment->setId($data->id);
        $comment->setBody($data->body);
        $comment->setCreatedAt($data->created_at);

        return $comment;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $author = isset($this->author) ? $this->author->toArray() : null;

        $arr = [
            'id'         => $this->getId(),
            'author'     => $author,
            'body'       => $this->getBody(),
            'create_at'  => $this->getCreatedAt(),
        ];
        return $arr;
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
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
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
}