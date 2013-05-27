<?php

namespace Sly\NotificationPusher\Model;

use Sly\NotificationPusher\Model\MessageInterface;
use Sly\NotificationPusher\Pusher\ApplePusher;

class Message implements MessageInterface
{
    protected $status;
    protected $message;
    protected $alert;
    protected $sound;
    protected $badge;
    protected $data;
    protected $createdAt;
    protected $sentAt;

    /**
     * __construct method.
     */
    public function __construct($message = null)
    {
        $this->status    = MessageInterface::STATUS_INIT;
        $this->message   = $message;
        $this->alert     = true;
        $this->badge     = 0;
        $this->data      = array();
        $this->sound     = 'default';
        $this->createdAt = new \DateTime();
    }

    /**
     * __toString method.
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->message;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function setStatus($status)
    {
        if (true === in_array($status, $this->getSentStatuses())) {
            $this->setSentAt(new \DateTime());
        }

        $this->status = $status;
    }

    /**
     * {@inheritdoc}
     */
    public function getSentStatuses()
    {
        return array(
            MessageInterface::STATUS_SENT,
            MessageInterface::STATUS_SIMULATED_SENT,
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * {@inheritdoc}
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * {@inheritdoc}
     */
    public function getAlert()
    {
        return $this->alert;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAlert()
    {
        return (bool) $this->alert;
    }

    /**
     * {@inheritdoc}
     */
    public function setAlert($alert)
    {
        $this->alert = $alert;
    }

    /**
     * {@inheritdoc}
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * {@inheritdoc}
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;
    }

    /**
     * {@inheritdoc}
     */
    public function getSound()
    {
        return $this->sound;
    }

    /**
     * {@inheritdoc}
     */
    public function setSound($sound)
    {
        $this->sound = $sound;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->data;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getDataValueForKey($key)
    {
        if(array_key_exists($key, $this->data)) {
            return $this->data[$key];
        } else {
            return NULL;
        }        
    }
    
    /**
     * {@inheritdoc}
     */
    public function addData($key, $value)
    {
        if($key !== ApplePusher::APNS_RESERVED_NAMESPACE) {
            $this->data[$key] = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setSentAt(\DateTime $sentAt)
    {
        $this->sentAt = $sentAt;
    }
}
