<?php
    include 'header.php';
    include 'menu.php';
?>
<style>
    .ContentReplace .msg{
        padding: 5px;
        font-size: 16px;
        border-radius: 2px;
    }
    .ContentReplace code{
        color: red;
        background: #d1e8ff;
        padding: 2px 3px;
        margin: 0 3px;
        border-radius: 5px;
    }
</style>
<div class="main ContentReplace">
    <div class="body container">
        <div class="row">
            <div class="typecho-page-title">
                <h2>内容替换</h2>
            </div>
            <?php
            if (isset($_GET['xixinyanjiu'])) {
                if(empty($_POST['oldurl']) || empty($_POST['newurl'])){
                    echo '<div class="msg error">输入框不能为空</div>';
                }
                else{
                    $old=$_POST['oldurl'];
                    $new=$_POST['newurl'];
                    $optionType=$_POST['optionType'];
                    if($optionType=='post-text'||$optionType=='post-title'||$optionType=='page-text'||$optionType=='page-title'||$optionType=='comments-text'||$optionType=='comments-url'){
                        $db = Typecho_Db::get();
                        $prefix = $db->getPrefix();
                        $data_name=$prefix.'contents';
                        //文章内容或标题
                        if($optionType=='post-text'||$optionType=='post-title'){
                        if($optionType=='post-text'){$optionType='text';}
                        if($optionType=='post-title'){$optionType='title';}
                            $db->query("UPDATE `{$data_name}` SET `{$optionType}`=REPLACE(`{$optionType}`,'{$old}','{$new}') WHERE type='post'");
                        }
                        //独立页面内容或标题
                        if($optionType=='page-text'||$optionType=='page-title'){
                        if($optionType=='page-text'){$optionType='text';}
                        if($optionType=='page-title'){$optionType='title';}
                            $db->query("UPDATE `{$data_name}` SET `{$optionType}`=REPLACE(`{$optionType}`,'{$old}','{$new}') WHERE type='page'");
                        }  
                          
                        //评论内容
                        if($optionType=='comments-text'||$optionType=='comments-url'){
                            $data_name=$prefix.'comments';
                            if($optionType=='comments-text'){$optionType='text';}
                            if($optionType=='comments-url'){$optionType='url';}
                            if($new=='null'||$new=='NULL'){$new='';}
                            $db->query("UPDATE `{$data_name}` SET `{$optionType}`=REPLACE(`{$optionType}`,'{$old}','{$new}')");
                        }
                    }
                    else{
                        echo '<div class="msg error">表单参数疑似被篡改提交异常！</div>';
                    }
                    ?>
                    <div class="msg success">内容替换完成！</div>
                    <script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('extending.php?panel=ContentReplace/console.php'); ?>\'", 1800);</script>
                    <?php
                }
            }
            ?>
            <div class="typecho-page-main" role="main">
                <form class="protected" action="<?php $options->adminUrl('extending.php?panel=ContentReplace/console.php&xixinyanjiu=1'); ?>" method="post">
                    <ul class="typecho-option">
                        <li>
                            <label class="typecho-label">旧内容</label>
                            <input name="oldurl" type="text" class="w-100 mono">
                            <p class="description">输入你需要替换的目标内容.</p>
                        </li>
                    </ul>  
                    <ul class="typecho-option">
                        <li>
                            <label class="typecho-label">新内容</label>
                            <input name="newurl" type="text" class="w-100 mono">
                            <p class="description">输入你希望替换成的内容.【如果想替换为空这里填写<code>null</code>即可】</p>
                        </li>
                    </ul>  
                    <ul class="typecho-option">
                        <li>
                            <label class="typecho-label">替换项目</label>
                            <select name="optionType" style="width: 100%;">
                                <option value="post-text" selected>文章内容</option>
                                <option value="post-title">文章标题</option>
                                <option value="page-text">独立页面内容</option>
                                <option value="page-title">独立页面标题</option>
                                <option value="comments-text">评论内容</option>
                                <option value="comments-url">评论网站地址</option>
                            </select>
                            <p class="description" style="color:red;">插件涉及数据库操作，使用前建议备份数据库！！！</p>
                        </li>
                    </ul>
                    <ul class="typecho-option typecho-option-submit" id="typecho-option-item-submit-8">
                        <li>
                            <button type="submit" class="btn primary">提交</button>
                        </li>
                    </ul> 
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    include 'copyright.php';
    include 'common-js.php';
    include 'footer.php';
?>