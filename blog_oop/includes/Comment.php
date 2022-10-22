<?php
    class Comment{
        private $id;
        private $blog_id;
        private $date;
        private $name;
        private $comment;

        public static function find($sql, $bindVal = null){
            global $dbc;
            $comments = $dbc->fetchArray($sql,$bindVal);
            if(!$comments){
                return [];
            }
            foreach($comments as $comment){
                $commentObjArray[] = new self($comment['id'],
                $comment['blog_id'], $comment['date'],
                $comment['name'], $comment['comment']);
            }
            return $commentObjArray;
        }
        public function __construct($id,$blog_id,$date,$name,$comment){
            $this->id = $id;
            $this->blog_id = $blog_id;
            $this->date = $date;
            $this->name = $name;
            $this->comment = $comment;
        }
        public function create(){
            global $dbc;
            $sql = "INSERT INTO `comments` " . " (blog_id, date, name, comment) " . "VALUES (:blog_id, NOW(), :name, :comment);";
            $bindVal = ['blog_id' => $this->blog_id,
                         'name' => $this->date,
                         'comment' => $this->comment];
            return $dbc->sqlQuery($sql,$bindVal);
        }

        public function setid($id){$this->id = $id; return $this;}
        public function setblog_id($blog_id){$this->blog_id = $blog_id; return $this;}
        public function setdate($date){$this->date = $date; return $this;}
        public function setname($name){$this->name = $name; return $this;}
        public function setcomment($comment){$this->comment = $comment; return $this;}

        public function getid(){return $this->id;}
        public function getblog_id(){return $this->blog_id;}
        public function getdate(){return $this->date;}
        public function getname(){return $this->name;}
        public function getcomment(){return $this->comment;}
    }
?>