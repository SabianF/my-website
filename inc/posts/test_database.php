T<?php
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
    
    <!-- Local Resources -->
    <link
        rel="stylesheet"
        type="text/css"
        href="/wp-content/themes/astra-child/style.css">
	<link
	    rel="stylesheet"
	    href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
	    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
	    crossorigin="anonymous">
    
    <!-- jQuery -->
    <script
	  src="https://code.jquery.com/jquery-3.5.1.min.js"
	  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	  crossorigin="anonymous"></script>
    <script src="/wp-content/themes/astra-child/inc/js/script.js"></script>

	<!-- DataTables -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.21/af-2.3.5/b-1.6.2/b-colvis-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/fh-3.1.7/r-2.2.4/sc-2.0.2/sp-1.1.0/sl-1.3.1/datatables.min.css"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.21/af-2.3.5/b-1.6.2/b-colvis-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/fh-3.1.7/r-2.2.4/sc-2.0.2/sp-1.1.0/sl-1.3.1/datatables.min.js"></script>
</head>
<body>
	<div id="primary" <?php astra_primary_class(); ?>>
<?php
        astra_primary_content_top();
?>
        <h1 class="center" style="padding-top:50px;"><?php get_the_title(get_post    (get_the_ID())) ?></h1>
        
        <div id="primary" class="content-area primary" >
            <div id="const" style="margin-left:auto;margin-right:auto;margin-bottom:50px;">
                <h2 class="title-header" style="text-shadow: 2px 2px 10px #CCC;text-align:center;">Under Construction!</h2>
                <p class="center" style="padding:10px;">
                    We're still working on this functionality but don't worry, we'll have the rest of it ready, soon! Check back later!
                </p>
            </div><!-- #const -->
            <div class="columns-2" style="margin-bottom:100px;">
                <div id="table-forms">
                    <h2 class="center">Testing Area</h2>
                    <p class="center">Currently testing forms to search within database.</p>
                    <div id="todos">
                        Coming soon:
                        <ul>
                            <li>Search and sort by date, type, count points</li>
                            <li>Update & add new entries</li>
                            <li>Visualizations</li>
                        </ul>
                    </div><!-- #todos -->
                </div>
                <div class="center" id="table-display" style="padding-left:10px;padding-right:10px;">
                    <?php db_display(); ?>
                </div><!-- #table-display -->
        	</div><!-- #columns-2 -->
<?php
            the_content();
	        astra_primary_content_bottom();
?>  
	    </div><!-- #primary -->
    </div><!-- other #primary -->
<?php
    if ( astra_page_layout() == 'right-sidebar' )
    {
        get_sidebar();
    }
    get_footer();
?>
</body>
</html>
