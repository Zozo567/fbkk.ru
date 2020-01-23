
<div class="custom_container">
    <div class="row news-block body-block body-block-news">
        <?php
            $return = Contact::getContact(); 
            echo $News = $return['content']; ?>
    </div>
</div>