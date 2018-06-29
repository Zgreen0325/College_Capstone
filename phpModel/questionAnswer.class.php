<?php
    class questionAnswer implements JsonSerializable {
        private $id;
        private $deviceID;
        private $text;
        private $filename;
        
        //Constructers
        function __construct($id, $deviceID, $text, $filename) {
	  	    $this->setID($id);
	  	    $this->setDeviceID($deviceID);
            $this->setText($text);
            $this->setFilename($filename);
        }
        
        //Setters
        public function setID($id) {$this->id=$id;}
        public function setDeviceID($deviceID) {$this->deviceID=$deviceID;}
        public function setText($text) {$this->text=$text;}
        public function setFilename($filename) {$this->filename=$filename;}
        
        //Getters
        public function getID() {return $this->id;}
        public function getDeviceID() {return $this->deviceID;}
        public function getText() {return $this->text;}
        public function getFilename() {return $this->filename;}
        
        // Json Seralize Method
	    public function jsonSerialize() {
	  	    return ['id'=>$this->getID(),
	  	        'deviceID'=>$this->getDeviceID(),
	  	        'text'=>$this->setText(),
                'filename'=>$this->getFilename()];
	    }
	    
	    public function __toString() {
   	        $answerObject =  'Answer: ' .
                'id=>' . $this->getID() . ' ' . 
   	            'deviceID=>' . $this->getDeviceID() . ' ' .
   	            'text=>' . $this->setText().' '.
                'filename=>' . $this->getFilename(); 
	        return $answerObject;
        }
    }
?>