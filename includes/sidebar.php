<?php
$aMan = $aPCat = $aCat = array();

// Manufacturers Code
if(isset($_REQUEST['man']) && is_array($_REQUEST['man'])){
    foreach($_REQUEST['man'] as $sKey => $sVal){
        if((int)$sVal != 0){
            $aMan[(int)$sVal] = (int)$sVal;
        }
    }
}

// Product Categories Code
if(isset($_REQUEST['p_cat']) && is_array($_REQUEST['p_cat'])){
    foreach($_REQUEST['p_cat'] as $sKey => $sVal){
        if((int)$sVal != 0){
            $aPCat[(int)$sVal] = (int)$sVal;
        }
    }
}

// Categories Code
if(isset($_REQUEST['cat']) && is_array($_REQUEST['cat'])){
    foreach($_REQUEST['cat'] as $sKey => $sVal){
        if((int)$sVal != 0){
            $aCat[(int)$sVal] = (int)$sVal;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Filter</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Panel Styling */
        .panel { border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px; }
        .panel-heading { position: relative; }
        .panel-heading h3.panel-title { font-size: 16px; font-weight: bold; display: inline-block; padding-right: 10px; }
        .pull-right { position: absolute; top: 15px; right: 15px; cursor: pointer; }
        .panel-body { padding: 10px; }
        .panel-body .input-group { margin-bottom: 10px; }
        .input-group input { width: 100%; }
        .input-group-addon { background-color: #f8f8f8; cursor: pointer; }
        .checkbox label { font-size: 14px; margin-left: 10px; }
        .checkbox input[type="checkbox"] { margin-right: 10px; }
        .category-menu li { padding: 8px; cursor: pointer; }
        .category-menu li:hover { background-color: #f1f1f1; }
        .panel-collapse { max-height: 0; overflow: hidden; transition: max-height 0.5s ease-out; }
        .panel-body.scroll-menu { display: flex; flex-direction: column; overflow-y: auto; max-height: 300px; }
        @media screen and (max-width: 768px) { .panel-body.scroll-menu { max-height: none; } }
        .show-panel { max-height: 500px; }
    </style>
</head>
<body>

<!-- Manufacturers Panel -->
<div class="panel panel-default sidebar-menu">
    <div class="panel-heading">
        <h3 class="panel-title">Manufacturers</h3>
        <span class="pull-right" onclick="togglePanel('man-panel')">
            <i class="fa fa-chevron-up" id="man-panel-toggle"></i>
        </span>
    </div>
    <div id="man-panel" class="panel-collapse show-panel">
        <div class="panel-body">
            <div class="input-group">
                <input type="text" class="form-control" id="filter-manufacturer" placeholder="Filter Manufacturers">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
            </div>
        </div>
        <div class="panel-body scroll-menu">
            <ul class="nav nav-pills nav-stacked category-menu" id="manufacturer-list">
                <?php
                $get_manfacturer = "SELECT * FROM manufacturers";
                $run_manfacturer = mysqli_query($con, $get_manfacturer);

                if (mysqli_num_rows($run_manfacturer) > 0) {
                    while($row_manfacturer = mysqli_fetch_array($run_manfacturer)){
                        $manufacturer_id = $row_manfacturer['manufacturer_id'];
                        $manufacturer_title = $row_manfacturer['manufacturer_title'];
                        $manufacturer_image = $row_manfacturer['manufacturer_image'];
                        $manufacturer_image = $manufacturer_image ? "<img src='admin_area/other_images/$manufacturer_image' width='20px'>&nbsp;" : "";
                        
                        echo "
                        <li class='checkbox checkbox-primary'>
                            <label>
                                <input " . (isset($aMan[$manufacturer_id]) ? "checked='checked'" : "") . " type='checkbox' value='$manufacturer_id' name='manufacturer' class='get_manufacturer'>
                                <span>$manufacturer_image$manufacturer_title</span>
                            </label>
                        </li>";
                    }
                } else {
                    echo "<li>No manufacturers available.</li>";
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<!-- Categories Panel -->
<div class="panel panel-default sidebar-menu">
    <div class="panel-heading">
        <h3 class="panel-title">Categories</h3>
        <span class="pull-right" onclick="togglePanel('cat-panel')">
            <i class="fa fa-chevron-up" id="cat-panel-toggle"></i>
        </span>
    </div>
    <div id="cat-panel" class="panel-collapse show-panel">
        <div class="panel-body">
            <div class="input-group">
                <input type="text" class="form-control" id="filter-category" placeholder="Filter Categories">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
            </div>
        </div>
        <div class="panel-body scroll-menu">
            <ul class="nav nav-pills nav-stacked category-menu" id="category-list">
                <?php
                $get_cat = "SELECT * FROM categories";
                $run_cat = mysqli_query($con, $get_cat);

                while($row_cat = mysqli_fetch_array($run_cat)){
                    $cat_id = $row_cat['cat_id'];
                    $cat_title = $row_cat['cat_title'];
                    $cat_image = $row_cat['cat_image'];
                    $cat_image = $cat_image ? "<img src='admin_area/other_images/$cat_image' width='20'>&nbsp;" : "";

                    echo "
                    <li class='checkbox checkbox-primary'>
                        <label>
                            <input " . (isset($aCat[$cat_id]) ? "checked='checked'" : "") . " type='checkbox' value='$cat_id' name='cat' class='get_cat'>
                            <span>$cat_image$cat_title</span>
                        </label>
                    </li>";
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<!-- Script -->
<script>
$(document).ready(function() {
    // Checkbox filter action
    $('.get_manufacturer, .get_cat').on('change', function() {
        filterProducts();
    });

    function filterProducts() {
        var man = [];
        var cat = [];

        $('.get_manufacturer:checked').each(function() {
            man.push($(this).val());
        });
        $('.get_cat:checked').each(function() {
            cat.push($(this).val());
        });

        var url = window.location.pathname + '?';
        if (man.length > 0) url += 'man[]=' + man.join('&man[]=') + '&';
        if (cat.length > 0) url += 'cat[]=' + cat.join('&cat[]=') + '&';

        window.location.href = url.slice(0, -1);
    }

    // Search filter Manufacturers
    $('#filter-manufacturer').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#manufacturer-list li').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Search filter Categories
    $('#filter-category').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#category-list li').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

// Toggle panel
function togglePanel(panelId) {
    const panel = $('#' + panelId);
    const icon = $('#' + panelId + '-toggle');

    if (panel.hasClass('show-panel')) {
        panel.removeClass('show-panel');
        icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
    } else {
        panel.addClass('show-panel');
        icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
    }
}
</script>

</body>
</html>
