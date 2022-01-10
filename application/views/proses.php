<?php
    require_once(APPPATH."views/parts/Header.php");
    require_once(APPPATH."views/parts/Sidebar.php");
    $active = 'dashboard';
?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Proses Pemetaan</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="dx-viewport demo-container">
                        <div id="data-grid-demo">
                          <div id="gridContainer">
                          </div>
                        </div>
                      </div>

                  </div>
                </div>
              </div>
            </div>
            <?php
              if (!isset($_POST['button']))
              {
              ?>
              <div class="row">
                <div class="col-md-12 col-sm-12  ">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Pemrosesan</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="post_" data-parsley-validate class="form-horizontal form-label-left" method="post">
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jumlah Cluster Dicari <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" name="jml_cluster" id="jml_cluster" required="" placeholder="Jumlah Cluster Dicari" class="form-control " value="2">
                            </div>
                          </div>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Maksimum Iterasi <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" name="max_iteration" id="max_iteration" required="" placeholder="Jumlah Cluster Dicari" class="form-control " value="100">
                            </div>
                          </div>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nilai Pembobot (Pangkat) <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" name="pembobot" id="pembobot" required="" placeholder="Jumlah Cluster Dicari" class="form-control " value="2">
                            </div>
                          </div>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nilai Error Terkecil <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" name="epsilon" id="epsilon" required="" placeholder="Jumlah Cluster Dicari" class="form-control " value="0.000001">
                            </div>
                          </div>

                          <div class="item form-group">
                            <div class="col-md-6 col-sm-6 ">
                              <input type="submit" name="button" id="button" required="" placeholder="Jumlah Cluster Dicari" class="form-control ">
                            </div>
                          </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              }
              else
              {
              ?>
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Hasil Proses</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <!-- Baris untuk menampilkan perhitungan, akan mucul jika tombol perhitungan di klik -->
                        <div id="perhitungan" style="display:none;">
                          <!--  -->
                          <?php
                          // menampilkan tabel hasil perhitungan
                            function tampiltabel($arr)
                            {
                              echo '<table width="500" border="1" cellspacing="1" cellpadding="3" bgcolor="#000099">';
                                for ($i=0;$i<count($arr);$i++)
                                {
                                echo '<tr>';
                                  for ($j=0;$j<count($arr[$i]);$j++)
                                  {
                                  echo '<td bgcolor="#FFFFFF">'.$arr[$i][$j].'</td>';
                                  }
                                echo '</tr>';
                                }
                              echo '</table>';
                            }
                            // baris tabel
                            function tampilbaris($arr)
                            {
                              echo '<table width="500" border="1" cellspacing="1" cellpadding="3" bgcolor="#000099">';
                              echo '<tr>';
                                  for ($i=0;$i<count($arr);$i++)
                                  {
                                  echo '<td bgcolor="#FFFFFF">'.$arr[$i].'</td>';
                                  }
                              echo "</tr>";
                              echo '</table>';
                            }

                            // Kolom tabel
                            function tampilkolom($arr)
                            {
                              echo '<table width="500" border="1" cellspacing="1" cellpadding="3" bgcolor="#000099">';
                              for ($i=0;$i<count($arr);$i++)
                              {
                                echo '<tr>';
                                  echo '<td bgcolor="#FFFFFF">'.$arr[$i].'</td>';
                                echo "</tr>";
                               }
                              echo '</table>';
                            }

                            // ==================== local variable ==================== 
                            $jmlCluster = $_POST['jml_cluster']; //3;
                            $jmlData;
                            $jmlVariabel;
                            $maksIterasi = $_POST['max_iteration']; // = 100;
                            $pembobot = $_POST['pembobot']; //2;
                            $epsilon = $_POST['epsilon']; //0.000001;
                            $selisih_fungsi_objective = 0;
                            $fungsi_objective_terakhir = 0;
                            $fungsi_objective = 0;
                            $Nomor = '';

                            $SQL = "SELECT RIGHT(MAX(Nomor),4)  AS Total FROM hasil WHERE LEFT(Nomor, LENGTH('11')) = '11'";

                            // var_dump($SQL);
                            $rs = $this->db->query($SQL);

                            $temp = $rs->row()->Total + 1;

                            $Nomor = '11'.str_pad($temp, 6,"0",STR_PAD_LEFT);

                            $alternatif = array(); //array("A", "B", "C", "D", "E", "F", "G", "H");
                            $alternatifksm = array();
                            // ==================== End local variable ==================== 

                            // Get data alternatif
                            $queryalternatif = $this->db->query("SELECT * FROM tumkm ORDER BY ID")->result();
                            // save di array
                            // var_dump($queryalternatif);
                            $i=0;
                            foreach ($queryalternatif as $key) {
                              $alternatif[$i] = $key->NamaPerusahaa;
                              $i++;
                            }
                            // while ($dataalternatif = mysqli_fetch_array($queryalternatif))
                            // {
                            //   $alternatif[$i] = $dataalternatif['NamaPerusahaa'];
                            //   //$alternatifksm[$i] = $dataalternatif['ksm'];
                            //   $i++;
                            // }
                            // end get data

                            // Get data kriteria
                            $kriteria = array(); //array("Rumah", "Mobil");
    
                            $querykriteria = $this->db->query("SELECT * FROM tkriteria ORDER BY id")->result();
                            $i=0;
                            // save di array
                            foreach ($querykriteria as $key) {
                               $kriteria[$i] = $key->NamaKriteria;
                               $i++;
                            }
                            // while ($datakriteria = mysqli_fetch_array($querykriteria))
                            // {
                            //   $kriteria[$i] = $datakriteria['NamaKriteria'];
                            //   $i++;
                            // }
                            // End get data

                            // get data kombinasi kriteria nilai alternatif
                            $alternatifkriteria = array();
                            // used
                            $queryalternatif = $this->db->query("SELECT * FROM tumkm ORDER BY ID");
                            $i = 0;
                            foreach ($queryalternatif->result() as $key) {
                              $querykriteria = $this->db->query("SELECT * FROM tkriteria ORDER BY ID")->result();
                              $j=0;
                              foreach ($querykriteria as $key1) {
                                $queryalternatifkriteria = $this->db->query("SELECT * FROM tnilai WHERE KodeUMKM = '".$key->ID."' AND KodeKriteria = '".$key1->ID."'")->row();
                                // var_dump($queryalternatifkriteria->Nilai);
                                $alternatifkriteria[$i][$j] = $queryalternatifkriteria->Nilai;
                                $j++;
                              }
                              $i++;
                            }
                            // end used
                            // var_dump($alternatifkriteria);  


                            // $queryalternatif = mysqli_query($koneksi,"SELECT * FROM tumkm ORDER BY ID");
                            
                            // $i=0;
                            // while ($dataalternatif = mysqli_fetch_array($queryalternatif))
                            // {
                            //   $querykriteria = mysqli_query($koneksi,"SELECT * FROM tkriteria ORDER BY ID");
                            //   $j=0;
                            //   while ($datakriteria = mysqli_fetch_array($querykriteria))
                            //   {
                            //     $queryalternatifkriteria = mysqli_query($koneksi,"SELECT * FROM tnilai WHERE KodeUMKM = '$dataalternatif[ID]' AND KodeKriteria = '$datakriteria[ID]'");
                            //     $dataalternatifkriteria = mysqli_fetch_array($queryalternatifkriteria); 
                                
                            //     $alternatifkriteria[$i][$j] = $dataalternatifkriteria['Nilai'];
                            //     $j++;
                            //   }
                            //   $i++;
                            // }
                            // End get data
                            $data = $alternatifkriteria;

                            // Start Perhitungan
                            $jmlVariabel = count($data[0]);
                            $jmlData = count($data);

                            $pusatCluster = array(array());

                            for ($d = 0; $d<$jmlData; $d++) {
                                $jml = 0;
                                for ($c = 0; $c < $jmlCluster; $c++) {
                                    $keanggotaan[$d][$c] = rand(0, 9);
                                    $jml += $keanggotaan[$d][$c];
                                }
                                for ($c = 0; $c < $jmlCluster; $c++) {
                                    $keanggotaan[$d][$c] = $keanggotaan[$d][$c] / $jml;
                                }
                                $tot=0;
                                for ($c = 0; $c < ($jmlCluster-1); $c++) {
                                    $tot = $tot + $keanggotaan[$d][$c];
                                }
                                $keanggotaan[$d][$jmlCluster-1] = 1 - $tot;
                            }

                            // Generate Random U
                            if ($jmlCluster == 3) {
                              $keanggotaan = array ();

                              $temp = array();
                              $temp1 = 0;
                              $temp2 = 0;
                              $temp3 = 0;
                              $xx = 0;

                              $i = 0;
                              for($i = 0; $i < $queryalternatif->num_rows(); $i++){
                                restart:

                                $temp1 = round(rand(8,0.9)/10,2);
                                $temp2 = round(rand(1,((1-$temp1)*10)-1)/10,2);
                                $temp3 = round((1-$temp1-$temp2),2);
                                
                                if ($temp1 == 0) {
                                  goto restart;
                                }
                                elseif ($temp2 == 0) {
                                  goto restart;
                                }
                                elseif ($temp3 == 0) {
                                  goto restart;
                                }
  
                                // $temp = array($temp1,$temp2,$temp3);
                                // array_push($temp, $temp1,$temp2,$temp3);
                                // echo $temp1."#".$temp2."#".$temp3."<br>";
                                $keanggotaan[] = array(0=>$temp1,1=>$temp2,2=>$temp3);
                              }
                            }
                            // var_dump($keanggotaan);
                            // End Generate Random U

                            $miu_kuadrat = array(array());
                            $miu_kuadrat_x = array(array(array()));
                            $total_miu_kuadrat = array();
                            $total_miu_kuadrat_x = array(array());
                            $pusat_cluster = array(array());
                            $X_V = array(array());
                            $L = array(array());
                            $total_L = array();
                            $LT = array(array());
                            $total_LT = array();
                            
                            $ketemu = false;

                            for ($iterasi = 0; $iterasi < $maksIterasi; $iterasi++) {
                              echo ("<br/><br/> -- ITERASI -- : " . ($iterasi+1) . "<br/><br/>");
            
                              for ($i = 0; $i < $jmlData; $i++) {
                                  $h = 0;
                                  for ($c = 0; $c < $jmlCluster; $c++) {
                                      $h += $keanggotaan[$i][$c];
                                      //echo ("Keanggotaan [" . $i . "][" . $c . "] :" . $keanggotaan[$i][$c] . "</br>");
                                  }
                                  //echo ("h [" . $i . "] : " . $h . "</br>");
                              }

                              echo "Keanggotaan : <br/><br/>";
                              tampiltabel($keanggotaan);
                                    echo "<br/><br/>";
                              
                                    $miu_kuadrat = array(array()); //new double[jmlCluster][jmlData];
                                    $total_miu_kuadrat = array(); //new double[jmlCluster];
                                    
                                    for ($c = 0; $c < $jmlCluster; $c++) {
                                        $total_miu_kuadrat[$c] = 0;
                                        for ($d = 0; $d < $jmlData; $d++) {
                                            $miu_kuadrat[$c][$d] = pow($keanggotaan[$d][$c], $pembobot); //$keanggotaan[$d][$c] * $keanggotaan[$d][$c];
                                            $total_miu_kuadrat[$c] = $total_miu_kuadrat[$c] + $miu_kuadrat[$c][$d];
                                            //echo("miu_kuadrat [" . $c . "][" . $d . "] :" . $miu_kuadrat[$c][$d] . "<br/>");
                                        }
                                    }

                              echo "Miu Kuadrat : <br/><br/>";
                              tampiltabel($miu_kuadrat);
                                    echo "<br/><br/>";
                              
                              echo "Total Miu Kuadrat : <br/><br/>";
                              tampilkolom($total_miu_kuadrat);
                                    echo "<br/><br/>";
                              
                              $miu_kuadrat_x = array(array(array())); //new double[jmlCluster][jmlData][jmlVariabel];
                              $total_miu_kuadrat_x = array(array()); //new double[jmlCluster][jmlVariabel];
                              
                              for ($c = 0; $c < $jmlCluster; $c++) {
                                  for ($d = 0; $d < $jmlData; $d++) {
                                      for ($v = 0; $v < $jmlVariabel; $v++) {
                                          $miu_kuadrat_x[$c][$d][$v] = $miu_kuadrat[$c][$d] * $data[$d][$v];
                                          $total_miu_kuadrat_x[$c][$v] = 0;
                                          //echo ("miu_kuadrat_x [" . $c . "][" . $d . "][" . $v . "] :" . $miu_kuadrat_x[$c][$d][$v] . "<br/>");
                                      }
                                  }
                          
                                  echo "Miu Kuadrat X ".($c+1)." : <br/><br/>";
                                  tampiltabel($miu_kuadrat_x[$c]);
                                  echo "<br/><br/>";
                              }

                              for ($c = 0; $c < $jmlCluster; $c++) {
                                  for ($d = 0; $d < $jmlData; $d++) {
                                      for ($v = 0; $v < $jmlVariabel; $v++) {
                                          $total_miu_kuadrat_x[$c][$v] = $total_miu_kuadrat_x[$c][$v] + $miu_kuadrat_x[$c][$d][$v]; 
                                      }
                                  }
                              }

                              echo "Total Miu Kuadrat X : <br/><br/>";
                              tampiltabel($total_miu_kuadrat_x);
                              echo "<br/><br/>";
                        
                              $pusat_cluster = array(array()); //new double[jmlCluster][jmlVariabel];
                              
                              for ($c = 0; $c < $jmlCluster; $c++) {
                                  for ($v = 0; $v < $jmlVariabel; $v++) {
                                      $pusat_cluster[$c][$v] = $total_miu_kuadrat_x[$c][$v] / $total_miu_kuadrat[$c]; 
                                      //echo ("pusat_cluster [" . $c . "][" . $v . "] :" + $pusat_cluster[$c][$v] . "<br/>");
                                  }
                              }

                              echo "Pusat Cluster : <br/><br/>";
                              tampiltabel($pusat_cluster);
                              echo "<br/><br/>";
                                    
                              $X_V = array(array()); //new double[jmlData][jmlCluster];
                              $L = array(array()); //new double[jmlData][jmlCluster];
                              $total_L = array(); //new double[jmlData];
                              
                              for ($c = 0; $c < $jmlCluster; $c++) {
                                  for ($d = 0; $d < $jmlData; $d++) {
                                      $X_V[$d][$c] = 0;
                                      for ($v = 0; $v < $jmlVariabel; $v++) {
                                          $X_V[$d][$c] = $X_V[$d][$c] + (($data[$d][$v] - $pusat_cluster[$c][$v]) * ($data[$d][$v] - $pusat_cluster[$c][$v]));
                                      }
                                  }
                              }

                              echo "X_V : <br/><br/>";
                              tampiltabel($X_V);
                              echo "<br/><br/>";
                                    
                              $fungsi_objective = 0;
                              
                              for ($d = 0; $d < $jmlData; $d++) {
                                  $total_L[$d] = 0;
                                  for ($c = 0; $c < $jmlCluster; $c++) {
                                      $L[$d][$c] = $X_V[$d][$c] * $miu_kuadrat[$c][$d];
                                      $total_L[$d] = $total_L[$d] + $L[$d][$c];
                                      //echo ("L [" . $d . "][" . $c . "] :" . $L[$d][$c] . "<br/>");
                                  }
                                  //echo ("Total L [" . $d . "] :" . $total_L[$d] . "<br/>");
                                $fungsi_objective = $fungsi_objective + $total_L[$d];   
                              }

                              echo "L : <br/><br/>";
                              tampiltabel($L);
                              echo "<br/><br/>";

                              
                              echo "Total L : <br/><br/>";
                              tampilkolom($total_L);
                              echo "<br/><br/>";
                                    
                              echo "Fungsi Objective = ".$fungsi_objective;
                              echo "<br/><br/>";
                                    
                              $LT = array(array()); //new double[jmlData][jmlCluster];
                              $total_LT = array(); //new double[jmlData];

                              for ($d = 0; $d < $jmlData; $d++) {
                                $total_LT[$d] = 0;
                                for ($c = 0; $c < $jmlCluster; $c++) {
                                    $LT[$d][$c] = (pow($X_V[$d][$c], (-1/($pembobot - 1)))); // * pow(10, 14);
                                    $total_LT[$d] = $total_LT[$d] + $LT[$d][$c];
                                    //echo ("LT [" . $d . "][" . $c . "] :" . $LT[$d][$c] . "<br/>");
                                }
                                //echo ("total_LT [" . $d . "] :" . $total_LT[$d] . "<br/>");
                              }

                              echo "LT : <br/><br/>";
                              tampiltabel($LT);
                              echo "<br/><br/>";
                              
                              echo "Total LT : <br/><br/>";
                              tampilkolom($total_LT);
                              echo "<br/><br/>";

                              
                              for ($d = 0; $d < $jmlData; $d++) {
                                  for ($c = 0; $c < $jmlCluster; $c++) {
                                      $keanggotaan[$d][$c] = ($LT[$d][$c] / $total_LT[$d]);
                                     // echo ("keanggotaan baru [" . $d . "][" . $c . "] :" . $keanggotaan[$d][$c] . "<br/>");
                                  }
                              }

                              echo "Keanggotaan Baru : <br/><br/>";
                              tampiltabel($keanggotaan);
                              echo "<br/><br/>";

                              $selisih_fungsi_objective = abs($fungsi_objective - $fungsi_objective_terakhir);

                              echo "Selisih Fungsi Objective = abs($fungsi_objective - $fungsi_objective_terakhir) = ".$selisih_fungsi_objective ;
                              echo "<br/><br/>";

                              $fungsi_objective_terakhir = $fungsi_objective;
                              if ($selisih_fungsi_objective <= $epsilon) {
                                $ketemu = true;
                                break;
                              } else {
                                $ketemu = false;
                              }
                            }
                            // End Perhitungan
                          ?>
                        </div>
                        <br>
                        <input class="btn btn-success" type="button" value="Perhitungan" onclick="document.getElementById('perhitungan').style.display='block';"/>
                        <br>

                        <?php
                        if ($ketemu == true) {
                            echo "<br/>";
                            echo "Hasil Didapatkan, Selisih Fungsi Objective Sudah Tidak Lebih Besar dari Selisih Fungsi Objective yang diharapkan";
                            echo "<br/>";
                            echo "<br/>";
                            echo "Keanggotaan Cluster Akhir";
                            echo "<br/>";
                            echo "<br/>";
                            echo "<table width=\"900\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\" bgcolor=\"#000099\">";
                            echo "<tr>";
                            echo "<td bgcolor=\"#FFFFFF\">Nomor</td>";
                            echo "<td bgcolor=\"#FFFFFF\">Nama</td>";
                            echo "<td bgcolor=\"#FFFFFF\">Keanggotaan</td>";
                            
                            echo "</tr>";
                            // mysqli_query($koneksi,"DELETE FROM hasil where periode = '".$periode."'") or die(mysqli_error());
                            // $this->db->query("DELETE FROM hasil where Nomor = '".$Nomor."'");
                            $this->db->query("update hasil set Sts = 0 where Sts = 1");
                            for ($d = 0; $d < $jmlData; $d++) {
                              $terkecil = 0;
                              $anggota[$d] = '';
                                    for ($c = 0; $c < $jmlCluster; $c++) {
                                      if ($c == 0) {
                                        $terkecil = $keanggotaan[$d][$c];
                                        $anggota[$d] = 'C'.($c+1);
                                      } else {
                                        if ($terkecil < $keanggotaan[$d][$c]) {
                                          $terkecil = $keanggotaan[$d][$c];
                                          $anggota[$d] = 'C'.($c+1);
                                        }
                                      }
                                    }
                              // insert ke db nm,anggota
                              
                              // mysqli_query($koneksi,"INSERT INTO hasil values('".$alternatif[$d]."', '".$anggota[$d]."','".$periode."')") or die(mysql_error());
                              $this->db->query("INSERT INTO hasil values('".$Nomor."','".$alternatif[$d]."','".$anggota[$d]."',1)");

                              echo "<tr>";
                              echo "<td bgcolor=\"#FFFFFF\" >".$Nomor."</td>";
                              echo "<td bgcolor=\"#FFFFFF\" >".$alternatif[$d]."</td>";
                              echo "<td bgcolor=\"#FFFFFF\" >".$anggota[$d]."</td>";
                              
                              echo "</tr>";
                            }
                                echo "<tr>";
                              echo "<td>Keterangan</td>";
                              echo "<td>&nbsp;</td>";
                              echo "</tr>";
                              echo "<tr>";
                              echo "<td>C1 :  <img src= '".base_url()."Assets/nodemaker/assets/marker/asal.png'></td>";
                              echo "<td></td>";
                              echo "</tr>";
                              echo "<tr>";
                              echo "<td>C2 :  <img src= '".base_url()."Assets/nodemaker/assets/marker/tujuan.png'></td>";
                              echo "<td></td>";
                              echo "</tr>";
                            echo "</table>";
                          }
                          else {
                            echo "Perhitungan Belum Mendapatkan Hasil Akhir, Rasio Masih Lebih Besar dari Rasio Sebelumnya, Silakan Dicoba Iterasi Lebih Banyak Lagi";
                          }
                        ?>

                        <?php 
                        }
                        ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php
                if (isset($_POST['button'])){
              ?>
              <div class="row">
                <div class="col-md-12 col-sm-12  ">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Hasil Pemetaan</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <input type="hidden" name="Alamat" id="Alamat">
                      <div id="map-canvas" style="width:100%;height: 400px;"></div>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              }
              ?>
          </div>
        </div>
        <!-- /page content -->
