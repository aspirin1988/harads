<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php //wp_head() ?>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php bloginfo('template_url')?>/public/bower_components/uikit/css/uikit.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url')?>/public/bower_components/uikit/css/components/slidenav.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url')?>/public/bower_components/uikit/css/components/slider.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url')?>/public/bower_components/uikit/css/components/slider.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url')?>/public/css/homepage.css">
    <style>

        #weglot_switcher {
            position: fixed;
            top: 0;
            right: 15px;
            background: #942f54;
            z-index: 99999;
        }

        #weglot_switcher .wgcurrent {
            text-align: center;
        }

        #weglot_switcher .wgcurrent a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            display: block;
        }

        #weglot_switcher ul {
            display: block;
            list-style:none;
            padding: 0;
            margin: 0;
            border-top: 1px solid #fff;
            display: none;
        }


        #weglot_switcher ul li {
            list-style: none;
        }

        #weglot_switcher ul li a {
            text-decoration: none;
            color: #eee;
            padding: 5px 10px;
            display: block;
        }

        #weglot_switcher ul li a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
