<?php
/*
 * Template name: selling_points
 */

get_header(); ?>

	<div class="buy-without-shipping-costs alert alert-danger" role="alert">
		<div class="row">
			<div class="col-md-9">
				<h4><strong>RECIBILA EN TU CASA SIN PAGAR GASTOS DE ENVÍO!!</strong></h4>
				<strong>Sí, leíste bien:</strong> te enviamos la revista a tu casa y no te cobramos el envío. No importa si vivís en Tierra del Fuego o en Salta. <strong>Mientras sea en territorio argentino, no pagás envío. Y NO HACE FALTA TENER TARJETA DE CRÉDITO</strong>.
			</div>
			<div class="col-md-3 buttons">
				<button type="button" class="btn btn-warning" data-dismiss="alert">Comprar número actual</button>
				<button type="button" class="btn btn-warning" data-dismiss="alert">Comprar atrasados</button>
			</div>
		</div>
	</div>

	<div class="row" ng-controller="SellingPointsController">
		
		<div class="col-md-6">
			<div class="panel panel-default header">
				<div class="panel-heading"><h4>Capital y GBA</h4></div>
				<div class="list-group">
					<div class="list-group-item" ng-repeat="point in capitalPoints">
					  <div class="badge">{{ point.zone }}</div>
					  <h4 class="list-group-item-heading">
					  	<span class="glyphicon glyphicon-fire"></span>
					  	{{ point.name }}
					  </h4>
					  <p class="list-group-item-text">{{ point.address }}</p>
					</div>
		    </div>
	    </div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-default header">
				<div class="panel-heading"><h4>Interior</h4></div>
				<div class="list-group">
					<div class="list-group-item" ng-repeat="point in interiorPoints">
					  <div class="badge">{{ point.zone }}</div>
					  <h4 class="list-group-item-heading">
					  	<span class="glyphicon glyphicon-fire"></span>
					  	{{ point.name }}
					  </h4>
					  <p class="list-group-item-text">{{ point.address }}</p>
					</div>
		    </div>
	    </div>
		</div>

	</div>

<?php get_footer(); ?>