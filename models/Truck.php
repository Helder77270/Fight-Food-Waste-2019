<?php


class Truck implements JsonSerializable
{

    private $id;
    private $licence_plate;
    private $brand;
    private $status;

    public function __construct(array $fields = [])
    {

        if(isset($fields['id'])){
            $this->id = $fields['id'];
        }
        $this->licence_plate = $fields['licence_plate'];
        $this->brand = $fields['brand'];
        $this->status = $fields['status'];
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
    public function getLicencePlate()
    {
        return $this->licence_plate;
    }

    /**
     * @param mixed $licence_plate
     */
    public function setLicencePlate($licence_plate)
    {
        $this->licence_plate = $licence_plate;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
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
        return $this->id." ".$this->licence_plate." ".$this->brand." ".$this->status;
    }

    public function JsonSerialize() {return get_object_vars($this);}

}