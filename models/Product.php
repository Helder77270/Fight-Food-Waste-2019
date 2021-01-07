<?php

class Product implements JsonSerializable
{
    private $id;
    private $codeBarre;
    private $nom;
    private $quantity;
    private $dateLimit;
    private $image;
    private $fkNumOrder;

    public function __construct(array $fields = [])
    {
        if(isset($fields['id'])){
            $this->id = $fields['id'];
        }
        $this->codeBarre = $fields['barcode'];
        $this->nom = $fields['name'];
        $this->quantity = $fields['quantity'];
        $this->dateLimit = $fields['date_limit'];
        $this->image = $fields['image'];
        $this->fkNumOrder = $fields['fk_num_order'];
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
    public function getCodeBarre()
    {
        return $this->codeBarre;
    }

    /**
     * @param mixed $codeBarre
     */
    public function setCodeBarre($codeBarre)
    {
        $this->codeBarre = $codeBarre;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getDateLimit()
    {
        return $this->dateLimit;
    }

    /**
     * @param mixed $dateLimit
     */
    public function setDateLimit($dateLimit)
    {
        $this->dateLimit = $dateLimit;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getFkNumOrder()
    {
        return $this->fkNumOrder;
    }

    /**
     * @param mixed $fkNumOrder
     */
    public function setFkNumOrder($fkNumOrder)
    {
        $this->fkNumOrder = $fkNumOrder;
    }






    public function JsonSerialize() {return get_object_vars($this);}

}

