<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>这个天才又来啦❤️</title>
</head>
<body>
<h1>主页</h1>
<div class="nav">
    <?php if (logged_in()): ?>
        <a href="/logout">登出</a>
    <?php else: ?>
        <a href="/login">登录</a>
        <a href="/signup">注册</a>
    <?php endif; ?>
</div>
<?php echo logged_in() ? his('username') : '游客' ?>你好
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
<script src="/js/util/fundation.js"></script>
<script src="js/public/home.js"></script>
</body>
</html>