<?php
  require_once(APPPATH."views/parts/Footer.php");
?>
<!-- <script src="assets/jQUery/jquery-3.2.1.min.js" type="text/javascript"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCG7FscIk67I9yY_fiyLc7-_1Aoyerf96E&libraries=places&callback=initMap"
         async defer></script>
<script src="<?php echo base_url() ?>Assets/nodemaker/assets/webGisTool-V3.js" type="text/javascript"></script>
<script type="text/javascript">
  $(function () {
        $(document).ready(function () {
          var where_field = '';
          var where_value = '';
          var table = 'users';

          $.ajax({
            type: "post",
            url: "<?=base_url()?>C_Proses/read",
            data: {'id':''},
            dataType: "json",
            success: function (response) {
              bindGrid(response.data);
            }
          });
        });
        $('.close').click(function() {
          location.reload();
        });
    function GetData(id) {
      var where_field = 'id';
      var where_value = id;
      var table = 'users';
      $.ajax({
            type: "post",
            url: "<?=base_url()?>C_JenisUsaha/read",
            data: {'id':id},
            dataType: "json",
            success: function (response) {
              $.each(response.data,function (k,v) {
                console.log(v.KelompokUsaha);
                $('#JenisUsaha').val(v.JenisUsaha);

                $('#id').val(v.ID);
                $('#formtype').val("edit");

                $('#modal_').modal('show');
              });
            }
          });
    }
    function bindGrid(data) {

      $("#gridContainer").dxDataGrid({
        allowColumnResizing: true,
            dataSource: data,
            keyExpr: "ID",
            showBorders: true,
            allowColumnReordering: true,
            allowColumnResizing: true,
            columnAutoWidth: true,
            showBorders: true,
            paging: {
                enabled: false
            },
            searchPanel: {
                visible: true,
                width: 240,
                placeholder: "Search..."
            },
            export: {
                enabled: true,
                fileName: "Daftar Jenis Usaha"
            },
            columns: [
                {
                    dataField: "ID",
                    caption: "#",
                    allowEditing:false
                },
                {
                    dataField: "NamaPerusahaa",
                    caption: "Nama UMKM",
                    allowEditing:false
                },
                {
                    dataField: "Aset",
                    caption: "Nilai Aset",
                    allowEditing:false
                },
                {
                    dataField: "OmsetperTahun",
                    caption: "Omset per Tahun",
                    allowEditing:false
                },
                {
                    dataField: "JumlahTenagaKerja",
                    caption: "Jumlah Tenaga Kerja",
                    allowEditing:false
                },
            ],
            onEditingStart: function(e) {
                GetData(e.data.ID);
            },
            onInitNewRow: function(e) {
                // logEvent("InitNewRow");
                $('#modal_').modal('show');
            },
            onRowInserting: function(e) {
                // logEvent("RowInserting");
            },
            onRowInserted: function(e) {
                // logEvent("RowInserted");
                // alert('');
                // console.log(e.data.onhand);
                // var index = e.row.rowIndex;
            },
            onRowUpdating: function(e) {
                // logEvent("RowUpdating");
                
            },
            onRowUpdated: function(e) {
                // logEvent(e);
            },
            onRowRemoving: function(e) {
              id = e.data.ID;
              Swal.fire({
                title: 'Apakah anda yakin?',
                text: "anda akan menghapus data di baris ini !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.value) {
                  var table = 'app_setting';
                  var field = 'id';
                  var value = id;

                  $.ajax({
                      type    :'post',
                      url     : '<?=base_url()?>C_JenisUsaha/CRUD',
                      data    : {'id':id,'formtype':'delete'},
                      dataType: 'json',
                      success : function (response) {
                        if(response.success == true){
                          Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      ).then((result)=>{
                            location.reload();
                          });
                        }
                        else{
                          Swal.fire({
                            type: 'error',
                            title: 'Woops...',
                            text: response.message,
                            // footer: '<a href>Why do I have this issue?</a>'
                          }).then((result)=>{
                            location.reload();
                          });
                        }
                      }
                    });
                  
                }
                else{
                  location.reload();
                }
              })
            },
            onRowRemoved: function(e) {
              // console.log(e);
            },
        onEditorPrepared: function (e) {
          // console.log(e);
        }
        });

        // add dx-toolbar-after
        // $('.dx-toolbar-after').append('Tambah Alat untuk di pinjam ');
    }
  });
</script>