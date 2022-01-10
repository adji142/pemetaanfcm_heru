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
                    <h2>Nilai</h2>
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

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Modal Nilai</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="post_" data-parsley-validate class="form-horizontal form-label-left">
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">UMKM <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                      <select id="KodeUMKM" name="KodeUMKM" class="form-control" required>
                        <?php
                          $rs = $this->db->query("select * from tumkm where id not in (select KodeUMKM from tnilai) order by ID")->result();
                          foreach ($rs as $key) {
                            echo "<option value = '".$key->ID."'>".$key->NamaPerusahaa."</option>";
                          }
                        ?>
                      </select>
                      <input type="hidden" name="id" id="id">
                      <input type="hidden" name="formtype" id="formtype" value="add">
                    </div>
                  </div>
                  <!-- <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kriteria <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                      <select id="KodeKriteria" name="KodeKriteria" class="form-control" required>
                        <?php
                          $rs = $this->db->query("select * from tkriteria order by ID")->result();
                          foreach ($rs as $key) {
                            echo "<option value = '".$key->ID."'>".$key->NamaKriteria."</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div> -->
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nilai Asset<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                      <input type="number" name="Nilai1" id="Nilai1" required="" placeholder="Nilai Asset" class="form-control ">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nilai Omset per Tahun<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                      <input type="number" name="Nilai2" id="Nilai2" required="" placeholder="Nilai Omset per Tahun" class="form-control ">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jumlah Tenaga Kerja <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                      <input type="number" name="Nilai3" id="Nilai3" required="" placeholder="Jumlah Tenaga Kerja" class="form-control ">
                    </div>
                  </div>
                  <div class="ite" form-group>
                    <button class="btn btn-primary" id="btn_Save">Save</button>
                  </div>
                </form>
              </div>
              <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
              </div> -->

            </div>
          </div>
        </div>

<!-- <div class="modal hide" id="modal_" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <div id="title_modal">Tambah Jenis Usaha
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </h5>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" enctype='application/json' id="post_">
          <div class="control-group">
            <label class="control-label">Jenis Usaha</label>
            <div class="controls">
              <input type="text" name="JenisUsaha" id="JenisUsaha" required="" placeholder="Jenis Usaha">
              <input type="hidden" name="id" id="id">
              <input type="hidden" name="formtype" id="formtype" value="add">
            </div>
          </div>
          <button class="btn btn-primary" id="btn_Save">Save</button>
        </form>
      </div>
    </div>
  </div>
</div> -->
<?php
  require_once(APPPATH."views/parts/Footer.php");
?>
<script type="text/javascript">
  $(function () {
        $(document).ready(function () {
          var where_field = '';
          var where_value = '';
          var table = 'users';

          $.ajax({
            type: "post",
            url: "<?=base_url()?>C_Nilai/read",
            data: {'id':''},
            dataType: "json",
            success: function (response) {
              bindGrid(response.data);
            }
          });
          // $.ajax({
          //   type: "post",
          //   url: "<?=base_url()?>Auth/Getindex",
          //   data: {'Kolom':'Indexs','Table':'tnilai','Prefix':'10'},
          //   dataType: "json",
          //   success: function (response) {
          //     // bindGrid(response.data);
          //     $('#id').val(response.nomor);
          //   }
          // });

        });
        $('#post_').submit(function (e) {
          $('#btn_Save').text('Tunggu Sebentar.....');
          $('#btn_Save').attr('disabled',true);

          e.preventDefault();
          var me = $(this);

          $.ajax({
                type    :'post',
                url     : '<?=base_url()?>C_Nilai/CRUD',
                data    : me.serialize(),
                dataType: 'json',
                success : function (response) {
                  if(response.success == true){
                    $('#modal_').modal('toggle');
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
                    $('#modal_').modal('toggle');
                    Swal.fire({
                      type: 'error',
                      title: 'Woops...',
                      text: response.message,
                      // footer: '<a href>Why do I have this issue?</a>'
                    }).then((result)=>{
                      $('#modal_').modal('show');
                      $('#btn_Save').text('Save');
                      $('#btn_Save').attr('disabled',false);
                    });
                  }
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
            url: "<?=base_url()?>C_Nilai/read",
            data: {'id':id},
            dataType: "json",
            success: function (response) {
              var index = 1
              $.each(response.data,function (k,v) {
                console.log(v.KelompokUsaha);
                $('#KodeUMKM').val(v.KodeUMKM).change();
                $('#KodeKriteria').val(v.KodeKriteria).change();
                if (index == 1) {
                  $('#Nilai1').val(v.Nilai);
                }
                else if (index == 2) {
                  $('#Nilai2').val(v.Nilai);
                }
                else if (index == 3) {
                  $('#Nilai3').val(v.Nilai);
                }
                $('#id').val(v.Indexs);
                $('#formtype').val("edit");
                index = index + 1;
              });
              $('#modal_').modal('show');
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
                    caption: "Nama UMKM",
                    allowEditing:false
                },
                {
                    dataField: "NamaKriteria",
                    caption: "Nama Kriteria",
                    allowEditing:false
                },
                {
                    dataField: "Nilai",
                    caption: "Nilai",
                    allowEditing:false
                },
            ],
            onEditingStart: function(e) {
                GetData(e.data.Indexs);
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
              id = e.data.Indexs;
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
                      url     : '<?=base_url()?>C_Nilai/CRUD',
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