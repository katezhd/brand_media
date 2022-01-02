# constructor

API для работы с тегами.

## List of constructor




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/constructor" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/constructor"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```
<div id="execution-results-GETapi-v1-constructor" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-constructor"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-constructor"></code></pre>
</div>
<div id="execution-error-GETapi-v1-constructor" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-constructor"></code></pre>
</div>
<form id="form-GETapi-v1-constructor" data-method="GET" data-path="api/v1/constructor" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-constructor', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-constructor" onclick="tryItOut('GETapi-v1-constructor');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-constructor" onclick="cancelTryOut('GETapi-v1-constructor');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-constructor" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/constructor</code></b>
</p>
</form>


## Update News

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://brand.media.test/api/v1/constructor" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/constructor"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-constructor" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-constructor"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-constructor"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-constructor" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-constructor"></code></pre>
</div>
<form id="form-POSTapi-v1-constructor" data-method="POST" data-path="api/v1/constructor" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-constructor', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-constructor" onclick="tryItOut('POSTapi-v1-constructor');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-constructor" onclick="cancelTryOut('POSTapi-v1-constructor');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-constructor" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/constructor</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-constructor" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-constructor" data-component="header"></label>
</p>
</form>



