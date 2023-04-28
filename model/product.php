<?php
    class Product{
        
        private $id;
        private $name;
        private $img_path;
        private $description;
        private $date;
        private $price;

        function __construct($id, $name, $img_path, $description, $date, $price){
            $this->setId($id);
			$this->setName($name);
			$this->setImgPath($img_path);
			$this->setDescription($description);
            $this->setDate($date);
            $this->setPrice($price);
        }

        public function setId($id){
			$this->id = $id;
		}

		public function getId(){
			return $this->id;
		}

        public function getName(){
			return $this->name;
		}
		
		public function setName($name){
			$this->name = $name;
		}
		
		public function getImgPath(){
			return $this->img_path;
		}
		
		public function setImgPath($img_path){
			$this->img_path = $img_path;
		}

		public function getDescription(){
			return $this->description;
		}

		public function setDescription($description){
			$this->description = $description;
		}

        public function getDate(){
			return $this->date;
		}

		public function setDate($date){
			$this->date = $date;
		}

        public function getPrice(){
			return $this->price;
		}

		public function setPrice($price){
			$this->price = $price;
		}

    }
    ?>