<?php ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- 引入样式 -->
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-default/index.css">
</head>
<body>
<div id="app">
    <el-row>
        <el-col :span="24"><div class="grid-content bg-purple-dark"></div></el-col>
    </el-row>
    <el-row>
        <el-col :span="4">
            <?php $this->insert('sidebar');?>
        </el-col>
        <el-col :span="20">
            <?php $this->section('content');?>
        </el-col>
    </el-row>
</div>
</body>
<!-- 先引入 Vue -->
<script src="https://unpkg.com/vue/dist/vue.js"></script>
<!-- 引入组件库 -->
<script src="https://unpkg.com/element-ui/lib/index.js"></script>
<?=$this->section('js')?>
<script>
    new Vue({
        el: '#app',
        data: function() {
            return { visible: false }
        }
    })
</script>
</html>