<?php
    class answer implements JsonSerializable {
        private $id;
        private $deviceID;
        private $answerText;
        private $subAns;
        private $nickname;
        private $displayed;
        
        //Constructers
        function __construct($id, $deviceID, $answerText, $subAns, $nickname, $displayed) {
	  	    $this->setID($id);
	  	    $this->setDeviceID($deviceID);
            $this->setAnswerText($subAns);
            $this->setsubAnswer($subAns);
            $this->setNickname($nickname);
            $this->setDisplayed($displayed);
        }
        
        //Setters
        public function setID($id) {$this->id=$id;}
        public function setDeviceID($deviceID) {$this->deviceID=$deviceID;}
        public function setAnswerText($answerText) {$this->answerText=$answerText;}
        public function setSubAnswer($subAns) {$this->subAns=$subAns;}
        public function setNickname($nickname) {$this->nickname=$nickname;}
        public function setDisplayed($displayed) {$this->displayed=$displayed;}
        
        //Getters
        public function getID() {return $this->id;}
        public function getDeviceID() {return $this->deviceID;}
        public function getAnswerText() {return $this->answerText;}
        public function getSubAnswer() {return $this->subAns;}
        public function getNickname() {return $this->nickname;}
        public function getDisplayed() {return $this->displayed;}
        
        // Json Seralize Method
	    public function jsonSerialize() {
	  	    return ['id'=>$this->setID(),
	  	        'deviceID'=>$this->setDeviceID(),
	  	        'answerText'=>$this->setAnswerText(),
                'subAns'=>$this->setSubAns(),
                'nickname'=>$this->setNickname(),
                'displayed'=>$this->setDisplayed()];
	    }
	    
	    public function __toString() {
   	        $answerObject =  'Answer: ' .
                'id=>' . $this->setCourseID() . ' ' . 
   	            'deviceID=>' . $this->setDeviceID() . ' ' .
   	            'submittedAnswer=>' . $this->setSubmittedAnswer().' '.
                'subAns' . $this->setSubAns().' '.
                'nickname' . $this->setNickname().' '.
                'displayed=>' . $this->setDisplayed(); 
	        return $answerObject;
        }
    }
?>