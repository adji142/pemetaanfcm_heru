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
                    <h2>Input UMKM</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form id="post_" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Perusahaan <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <input type="text" name="NamaPerusahaa" id="NamaPerusahaa" required="" placeholder="Nama Perusahaan" class="form-control ">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="formtype" id="formtype" value="add">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Pemilik <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <input type="text" name="NamaPemilik" id="NamaPemilik" required="" placeholder="Nama Pemilik" class="form-control ">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Alamat<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <input type="text" name="Alamat" id="Alamat" required="" placeholder="Alamat" class="form-control ">
                            <!-- <br>
                            <input type="hidden" name="GPS" id="GPS"> -->
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Koordinat<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <input type="text" name="GPS" id="GPS" required="" placeholder="Koordinat" class="form-control ">
                            <!-- <br>
                            <input type="hidden" name="GPS" id="GPS"> -->
                          </div>
                        </div>
                        <div class="item form-group">
                          <div class="col-md-12 col-sm-12 ">
                            <!-- <input id="pac-input" class="controls" type="text" placeholder="Search Box"> -->
                            <div id="map-canvas" style="width:100%;height: 400px;"></div>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jenis Usaha <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <select class="form-control" id="JenisUsaha" name="JenisUsaha">
                              <?php
                                $rs = $this->db->query("select * from tjenisusaha order by ID")->result();
                                foreach ($rs as $key) {
                                  echo "<option value = '".$key->ID."'>".$key->JenisUsaha."</option>";
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pemasaran <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <select class="form-control" id="Pemasaran" name="Pemasaran">
                              <option value="Regional">Regional</option>
                              <option value="Lokal">Lokal</option>
                            </select>
                          </div>
                        </div>
                        <div class="item" form-group>
                          <button class="btn btn-primary" id="btn_Save">Save</button>
                        </div>
                      </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar UMKM</h2>
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
          </div>
        </div>
        <!-- /page content -->

        <div class="modal fade bs-example-modal-lg" role="dialog" aria-hidden="true" id="modal_">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                
              </div>

              <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
              </div> -->

            </div>
          </div>
        </div>
<?php
  require_once(APPPATH."views/parts/Footer.php");
?>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCG7FscIk67I9yY_fiyLc7-_1Aoyerf96E&sensor=false&libraries=places" async defer></script> -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=AIzaSyCG7FscIk67I9yY_fiyLc7-_1Aoyerf96E"></script>
<script type="text/javascript">
   function init() {
   var map = new google.maps.Map(document.getElementById('map-canvas'), {
     center: {
       lat: -7.5591225,
       lng: 110.7837923
     },
     zoom: 12,
     options: {
        gestureHandling: 'greedy'
      }
   });


   var searchBox = new google.maps.places.SearchBox(document.getElementById('Alamat'));
   // map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('pac-input'));
   google.maps.event.addListener(searchBox, 'places_changed', function() {
     searchBox.set('map', null);


     var places = searchBox.getPlaces();

     var bounds = new google.maps.LatLngBounds();
     var i, place;
     for (i = 0; place = places[i]; i++) {
       (function(place) {
         var marker = new google.maps.Marker({

           position: place.geometry.location
         });
         marker.bindTo('map', searchBox, 'map');
         google.maps.event.addListener(marker, 'map_changed', function() {
           if (!this.getMap()) {
             this.unbindAll();
           }
         });
         bounds.extend(place.geometry.location);
         // console.log(place.geometry.location);
       }(place));

     }
     map.fitBounds(bounds);
     console.log(bounds);
     searchBox.set('map', map);
     map.setZoom(Math.min(map.getZoom(),12));

     map.addListener('click', function(e) {
        //console.log(e);
        addMarker(e.latLng);
      });

     GetLatlong();
   });
 }
 function GetLatlong() {
  var geocoder = new google.maps.Geocoder();
  var address = document.getElementById('Alamat').value;

  geocoder.geocode({
    'address': address
  }, function(results, status) {

    if (status == google.maps.GeocoderStatus.OK) {
      var latitude = results[0].geometry.location.lat();
      var longitude = results[0].geometry.location.lng();

      console.log(latitude);
      console.log(longitude);

      $('#GPS').val(""+latitude+","+longitude+"");
      // document.getElementById('GPS').value(""+latitude+","+longitude)
    }
  });
}

function codeAddress(address) {

    geocoder.geocode({ 'address': address }, function (results, status) {
        console.log(results);
        var latLng = {lat: results[0].geometry.location.lat (), lng: results[0].geometry.location.lng ()};
        console.log (latLng);
        if (status == 'OK') {
            var marker = new google.maps.Marker({
                position: latLng,
                map: map
            });
            console.log (map);
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}
  function addMarker(latLng) {
    let marker = new google.maps.Marker({
        map: map,
        position: latLng,
        draggable: true
    });
  }
 google.maps.event.addDomListener(window, 'load', init);
  $(function () {
        $(document).ready(function () {
          var where_field = '';
          var where_value = '';
          var table = 'users';

          $.ajax({
            type: "post",
            url: "<?=base_url()?>C_UMKM/read",
            data: {'id':''},
            dataType: "json",
            success: function (response) {
              bindGrid(response.data);
            }
          });

        });
        $('#post_').submit(function (e) {
          $('#btn_Save').text('Tunggu Sebentar.....');
          $('#btn_Save').attr('disabled',true);

          e.preventDefault();
          var me = $(this);
          // alert($('#GPS').val());
          if ($('#GPS').val() != '') {
            $.ajax({
                type    :'post',
                url     : '<?=base_url()?>C_UMKM/CRUD',
                data    : me.serialize(),
                dataType: 'json',
                success : function (response) {
                  if(response.success == true){
                    // $('#modal_').modal('toggle');
                    Swal.fire({
                      type: 'success',
                      title: 'Horay..',
                      text: 'Data Berhasil disimpan!',
                      // footer: '<a href>Why do I have this issue?</a>'
                    }).then((result)=>{
                      location.reload();
                    });
                  }
                  else{
                    // $('#modal_').modal('toggle');
                    Swal.fire({
                      type: 'error',
                      title: 'Woops...',
                      text: response.message,
                      // footer: '<a href>Why do I have this issue?</a>'
                    }).then((result)=>{
                      // $('#modal_').modal('show');
                      $('#btn_Save').text('Save');
                      $('#btn_Save').attr('disabled',false);
                    });
                  }
                }
              });
          }
          else{
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: 'Alamat Tidak Valid',
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              // $('#modal_').modal('show');
              $('#btn_Save').text('Save');
              $('#btn_Save').attr('disabled',false);
            });
          }
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
            url: "<?=base_url()?>C_UMKM/read",
            data: {'id':id},
            dataType: "json",
            success: function (response) {
              $.each(response.data,function (k,v) {
                console.log(v.KelompokUsaha);
                $('#NamaPerusahaa').val(v.NamaPerusahaa);
                $('#NamaPemilik').val(v.NamaPemilik);
                $('#Alamat').val(v.Alamat);
                $('#GPS').val(v.GPS);
                $('#JenisUsaha').val(v.JenisUsaha).change();
                $('#Pemasaran').val(v.Pemasaran).change();

                $('#id').val(v.ID);
                $('#formtype').val("edit");

                // $('#modal_').modal('show');
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
            editing: {
                mode: "row",
                allowAdding:true,
                allowUpdating: true,
                allowDeleting: true,
                texts: {
                    confirmDeleteMessage: ''  
                }
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
                    caption: "Nama Perusahaan",
                    allowEditing:false
                },
                {
                    dataField: "NamaPemilik",
                    caption: "Nama Pemilik",
                    allowEditing:false
                },
                {
                    dataField: "Alamat",
                    caption: "Alamat",
                    allowEditing:false
                },
                {
                    dataField: "GPS",
                    caption: "GPS",
                    allowEditing:false
                },
                {
                    dataField: "NamaJenisUsaha",
                    caption: "Jenis Usaha",
                    allowEditing:false
                },
                {
                    dataField: "Pemasaran",
                    caption: "Pemasaran",
                    allowEditing:false
                },
            ],
            onEditingStart: function(e) {
                GetData(e.data.ID);
            },
            onInitNewRow: function(e) {
                // logEvent("InitNewRow");
                // $('#modal_').modal('show');
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
                      url     : '<?=base_url()?>C_UMKM/CRUD',
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