<?php
include 'constants.php';
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="css/admin.css">
	<link href="css/foundation-icons/foundation-icons.css" rel="stylesheet" />
	<script src="js/vendor/modernizr.js"></script>
	<link href="css/style.css" rel="stylesheet" />
	<link href="css/newStyle.css" rel="stylesheet" />
	<link href="css/flat-icon/flaticon.css" rel="stylesheet" />
	<link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
</head>

<body>
	<div class="row full-width wrapper">
		<div class="large-12 columns content-bg">
			<div id="top-menu">
				<div class="row">
					<div class="large-2 medium-4 small-12 columns top-part-no-padding">
						<div class="logo-bg p-5">
							<span class=" m-5" style="color:white;font-size:25px;font-weight:bold">
							<img width="50px" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIAHYAdgMBEQACEQEDEQH/xAAbAAEAAwADAQAAAAAAAAAAAAAABAUGAgMHAf/EADYQAAEEAgECBAIJAQkAAAAAAAEAAgMEBRESITEGE0FRImEUIzJxgZGhscHRBxVSYmNyguHw/8QAGgEBAAIDAQAAAAAAAAAAAAAAAAQFAQIDBv/EAC8RAAICAgAEBQIFBQEAAAAAAAABAgMEEQUSITETQVGB8HGxIjJhkeFCUqHR8RT/2gAMAwEAAhEDEQA/APcUAQBAEAQBAEAQBAEAQBAEAQBAEAQBAEAQBAEAQBAEAQBAEAQBAEAQBAEBxe5rGlzyGtHck9kG9EI5rFB/A5KmH/4TYZv902cXkVJ6cl+6JkcrJWh0bmuaexadhDqmn1RzQycXvbG0ueQ1oGySdAIaykorcnpHRVv1bb5GVpRIY9cuI6dfn+CEfHzcfIlKNUt676JKEoIAgCAIAgCAIAgI+RqRX6M9Sw3cUzCxw+RQ0sgpxcX2Z4taxM2OyEtOw3UkTtdvtD0I+RWqj10eGy650TcJeRd4axax0gkqyuZ7t38LvvClwqT7kGrPuxp81Utfb3PSMTkGZGoJWji8dHt9j/RcrK3W9M91w7PhnU+JHo/NejMVnc1JksrLXY8inXkLNA/bIPU/mu1dHMup5bjmdK2117/CvL1/U1Phjg+kXxxBjOWh076/dc7oqD0i84Byyx3KMdLsXS4l6EAQBAEAQBAEAQHwkICn8QYGtmo28vq7DB9XMB2+R9wjRAzsCGXHT6NeZkJsHlse8tdXMrB2dEOQP8reF04HjMvg2TU/ybXquv8AJceGbFuK8yGSq5kTwQ4+W4aPcb/96rNl0rO5O4FO6jIVTrai+/R+xSYjwxefclkybm06olceUjxzkG+4Hpv3Kk2ZVdcdb6k5cCtyb3KfSO/c3le3j61ZscE0flMHFoYd9lS3cUxINudi+/2PUU4cqoquEdJEiraitBxhcSGnR2NLbEzacuLlU96NrKpVvUjvUs5hAEAQBAEAQBAZ3OYrOXr3KjlxUqcAOAadg+p6a3+ak1WUxhqUdss8TJxKa9W1c0t9zOMmzXh/Pvx0E5yNieNpZ55dp3c7ALunZw7+i6uMLK+fsWrhiZuKrpLkUX11/wA/VeRdNZ4wtAF0lWrvvrj/AEcoclH+kgN8Lr7Jy+exU5oZGlPHXs5SaxO8A+XGXaAPb16n5aUS2EtdybieBdFzjWlFeb0SPD+KbdsSMv1rLC1u+TttH3dRv9VEhhwsk1YjlnZTqinTJdfnzoa6LHVImNa2BumjQ31XdcOxV3gn9ev3KSWRbJ7bIfh47ba128xV/A6+RW6/uJGb3j9C3V6QQgCAIAgCAIAgCAxn9oDXUrGLzMe91pgx+h3HcfsR+Kn4K8RTq9UXvBdXRtxpf1Lp8+djYRPbJG17DtrhsH3CgNa6FG009My3i7EtmtxXY71erKQGATycASDsEH3WdbRccNy+SEqnByXfot/uccZbu0ZIobVr6Q5zhy1J5g0enQp4bS2ZyKqboudceX20a3awUpSeFXc61h3+r/CruHQ5Yy+pY8RWpxX6F4rErggCAIAgCAIAgCAqPFdD+8fD92Bo2/y+bP8Ac3qP2UjEs8O+Mibw6/wMqE3231+j6GUwfjynSw1OpPBZmtRs8vTANHXbqT7aVjkcMsdspRaUS6y+BW2ZE7ItKLez7kr1vxLJAG4G2xsRJbKS4DR9Ps6PYeqjxphT+aaMY9FeApN3rr5dP97/AME2liMwyRsrYY43N6tMjmnXz11XG2yt9mcLsvFa5W2/p8RPmx2SLd3sy2FvyOh/ChTjzdmRI5OOuldW/nuWPh+rXq1Htq2m2WueSZGkEb9ui0qrjWtIjZltltm5x5enYtF1IgQBAEAQBAEAQBAfHdkB5tE7N+FLGWbSxnnU/MMrZpGkNa3r69N9NfkvQSjjZsK3Oepa1o9XJYfEoUu2zU9a15tn2XxD4nkxTcnIYoacjuLXRMbv27HZWqw8NWuldZL1EeH8OWR/51tyXr/Gi0mxGXmxsl2XMzSgQ+a2KPl8XTYHcfsoEraebljDRChl4sbVXGlLrrb16mdeyg/DC39NLsg6TRhOj0339+3Xf4LlbW+ZrXQtlO9ZPhcn4Ndz0bBU4aWOibDD5Rexr5G8ifiIG+6i60eTyrpW2tye9dPYsUI4QBAEAQBAEAQBAEBEvwPt1paz2RuilYWPa4kbBGitoTcJKUe6N67JVzU490YlvgXIhjKj8pzx7H8hByI/6/HSuHxaH51X+P1L+XHYdbI1LxGtbNxXZNHE1jmQta0aAZvoFTNtvbPPNtvbIbPDuJbb+lijEJt8tjet+/Ht+i3d02uVslPOyXX4bm9fPPuWgGlzIh9QBAEAQBAEAQEPMXxi8ZZvugnsCvGXmKuzk9+vRo9SspbegUo8Z0zUbZFeUtdWFjTZI39DL5fHbXEb38/16Joxsjz+PaUMuXj+g2nuxjg1/B0Z5kyCPQ+L4TsgjlrY2R2WeUbO4+NKzM1jcTNSsMsX4mSs+OM8eZfoa5bdrgdloIAIJWNdNjZ34/xfQvWWQNjmjd5MsszpGgCAMIHxH/MDyHy6+yaGzqm8Z0osdTuvglDbPmDynPYHtcxwaWa5ac/Z0GtJ36JobJEniiq2bKRMhlkdjI3SWeJHTX2QOvUu6/drrrY20Z2dxzUgdjwKErhdkMbSJG/AQHOO9n2YUBcLACAIAgCAIAgOm5Vgu1pK1uJksMg0+N42HBAQD4bwpbUacXUIpkmvuIfVHkHdP+QB+8b7rO2Y0cbNXHyR2cfYoRvrTSh0jCNtkc7b9ke/Jv5oCPHRxbJIJBiohJEG+U8NJLeHNzQ069OT/bq7XXadTJ3fRqM0boX4weUK728Szo5pa3kz8eg0fZYBxnhpuMwfi2OLmkua7u7k4NPQb9GNJI9ggO+OlSu+cZqUQLjIx3LqXB+uW/v4t/IICXHQrRtha2IageXxbJPFxBBI38nEfigJKAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCAIAgCA//2Q==" alt="Logo">
						</span> <i class="fi-list toggles" data-toggle="hide"></i>
						</div>
					</div>
					<div class="large-10 header medium-8 small-12 columns top-menu">
						<div class="row">
							<div class="large-6 medium-6 small-12 columns">
								<div class="row">&nbsp;</div>
							</div>
							<div class="large-4 medium-6 small-12 columns text-center">
								<div class="row">
								<?php
								if (isset ( $_SESSION ['admin_id'] )) {
									echo "
									<div class=\"medium-12 small-12 columns\">
									<a id=\"logout\" href=\"logout.php\" style=\"color:white\" title=\"Click here to logout\">Logout</a>
									</div>
									";
								}
										?>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>