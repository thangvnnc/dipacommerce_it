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
                <h1 class="page-header">Products</h1>
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
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Content</th>
                                <th>Status</th>
                                <th>Group Item</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($idx = 0; $idx < count($items); $idx++)
                                @if($idx % 2 == 0)
                                    <tr class="odd gradeX">
                                @else
                                    <tr class="even gradeC">
                                        @endif
                                        <td>{{$items[$idx]->id}}</td>
                                        <td style="text-align: center"><img src="/{{$items[$idx]->image}}"/></td>
                                        <td>{{$items[$idx]->code}}</td>
                                        <td>{{$items[$idx]->name}}</td>
                                        <td>{{$items[$idx]->price}}</td>
                                        <td>
                                            <pre>{{$items[$idx]->content}}</pre>
                                        </td>
                                        <td>{{$items[$idx]->getStatusString()}}</td>
                                        <td>{{$items[$idx]->group_item->content}}</td>
                                        <td>{{$items[$idx]->created_at}}</td>
                                        <td>
                                            <a class="btn-edit-item" data-id="{{$items[$idx]->id}}"
                                               href="javascript:void(0);"><i class="fa-2x glyphicon glyphicon-edit"></i></a>
                                            <a class="btn-del-item" data-id="{{$items[$idx]->id}}"
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
<!-- /#wrapper -->

<script>
    var datas = <?php echo json_encode($items); ?>;
</script>

