# Reactions

API для работы с реакциями.

## Create Reactions

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://brand.media.test/api/v1/app/reaction" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":"consequatur","action":"dolorem","news_id":1}'

```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/app/reaction"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "consequatur",
    "action": "dolorem",
    "news_id": 1
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-app-reaction" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-app-reaction"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-app-reaction"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-app-reaction" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-app-reaction"></code></pre>
</div>
<form id="form-POSTapi-v1-app-reaction" data-method="POST" data-path="api/v1/app/reaction" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-app-reaction', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-app-reaction" onclick="tryItOut('POSTapi-v1-app-reaction');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-app-reaction" onclick="cancelTryOut('POSTapi-v1-app-reaction');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-app-reaction" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/app/reaction</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-app-reaction" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-app-reaction" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>token</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="token" data-endpoint="POSTapi-v1-app-reaction" data-component="body" required  hidden>
<br>
Название организации
</p>
<p>
<b><code>action</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="action" data-endpoint="POSTapi-v1-app-reaction" data-component="body" required  hidden>
<br>
Действие (like, dislike)
</p>
<p>
<b><code>news_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="news_id" data-endpoint="POSTapi-v1-app-reaction" data-component="body"  hidden>
<br>
id новости
</p>

</form>



