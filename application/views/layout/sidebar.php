<?php
    $current_url_requested = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
    if(isMobile()){
        $side_bar_status = "";
    } else {
        if(isset($_COOKIE["minion_side_bar_display"])){
            $side_bar_status = $_COOKIE["minion_side_bar_display"];
            if($side_bar_status != "collapsed"){
                $side_bar_status = "";
            }
        } else {
            $side_bar_status = "";
        }    
    }    
?>

<nav id="sidebar" class="sidebar js-sidebar <?php echo $side_bar_status;?>">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="<?php echo BASE_URL;?>">
            <img src = "<?php echo PORTAL_ASSET_URL;?>img/victr_logo.png" style = "width:100%;">
        </a>
        <ul class="sidebar-nav">
            <?php	          
                $page_access = page_access;
                foreach($page_access as $page){
                    $active = "";
                    if($current_url_requested == BASE_URL. $page['url']){
                        $active = "active";
                    }
                    echo '<li class="sidebar-item ' . $active .'">
                        <a class="sidebar-link" href="' . BASE_URL. $page['url'] . '">
                            <i class="align-middle" data-feather="' . $page['icon'] . '"></i> <span class="align-middle">' . $page['name'] . '</span>
                        </a>
                    </li>';
                }
            ?>
        </ul>
    </div>
</nav>
