<?php
    function display_items($category_id){
        global $db;
        if($category_id){
            $query = 'SELECT t.ItemNum, t.Title, t.Description, c.categoryName
                FROM todoitems t LEFT JOIN categories c ON t.categoryID = c.categoryID
                WHERE t.categoryID = :category_id ORDER BY t.categoryID';
                $statement = $db->prepare($query);
                $statement->bindValue(':category_id', $category_id);

        } else {
            $query = 'SELECT t.ItemNum, t.Title, t.Description, c.categoryName
                FROM todoitems t LEFT JOIN categories c ON t.categoryID = c.categoryID
                ORDER BY t.categoryID';
            $statement = $db->prepare($query);
        }
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;
    }

    function insert_item($title, $description, $category_id){
        global $db;
        $query = 'INSERT INTO todoitems(categoryID, Title, Description)
                    VALUES(:category_id, :title, :description)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(":title", $title);
        $statement->bindValue(":description", $description);
        if($statement->execute()){
            $count = $statement->rowCount();
        }
        $statement->closeCursor();
        return $count;
    }
    
    function delete_item($id){
        global $db;
        $count = 0;
        $query = 'DELETE FROM todoitems
                    WHERE ItemNum = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        if($statement->execute()){
            $count = $statement->rowCount();
        }
        $statement->closeCursor();
        return $count;
    }
?>