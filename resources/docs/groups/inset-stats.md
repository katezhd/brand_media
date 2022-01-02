# inset_stats

API для работы со статистикой по репостам инфо-блоков.

## List of inset_stats




> Example request:

```bash
curl -X GET \
    -G "http://brand_media.test/api/v1/insets_stats?page=18&sort=eaque&search=et&type=fugiat&social=est&from=rerum&till=atque" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/insets_stats"
);

let params = {
    "page": "18",
    "sort": "eaque",
    "search": "et",
    "type": "fugiat",
    "social": "est",
    "from": "rerum",
    "till": "atque",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

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
<div id="execution-results-GETapi-v1-insets_stats" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-insets_stats"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-insets_stats"></code></pre>
</div>
<div id="execution-error-GETapi-v1-insets_stats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-insets_stats"></code></pre>
</div>
<form id="form-GETapi-v1-insets_stats" data-method="GET" data-path="api/v1/insets_stats" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-insets_stats', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-insets_stats" onclick="tryItOut('GETapi-v1-insets_stats');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-insets_stats" onclick="cancelTryOut('GETapi-v1-insets_stats');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-insets_stats" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/insets_stats</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-insets_stats" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-insets_stats" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
<p>
<b><code>search</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="search" data-endpoint="GETapi-v1-insets_stats" data-component="query"  hidden>
<br>
Строка, которая должна содержаться в результатах выдачи
</p>
<p>
<b><code>type</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="type" data-endpoint="GETapi-v1-insets_stats" data-component="query"  hidden>
<br>
Тип инфо-блока (horoscope, joke, quote)
</p>
<p>
<b><code>social</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="social" data-endpoint="GETapi-v1-insets_stats" data-component="query"  hidden>
<br>
Социальная сеть (facebook, telegram)
</p>
<p>
<b><code>from</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="from" data-endpoint="GETapi-v1-insets_stats" data-component="query"  hidden>
<br>
Начало периода в формате 'YYYY-mm-dd HH:ii:ss'
</p>
<p>
<b><code>till</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="till" data-endpoint="GETapi-v1-insets_stats" data-component="query"  hidden>
<br>
Окончание периода в формате 'YYYY-mm-dd HH:ii:ss'
</p>
</form>


## List of data for charts




> Example request:

```bash
curl -X GET \
    -G "http://brand_media.test/api/v1/insets_charts?type=autem&social=possimus&from=cumque&till=excepturi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/insets_charts"
);

let params = {
    "type": "autem",
    "social": "possimus",
    "from": "cumque",
    "till": "excepturi",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

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
<div id="execution-results-GETapi-v1-insets_charts" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-insets_charts"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-insets_charts"></code></pre>
</div>
<div id="execution-error-GETapi-v1-insets_charts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-insets_charts"></code></pre>
</div>
<form id="form-GETapi-v1-insets_charts" data-method="GET" data-path="api/v1/insets_charts" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-insets_charts', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-insets_charts" onclick="tryItOut('GETapi-v1-insets_charts');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-insets_charts" onclick="cancelTryOut('GETapi-v1-insets_charts');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-insets_charts" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/insets_charts</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>type</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="type" data-endpoint="GETapi-v1-insets_charts" data-component="query"  hidden>
<br>
Тип инфо-блока (horoscope, joke, quote)
</p>
<p>
<b><code>social</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="social" data-endpoint="GETapi-v1-insets_charts" data-component="query"  hidden>
<br>
Социальная сеть (facebook, telegram)
</p>
<p>
<b><code>from</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="from" data-endpoint="GETapi-v1-insets_charts" data-component="query"  hidden>
<br>
Начало периода в формате 'YYYY-mm-dd HH:ii:ss'
</p>
<p>
<b><code>till</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="till" data-endpoint="GETapi-v1-insets_charts" data-component="query"  hidden>
<br>
Окончание периода в формате 'YYYY-mm-dd HH:ii:ss'
</p>
</form>


## Update inset_stats

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://brand_media.test/api/v1/app/inset_stat" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"type":"esse","social":"fugit","inset_id":10}'

```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/app/inset_stat"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "type": "esse",
    "social": "fugit",
    "inset_id": 10
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-app-inset_stat" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-app-inset_stat"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-app-inset_stat"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-app-inset_stat" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-app-inset_stat"></code></pre>
</div>
<form id="form-POSTapi-v1-app-inset_stat" data-method="POST" data-path="api/v1/app/inset_stat" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-app-inset_stat', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-app-inset_stat" onclick="tryItOut('POSTapi-v1-app-inset_stat');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-app-inset_stat" onclick="cancelTryOut('POSTapi-v1-app-inset_stat');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-app-inset_stat" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/app/inset_stat</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-app-inset_stat" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-app-inset_stat" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>type</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="type" data-endpoint="POSTapi-v1-app-inset_stat" data-component="body" required  hidden>
<br>
Тип инфо-блока (joke, quote, horoscope)
</p>
<p>
<b><code>social</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="social" data-endpoint="POSTapi-v1-app-inset_stat" data-component="body"  hidden>
<br>
Социальная сеть (facebook, telegram)
</p>
<p>
<b><code>inset_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="inset_id" data-endpoint="POSTapi-v1-app-inset_stat" data-component="body"  hidden>
<br>
ID инфо-блока
</p>

</form>



