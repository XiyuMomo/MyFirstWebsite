<div class="modalBackground" id="modalBackground">
    <div class="modal">
        <div class="modalTitleContain">
            <span class="modalTitle">Warning!!</span>
            <hr style="margin: 10px auto;"/>
        </div>
        <div class="modalArticleContain">
            <article>
                本网站包含且不限于<strong>色情或其他不适宜在公共场所观看</strong>的内容，且这些内容仅允许登录后观看。您必须已达您当地的法定年龄并同意您想要观看此类题材。若在浏览本网站过程中您发生<strong>社会性死亡</strong>，本站概不负责。
                <br /><br />
                为取得进入网站的权限而谎报年龄可能会触犯您的国家、州和/或联邦<strong>法律</strong>。经由进入网站，您就此申明您没有触犯伪证罪条款，您至少有<strong>18岁</strong>（或您存取本站所在地的<strong>法定成年年龄</strong>）。
                <br /><br />
                您表明基于对您所在地的这些标准和法律的熟悉，您不会藉由要求和接收网站上的任何成人题材而触犯任何这些标准和/或法律。您了解您应确保本站不因您要求、接收和持有网站上的题材之相关责任而受损害。
                <br /><br />
                您的年龄为<strong>18岁</strong>以上吗？（或您存取本站所在地辖区的<strong>法定成年年龄</strong>）
                <br /><br />
                经由点下「我已成年」，您已经<strong>阅读并了解</strong>以上的声明。
            </article>
        </div>
        <div class="modalButtonContain">
            <hr style="margin: 10px auto;"/>
            <button class="modalButton" id="r18_y">我已成年</button>
            <button class="modalButton" id="r18_n">我未成年</button>
        </div>
    </div>
</div>
<script>
    var cookie_r18 = getCookie("r18");
    var modalBackground = document.getElementById("modalBackground");
    if(cookie_r18 != "1")
    {
        modalBackground.style.display = "block";
    }
    var button_r18_y = document.getElementById("r18_y");
    var button_r18_n = document.getElementById("r18_n");
    button_r18_y.onclick = function ()
    {
        setCookie("r18", "1", 2592000000);
        modalBackground.style.display = "none";
    }
    button_r18_n.onclick = function ()
    {
        window.location.href = "https://www.spp.gov.cn/spp/fl/201802/t20180206_364975.shtml"
    }
</script>