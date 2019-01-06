<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dipacommerce</title>

    <!-- Bootstrap Core CSS -->
    <link href="/public/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/public/admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="/public/admin/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="/public/admin/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/public/admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/public/admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    @include('admin.nav')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Groups</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: right">
                        <a data-toggle="modal" data-target="#addModal" href="javascript:void(0);">
                            <i style="cursor: pointer" class="fa fa-2x fa-plus-square" aria-hidden="true"></i>
                        </a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover"
                               id="dataTables">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Type</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($idx = 0; $idx < count($groups); $idx++)
                                @if($idx % 2 == 0)
                                    <tr class="odd gradeX">
                                @else
                                    <tr class="even gradeC">
                                        @endif
                                        <td>{{$groups[$idx]->id}}</td>
                                        <td>{{$groups[$idx]->code}}</td>
                                        <td>{{$groups[$idx]->content}}</td>
                                        <td style="text-align: center"><img src="/{{$groups[$idx]->image}}"/></td>
                                        <td>{{$groups[$idx]->type['content']}}</td>
                                        <td>{{$groups[$idx]->created_at}}</td>
                                        <td>
                                            <a class="btn-edit-item" data-id="{{$groups[$idx]->id}}"
                                               href="javascript:void(0);"><i class="fa-2x glyphicon glyphicon-edit"></i></a>
                                            <a class="btn-del-item" data-id="{{$groups[$idx]->id}}"
                                               href="javascript:void(0);"><i
                                                    class="fa-2x glyphicon glyphicon-remove"></i></a>
                                        </td>
                                    </tr>
                                    @endfor
                            </tbody>
                        </table>

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <!-- /#page-wrapper -->
</div>
<script>
    var datas = <?php echo json_encode($groups); ?>;
