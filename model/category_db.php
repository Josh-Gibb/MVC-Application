<?php 
    function get_category_name($category_id){
        global $db;
        if(!$category_id){
            return 'All courses';
        }
        $query = 'SELECT* FROM categories WHERE categoryID = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $category = $statement->fetch();
        $statement->closeCursor();
        $category_name = $category['categoryName'];
        return $category_name;
    }

    function get_categories(){
        global $db;
        $query = 'SELECT* FROM categories';
        $statement = $db->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll();
        $statement->closeCursor();
        return $categories;
    }

    function delete_category($category_id){
        global $db;
        $query = 'DELETE FROM categories WHERE categoryID = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_category($category_name)
    {
        global $db;
        $query = 'INSERT INTO categories (categoryName)
                    VALUES (:category_name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_name', $category_name);
        $statement->execute();
        $statement->closeCursor();
    }
?>