<?php include_once("user_auth.php"); include_once("Controller/resources.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("header_references.php"); ?>

  <style>
    th {
      color: #7A8183;
    }

    /* Hide scrollbar for Chrome, Safari and Opera */
    .hsb::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .hsb {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
    }

    /* CHEKBOX INICIA */
    .checktainer input:checked ~ .checkmark {
      background-color: #5d666f !important;
    }
    /* CHEKBOX TERMINA */

    .card-paper {
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      padding: 5px;
      border-radius: 5px;
      background: #FFFF;
    }

    .card-paper:hover {
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    .bottom-shadow {
      background: #FFFF;
      -webkit-box-shadow: 0 8px 6px -6px rgba(0,0,0,0.2);
	    -moz-box-shadow: 0 8px 6px -6px rgba(0,0,0,0.2);
	        box-shadow: 0 8px 6px -6px rgba(0,0,0,0.2);
    }
  </style>
  <script>
    $(document).ready(function () {

      var toggleOn = function() {
        $('input[id=select]').bootstrapToggle('on', true);
      }

      var toggleOff = function() {
        $('input[id=select]').bootstrapToggle('off', true);
      }

      $('input[id^=c_]').change(function() {

        $('div[id=t_'+this.name+']').toggle(200);

        loadItem(this.name);

        var offc = false;
        var filtro = ''
        for (var i = 1; i < 24; i++) {
          if($('input[id=c_'+i+']').is(":checked")){
            filtro += $('input[id=c_'+i+']').parent().text().trim()+', ';
          } else {
            offc = true;
          }
        }
        if(offc){
          toggleOff()
        } else {
          toggleOn()
        }
        $('span[id=filtros]').html(filtro.slice(0, -2))
      });

      $('input[id=select]').change(async function() {
        if($(this).prop('checked')){
          $('input[id^=c_]').prop('checked', true);
          $('span[id=filtros]').html('Todos')

          for (var i = 1; i < 24; i++) {
            $('div[id=t_'+i+']').show(200)

            await loadItem(i);
          }
        } else {
          $('input[id^=c_]').prop('checked', false);
          $('span[id=filtros]').html('Ninguno')

          for (var i = 1; i < 24; i++) {
            $('div[id=t_'+i+']').hide(200)
          }
        }
      });

      $('button[id=expand]').click(function(e) {
        $('div[id=filters]').toggle(250);
        $('i[name=collapse]').toggleClass(['fa-chevron-up', 'fa-chevron-down']);
      });

      $('input[id=select]').bootstrapToggle({
        on: 'Todos',
        off: 'Ninguno',
        onstyle: 'secondary'
      });

      loadItem(1);
    })
    function loadItem(id) {
      var _id = id

      return $.ajax({
        method:"GET",
        url:"graficas.php?" + $.param({ form: _id }),
        contentType:false,
        cache:false,
        processData:false,
        success:function(resp){
          var data = JSON.parse(resp);

          var table = '';
          var array = [];
          data.reverse().forEach(function(item) {
            if(_id != 23){
              array.push({label: item.age, value: item.total})
            } else {
              array.push({label: 'Mujeres', value: item.feminine})
              array.push({label: 'Hombres', value: item.masculine})
              array.push({label: 'ND', value: item.gender_inv})
            }

            table += '<tr>';
            if (_id != 23) table += '<td>'+item.age+'</td>'
            table += '<td style="text-align:right;">'+item.feminine+'</td>'
            table += '<td style="text-align:right;">'+item.masculine+'</td>'
            table += '<td style="text-align:right;">'+item.gender_inv+'</td>'
            table += '<td style="text-align:right;">'+item.total+'</td>'
            table += '</tr>'
          })

          var chartConfigs = {
            type: "pie2d",
            width: "100%",
            height: "350",
            dataFormat: "json",
            dataSource: {
              // Chart Configuration
              "chart": {
                "caption": data[0].form,
                "theme": "fusion",
              },
              // Chart Data
              "data": array
            },
          }

          $("#sp_"+_id).html(data[0].form);
          $("#ch_"+_id).insertFusionCharts(chartConfigs);
          $("#tb_"+_id).html(table);
        }
      })
    }
  </script>
</head>

<body id="bootstrap_overrides" class="hsb">
  <noscript>You need to enable JavaScript to run this app.</noscript>
  <?php include("user_navigator.php"); ?>
  <div class="container-fluid">
    <div class="row custom-vertical-padding">
        <div class="offset-0 offset-md-2 offset-sm-2 offset-lg-3 col-12 col-sm-8 col-md-8 col-lg-6 text-center">
            <button class="btn my-2 my-sm-0 custom-btn-disabled" type="submit">
                <span>
                    <i class="fas fa-chart-pie custom-icon icon-behind"></i>
                    <h4 class="text-white bold-font text-forward">ESTADISTICO</h4>
                </span>
            </button>
        </div>
    </div>

    <div class="row">
      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10 pt-3 bottom-shadow">
        <div class="row">
          <div class="col-10 mb-4">
            <input id="select" type="checkbox">
            <span class="instructions-paragraph regular-font text-royal-blue ml-4">
              <strong>Filtrando por: </strong><span id="filtros">Antecedentes Familiares</span>
            </span>
          </div>
          <div class="col-2 mb-4 d-flex justify-content-end">
              <button id="expand" class="btn btn-light">
                  <span>
                      <i name="collapse" class="fas fa-chevron-down"></i>
                  </span>
              </button>
          </div>
        </div>
        <div id="filters" style="display:none;" class="row">
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Antecedentes Familiares
                        <input type="checkbox" id="c_1" name="1" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">DASS-21
                        <input type="checkbox" id="c_2" name="2" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Medio Ambiente
                        <input type="checkbox" id="c_3" name="3" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Depresión geriátrica
                        <input type="checkbox" id="c_4" name="4" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Escala de Zarit
                        <input type="checkbox" id="c_5" name="5" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Enfermedades de transmisión sexual
                        <input type="checkbox" id="c_6" name="6" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Cuestionario socio-cultural
                        <input type="checkbox" id="c_7" name="7" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Diabetes mellitus
                        <input type="checkbox" id="c_8" name="8" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Hipertensión Arterial Sistémica
                        <input type="checkbox" id="c_9" name="9" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Estilo de vida personal de [0-1] años
                        <input type="checkbox" id="c_10" name="10" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Estilo de vida personal de [6-12] años
                        <input type="checkbox" id="c_11" name="11" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Estilo de vida personal de [12+] años.
                        <input type="checkbox" id="c_12" name="12" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Estilo de vida personal de [1-5] años
                        <input type="checkbox" id="c_13" name="13" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Ginecología
                        <input type="checkbox" id="c_14" name="14" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">PBIQ
                        <input type="checkbox" id="c_15" name="15" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Signos vitales + Laboratorio
                        <input type="checkbox" id="c_16" name="16" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Violencia de género
                        <input type="checkbox" id="c_17" name="17" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Esquema de vacunación de [0-9] años
                        <input type="checkbox" id="c_18" name="18" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Esquema de vacunación de [10-19] años
                        <input type="checkbox" id="c_19" name="19" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Esquema de vacunación de [20-59] años
                        <input type="checkbox" id="c_20" name="20" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Esquema de vacunación de [60+] años
                        <input type="checkbox" id="c_21" name="21" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Desesperanza de Beck
                        <input type="checkbox" id="c_22" name="22" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Total
                        <input type="checkbox" id="c_23" name="23" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="row pb-5">

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" id="t_1">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_1" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_1" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_1">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_2">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_2" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_2" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_2">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_3">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_3" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_3" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_3">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_4">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_4" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_4" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_4">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_5">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_5" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_5" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_5">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_6">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_6" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_6" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_6">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_7">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_7" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_7" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_7">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_8">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_8" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_8" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_8">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_9">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_9" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_9" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_9">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_10">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_10" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_10" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_10">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_11">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_11" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_11" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_11">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_12">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_12" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_12" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_12">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_13">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_13" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_13" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_13">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_14">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_14" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_14" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_14">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_15">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_15" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_15" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_15">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_16">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_16" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_16" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_16">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_17">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_17" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_17" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_17">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_18">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_18" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_18" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_18">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_19">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_19" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_19" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_19">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_20">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_20" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_20" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_20">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_21">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_21" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_21" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_21">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_22">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_22" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_22" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Edad</th>
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_22">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row" style="display:none;" id="t_23">
          <div class="col-12 text-center mt-4 mb-2">
            <span id="sp_23" class="text-royal-blue bold-font custom-form-label-element">
              Cargando...
            </span>
          </div>

          <div class="col-lg-6">
            <div class="card-paper">
              <div id="ch_23" class="text-center"><span class="text-secondary">Cargando graficos...</span></div>
            </div>
          </div>
          <div class="col-lg-6">
            <table class="table">
              <thead>
                <tr>
                  <!-- <th>Edad</th> -->
                  <th style="text-align:right;">Mujeres</th>
                  <th style="text-align:right;">Hombres</th>
                  <th style="text-align:right;">ND</th>
                  <th style="text-align:right;">Total</th>
                </tr>
              </thead>
              <tbody id="tb_23">
                <tr>
                  <td colspan=5 style="text-align:center;"><span class="text-secondary">Cargando datos...</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>


    </div>
  </div>
</body>

</html>