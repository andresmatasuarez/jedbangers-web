<?php
/*
 * Template name: label
 */

get_header(); ?>

	<div class="container-fluid" ng-controller="LabelController">
		<div class="row">

			<ng-include
				ng-repeat="record in records"
				ng-init="record = record"
				src="model.recordTemplate">
			</ng-include>

		</div>
	</div>

<?php get_footer(); ?>