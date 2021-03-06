<?php

error_reporting(0);

header('Content-Type: application/json');

include('craw.php');

$craw = new Craw();

// $_GET['page'] = $craw->formatarURL(['http://','https://'],$_GET['page']);

$_GET['page'] = $craw->url_path($_GET['page']);

$data = $craw->crawlerPage('https://www.alexa.com/siteinfo/'.$_GET['page']);

try{
	$json['topKeywordsJSON'] = json_decode($craw->pesquisar($data, '<script type="application/json" id="topKeywordsJSON">', '</script>'),true);

	$json['competitorsJSON'] = json_decode($craw->pesquisar($data, '<script type="application/json" id="competitorsJSON">', '</script>'),true);

	$json['visitorPercentage'] = json_decode($craw->pesquisar($data, '<script type="application/json" id="visitorPercentage">', '</script>'),true);

	$json['rankData'] = (array) json_decode($craw->pesquisar($data, '<script type="application/json" id="rankData">', '</script>'),true);

	$country_rank_html = $craw->pesquisar($data, '<section class="countryrank">', '</section>',false);

	$json['country_rank'] = $craw->pesquisar($country_rank_html, '<li data-value="', '"');

	$bounce_rating_html = $craw->pesquisar($data, '<h3>Bounce rate</h3>', '</section>',false);

	$json['bounce_rating'] = $craw->pesquisar($bounce_rating_html, '<span class="num purple">', '%</span>');

	$page_views_html = $craw->pesquisar($data, '<h3>Engagement</h3>', '</section>',false);

	$json['page_views'] = doubleval($craw->pesquisar($page_views_html, '<p class="small data">', '</span>'));

	$time_on_site = explode(':',$craw->pesquisar($data, '<div class="rankmini-daily" style="flex-basis:40%;">', '</div>'));

	$json['time_on_site'] = ($time_on_site[0]*60)+$time_on_site[1];

	$search_visits_html = $craw->pesquisar($data, '<p>Percentage of visits to the site that consist of a single pageview.</p>', '</section>',false);

	$json['search_visits'] = doubleval($craw->pesquisar($search_visits_html, '<span class="num purple">', '%</span>'));

	$comparison_metrics_html = $craw->pesquisar($data, '<p><strong>Comparison Metrics</strong></p>', '</section>',false);

	$json['comparison_metrics'] = doubleval($craw->pesquisar($comparison_metrics_html, '<span class="num purple">', '%</span>'));

	$json['success'] = true;
}catch(Exception $e){
	$json['success'] = false;
	$json['error'] = $e;
}

echo json_encode($json);

?>