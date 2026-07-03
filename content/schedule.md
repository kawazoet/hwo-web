---
title: 練習日程
---

![練習場所](/images/map.gif)

練習場所：高槻市生涯学習センターB1Fリハーサル室



<table class="schedule-table">
<thead>
<tr>
<th>日付</th><th>時間</th><th>内容</th><th>備考</th>
</tr>
</thead>
<tbody>
<% def(SCHEDULE) %>
  <% each(SCHEDULE) %>
    <tr>
      <td nowrap><% echo(SCHEDULE/DATE) %></td>
      <td nowrap><% echo(SCHEDULE/TIME) %></td>
      <td><% echo(SCHEDULE/MENU|htmlspecialchars) %></td>
      <td><% echo(SCHEDULE/NOTE|htmlspecialchars) %></td>
    </tr>
  <% /each %>
<% /def %>
</tbody>
</table>
