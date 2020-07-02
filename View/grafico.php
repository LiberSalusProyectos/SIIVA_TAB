<?php include_once("user_auth.php"); include_once("Controller/resources.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("header_references.php");

    $result = getDataByGenderAge($linkDB);

    // echo "<pre>";
    // var_dump($result);
    // echo "</pre>";

  ?>

  <style>
    table {
      width:100%;
      margin-bottom:40px;
      border-collapse: collapse;
    }

    table, th, td {
      border: 1px solid black;
    }

    th, td {
      width:20%;
      padding: 4px;
    }

    .contenedor {
      transform: translate(0, 50px);
    }
    .texto {
      transform: rotate(270deg);
      transform-origin: center;
    }
    .marco {
      box-shadow: 0px 0px 10px #00000040;
      border: 3px solid #06AACA;
      border-radius: 12px;
      opacity: 1;
    }
    .propiedad {
      font-size: 16px;
      color: #C3BFBF;
    }
    .contenido {
      font-size: 20px;
      color: #0074B0;
    }
    .nombre {
      font-size: 16px;
      color: #7A8183;
    }
  </style>
  <script>
    //STEP 2 - Chart Data
    const chartData = [{
        label: "Venezuela",
        value: "290"
    }, {
        label: "Saudi",
        value: "260"
    }, {
        label: "Canada",
        value: "180"
    }, {
        label: "Iran",
        value: "140"
    }, {
        label: "Russia",
        value: "115"
    }, {
        label: "UAE",
        value: "100"
    }, {
        label: "US",
        value: "30"
    }, {
        label: "China",
        value: "30"
    }]
    //STEP 3 - Chart Configurations
    const chartConfigs = {
      id: 'chart',
      type: "column3d",
      width: "100%",
      height: "500",
      dataFormat: "json",
      dataSource: {
          // Chart Configuration
          "chart": {
              "caption": "Countries With Most Oil Reserves [2017-18]",
              "subCaption": "In MMbbl = One Million barrels",
              "xAxisName": "Country",
              "yAxisName": "Reserves (MMbbl)",
              "numberSuffix": "K",
              "theme": "fusion",
              "bgColor": "EEEEEE,CCCCCC",
              "bgratio": "60,40",
              "bgAlpha": "70,80",
              "bgAngle": "90"
          },
          // Chart Data
          "data": chartData
      },
      events: {
        "renderComplete": function(evt, args) {
          console.log('Render complete!!')
        }
      },
    }
    // Create a chart container
    $('document').ready(function () {
      $("#chart-container").insertFusionCharts(chartConfigs);
      $(window).resize(function(){
        var w = $( window ).width() - 40
        FusionCharts.items['chart'].resizeTo(w, "400");
      });
    });
  </script>
</head>

<body id="bootstrap_overrides">
  <noscript>You need to enable JavaScript to run this app.</noscript>
  <?php include("user_navigator.php"); ?>
  <div class="container-fluid">
    <div class="row custom-vertical-padding">
        <div class="offset-0 offset-md-2 offset-sm-2 offset-lg-3 col-12 col-sm-8 col-md-8 col-lg-6 text-center">
            <button class="btn my-2 my-sm-0 custom-btn-disabled" type="submit">
                <span>
                    <i class="fas fa-file custom-icon icon-behind"></i>
                    <h4 class="text-white bold-font text-forward">FUSION CHART</h4>
                </span>
            </button>
        </div>
    </div>

    <div class="row">
      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10 d-flex justify-content-center">
        <div id="chart-container">FusionCharts will render here</div>
      </div>
    </div>
  </div>
</body>

</html>