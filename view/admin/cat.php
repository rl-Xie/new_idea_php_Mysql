<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>这个天才又来啦❤️</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
</head>
<body>
<h1>分类管理业</h1>
<form id ="list">
    <input type="hidden" name="id">
    <input type="text" placeholder="title" name="title">
    <button type="submit">提交</button>
</form>
<br>
<div id="show_data">
    <table  class="table table-hover">
        <thead>
        <th>ID</th>
        <th>标题</th>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<div class="f-page">
    <nav aria-label="Page navigation">
        <ul class="pager">
            <li class="top-one"><a href="#">上一页</a></li>
            <li class="next-one"><a href="#">下一页</a></li>
        </ul>
    </nav>
</div>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
<script src="/js/util/fundation.js"></script>
<script src="/js/admin/model_api.js"></script>
<script src="/js/admin/model_ui.js"></script>
<script src="/js/admin/cat.js"></script>
</body>
</html>