
<div class="container">
    <div class="row body-block body-block-news">
    <?php
        $return = Guidance::getGuidance(); 
        echo $News = $return['content']; ?>
    </div>
</div>