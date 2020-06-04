<?php
    /**
     * STATUS = Under Construction
     *
     * @author Sabian Finogwar
     * @since 1.0.0
     */
    if ( ! defined( 'ABSPATH' ) ) {
    	exit; // Exit if accessed directly.
    }
    
    get_header();
    
    if ( astra_page_layout() == 'left-sidebar' ) :
    	get_sidebar();
    endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        type="text/css"
        href="/wp-content/themes/astra-child/style.css">
    
    <!-- FontAwesome -->
	<link
	    rel="stylesheet"
	    href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
	    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
	    crossorigin="anonymous">
    
    <!-- JSON -->
    <!--
    <script src="/wp-content/themes/astra-child/inc/resources/json/json2.js"></script>
    -->
    
    <!-- jQuery -->
    <script
	  src="https://code.jquery.com/jquery-3.5.1.min.js"
	  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	  crossorigin="anonymous"></script>
    <script src="/wp-content/themes/astra-child/inc/js/script.js"></script>
    
	<!-- DataTables -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.21/af-2.3.5/b-1.6.2/b-colvis-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/fh-3.1.7/r-2.2.4/sc-2.0.2/sp-1.1.0/sl-1.3.1/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.21/af-2.3.5/b-1.6.2/b-colvis-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/fh-3.1.7/r-2.2.4/sc-2.0.2/sp-1.1.0/sl-1.3.1/datatables.min.js"></script>
    
    <!-- Data Visualization: D3 v5.16.0 -->
    <script src="/wp-content/themes/astra-child/inc/resources/d3/d3.min.js"></script>
</head>
<body>
	<div id="primary" <?php astra_primary_class(); ?>>
        <?php astra_primary_content_top(); ?>
        <div class="title-image">
            <h1 class="center-stb title-image-txt"><?php echo get_the_title(get_post(get_the_ID())) ?></h1>
        </div>
        <div class="theme1" id="intro">
            <h2>Work In-Progress!</h2>
            <p>
        We're currently developing this functionality. Try it out! We'll have the rest of it ready, soon, so make sure to check back later!
            </p>
            <p>
                Coming soon:
                <ul>
                <li><i class="fas fa-check" style="color:green;"></i> Search and sort by date, type, count points</li>
                    <li><i class="fas fa-check" style="color:green;"></i> Update & add new entries</li>
                    <li>Visualizations</li>
                </ul>
            </p>
        </div><!-- #intro -->
        <div class="flex-container theme2" id="table-section">
            <div class="flex-child" id="table-display">
                <h2 class="center">Example Data Table</h2><br>
                <p class="center"><i>(Double-click to edit values)</i></p><br>
                <?php echo db_display(); ?>
            </div><!-- #table-display -->
            <div class="flex-child center" id="table-form-fields">
                <h4 id="addRow">Add New Entry</h4><br>
                <p class="center"><i>(Make sure to fill out all fields)</i></p><br>
                <form id="addData">
                    <label id="lb_date">Date</label><br>
                    <input type="date" id="date_input"><br>
                    <br>
                    <label id="lb_workout">Workout</label><br>
                    <input type="text" id="workout_input"><br>
                    <br>
                    <label id="lb_count">Count</label><br>
                    <input type="number" id="count_input"><br>
                    <br>
                    <label id="lb_points">Points</label><br>
                    <input type="number" id="points_input"><br>
                    <br>
                    <button type="button" id="addData_button">Add Submission</button>
                </form>
            </div><!-- #table-form-fields -->
    	</div><!-- #table-section -->
    	<div class="theme1" id="viz-section">
    	    <h2 class="center">Data Visualizations</h2><br>
    	    <p class="center">Coming soon...</p>
            <div class="flex-container center-sb" id="viz-charts">
                <div class="flex-child center" id="viz-bar">
                    <h3>Bar Chart</h3><br>
    	            <label for="sort-type">Sort Type:</label><br>
                    <select id="sort-type" name="sort-type">
                      <option value="0">None      </option>
                      <option value="1">Asending  </option>
                      <option value="2">Descending</option>
                    </select>
                    <div id="viz-bar-chart"><p class="center-stb">Under construction...</p></div>
                </div>
                <div class="flex-child center" id="viz-line">
                    <h3>Line Graph</h3><br>
                    <div id="viz-line-graph" style="margin-top: 60px;"><p class="center-stb">Under construction...</p></div>
                </div>
            </div><!-- #viz-charts --->
    	</div><!-- #viz-section --->
<?php
        the_content();
        astra_primary_content_bottom();
?>  
    </div><!-- #primary -->
<?php
    if ( astra_page_layout() == 'right-sidebar' )
    {
        get_sidebar();
    }
    get_footer();
?>
</body>
</html>
