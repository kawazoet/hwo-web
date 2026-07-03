---
url: "/message"
---

# お問い合わせ

入団・見学を希望される方や、当団体へのお問い合わせは、こちらからお送りください。\
(見学をご希望の方は、所有楽器の種類と経験年数をお書き添えください。)

<div>
  <% def(MESSAGE) %>
    <font color='red'><b>
    <% echo(MESSAGE|htmlspecialchars) %>
    </b></font><br>
  <% /def %>
</div>

<form action="confirm.php" method="POST">

  <div class="form-group">
    <label for="name">お名前</label>
    <input id="name" name="name" type="text"
      value="<% echo(NAME|htmlspecialchars) %>">
  </div>

  <div class="form-group">
    <label for="address">メールアドレス</label>
    <input id="address" name="address" type="email"
      value="<% echo(ADDRESS|htmlspecialchars) %>">
  </div>

  <div class="form-group">
    <label for="address2">メールアドレス（確認用）</label>
    <input id="address2" name="address2" type="email"
      value="<% echo(ADDRESS2|htmlspecialchars) %>">
  </div>

  <div class="form-group">
    <label for="body">本文</label>
    <textarea id="body" name="body"><% echo(BODY|htmlspecialchars) %></textarea>
  </div>

  <div class="form-actions">
    <input type="submit" value="確認">
    <input type="reset" value="取消">
  </div>

</form>