<div class="modal fade" id="addModal" role="dialog">
    <div class="modal-dialog" style="width: fit-content;">
        <form id="id_add" action="/admin/items/add" method="post" enctype="multipart/form-data">
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
                        <label>Name</label>
                        <input class="form-control add-name" name="add-name" placeholder="Name"/>
                    </div>
                    <div class="form-group">
                        <label>Belong to</label>
                        <select name="add-id-group_item" class="form-control add-id-group_item">
                            <option value="-1">Please choose</option>
                            @foreach($group_items as $group_item)
                                <option value="{{$group_item->id}}">{{$group_item->content}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label>Price</label>
                            <input class="form-control add-price" name="add-price" placeholder="0"/>
                        </div>
                        <div class="col-md-6">
                            <label>Status</label>
                            <select name="add-status" class="form-control add-status">
                                <option value="-1">Please choose</option>
                                <option value="0">Add to Cart</option>
                                <option value="1">Not Available</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="add-content" style="resize: none;" class="form-control add-content"
                                  rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <div style="text-align: center">
                            <img src="/public/admin/image/noimage.jpg" class="img-rounded add-img-product"
                                 id="addImgpreviewProduct" height="200" width="200">
                            <img src="/public/admin/image/noimage.jpg" class="img-rounded add-img-equipementier"
                                 id="addImgpreviewEquipementier" height="50" width="100">
                        </div>
                        <div style="text-align: center">
                            <label class="btn btn-default" style="width: 200px">
                                Image product<input name="add-img-product" style="display: none;" type="file"
                                                    accept="image/*"
                                                    class="form-control" placeholder="Link"
                                                    onchange="onFileAddSelectedProduct(event)"/>
                            </label>
                            <label class="btn btn-default" style="width: 100px">
                                Logo<input name="add-img-equipementier" style="display: none;" type="file"
                                           accept="image/*"
                                           class="form-control" placeholder="Link"
                                           onchange="onFileAddSelectedEquipementier(event)"/>
                            </label>
                        </div>
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
        <form id="id_edit" action="/admin/items/edit" method="post" enctype="multipart/form-data">
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
                        <label>Name</label>
                        <input class="form-control edit-name" name="edit-name" placeholder="Name"/>
                    </div>
                    <div class="form-group">
                        <label>Belong to</label>
                        <select name="edit-id-group_item" class="form-control edit-id-group_item">
                            <option value="-1">Please choose</option>
                            @foreach($group_items as $group_item)
                                <option class="edit-id-group_item-{{$group_item->id}}"
                                        value="{{$group_item->id}}">{{$group_item->content}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label>Price</label>
                            <input class="form-control edit-price" name="edit-price" placeholder="0"/>
                        </div>
                        <div class="col-md-6">
                            <label>Status</label>
                            <select name="edit-status" class="form-control edit-status">
                                <option value="-1">Please choose</option>
                                <option class="edit-status-1" value="0">Add to Cart</option>
                                <option class="edit-status-2" value="1">Not Available</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="edit-content" style="resize: none;" class="form-control edit-content"
                                  rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <div style="text-align: center">
                            <img src="/public/admin/image/noimage.jpg" class="img-rounded edit-img-product"
                                 id="editImgpreviewProduct" height="200" width="200">
                            <img src="/public/admin/image/noimage.jpg" class="img-rounded edit-img-equipementier"
                                 id="editImgpreviewEquipementier" height="50" width="100">
                        </div>
                        <div style="text-align: center">
                            <label class="btn btn-default" style="width: 200px">
                                Image product<input name="edit-img-product" style="display: none;" type="file"
                                                    accept="image/*"
                                                    class="form-control" placeholder="Link"
                                                    onchange="onFileEditSelectedProduct(event)"/>
                            </label>
                            <label class="btn btn-default" style="width: 100px">
                                Logo<input name="edit-img-equipementier" style="display: none;" type="file"
                                           accept="image/*"
                                           class="form-control" placeholder="Link"
                                           onchange="onFileEditSelectedEquipementier(event)"/>
                            </label>
                        </div>
                        <input style="display: none;" class="form-control edit-id" name="edit-id"/>
                    </div>
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
        <form id="id_del" action="/admin/items/del" method="post" enctype="multipart/form-data">
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
    $(document).ready(function () {
        function getData(id) {
            for (let i = 0; i < datas.length; i++) {
                if (datas[i].id == id) {
                    return datas[i];
                }
            }
            return null;
        }

        $('#dataTables').DataTable({
            responsive: true
        });

        $('#addModal').on('shown.bs.modal', function () {
            $('#id_add').trigger("reset");
            $('#id_add').find(".add-img-product").attr('src', '/public/admin/image/noimage.jpg');
            $('#id_add').find(".add-img-equipementier").attr('src', '/public/admin/image/noimage.jpg');
        });

        $(".btn-add").on('click', function (event) {
            let name = $('.add-name').val();
            let code = $('.add-code').val();
            let price = $('.add-price').val();
            let status = $('.add-status').val();
            let content = $('.add-content').val();
            let id_group_item = $('.add-id-group_item').val();
            let imgsrcproduct = $('.add-img-product').attr('src');
            let imgsrcequipementier = $('.add-img-equipementier').attr('src');

            if (code === "") {
                showMessage(codeRequired);
                return;
            }

            if (id_group_item == -1) {
                showMessage(typeRequired);
                return;
            }

            if (status == -1) {
                showMessage(statusRequired);
                return;
            }

            if (name === "") {
                showMessage(nameRequired);
                return;
            }

            if (price === "") {
                showMessage(nameRequired);
                return;
            }

            if (content === "") {
                showMessage(contentRequired);
                return;
            }

            if (imgsrcproduct === "/public/admin/image/noimage.jpg" || imgsrcequipementier === "/public/admin/image/noimage.jpg") {
                showMessage(imageRequired);
                return;
            }

            $("#id_add").submit();
        });

        $('#dataTables').on('click', '.btn-edit-item', function (event) {
            let id = $(this).attr('data-id');
            let data = getData(id);
            $('.edit-name').val(data.name);
            $('.edit-content').val(data.content);
            $('.edit-price').val(data.price);
            $('.edit-id-group_item').find('option').removeAttr("selected");
            $('.edit-id-group_item-' + data.id_group_item).attr('selected', 'selected');
            $('.edit-statu').find('option').removeAttr("selected");
            $('.edit-status-' + (data.status + 1)).attr('selected', 'selected');
            $('.edit-code').val(data.code);
            $('.edit-img-product').attr('src', "/" + data.image);
            $('.edit-img-equipementier').attr('src', "/" + data.logo_equipementier);
            $('.edit-id').val(data.id);
            $('#editModal').modal('show');
        });

        $('.btn-edit').on('click', function (event) {
            let code = $('.edit-code').val();
            let name = $('.edit-name').val();
            let content = $('.edit-content').val();
            let price = $('.edit-price').val();

            if (code === "") {
                showMessage(codeRequired);
                return;
            }

            if (name === "") {
                showMessage(nameRequired);
                return;
            }

            if (price === "") {
                showMessage(nameRequired);
                return;
            }

            if (content === "") {
                showMessage(contentRequired);
                return;
            }

            $("#id_edit").submit();
        });

        $('#dataTables').on('click', '.btn-del-item', function (event) {
            let id = $(this).attr('data-id');
            let data = getData(id);
            $('.del-id').val(id);
            $('.del-name').html(data.name);
            $('#deleteModal').modal('show');
        });

        $('.btn-delete').on('click', function (event) {
            $('#id_del').submit();
        });
    });

    function onFileAddSelectedProduct(event) {
        var selectedFile = event.target.files[0];
        var reader = new FileReader();

        var imgtag = document.getElementById("addImgpreviewProduct");
        imgtag.title = selectedFile.name;

        reader.onload = function (event) {
            imgtag.src = event.target.result;
        };

        reader.readAsDataURL(selectedFile);
    }

    function onFileAddSelectedEquipementier(event) {
        var selectedFile = event.target.files[0];
        var reader = new FileReader();

        var imgtag = document.getElementById("addImgpreviewEquipementier");
        imgtag.title = selectedFile.name;

        reader.onload = function (event) {
            imgtag.src = event.target.result;
        };

        reader.readAsDataURL(selectedFile);
    }

    function onFileEditSelectedProduct(event) {
        var selectedFile = event.target.files[0];
        var reader = new FileReader();

        var imgtag = document.getElementById("editImgpreviewProduct");
        imgtag.title = selectedFile.name;

        reader.onload = function (event) {
            imgtag.src = event.target.result;
        };

        reader.readAsDataURL(selectedFile);
    }

    function onFileEditSelectedEquipementier(event) {
        var selectedFile = event.target.files[0];
        var reader = new FileReader();

        var imgtag = document.getElementById("editImgpreviewEquipementier");
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
