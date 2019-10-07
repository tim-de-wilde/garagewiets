<?php
namespace garagewiets\src\Helpers;

/**
 * Class Table
 *
 * @package garagewiets\src\Helpers
 */
class Table
{
    private $name;
    private $headers;
    private $content;

    /**
     * Table constructor.
     *
     * @param String $name
     * @param        $headers
     * @param        $content
     */
    public function __construct(String $name, $headers, $content)
    {
        $this->name = $name;
        $this->headers = $headers;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }
}
