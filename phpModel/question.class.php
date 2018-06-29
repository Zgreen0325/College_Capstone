<?php
    class question implements JsonSerializable {
        private $id;
        private $text;
        private $type;
        private $correctID;
        private $filename;
        private $correctAnswer;
        //private $currentQ;
        
        //Constructers
        function __construct($id, $text, $type, $filename, $correctID, $answer) {
	  	    $this->setID($id);
	  	    $this->setText($text);
            $this->setType($type);
		    $this->setCorrectID($correctID);
            $this->setFilename($filename);
            $this->setcorrectAnswer($answer);
		    //$this->setCurrentQ($currentQ);
        }
        
        //Setters
        public function setID($id) {$this->id=$id;}
        public function setText($text) {$this->text=$text;}
        public function setType($type) {$this->type=$type;}
        public function setCorrectID($correctID) {$this->correctID=$correctID;}
        public function setFilename($filename) {$this->filename=$filename;}
        public function setCorrectAnswer($answer) {$this->correctAnswer=$answer;}
        //public function setCurrentQ($currentQ) {$this->currentQ=$id$currentQ;}
        
        //Getters
        public function getID() {return $this->id;}
        public function getText() {return $this->text;}
        public function getType() {return $this->type;}
        public function getCorrectID() {return $this->correctID;}
        public function getFilename() {return $this->filename;}
        public function getCorrectAnswer() {return $this->correctAnswer;}
        //public function getCurrentQ() {return $this->currentQ;}
        
        // Json Seralize Method
	    public function jsonSerialize() {
	  	    return ['id'=>$this->getID(),
	  	        'text'=>$this->getText(),
	  	        'type'=>$this->getType(),
	  	        'correctID'=>$this->getCorrectID(),
	  	        'filename'=>$this->getFilename()];
	  	        //'currentQ'=>$this->getCurrentQ()];
	    }
	    
	    public function __toString() {
   	        $questionObject =  'Question: ' .
                'id=>' . $this->getID() . ' ' . 
   	            'text=>' . $this->getText() . ' ' .
   	            'type=>' . $this->getType() . ' ' .
   	            'correctID=>' . $this->getCorrectID() . ' ' .
   	            'filename=>' . $this->getFilename();
   	            //'currentQ=>' . $this->getCurrentQ(); 
	        return $questionObject;
        }
    }
?>