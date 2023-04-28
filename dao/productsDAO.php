<?php
require_once('abstractDAO.php');
require_once('./model/product.php');

class productsDAO extends abstractDAO {
        
    function __construct() {
        try{
            parent::__construct();
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }  
    
    public function getProduct($productId){
        $query = 'SELECT * FROM products WHERE id = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $temp = $result->fetch_assoc();
            $product = new product($temp['id'],$temp['name'], $temp['img_path'], $temp['description'], $temp['date'], $temp['price']);
            $result->free();
            return $product;
        }
        $result->free();
        return false;
    }


    public function getProducts(){
        //The query method returns a mysqli_result object
        $result = $this->mysqli->query('SELECT * FROM products');
        $products = Array();
        
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
                //Create a new products object, and add it to the array.
                $product = new product($row['id'], $row['name'], $row['img_path'], $row['description'], $row['date'], $row['price']);
                $products[] = $product;
            }
            $result->free();
            return $products;
        }
        $result->free();
        return false;
    }   
    
    public function addProduct($product){
        
        if(!$this->mysqli->connect_errno){
            //The query uses the question mark (?) as a
            //placeholder for the parameters to be used
            //in the query.
            //The prepare method of the mysqli object returns
            //a mysqli_stmt object. It takes a parameterized 
            //query as a parameter.
			$query = 'INSERT INTO products (name, img_path, description, date, price) VALUES (?,?,?,?,?)';
			$stmt = $this->mysqli->prepare($query);
            if($stmt){
                    $name = $product->getName();
			        $img_path = $product->getImgPath();
			        $description = $product->getDescription();
                    $date = $product->getDate();
                    $price = $product->getPrice();
                  
			        $stmt->bind_param('ssssd', 
				        $name,
				        $img_path,
				        $description,
                        $date,
                        $price
			        );    
                    //Execute the statement
                    $stmt->execute();         
                    
                    if($stmt->error){
                        return $stmt->error;
                    } else {
                        return $product->getName() . ' added successfully!';
                    } 
			}
             else {
                $error = $this->mysqli->errno . ' ' . $this->mysqli->error;
                echo $error; 
                return $error;
            }
       
        }else {
            return 'Could not connect to Database.';
        }
    }   
    public function updateProduct($product){
        
        if(!$this->mysqli->connect_errno){
            //The query uses the question mark (?) as a
            //placeholder for the parameters to be used
            //in the query.
            //The prepare method of the mysqli object returns
            //a mysqli_stmt object. It takes a parameterized 
            //query as a parameter.
            $query = "UPDATE products SET name=?, img_path=?, description=?, date=?, price=? WHERE id=?";
            $stmt = $this->mysqli->prepare($query);
            if($stmt){
                    $id = $product->getId();
                    $name = $product->getName();
			        $img_path = $product->getImgPath();
			        $description = $product->getDescription();
                    $date = $product->getDate();
                    $price = $product->getPrice();
                  
                    $stmt->bind_param('ssssdi', 
                    $name,
                    $img_path,
                    $description,
                    $date,
                    $price,
                    $id
                );   
                    //Execute the statement
                    $stmt->execute();         
                    
                    if($stmt->error){
                        return $stmt->error;
                    } else {
                        return $product->getName() . ' updated successfully!';
                    } 
			}
             else {
                $error = $this->mysqli->errno . ' ' . $this->mysqli->error;
                echo $error; 
                return $error;
            }
       
        }else {
            return 'Could not connect to Database.';
        }
    }   

    public function deleteProduct($productId){
        if(!$this->mysqli->connect_errno){
            $query = 'DELETE FROM products WHERE id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $productId);
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}
?>