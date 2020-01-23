<!-- <div class="adap-header-federation">
    <span class="page-header-text-federation"><a href="/federation">Проекты</a></span>
    <div class="page-nav-federation">
        <?php
            //$return = Projects::getHeadProjects(); 
            //echo $ProjectsHead = $return['content']; 
        ?>
    </div>
</div> -->

<div class="container">
    <div class="row body-block body-block-news">
    <?php
        $return = Projects::getProjects(); 
        echo $Projects = $return['content']; ?>
    </div>
</div>
