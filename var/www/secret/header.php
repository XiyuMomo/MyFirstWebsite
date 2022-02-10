<div class="headerContain">
    <div class="userInfoArea">
        <?php
        if($ISLOGGED)
        {
            echo "<span>当前用户:".@$_SESSION['name']."&nbsp;&nbsp;</span>";
            echo "<span>用户ID:".@$_SESSION['id']."</span>";
        }
        else
        {
            echo "<span>用户未登录</span>";
        }
        ?>
    </div>

    <div class="userOptionArea">
        <?php
        if($ISLOGGED)
        {
            echo '<a class="userOption" href="">[个人设置]</a>&nbsp;&nbsp;';
            echo '<a class="userOption" href="/logout.php">[登出]</a>';
        }
        else
        {
            echo '<a class="userOption" href="/createAccount.php">[注册]</a>&nbsp;&nbsp;';
            echo '<a class="userOption" href="/login.php">[登录]</a>';
        }
        ?>
    </div>
</div>
<hr style="margin: 0 auto;"/>