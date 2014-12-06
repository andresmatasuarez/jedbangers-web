<?php
/*
 * Template name: issues
 */

  get_header();

?>

  <div class="row multicolumns" ng-controller="IssuesController">

    <div class="col-md-3 col-xs-6" style="text-align: center; display: inline-block; margin-bottom: 20px;" ng-repeat="m in issues">

      <a ng-if="!emptyIssue(m)" href="" ng-click="openIssueModal(m.number)">
        <img style="border-radius: 5px; width: 140px; height: 200px;" ng-src="{{ _.first(_.flatten([ m.cover ])) }}" />
      </a>

      <img ng-if="emptyIssue(m)" style="border-radius: 5px; width: 140px; height: 200px;" ng-src="{{ _.first(_.flatten([ m.cover ])) }}" />

      <div>
        <span class="jedbangers">#{{ m.number }}</span>

        <span ng-if="!_.isEmpty(m.title)" style="font-family: 'Oswald', sans-serif; font-weight: 600;">
          <br/>
          {{ m.title }}
        </span>

        <span ng-if="!_.isEmpty(m.date)" style="font-family: 'Oswald', sans-serif; font-size: 0.8em; ">
          <br/>
          {{ Date.parse(m.date) | date : 'MMMM | yyyy' }}
        </span>

        <br/>
        <a ng-if="!emptyIssue(m)" href="" ng-click="openIssueModal(m.number)">
          <span class="label label-default">Contenidos</span>
        </a>
        <a ng-if="!_.isEmpty(m.store_product)" ng-click="readBeforeBuyingModal(null, m.store_product)" target="_blank" href="">
          <span class="label label-danger">Comprar</span>
        </a>
      </div>

    </div>

  </div>

<?php get_footer(); ?>
