
<?php  
  class Post extends Base {
    function __construct($pdo) {
      $this->pdo = $pdo;
    }
 
    public function posts($user_id) {
      $stmt = $this->pdo->prepare("SELECT * FROM post, users WHERE (postby = user_id AND user_id = :user_id) OR (postby = user_id AND postby IN(SELECT reciever FROM follow WHERE sender = :user_id)) ORDER BY postid DESC");
 
      $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
      $stmt->execute();
      $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
 
      foreach ($posts as $post) {
        echo '<div class="all-post">
            <div class="t-show-wrap">  
             <div class="t-show-inner">
              <div class="t-show-popup">
                <div class="t-show-head">
                  <div class="t-show-img">
                    <img src="'. $post->profileImage .'"/>
                  </div>
                  <div class="t-s-head-content">
                    <div class="t-h-c-name">
                      <span><a href="profile.php?username='. $post->username .'">'. $post->fullname .'</a></span>
                      <span>@'. $post->username .'</span>
                      <span>'. $post->postedon .'</span>
                    </div>
                    <div class="t-h-c-dis">
                      '. $post->status .'
                    </div>
                  </div>
                </div>
              </div>
              <div class="t-show-footer">
                <div class="t-s-f-right">
                  <ul> 
                    <li><button><a href="#"><i class="fa fa-repost" aria-hidden="true"></i></a></button></li>
                    <li><button><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></button></li>
                      <li>
                      <a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            </div>
          </div>';
      }
    }
 
    
    
    public function countPosts($user_id) {
      $stmt = $this->pdo->prepare("SELECT COUNT(postid) AS totalPosts FROM post where postby = :user_id");
      $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
      $stmt->execute();
      $count = $stmt->fetch(PDO::FETCH_OBJ);
      echo $count->totalPosts;
    }

    
    
    public function getUserPosts($user_id) {
      $stmt = $this->pdo->prepare("SELECT * FROM post, users where postby = user_id AND user_id = :user_id");
      $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
      $stmt->execute();
   
      return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  }
?>
