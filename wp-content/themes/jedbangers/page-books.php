<?php
/*
 * Template name: books
 */

get_header(); ?>

	<div class="container-fluid" ng-controller="BooksController">
		<div class="row">

			<!-- Include gallery modal -->
			<ng-include src="model.galleryModalTemplate"></ng-include>

			<ng-include
				ng-repeat="book in books"
				ng-init="book = book"
				src="model.bookTemplate">
			</ng-include>

		</div>
	</div>

<?php get_footer(); ?>