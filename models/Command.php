<?php


class Command implements JsonSerializable
{
    private $id;
    private $num_order;
    private $fk_mail_user;
    private $status;

    public function __construct(array $fields = [])
    {
        if(isset($fields['id'])){
            $this->id = $fields['id'];
        }
        $this->num_order=$fields['num_order'];
        $this->fk_mail_user=$fields['fk_mail_user'];
        $this->status=$fields['status'];

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNumOrder()
    {
        return $this->num_order;
    }

    /**
     * @param mixed $num_order
     */
    public function setNumOrder($num_order)
    {
        $this->num_order = $num_order;
    }


    /**
     * @return mixed
     */
    public function getFkMailUser()
    {
        return $this->fk_mail_user;
    }

    /**
     * @param mixed $fk_mail_user
     */
    public function setFkMailUser($fk_mail_user)
    {
        $this->fk_mail_user = $fk_mail_user;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }





    public function __toString(){
       return $this->id." ".$this->num_order." ".$this->fk_mail_user." ".$this->status;
    }

    public function JsonSerialize() {return get_object_vars($this);}


}

