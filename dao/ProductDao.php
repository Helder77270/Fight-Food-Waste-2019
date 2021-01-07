<?php

require_once __DIR__ . '/../utils/DatabaseManager.php';
require_once __DIR__ . '/../models/Product.php';

class ProductDao
{

    public static function displayAllProducts(){
        // Récupère tout (*) les produits de la table "product"
        return DatabaseManager::getSharedInstance()->selecAll("SELECT * FROM product",[]);
    }

    public static function addProduct($barcode, $name, $quantity, $image_link,$date_limit)
    {
        // Insère en base de données un produit composé d'un code bare, un nom et une quantité et une image(lien exclusiment)
        $res = DatabaseManager::getSharedInstance()->exec("INSERT INTO product(barcode,name,quantity,image,date_limit) VALUES (?,?,?,?,?)", [$barcode, $name, $quantity, $image_link,$date_limit]);
        if ($res){
            var_dump($res);
            return ["success" => "Produit ajouté !"];

        }else{
            var_dump($res);
            return ["error" => " Un problème est survenu, contacter les développeurs au plus vite : helder.salvador@yahoo.com / stephane.trochu@gmail.com / crolandmonnet@gmail.com "];

        }
    }

    public static function updateProduct($barcode, $name, $quantity, $image_link, $id)
    {
        // Modifie en base de données un produit composé d'un code bare, un nom et une quantité et une image(lien exclusiment)
         $res = DatabaseManager::getSharedInstance()->exec("UPDATE product SET barcode=?,name=?,quantity=?,image=? WHERE id=? ", [$barcode, $name, $quantity, $image_link, $id]);

         //$res reçoit true si ok
         if ($res){
             return ["success" => " Le produit a été modifié "];
         }else{
             return ["error" => " Un problème est survenu, contacter les développeurs au plus vite : helder.salvador@yahoo.com / stephane.trochu@gmail.com / crolandmonnet@gmail.com "];
         }

    }

    public static function deleteProduct($id)
    {
        // Supprime un produit de par son id
        return DatabaseManager::getSharedInstance()->exec("DELETE FROM product WHERE id=?", [$id]);
    }

}