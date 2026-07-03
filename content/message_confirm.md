---
title: 'お問い合わせ'
url: "/message/confirm.html"
draft: false
---

以下のメッセージを送信します。\
よろしければ、送信ボタンを押してください。


<form action="commit.php" method="POST">
  <input type="hidden" name="TOKEN" value="<% echo(TOKEN|htmlspecialchars) %>">

  <div class="form-group">
    <div class="form-label">お名前</div>
    <div class="form-value"><% echo(NAME|htmlspecialchars) %> 様</div>
  </div>

  <div class="form-group">
    <div class="form-label">メールアドレス</div>
    <div class="form-value"><% echo(ADDRESS|htmlspecialchars) %></div>
  </div>

  <div class="form-group">
    <div class="form-label">本文</div>
    <div class="form-value">
      <% echo(BODY|htmlspecialchars|nl2br) %>
    </div>
  </div>

  <div class="form-actions">
    <input type="submit" value="送信">
    <button type="button" onclick="history.back()">戻る</button>
  </div>
</form>


