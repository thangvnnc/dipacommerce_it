<?php
/**
 * Created by PhpStorm.
 * User: Thang
 * Date: 1/5/2019
 * Time: 3:16 PM
 */

namespace App\Message;

class Message {
    protected $code;
    protected $content;

    /**
     * @return mixed
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void {
        $this->code = $code;
    }

    public function __construct($code, $content) {
        $this->content = $content;
        $this->code = $code;
    }
}
