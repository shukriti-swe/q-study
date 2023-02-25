<style>
  .panel {
    margin-bottom: 24px;
    background-color: #ffffff;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
  }
  .panel-body {
    padding: 15px;
  }
  .panel-body > *:last-child {
    margin-bottom: 0;
  }
  .panel-heading {
    padding: 0px 15px;
    border-bottom: 1px solid transparent;
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
  }
  .panel-heading > .dropdown .dropdown-toggle {
    color: inherit;
  }
  .panel-title {
    margin-top: 0;
    margin-bottom: 0;
    color: inherit;
  }
  .panel-title > a,
  .panel-title > small,
  .panel-title > .small,
  .panel-title > small > a,
  .panel-title > .small > a {
    color: inherit;
  }
  .panel-footer {
    padding: 10px 15px;
    background-color: #f5f5f5;
    border-top: 1px solid #dddddd;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
  }
  .panel > .list-group,
  .panel > .panel-collapse > .list-group {
    margin-bottom: 0;
  }
  .panel > .list-group .list-group-item,
  .panel > .panel-collapse > .list-group .list-group-item {
    border-width: 1px 0;
    border-radius: 0;
  }
  .panel > .list-group:first-child .list-group-item:first-child,
  .panel > .panel-collapse > .list-group:first-child .list-group-item:first-child {
    border-top: 0;
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
  }
  .panel > .list-group:last-child .list-group-item:last-child,
  .panel > .panel-collapse > .list-group:last-child .list-group-item:last-child {
    border-bottom: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
  }
  .panel-heading + .list-group .list-group-item:first-child {
    border-top-width: 0;
  }
  .list-group + .panel-footer {
    border-top-width: 0;
  }
  .panel > .table,
  .panel > .table-responsive > .table,
  .panel > .panel-collapse > .table {
    margin-bottom: 0;
  }
  .panel > .table caption,
  .panel > .table-responsive > .table caption,
  .panel > .panel-collapse > .table caption {
    padding-left: 15px;
    padding-right: 15px;
  }
  .panel > .table:first-child,
  .panel > .table-responsive:first-child > .table:first-child {
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
  }
  .panel > .table:first-child > thead:first-child > tr:first-child,
  .panel > .table-responsive:first-child > .table:first-child > thead:first-child > tr:first-child,
  .panel > .table:first-child > tbody:first-child > tr:first-child,
  .panel > .table-responsive:first-child > .table:first-child > tbody:first-child > tr:first-child {
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
  }
  .panel > .table:first-child > thead:first-child > tr:first-child td:first-child,
  .panel > .table-responsive:first-child > .table:first-child > thead:first-child > tr:first-child td:first-child,
  .panel > .table:first-child > tbody:first-child > tr:first-child td:first-child,
  .panel > .table-responsive:first-child > .table:first-child > tbody:first-child > tr:first-child td:first-child,
  .panel > .table:first-child > thead:first-child > tr:first-child th:first-child,
  .panel > .table-responsive:first-child > .table:first-child > thead:first-child > tr:first-child th:first-child,
  .panel > .table:first-child > tbody:first-child > tr:first-child th:first-child,
  .panel > .table-responsive:first-child > .table:first-child > tbody:first-child > tr:first-child th:first-child {
    border-top-left-radius: 3px;
  }
  .panel > .table:first-child > thead:first-child > tr:first-child td:last-child,
  .panel > .table-responsive:first-child > .table:first-child > thead:first-child > tr:first-child td:last-child,
  .panel > .table:first-child > tbody:first-child > tr:first-child td:last-child,
  .panel > .table-responsive:first-child > .table:first-child > tbody:first-child > tr:first-child td:last-child,
  .panel > .table:first-child > thead:first-child > tr:first-child th:last-child,
  .panel > .table-responsive:first-child > .table:first-child > thead:first-child > tr:first-child th:last-child,
  .panel > .table:first-child > tbody:first-child > tr:first-child th:last-child,
  .panel > .table-responsive:first-child > .table:first-child > tbody:first-child > tr:first-child th:last-child {
    border-top-right-radius: 3px;
  }
  .panel > .table:last-child,
  .panel > .table-responsive:last-child > .table:last-child {
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
  }
  .panel > .table:last-child > tbody:last-child > tr:last-child,
  .panel > .table-responsive:last-child > .table:last-child > tbody:last-child > tr:last-child,
  .panel > .table:last-child > tfoot:last-child > tr:last-child,
  .panel > .table-responsive:last-child > .table:last-child > tfoot:last-child > tr:last-child {
    border-bottom-left-radius: 3px;
    border-bottom-right-radius: 3px;
  }
  .panel > .table:last-child > tbody:last-child > tr:last-child td:first-child,
  .panel > .table-responsive:last-child > .table:last-child > tbody:last-child > tr:last-child td:first-child,
  .panel > .table:last-child > tfoot:last-child > tr:last-child td:first-child,
  .panel > .table-responsive:last-child > .table:last-child > tfoot:last-child > tr:last-child td:first-child,
  .panel > .table:last-child > tbody:last-child > tr:last-child th:first-child,
  .panel > .table-responsive:last-child > .table:last-child > tbody:last-child > tr:last-child th:first-child,
  .panel > .table:last-child > tfoot:last-child > tr:last-child th:first-child,
  .panel > .table-responsive:last-child > .table:last-child > tfoot:last-child > tr:last-child th:first-child {
    border-bottom-left-radius: 3px;
  }
  .panel > .table:last-child > tbody:last-child > tr:last-child td:last-child,
  .panel > .table-responsive:last-child > .table:last-child > tbody:last-child > tr:last-child td:last-child,
  .panel > .table:last-child > tfoot:last-child > tr:last-child td:last-child,
  .panel > .table-responsive:last-child > .table:last-child > tfoot:last-child > tr:last-child td:last-child,
  .panel > .table:last-child > tbody:last-child > tr:last-child th:last-child,
  .panel > .table-responsive:last-child > .table:last-child > tbody:last-child > tr:last-child th:last-child,
  .panel > .table:last-child > tfoot:last-child > tr:last-child th:last-child,
  .panel > .table-responsive:last-child > .table:last-child > tfoot:last-child > tr:last-child th:last-child {
    border-bottom-right-radius: 3px;
  }
  .panel > .panel-body + .table,
  .panel > .panel-body + .table-responsive,
  .panel > .table + .panel-body,
  .panel > .table-responsive + .panel-body {
    border-top: 1px solid #dddddd;
  }
  .panel > .table > tbody:first-child > tr:first-child th,
  .panel > .table > tbody:first-child > tr:first-child td {
    border-top: 0;
  }
  .panel > .table-bordered,
  .panel > .table-responsive > .table-bordered {
    border: 0;
  }
  .panel > .table-bordered > thead > tr > th:first-child,
  .panel > .table-responsive > .table-bordered > thead > tr > th:first-child,
  .panel > .table-bordered > tbody > tr > th:first-child,
  .panel > .table-responsive > .table-bordered > tbody > tr > th:first-child,
  .panel > .table-bordered > tfoot > tr > th:first-child,
  .panel > .table-responsive > .table-bordered > tfoot > tr > th:first-child,
  .panel > .table-bordered > thead > tr > td:first-child,
  .panel > .table-responsive > .table-bordered > thead > tr > td:first-child,
  .panel > .table-bordered > tbody > tr > td:first-child,
  .panel > .table-responsive > .table-bordered > tbody > tr > td:first-child,
  .panel > .table-bordered > tfoot > tr > td:first-child,
  .panel > .table-responsive > .table-bordered > tfoot > tr > td:first-child {
    border-left: 0;
  }
  .panel > .table-bordered > thead > tr > th:last-child,
  .panel > .table-responsive > .table-bordered > thead > tr > th:last-child,
  .panel > .table-bordered > tbody > tr > th:last-child,
  .panel > .table-responsive > .table-bordered > tbody > tr > th:last-child,
  .panel > .table-bordered > tfoot > tr > th:last-child,
  .panel > .table-responsive > .table-bordered > tfoot > tr > th:last-child,
  .panel > .table-bordered > thead > tr > td:last-child,
  .panel > .table-responsive > .table-bordered > thead > tr > td:last-child,
  .panel > .table-bordered > tbody > tr > td:last-child,
  .panel > .table-responsive > .table-bordered > tbody > tr > td:last-child,
  .panel > .table-bordered > tfoot > tr > td:last-child,
  .panel > .table-responsive > .table-bordered > tfoot > tr > td:last-child {
    border-right: 0;
  }
  .panel > .table-bordered > thead > tr:first-child > td,
  .panel > .table-responsive > .table-bordered > thead > tr:first-child > td,
  .panel > .table-bordered > tbody > tr:first-child > td,
  .panel > .table-responsive > .table-bordered > tbody > tr:first-child > td,
  .panel > .table-bordered > thead > tr:first-child > th,
  .panel > .table-responsive > .table-bordered > thead > tr:first-child > th,
  .panel > .table-bordered > tbody > tr:first-child > th,
  .panel > .table-responsive > .table-bordered > tbody > tr:first-child > th {
    border-bottom: 0;
  }
  .panel > .table-bordered > tbody > tr:last-child > td,
  .panel > .table-responsive > .table-bordered > tbody > tr:last-child > td,
  .panel > .table-bordered > tfoot > tr:last-child > td,
  .panel > .table-responsive > .table-bordered > tfoot > tr:last-child > td,
  .panel > .table-bordered > tbody > tr:last-child > th,
  .panel > .table-responsive > .table-bordered > tbody > tr:last-child > th,
  .panel > .table-bordered > tfoot > tr:last-child > th,
  .panel > .table-responsive > .table-bordered > tfoot > tr:last-child > th {
    border-bottom: 0;
  }
  .panel > .table-responsive {
    border: 0;
    margin-bottom: 0;
  }
  .panel-group {
    margin-bottom: 24px;
  }
  .panel-group .panel {
    margin-bottom: 0;
    border-radius: 4px;
  }
  .panel-group .panel + .panel {
    margin-top: 5px;
  }
  .panel-group .panel-heading {
    border-bottom: 0;
  }
  .panel-group .panel-heading + .panel-collapse > .panel-body,
  .panel-group .panel-heading + .panel-collapse > .list-group {
    border-top: 1px solid #dddddd;
  }
  .panel-group .panel-footer {
    border-top: 0;
  }
  .panel-group .panel-footer + .panel-collapse .panel-body {
    border-bottom: 1px solid #dddddd;
  }
  .panel-default {
    border-color: #dddddd;
  }
  .panel-default > .panel-heading {
    /* color: #333333;
    background-color: #f5f5f5;
    border-color: #dddddd; */
    background-color: #D63832 !important;
    color: #fff !important;
  }
  .panel-default > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: #dddddd;
  }
  .panel-default > .panel-heading .badge {
    color: #f5f5f5;
    background-color: #333333;
  }
  .panel-default > .panel-footer + .panel-collapse > .panel-body {
    border-bottom-color: #dddddd;
  }
  .panel-default h1,
  .panel-default h2,
  .panel-default h3,
  .panel-default h4,
  .panel-default h5,
  .panel-default h6,
  .panel-default .h1,
  .panel-default .h2,
  .panel-default .h3,
  .panel-default .h4,
  .panel-default .h5,
  .panel-default .h6 {
    color: #333333;
  }
  .panel-primary {
    border-color: #cccccc;
  }
  .panel-primary > .panel-heading {
    color: #ffffff;
    background-color: #095f7b;
    border-color: #cccccc;
  }
  .panel-primary > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: #cccccc;
  }
  .panel-primary > .panel-heading .badge {
    color: #095f7b;
    background-color: #ffffff;
  }
  .panel-primary > .panel-footer + .panel-collapse > .panel-body {
    border-bottom-color: #cccccc;
  }
  .panel-primary h1,
  .panel-primary h2,
  .panel-primary h3,
  .panel-primary h4,
  .panel-primary h5,
  .panel-primary h6,
  .panel-primary .h1,
  .panel-primary .h2,
  .panel-primary .h3,
  .panel-primary .h4,
  .panel-primary .h5,
  .panel-primary .h6 {
    color: #ffffff;
  }
  .panel-success {
    border-color: #d6e9c6;
  }
  .panel-success > .panel-heading {
    color: #2da285;
    background-color: #dff0d8;
    border-color: #d6e9c6;
  }
  .panel-success > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: #d6e9c6;
  }
  .panel-success > .panel-heading .badge {
    color: #dff0d8;
    background-color: #2da285;
  }
  .panel-success > .panel-footer + .panel-collapse > .panel-body {
    border-bottom-color: #d6e9c6;
  }
  .panel-success h1,
  .panel-success h2,
  .panel-success h3,
  .panel-success h4,
  .panel-success h5,
  .panel-success h6,
  .panel-success .h1,
  .panel-success .h2,
  .panel-success .h3,
  .panel-success .h4,
  .panel-success .h5,
  .panel-success .h6 {
    color: #2da285;
  }
  .panel-info {
    border-color: #bce8f1;
  }
  .panel-info > .panel-heading {
    color: #3e97b6;
    background-color: #d9edf7;
    border-color: #bce8f1;
  }
  .panel-info > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: #bce8f1;
  }
  .panel-info > .panel-heading .badge {
    color: #d9edf7;
    background-color: #3e97b6;
  }
  .panel-info > .panel-footer + .panel-collapse > .panel-body {
    border-bottom-color: #bce8f1;
  }
  .panel-info h1,
  .panel-info h2,
  .panel-info h3,
  .panel-info h4,
  .panel-info h5,
  .panel-info h6,
  .panel-info .h1,
  .panel-info .h2,
  .panel-info .h3,
  .panel-info .h4,
  .panel-info .h5,
  .panel-info .h6 {
    color: #3e97b6;
  }
  .panel-warning {
    border-color: #faebcc;
  }
  .panel-warning > .panel-heading {
    color: #ab8d00;
    background-color: #D63832;
    border-color: #faebcc;
  }
  .panel-warning > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: #faebcc;
  }
  .panel-warning > .panel-heading .badge {
    color: #fcf8e3;
    background-color: #ab8d00;
  }
  .panel-warning > .panel-footer + .panel-collapse > .panel-body {
    border-bottom-color: #faebcc;
  }
  .panel-warning h1,
  .panel-warning h2,
  .panel-warning h3,
  .panel-warning h4,
  .panel-warning h5,
  .panel-warning h6,
  .panel-warning .h1,
  .panel-warning .h2,
  .panel-warning .h3,
  .panel-warning .h4,
  .panel-warning .h5,
  .panel-warning .h6 {
    color: #ab8d00;
  }
  .panel-danger {
    border-color: #ebccd1;
  }
  .panel-danger > .panel-heading {
    color: #a72026;
    background-color: #f2dede;
    border-color: #ebccd1;
  }
  .panel-danger > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: #ebccd1;
  }
  .panel-danger > .panel-heading .badge {
    color: #f2dede;
    background-color: #a72026;
  }
  .panel-danger > .panel-footer + .panel-collapse > .panel-body {
    border-bottom-color: #ebccd1;
  }
  .panel-danger h1,
  .panel-danger h2,
  .panel-danger h3,
  .panel-danger h4,
  .panel-danger h5,
  .panel-danger h6,
  .panel-danger .h1,
  .panel-danger .h2,
  .panel-danger .h3,
  .panel-danger .h4,
  .panel-danger .h5,
  .panel-danger .h6 {
    color: #a72026;
  }

  .panel-title > a:before {
    content: "\f068";
    float: right !important;
    position: relative;
    top: 10px;
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    line-height: 1;
  }
  .panel-title > a.collapsed:before {
    content: "\f067";
  }
  .panel-title > a {
    text-decoration: none;
  }
  .panel-title > a {
    text-decoration: none;
    color: #fff !important;
  }

</style>

<div class="col-sm-12">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

    <div class="panel panel-warning">
      <div class="panel-heading" role="tab" id="headingFive">
        <h4 class="panel-title">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Front Page Items</a>
        </h4>
      </div>
      <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
        <div class="panel-body">
          <ul class="list-unstyled">
            <li class="fPageItems" id="pricing"><a href="">Pricing</a></li>
            <li class="fPageItems" id="how_it_works"><a href="">How it works</a></li>
            <li class="fPageItems" id="about_us"><a href="">About us</a></li>
            <li class="fPageItems" id="terms_and_conditions"><a href="">Terms & Conditions</a></li>
            <li class="fPageItems" id="privacy_policy"><a href="">Privacy Policy</a></li>
            <li class="fPageItems" id="disclaimer"><a href="">Disclaimer</a></li>
            <li class="fPageItems" id="become_a_tutor"><a href="">Become a tutor</a></li>
            <li class="fPageItems" id="video_guide"><a href="">Video guide</a></li>
          </ul>
        </div>
      </div>
    </div>

  </div>

</div>

<script>
  $(document).ready(function () {
    $("a.collapsed").click(function () {
      $(this).find(".btn:contains('answer')").toggleClass("collapsed");
    });
  });
</script>
