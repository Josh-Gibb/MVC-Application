<?php
require('model/database.php');
require('model/items_db.php');
require('model/category_db.php');

$itemNum = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

//Post Data
$job = filter_input(INPUT_POST, "title", FILTER_UNSAFE_RAW);
$details = filter_input(INPUT_POST, "description", FILTER_UNSAFE_RAW);

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
if(!$action){
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if(!$action){
        $action = "";
    }
}


$cat_id = filter_input(INPUT_POST, "category_id", FILTER_VALIDATE_INT);
if (!$cat_id) {
    $cat_id = filter_input(INPUT_GET, "category_id", FILTER_VALIDATE_INT);
}

$name = filter_input(INPUT_POST, "categoryName", FILTER_UNSAFE_RAW);
switch ($action) {
    case 'list_categories':
        $results = get_categories();
        include('view/category_list.php');
        break;
    case 'add_category':
        add_category($name);
        header("Location: .?action=list_categories");
        break;
    case 'delete_category':
        if($cat_id){
            try{
                delete_category($cat_id);
                header("Location: ?.action=list_categories");
            } catch (PDOException $e){
                $error = "You cannot delete the category as it is linked to an item in the toDo List";
                include('view/error.php');
                exit();
            }
            header("Location: .?action=list_categories");
        }
        break;
    case 'add_item':
        if($job && $details){
            insert_item($job, $details, $cat_id);
            header("Location: .?category_id=$cat_id");
        } else{
            $error = "Invalid data entered, please check all fields";
            include('view/error.php');
            exit();
        }
        break;
    case 'delete_item':
        if($itemNum){
            delete_item($itemNum);
            header("Location: ?.category_id=$cat_id");
        }
        else{
            $error = "Missing or incorrect assignment id.";
            include('view/error.php');
            exit();
        }
        break;
    case 'display_add_page':
        $categories = get_categories();    
        include('view/add_item.php');
        break;    
    default:
        $category_name = get_category_name($cat_id);
        $categories = get_categories();    
        $results = display_items($cat_id);
        include('view/item_list.php');
}
?>