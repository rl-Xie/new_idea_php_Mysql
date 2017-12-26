<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>这个天才又来啦❤️</title>
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    <style>
        .table-hover img{
            width: 50px;
        }
    </style>
</head>
<body>
<h1>商品管理业</h1>
<form id="list">
    <input type="hidden" name="id">
    <input type="text" placeholder="title" name="title">
    <input type="text" placeholder="price" name="price">
    <input type="text" placeholder="sales" name="sales">
    <select name="cat_id" id="cat_select_list"></select>
    <input type="file" placeholder="文件" name="cover_path">
    <button type="submit">提交</button>
</form>
<br>
<div id="show_data">
    <table class="table table-hover">
        <thead>
        <th>ID</th>
        <th>标题</th>
        <th>价格</th>
        <th>分类</th>
        <th>销量</th>
        <th>图片</th>
        <th>操作</th>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
<script src="/js/util/fundation.js"></script>
<script src="/js/admin/model_api.js"></script>
<script src="/js/admin/model_ui.js"></script>
<script src="/js/admin/product.js"></script>
</body>
</html>