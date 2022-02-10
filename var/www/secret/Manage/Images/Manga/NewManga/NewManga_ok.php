<form action="NewMangaVerify.php" method="POST">
    <table>
        <tr style="background-color: #444444;">
            <td class="TD1">Title</td>
            <td class="input"><input type="text" class="inputText" name="title" size="10" /></td>
        </tr>
        <tr>
            <td class="TD1">Age Set</td>
            <td class="input">
                <select name="age" class="inputSelect">
                    <option value="ALL">All Age</option>
                    <option value="R15">R15</option>
                    <option value="R18">R18</option>
                    <option value="R18G">R18G</option>
                </select>
            </td>
        </tr>
        <tr style="background-color: #444444;">
            <td class="TD1">Artist</td>
            <td class="input"><input type="text" class="inputText" name="artist" size="10" /></td>
        </tr>
        <tr>
            <td class="TD1">Language</td>
            <td class="input">
                <select name="language" class="inputSelect">
                    <option value="EN">English</option>
                    <option value="JA">Japanese</option>
                    <option value="ZH">Chinese</option>
                </select>
            </td>
        </tr>
    </table>
    <div class="submitContain">
        <input type="submit" class="submit" value="提交" />
    </div>
</form>