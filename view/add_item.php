<?php include('view/header.php') ?>
<section>
    <h2>Add item</h2>
    <form action="." method="POST">
        <input type="hidden" name="action" value="add_item">
        <div class = "aItem">
            <label>Category:</label>
            <select class = "selectCategory" name="category_id">
                <option value="">Please select</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['categoryID'] ?>">
                        <?= $category['categoryName']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label class = "aTitles">Title:</label>
            <input class = "textfields" type="text" name="title" maxLength="20" placeholder="Title" required>
            <label class = "aTitles">Description:</label>
            <input class = "textfields" type="text" name="description" maxlength="50" placeholder="Description" required>
            <div>
                <button class="addButton">Add Item</button>
            </div>
        </div>
    </form>
</section>
<p><a href=".?action=">View To Do List</a></p>
<?php include('view/footer.php') ?>