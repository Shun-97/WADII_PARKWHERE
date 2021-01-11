<?php

require_once 'common.php';

class AccountDAO
{

    public function getHashedPassword($username)
    {

        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "SELECT
                    hashed_password
                FROM
                    users
                WHERE
                    username = :username
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Step 3 - Execute SQL
        $hashed_password = null;

        if ($stmt->execute()) {

            // Step 4 - Retrieve Query Results
            if ($row = $stmt->fetch()) {
                $hashed_password = $row['hashed_password'];
            }
        }

        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $hashed_password;
    }

    public function register($username, $hashed_password, $email)
    {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();
        $cdate = date("Y-m-d");
        $sql = "INSERT IGNORE INTO users(email, username, hashed_password, join_date) VALUES (
                   :email, :username, :hashed_password, :cdate
                )
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(':cdate', $cdate, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $isOk = true;
        } else {
            $isOk = false;
        }
        $stmt = null;
        $pdo = null;

        return $isOk;
    }

    public function retrievePic($username)
    {

        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "SELECT
                    images
                FROM
                    users
                WHERE
                    username = :username
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Step 3 - Execute SQL
        $img = null;

        if ($stmt->execute()) {

            // Step 4 - Retrieve Query Results
            if ($row = $stmt->fetch()) {
                $img = $row['images'];
            }
        }

        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $img;
    }

    public function retrieveBio($username)
    {

        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "SELECT
                    bio
                FROM
                    users
                WHERE
                    username = :username
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Step 3 - Execute SQL
        $bio = null;

        if ($stmt->execute()) {

            // Step 4 - Retrieve Query Results
            if ($row = $stmt->fetch()) {
                $bio = $row['bio'];
            }
        }

        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $bio;
    }

    public function retrieveJoinDate($username)
    {
        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "SELECT
                    join_date
                FROM
                    users
                WHERE
                    username = :username
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Step 3 - Execute SQL
        $join_date = null;

        if ($stmt->execute()) {

            // Step 4 - Retrieve Query Results
            if ($row = $stmt->fetch()) {
                $join_date = $row['join_date'];
            }
        }

        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $join_date;
    }

    public function retrieveNoOfPosts($username)
    {
        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "SELECT
                    count(username) as posts
                FROM
                    posts
                WHERE
                    username = :username
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Step 3 - Execute SQL
        $noOfPosts = null;

        if ($stmt->execute()) {

            // Step 4 - Retrieve Query Results
            if ($row = $stmt->fetch()) {
                $noOfPosts = $row['posts'];
            }
        }

        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $noOfPosts;
    }

    public function updatePic($images,$username)
    {

        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "UPDATE
                    users
                set
                    images = :images
                WHERE
                    username = :username
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':images', $images, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Step 3 - Execute SQL
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $isOk = true;
        } else {
            $isOk = false;
        }
        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $isOk;
    }

    public function updateBio($bio, $username)
    {
        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "UPDATE
                    users
                set
                    bio = :bio
                WHERE
                    username = :username
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Step 3 - Execute SQL
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $isOk = true;
        } else {
            $isOk = false;
        }
        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $isOk;
    }

    public function insertCP($carparkid, $carparkname, $sat_rate, $wkdy_rate, $lat, $lng)
    {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();
        $sql = "INSERT IGNORE INTO carparkinfo VALUES (
                :carparkid, :carparkname,  :sat_rate, :wkdy_rate, :lat, :lng
            )
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':carparkid', $carparkid, PDO::PARAM_STR);
        $stmt->bindParam(':carparkname', $carparkname, PDO::PARAM_STR);
        $stmt->bindParam(':sat_rate', $sat_rate, PDO::PARAM_STR);
        $stmt->bindParam(':wkdy_rate', $wkdy_rate, PDO::PARAM_STR);
        $stmt->bindParam(':lat', $lat, PDO::PARAM_STR);
        $stmt->bindParam(':lng', $lng, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $isOk = true;
        } else {
            $isOk = false;
        }
        $stmt = null;
        $pdo = null;

        return $isOk;
    }

    public function retrieveCP()
    {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();
        $sql = "SELECT * FROM carparkinfo";
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $carpark_list = [];
        while($row = $stmt->fetch()){
            $carpark = new Carpark(
                $row['carparkid'],
                $row['carparkname'],
                $row['sat_rate'],
                $row['wkdy_rate'],
                $row['lat'],
                $row['lng']
            );
            $carpark_list[] = $carpark;
        };
        $stmt = null;
        $pdo = null;
        return $carpark_list;
    }

    public function getCP($cpname)
    {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();
        $sql = "SELECT * FROM carparkinfo WHERE carparkname = :carparkname";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':carparkname', $cpname, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        while($row = $stmt->fetch()){
            $carpark = new Carpark(
                $row['carparkid'],
                $row['carparkname'],
                $row['sat_rate'],
                $row['wkdy_rate'],
                $row['lat'],
                $row['lng']
            );
        };
        $stmt = null;
        $pdo = null;
        return $carpark;
    }

    public function getmePost($cpname)
    {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();
        $sql = "SELECT * FROM posts WHERE carparkname = :carparkname";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':carparkname', $cpname, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $posts = [];
        while($row = $stmt->fetch()){
            $post = new Post(
                $row['username'],
                $row['carparkname'],
                $row['info'],
                $row['stars']
            );
            $posts[] = $post;
        };
        $stmt = null;
        $pdo = null;
        return $posts;
    }

    public function insertPost($username, $carparkname, $info,$stars)
    {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();
        $cdate = date("Y-m-d");
        $sql = "INSERT IGNORE INTO posts VALUES (
                   :username, :carparkname, :info, :stars, :cdate
                )
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':carparkname', $carparkname, PDO::PARAM_STR);
        $stmt->bindParam(':info', $info, PDO::PARAM_STR);
        $stmt->bindParam(':stars', $stars, PDO::PARAM_STR);
        $stmt->bindParam(':cdate', $cdate, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $isOk = true;
        } else {
            $isOk = false;
        }
        $stmt = null;
        $pdo = null;

        return $isOk;
    }
    public function Schedule($id,$username,$location,$time)
    {

        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "INSERT INTO Schedule VALUES (:id,:username,:location,:time)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':location', $location, PDO::PARAM_STR);
        $stmt->bindParam(':time', $time, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Step 3 - Execute SQL
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $isOk = true;
        } else {
            $isOk = false;
        }
        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $isOk;
    }

    public function Comment($username) 
    {
        // Step 1 - Connect to Database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // Step 2 - Prepare SQL
        $sql = "SELECT
                    *
                FROM
                    posts
                WHERE
                    username = :username
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Step 3 - Execute SQL
        $stmt->execute();
        $comment_list = [];
        // Step 4 - Retrieve Query Results
        while($row = $stmt->fetch()){
            $comment = new comment(
                $row['username'],
                $row['carparkname'],
                $row['info'],
                $row['stars']
            );
            $comment_list[] = $comment;
         };

        // Step 5 - Clear Resources
        $stmt = null;
        $pdo = null;

        // Step 6 - Return
        return $comment_list;
    }
    public function retrieveAvgStars($carparkname) 
    { 
        // Step 1 - Connect to Database 
        $connMgr = new ConnectionManager(); 
        $pdo = $connMgr->getConnection(); 
 
        // Step 2 - Prepare SQL 
        $sql = "SELECT 
                    avg(stars) as star 
                FROM 
                    posts 
                WHERE 
                    carparkname = :carparkname 
        "; 
        $stmt = $pdo->prepare($sql); 
        $stmt->bindParam(':carparkname', $carparkname, PDO::PARAM_STR); 
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
 
        // Step 3 - Execute SQL 
        $avgStar = null; 
 
        if ($stmt->execute()) { 
 
            // Step 4 - Retrieve Query Results 
            if ($row = $stmt->fetch()) { 
                $avgStar = $row['star']; 
            } 
        } 
 
        // Step 5 - Clear Resources 
        $stmt = null; 
        $pdo = null; 
 
        // Step 6 - Return 
        return $avgStar; 
    }
    public function checkUser($username) { 
 
        // Step 1 - Connect to Database 
        $connMgr = new ConnectionManager(); 
        $pdo = $connMgr->getConnection(); 
 
        // Step 2 - Prepare SQL 
        $sql = "SELECT 
                    * 
                FROM 
                    users 
                WHERE 
                    username = :username 
        "; 
        $stmt = $pdo->prepare($sql); 
        $stmt->bindParam(':username', $username, PDO::PARAM_STR); 
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
         
        // Step 3 - Execute SQL 
        $exists = False; 
        if( $stmt->execute() ) { 
 
            // Step 4 - Retrieve Query Results 
            if( $stmt->rowCount() > 0 ) { 
                $exists = True; 
            } 
        } 
         
        // Step 5 - Clear Resources 
        $stmt = null; 
        $pdo = null; 
 
        // Step 6 - Return 
        return $exists; 
    }
}
