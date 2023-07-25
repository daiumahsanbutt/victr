<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="VICTR | Skill Assessment">
    <meta name="author" content="Daium Butt">
    <meta name="keywords"
        content="skill, assessment, victr, daium, butt">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link rel="shortcut icon" href="<?php echo PORTAL_ASSET_URL;?>img/favicon.ico" />
    <title><?php echo $pageTitle;?> | VICTR</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&amp;display=swap" rel="stylesheet">
    <script src="<?php echo PORTAL_ASSET_URL;?>js/jquery.js"></script>
    <script src="<?php echo PORTAL_ASSET_URL;?>js/moment.js"></script>
    <script src="<?php echo PORTAL_ASSET_URL;?>js/DataTables/datatables.min.js"></script>
    <script src="<?php echo PORTAL_ASSET_URL;?>js/dateRangePicker.js"></script>
    <script src="<?php echo PORTAL_ASSET_URL;?>js/bootstrap-slider.min.js"></script>

    <link class="js-stylesheet" href="<?php echo PORTAL_ASSET_URL;?>css/light.css" rel="stylesheet">    
    <link class="js-stylesheet" href="<?php echo PORTAL_ASSET_URL;?>css/dateRangePicker.css" rel="stylesheet">
    <link class="js-stylesheet" href="<?php echo PORTAL_ASSET_URL;?>css/leaflet.css" rel="stylesheet">    
    <link class="js-stylesheet" href="<?php echo PORTAL_ASSET_URL;?>css/leaflet_locate.css" rel="stylesheet">
    <link class="js-stylesheet" href="<?php echo PORTAL_ASSET_URL;?>css/bootstrap-slider.min.css" rel="stylesheet">
    <link class="js-stylesheet" href="<?php echo PORTAL_ASSET_URL;?>js/DataTables/datatables.min.css" rel="stylesheet">   
    
    
    <style>
    body {
        opacity: 0;
    }
    </style>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo GOOGLE_TAG_MANAGER_ID;?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo GOOGLE_TAG_MANAGER_ID;?>');
    </script>
</head>
<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">
        
        <?php echo $sidebar;?>

        <div class="main">
            <?php echo $header;?>
            <main class="content" style = "position:relative">
                <div class="loader_overlay"><span class="loader_webpage"></span></div>
                <?php echo $body;?>
            </main>

            <?php echo $footer;?>
        </div>
    </div>

    <script src="<?php echo PORTAL_ASSET_URL;?>js/app.js"></script>
    <script src="<?php echo PORTAL_ASSET_URL;?>js/swal.js"></script>
    <script src="<?php echo PORTAL_ASSET_URL;?>js/minionBasics.js"></script>
    <script src="<?php echo PORTAL_ASSET_URL;?>js/leaflet.js"></script>
    <script src="<?php echo PORTAL_ASSET_URL;?>js/leaflet_locate.js"></script>
    <script src="<?php echo PORTAL_ASSET_URL;?>js/jquery_validate.min.js"></script>
    <script src="<?php echo PORTAL_ASSET_URL;?>js/printThis.js"></script>
    <script src="<?php echo PORTAL_ASSET_URL;?>js/jquery_cookie.min.js"></script>
    <script src="<?php echo PORTAL_ASSET_URL;?>js/weekSelect.js"></script>
    <script src="<?php echo PORTAL_ASSET_URL;?>js/debounce.js"></script>
    <script src="<?php echo PORTAL_ASSET_URL;?>js/sortable.min.js"></script>
    <script src="<?php echo PORTAL_ASSET_URL;?>js/chroma.js"></script>   
    <script src="<?php echo PORTAL_ASSET_URL;?>js/webcam.js"></script>   
    <script src="<?php echo PORTAL_ASSET_URL;?>js/xlsx.full.min.js"></script>   
    <script src="<?php echo PORTAL_ASSET_URL;?>js/jsPDF.js"></script>    
    <script src="<?php echo PORTAL_ASSET_URL;?>js/jsdpfAutoTable.js"></script>   

    <script>
        var route_control_api = "<?php echo BASE_URL;?>";
        var portal_asset_url = "<?php echo PORTAL_ASSET_URL;?>";
        window.jsPDF = window.jspdf.jsPDF
    </script>
    <?php
        if(isset($script_file) && $script_file != ""){
            echo '<script src="' . PAGE_SCRIPTS_URL . $script_file . '.js?v=' . SCRIPTS_VERSION . '"></script>';
        }
    ?>
    <script>
        $(document).on("click", ".js-sidebar-toggle", function(){
            if(Cookies.get('minion_side_bar_display') == "collapsed"){
                Cookies.set('minion_side_bar_display', "open", { expires: 1});
            } else {
                Cookies.set('minion_side_bar_display', "collapsed", { expires: 1});
            }
        });
        
        $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
            if (originalOptions.data instanceof FormData) { 
                originalOptions.data.append("<?= $this->security->get_csrf_token_name(); ?>", "<?= $this->security->get_csrf_hash(); ?>"); 
            }
        });
        $.ajaxSetup({
			data: {
				<?= $this->security->get_csrf_token_name(); ?>: "<?= $this->security->get_csrf_hash(); ?>",
			},
            beforeSend: function(jqXHR, settings) {
                if('webpage_loader' in settings && settings.webpage_loader == false){

                } else {
                    loader_start();
                }
            },
            complete: function() {
                loader_end();
            },
            error: function(xhr) {
                loader_end();
                popupNotification("An unknown error occured while processing your request. Please try again or contact support", 'error');
                console.log(xhr);
            },
		});
        $('body').on('click', function (e) {
            $('[data-bs-toggle=popover]').each(function () {
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    $(this).popover('hide');
                }
            });
        });
    </script>  
</body>
</html>

