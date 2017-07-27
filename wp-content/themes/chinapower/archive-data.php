<?php
/**
 * Archive: Data
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package chinapower
 */

get_header(); ?>

	<!-- Data Repo -->
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header content-wrapper">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_top_content();
				?>
			</header><!-- .page-header -->

			<div class="data-container">
				<div class="content-wrapper">
					<div class="filterControls row middle-md">
						<div class="filter-sort col-xs-12 col-md-4">
							<span class="sortTitle">Sort By</span>
							<button class="btn btn-gray btn-red-hover tableSort" data-sortCol="0" aria-label="Sort by Title">Title</button>
							<button class="btn btn-gray btn-red-hover tableSort" data-sortCol="1" aria-label="Sort by Topic">Topic</button>
							<button class="btn btn-gray btn-red-hover tableSort" data-sortCol="2" aria-label="Sort by Source">Source</button>
						</div>
						<div class="filter-view col-xs-12 col-md-3">
							<span class="sortTitle">View</span> <i class="icon icon-align-justify"></i> <i class="icon icon-th active"></i>
						</div>
						<div class="filter-search col-xs-12 col-md-5">
							<label for="dataSearch" class="sortTitle">Filter <i class="icon icon-search"></i></label>
							<input id="dataSearch" name="dataSearch" type="text" placeholder="Start typing to filter results" />
						</div>
					</div>

					<table id="dataRepo">
						<thead>
							<tr>
								<th>Title</th>
								<th>Topic</th>
								<th>Source</th>
								<th>View</th>
							</tr>
						</thead>
						<tbody>
						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content-data' );

						endwhile;

		else :

						get_template_part( 'template-parts/content', 'none' );

		endif; ?>
						</tbody>
					</table>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
wp_enqueue_script('chinapower-datatables', '//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js', array(), '20170727', true );
wp_enqueue_script('chinapower-datarepo', get_template_directory_uri() . '/js/data-repo.js', array(), '20170727', true );
get_footer();
