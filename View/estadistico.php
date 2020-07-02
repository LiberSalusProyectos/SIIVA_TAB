<?php include_once("user_auth.php"); include_once("Controller/resources.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("header_references.php");

    $result = getDataEstadistic($linkDB);

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

    /* Hide scrollbar for Chrome, Safari and Opera */
    .hsb::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .hsb {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
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
        toggleOff()
        $('table[id=t_'+this.name+']').toggle(200);

        var offc = false;
        var filtro = ''
        for (var i = 1; i < 24; i++) {
          if(i==23){
            if($('input[id=c_t]').is(":checked")){
              filtro += 'Total, ';
            } else {
              offc = true;
            }
          } else {
            if($('input[id=c_'+i+']').is(":checked")){
              filtro += $('input[id=c_'+i+']').parent().text().trim()+', ';
            } else {
              offc = true;
            }
          }
        }
        if(offc){
          toggleOff()
        } else {
          toggleOn()
        }
        $('span[id=filtros]').html(filtro.slice(0, -2))
      });

      $('input[id=select]').change(function() {
        if($(this).prop('checked')){
          $('input[id^=c_]').prop('checked', true);
          $('span[id=filtros]').html('Todos')

          for (var i = 1; i < 24; i++) {
            if(i==23){
              $('table[id=t_t]').show(200)
            } else {
              $('table[id=t_'+i+']').show(200)
            }
          }
        } else {
          $('input[id^=c_]').prop('checked', false);
          $('span[id=filtros]').html('Ninguno')

          for (var i = 1; i < 24; i++) {
            if(i==23){
              $('table[id=t_t]').hide(200)
            } else {
              $('table[id=t_'+i+']').hide(200)
            }
          }
        }
      });

      $('button[id=expand]').click(function(e) {
        $('div[id=filters]').toggle(250);
        $('i[name=collapse]').toggleClass(['fa-chevron-up', 'fa-chevron-down']);
      });

      $('input[id=select]').bootstrapToggle({
        on: 'Todos',
        off: 'Ninguno'
      });

      toggleOn()
    })
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
                    <i class="fas fa-file custom-icon icon-behind"></i>
                    <h4 class="text-white bold-font text-forward">MEDICIONES COMPLETADAS</h4>
                </span>
            </button>
        </div>
    </div>

    <div class="row">
      <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
        <div class="row">
            <div class="col-10 mb-4">
              <input id="select" type="checkbox">
              <span class="instructions-paragraph regular-font text-royal-blue ml-4">
                <strong>Filtrando por: </strong><span id="filtros">Todos</span>
              </span>
            </div>
            <div class="col-2 mb-4 d-flex justify-content-end">
                <button id="expand" class="btn btn-light">
                    <span>
                        <i name="collapse" class="fas fa-chevron-up"></i>
                    </span>
                </button>
            </div>
        </div>
      </div>
    </div>

    <div id="filters" class="row">
      <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
        <div class="row">
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
                        <input type="checkbox" id="c_2" name="2" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Medio Ambiente
                        <input type="checkbox" id="c_3" name="3" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Depresión geriátrica
                        <input type="checkbox" id="c_4" name="4" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Escala de Zarit
                        <input type="checkbox" id="c_5" name="5" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Enfermedades de transmisión sexual
                        <input type="checkbox" id="c_6" name="6" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Cuestionario socio-cultural
                        <input type="checkbox" id="c_7" name="7" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Diabetes mellitus
                        <input type="checkbox" id="c_8" name="8" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Hipertensión Arterial Sistémica
                        <input type="checkbox" id="c_9" name="9" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Estilo de vida personal de [0-1] años
                        <input type="checkbox" id="c_10" name="10" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Estilo de vida personal de [6-12] años
                        <input type="checkbox" id="c_11" name="11" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Estilo de vida personal de [12+] años.
                        <input type="checkbox" id="c_12" name="12" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Estilo de vida personal de [1-5] años
                        <input type="checkbox" id="c_13" name="13" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Ginecología
                        <input type="checkbox" id="c_14" name="14" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">PBIQ
                        <input type="checkbox" id="c_15" name="15" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Signos vitales + Laboratorio
                        <input type="checkbox" id="c_16" name="16" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Violencia de género
                        <input type="checkbox" id="c_17" name="17" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Esquema de vacunación de [0-9] años
                        <input type="checkbox" id="c_18" name="18" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Esquema de vacunación de [10-19] años
                        <input type="checkbox" id="c_19" name="19" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Esquema de vacunación de [20-59] años
                        <input type="checkbox" id="c_20" name="20" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Esquema de vacunación de [60+] años
                        <input type="checkbox" id="c_21" name="21" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Desesperanza de Beck
                        <input type="checkbox" id="c_22" name="22" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="form-group">
                    <label class="checktainer text-royal-blue regular-font">Total
                        <input type="checkbox" id="c_t" name="t" checked="true" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="row">

      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <?php if (count($result) > 0): ?>

        <?php $grupo=''; $fem=0; $masc=0; $gi=0; $total=0; foreach ($result as $key=>$row): $fem+=$row["feminine"]; $masc+=$row["masculine"];; $gi+=$row["gender_inv"];; $total+=$row["total"]; ?>
            <?php if ($grupo != $row["form"]): ?>
              <?php if ($grupo != ''): ?>
                  </tbody>
                </table>
              <?php endif; ?>
              <table id="t_<?php echo $row["id"]; ?>">
                <thead>
                  <tr>
                    <td colspan=5 style="text-align:center;color:white;background-color:rgb(247, 164, 26);font-weight:bold;"><?php echo utf8_encode($row["form"]); ?></td>
                  </tr>
                  <tr>
                    <th>Rango de edad</th>
                    <th>Mujeres</th>
                    <th>Hombres</th>
                    <th>Sin género/No válido</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
            <?php endif; ?>
            <tr>
              <td><?php echo utf8_encode($row["age"]); ?></td>
              <td style="text-align:right;"><?php echo number_format($row["feminine"]); ?></td>
              <td style="text-align:right;"><?php echo number_format($row["masculine"]); ?></td>
              <td style="text-align:right;"><?php echo number_format($row["gender_inv"]); ?></td>
              <td style="text-align:right;"><?php echo number_format($row["total"]); ?></td>
            </tr>
            <?php if (($key+1) === sizeof($result)): ?>
              </tbody>
                </table>

              <table id="t_t">
                <thead>
                  <tr>
                    <td colspan=5 style="text-align:center;color:white;background-color:rgb(247, 164, 26);font-weight:bold;">TOTAL</td>
                  </tr>
                  <tr>
                    <th>Mujeres</th>
                    <th>Hombres</th>
                    <th>Sin género/No válido</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="text-align:right;"><?php echo number_format($fem); ?></td>
                    <td style="text-align:right;"><?php echo number_format($masc); ?></td>
                    <td style="text-align:right;"><?php echo number_format($gi); ?></td>
                    <td style="text-align:right;"><?php echo number_format($total); ?></td>
                  </tr>
                </tbody>
              </table>
            <?php endif; ?>
            <?php $grupo=$row["form"]; ?>
        <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>

</html>