</script>
<div class="modal fade" id="addModal" role="dialog">
    <div class="modal-dialog" style="width: fit-content;">
        <form id="id_add" action="/admin/groups/add" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Code</label>
                        <input class="form-control add-code" name="add-code" placeholder="001"/>
                    </div>
                    <div class="form-group">
                        <label>Belong to</label>
                        <select name="add-id-type" class="form-control add-id-type">
                            <option value="-1">Please choose</option>
                            @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->content}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control add-name" name="add-name" placeholder="Name"/>
                    </div>
                    <div class="form-group">
                        <div style="text-align: center">
                            <img src="/public/admin/image/noimage.jpg" class="img-rounded add-img"
                                 id="addImgpreview" height="180" width="444">
                        </div>
                        <label class="btn btn-default" style="width: 100%">
                            Browse<input name="add-img" style="display: none;" type="file" accept="image/*"
                                         class="form-control" placeholder="Link"
                                         onchange="onFileAddSelected(event)"/>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-add">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog" style="width: fit-content;">
        <form id="id_edit" action="/admin/groups/edit" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Code</label>
                        <input class="form-control edit-code" name="edit-code" placeholder="001"/>
                    </div>
                    <div class="form-group">
                        <label>Belong to</label>
                        <select name="edit-id-type" class="form-control edit-id-type">
                            <option value="-1">Please choose</option>
                            @foreach($types as $type)
                                <option class="edit-id-type-{{$type->id}}" value="{{$type->id}}">{{$type->content}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control edit-name" name="edit-name" placeholder="Name"/>
                    </div>
                    <div class="form-group">
                        <div style="text-align: center">
                            <img src="/public/admin/image/noimage.jpg" class="img-rounded edit-img"
                                 id="editImgpreview" height="180" width="444">
                        </div>
                        <label class="btn btn-default" style="width: 100%">
                            Browse<input name="edit-img" style="display: none;" type="file" accept="image/*"
                                         class="form-control" placeholder="Link"
                                         onchange="onFileEditSelected(event)"/>
                        </label>
                    </div>
                    <input style="display: none;" class="form-control edit-id" name="edit-id"/>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-edit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
     id="deleteModal">
    <div class="modal-dialog modal-sm">
        <form id="id_del" action="/admin/groups/del" method="post" enctype="multipart/form-data">
            @csrf
            <input style="display: none" name="del-id" class="del-id"/>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Confirm</h4>
                </div>
                <div class="modal-body">
                    <span>Are you sure you want to delete <b class="del-name"></b>?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-delete">Yes</button>
                    <button type="button" data-dismiss="modal" class="btn btn-default">No</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- /#wrapper -->

<!-- jQuery -->
<script src="/public/admin/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/public/admin/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="/public/admin/vendor/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="/public/admin/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="/public/admin/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="/public/admin/vendor/datatables-responsive/dataTables.responsive.js"></script>

<!-- Custom Theme JavaScript -->
<script src="/public/admin/dist/js/sb-admin-2.js"></script>
<script src="/public/admin/js/message.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    function getData(id) {
        for (let i = 0; i < datas.length; i++) {
            if (datas[i].id == id) {
                return datas[i];
            }
        }
        return null;
    }

    $(document).ready(function () {
        $('#dataTables').DataTable({
            responsive: true
        });

        $('#addModal').on('shown.bs.modal', function () {
            $('#id_add').trigger("reset");
            $('#id_add').find("img").attr('src', '/public/admin/image/noimage.jpg');
        });

        $(".btn-add").on('click', function (event) {
            let name = $('.add-name').val();
            let code = $('.add-code').val();
            let id_type = $('.add-id-type').val();
            let imgsrc = $('.add-img').attr('src');

            if (code === "") {
                showMessage(codeRequired);
                return;
            }

            if (id_type == -1) {
                showMessage(typeRequired);
                return;
            }

            if (name === "") {
                showMessage(nameRequired);
                return;
            }

            if (imgsrc === "/public/admin/image/noimage.jpg") {
                showMessage(imageRequired);
                return;
            }

            $("#id_add").submit();
        });

        $('#dataTables').on('click', '.btn-edit-item', function (event) {
            let id = $(this).attr('data-id');
            let data = getData(id);
            $('.edit-name').val(data.content);
            $('.edit-id-type').find('option').removeAttr("selected") ;
            $('.edit-id-type-'+data.id_type).attr('selected','selected');
            $('.edit-code').val(data.code);
            $('.edit-img').attr('src', "/" + data.image);
            $('.edit-id').val(data.id);
            $('#editModal').modal('show');
        });

        $('.btn-edit').on('click', function (event) {
            let code = $('.edit-code').val();
            let name = $('.edit-name').val();

            if (code === "") {
                showMessage(codeRequired);
                return;
            }

            if (name === "") {
                showMessage(nameRequired);
                return;
            }

            $("#id_edit").submit();
        });

        $('#dataTables').on('click', '.btn-del-item', function (event) {
            let id = $(this).attr('data-id');
            let data = getData(id);
            $('.del-id').val(id);
            $('.del-name').html(data.content);
            $('#deleteModal').modal('show');
        });

        $('.btn-delete').on('click', function (event) {
            $('#id_del').submit();
        });
    });

    function onFileAddSelected(event) {
        var selectedFile = event.target.files[0];
        var reader = new FileReader();

        var imgtag = document.getElementById("addImgpreview");
        imgtag.title = selectedFile.name;

        reader.onload = function (event) {
            imgtag.src = event.target.result;
        };

        reader.readAsDataURL(selectedFile);
    }

    function onFileEditSelected(event) {
        var selectedFile = event.target.files[0];
        var reader = new FileReader();

        var imgtag = document.getElementById("editImgpreview");
        imgtag.title = selectedFile.name;

        reader.onload = function (event) {
            imgtag.src = event.target.result;
        };

        reader.readAsDataURL(selectedFile);
    }
</script>
@if(isset($message))
    <script>
        showMessage("{{$message->getContent()}}");
    </script>
@endif
</body>

</html>
