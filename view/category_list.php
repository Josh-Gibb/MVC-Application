<?php include('view/header.php') ?>
<section>
    <h2>Category List</h2>
    <div class="titleCategory">
        <label class="categoryTitle">Name</label>
    </div>
    <?php if ($results) { ?>
        <?php foreach ($results as $result) {
            $category_id = $result['categoryID'];
            $categoryName = $result['categoryName'];
            ?>
            <form name="categoryList" action="." method="POST">
                <input type="hidden" name="action" value="delete_category">
                <input type="hidden" name="category_id" value="<?= $category_id ?>">
                <div class="category">
                    <label class="columns">
                        <?= $categoryName ?>
                    </label>
                    <div class="button_delete">
                        <button class='delete'>Remove</button>
                    </div>
                </div>
            </form>
        <?php } ?>
    <?php } else { ?>
        <p>No results, add categories to the list</p>
    <?php } ?>
</section>
<section>
    <h2>Add category</h2>
    <form name="addCategory" action="." method="POST">
        <input type="hidden" name="action" value="add_category">
        <div class = "aCategory">
            <label>Name:</label>
            <input class = "textfields" type="text" name="categoryName" maxlength="50" placeholder="Course Name" required>
            <div>
                <button class="addButton">Add Category</button>
            </div>
        </div>
    </form>
</section>
<p><a href=".?action=">View To Do List</a></p>
<?php include('view/footer.php') ?>