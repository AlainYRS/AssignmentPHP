<?php
    class Entry{
        private $id;
        private $catId;
        private $date;
        private $subject;
        private $body;

        public static function find($sql, $bindVal = null){
            global $dbc;
            $entries = $dbc->fetchArray($sql,$bindVal);
            if(!$entries){
                return [];
            }
            foreach($entries as $entry){
                $entryObjArray[] = new self($entry['id'],$entry['cat_id'],$entry['date'],$entry['subject'],$entry['body']);
            }
            return $entryObjArray;
        }

        public function __construct($id,$catId,$date,$subject,$body){
            $this->id = $id;
            $this->catId = $catId;
            $this->date = $date;
            $this->subject = $subject;
            $this->body = $body;
        }

        public function create(){
            global $dbc;
            $sql = "INSERT INTO `entries`"." (cat_id,date,subject,body) "."VALUES (:catId,NOW(),:subject,:body);";
            $bindVal = ['catId'=>$this->catId,
                        'subject'=>$this->subject,
                        'body'=>$this->body];
            return $dbc->sqlQuery($sql,$bindVal);
        }
        
        public function update(){
            global $dbc;
            $sql = "UPDATE entries SET cat_id = :catId,"."subject = :subject,"."body = :body WHERE id = :id";
            $bindVal = ['catId'=>$this->catId,
                        'subject'=>$this->subject,
                        'body'=>$this->body,
                        'id'=>$this->id];
            return $dbc->sqlQuery($sql,$bindVal);
        }
                
        public function getid(){return $this->id;}
        public function getcatId(){return $this->catId;}
        public function getdate(){return $this->date;}
        public function getsubject(){return $this->subject;}
        public function getbody(){return $this->body;}
        public function setid($id){$this->id = $id; return $this;}
        public function setcatId($catId){$this->catId = $catId; return $this;}
        public function setdate($date){$this->date = $date; return $this;}
        public function setsubject($subject){$this->subject = $subject; return $this;}
        public function setbody($body){$this->body = $body; return $this;}
    }
?>