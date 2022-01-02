# weather

API для работы с тегами.

## List of weathers




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/app/weather?page=18&sort=iusto&search=repellat&status=iure" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/app/weather"
);

let params = {
    "page": "18",
    "sort": "iusto",
    "search": "repellat",
    "status": "iure",
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


> Example response (200):

```json

[]
```
<div id="execution-results-GETapi-v1-app-weather" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-app-weather"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-app-weather"></code></pre>
</div>
<div id="execution-error-GETapi-v1-app-weather" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-app-weather"></code></pre>
</div>
<form id="form-GETapi-v1-app-weather" data-method="GET" data-path="api/v1/app/weather" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-app-weather', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-app-weather" onclick="tryItOut('GETapi-v1-app-weather');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-app-weather" onclick="cancelTryOut('GETapi-v1-app-weather');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-app-weather" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/app/weather</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-app-weather" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-app-weather" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
<p>
<b><code>search</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="search" data-endpoint="GETapi-v1-app-weather" data-component="query"  hidden>
<br>
Строка, которая должна содержаться в результатах выдачи
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="status" data-endpoint="GETapi-v1-app-weather" data-component="query"  hidden>
<br>
Статус отображения (возможные значения visible, hidden)
</p>
</form>


## List of weathers




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/app/currency?page=20&sort=voluptatem&search=porro&status=laudantium" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/app/currency"
);

let params = {
    "page": "20",
    "sort": "voluptatem",
    "search": "porro",
    "status": "laudantium",
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


> Example response (200):

```json

[]
```
<div id="execution-results-GETapi-v1-app-currency" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-app-currency"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-app-currency"></code></pre>
</div>
<div id="execution-error-GETapi-v1-app-currency" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-app-currency"></code></pre>
</div>
<form id="form-GETapi-v1-app-currency" data-method="GET" data-path="api/v1/app/currency" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-app-currency', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-app-currency" onclick="tryItOut('GETapi-v1-app-currency');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-app-currency" onclick="cancelTryOut('GETapi-v1-app-currency');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-app-currency" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/app/currency</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-app-currency" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-app-currency" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
<p>
<b><code>search</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="search" data-endpoint="GETapi-v1-app-currency" data-component="query"  hidden>
<br>
Строка, которая должна содержаться в результатах выдачи
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="status" data-endpoint="GETapi-v1-app-currency" data-component="query"  hidden>
<br>
Статус отображения (возможные значения visible, hidden)
</p>
</form>


## Get specified insets




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/app/horoscope" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/app/horoscope"
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


> Example response (404):

```json
{
    "status": "error",
    "message": "Ресурс не знайден."
}
```
<div id="execution-results-GETapi-v1-app-horoscope" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-app-horoscope"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-app-horoscope"></code></pre>
</div>
<div id="execution-error-GETapi-v1-app-horoscope" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-app-horoscope"></code></pre>
</div>
<form id="form-GETapi-v1-app-horoscope" data-method="GET" data-path="api/v1/app/horoscope" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-app-horoscope', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-app-horoscope" onclick="tryItOut('GETapi-v1-app-horoscope');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-app-horoscope" onclick="cancelTryOut('GETapi-v1-app-horoscope');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-app-horoscope" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/app/horoscope</code></b>
</p>
</form>



