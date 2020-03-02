<?php
/*

 CREATE TABLE member(
    member_id INT(11) NOT NULL AUTO_INCREMENT,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    age INT(11) NOT NULL,
    gender VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    seeking VARCHAR(255) NOT NULL,
    bio VARCHAR(255) NOT NULL,
    premium tinyint(4) NOT NULL,
    interests VARCHAR(255) NULL,
    image VARCHAR(255) NULL,
    PRIMARY KEY (member_id)
    );
 CREATE TABLE interest(
    interest_id INT(11) NOT NULL AUTO_INCREMENT,
    interest VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL,
    PRIMARY KEY (interest_id)
    );
CREATE TABLE member_interest(
    member_interest_id INT NOT NULL AUTO_INCREMENT,
    member_id INT NOT NULL,
    interest_id INT NOT NULL,
    PRIMARY KEY (member_interest_id),
    FOREIGN KEY (member_id) REFERENCES member (member_id),
    FOREIGN KEY (interest_id) REFERENCES interest (interest_id)
    );

 */

require_once ("config-member.php");

class Database
{
    // PDO object
    private $_dbh;


    function __construct()
    {
        $this->connect();
    }

    function connect()
    {
        try{
            // create new pdo connection
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME,DB_PASSWORD);
            //     echo "Connected";
        }

        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    function insertMember($member)
    {
        //var_dump($member);

        //1. Define the query
        $sql = "INSERT INTO member (fname, lname, age,
                gender, phone, email, state, seeking, bio, premium,
                image)
                VALUES (:fname, :lname, :age, :gender, :phone, :email,
                :state, :seeking, :bio, :premium, '')";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':fname', $member->getFname());
        $statement->bindParam(':lname', $member->getLname());
        $statement->bindParam(':age', $member->getAge());
        $statement->bindParam(':gender', $member->getGender());
        $statement->bindParam(':phone', $member->getPhone());
        $statement->bindParam(':email', $member->getEmail());
        $statement->bindParam(':state', $member->getState());
        $statement->bindParam(':seeking', $member->getSeeking());
        $statement->bindParam(':bio', $member->getBio());
        $statement->bindParam(':premium', $member->getPremium());
//        $statement->bindParam(':image', $member->getPhone());

        //4. Execute the statement
        $statement->execute();

        //Get the key of the last inserted row
        $id = $this->_dbh->lastInsertId();
    }

    function getMembers()
    {
        //1. Define the query
        $sql = "SELECT * FROM member
                ORDER BY lname, fname";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the statement
        $statement->execute();

        //5. Get the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getMember($member_id)
    {
        //1. Define the query
        $sql = "SELECT * FROM member
                WHERE member.member_id = :member_id
                ORDER BY lname, fname";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the statement
        $statement->execute();

        //5. Get the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getInterests($member_id)
    {
        //come back to this.
        //1. Define the query
        $sql = "SELECT * FROM interest
                WHERE member.member_id = :member_id
                ORDER BY lname, fname";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the statement
        $statement->execute();

        //5. Get the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}