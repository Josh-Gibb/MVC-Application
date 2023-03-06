<?php include('view/header.php'); ?>
<section>
    <div class="select_item">
        <form action="." method "GET">
            <input type="hidden" name="action" value="">
            <label>Category:</label>
            <select name="category_id" class="options" required>
                <option value="0">View All</option>
                <?php foreach ($categories as $category): ?>
                    <?php if ($cat_id == $category['categoryID']) { ?>
                        <option value="<?= $category['categoryID'] ?>" selected>
                        <?php } else { ?>
                        <option value="<?= $category['categoryID'] ?>">
                        <?php } ?>
                        <?= $category['categoryName']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button class="select_button">Go</button>
        </form>
    </div>
    <div class="border">
        <label class="titles">Title</label>
        <label class="titles">Description</label>
        <label class="titles">Category</label>
        <label class="titles"></label>
    </div>
    <?php if ($results) {
        foreach ($results as $result) {
            $id = $result['ItemNum'];
            $categoryName = $result['categoryName'];
            $title = $result['Title'];
            $description = $result['Description'];
            ?>
            <form action="." method="POST">
                <input type="hidden" name="action" value="delete_item">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="item">
                    <label class="list">
                        <?= $title ?>
                    </label>
                    <label class="list">
                        <?= $description ?>
                    </label>
                    <label class="list">
                        <?= $categoryName ?>
                    </label>
                    <div class="list">
                        <button class="delete">Delete</button>
                    </div>
                </div>
            </form>
        <?php }
    } else { ?>
        <p>No Results, add items to the list</p>
    <?php } ?>
</section>
<p><a href=".?action=display_add_page">Click here</a> to add a new item to the list</p>
<p><a href=".?action=list_categories">View/Edit Categories</a></p>
<?php include('footer.php'); ?>