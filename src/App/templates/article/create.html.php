<h1>Article Form</h1>
<form method="post">
    <div>
        <label for="category"></label>
        <select name="category" id="category">
            <option value="">--Category--</option>
            <?php
            use App\Domain\Article\Category;
            /** @var iterable<Category> $categories */
            foreach($categories as $category){
                echo '<option value="'.$category->getId()->getId().'">'.$category->getName().'</option>';
            }
            ?>
        </select>
    </div>
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title"/>
    </div>
    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content"></textarea>
    </div>
    <button type="submit">Submit</button>
</form>