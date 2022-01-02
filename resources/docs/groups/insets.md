# insets

API для работы с тегами.

## List of insets




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/insets?page=18&sort=temporibus&search=excepturi&status=et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/insets"
);

let params = {
    "page": "18",
    "sort": "temporibus",
    "search": "excepturi",
    "status": "et",
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
<div id="execution-results-GETapi-v1-insets" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-insets"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-insets"></code></pre>
</div>
<div id="execution-error-GETapi-v1-insets" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-insets"></code></pre>
</div>
<form id="form-GETapi-v1-insets" data-method="GET" data-path="api/v1/insets" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-insets', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-insets" onclick="tryItOut('GETapi-v1-insets');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-insets" onclick="cancelTryOut('GETapi-v1-insets');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-insets" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/insets</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-insets" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-insets" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
<p>
<b><code>search</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="search" data-endpoint="GETapi-v1-insets" data-component="query"  hidden>
<br>
Строка, которая должна содержаться в результатах выдачи
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="status" data-endpoint="GETapi-v1-insets" data-component="query"  hidden>
<br>
Статус отображения (возможные значения visible, hidden)
</p>
</form>


## Get specified insets




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/inset/deleniti" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/inset/deleniti"
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
<div id="execution-results-GETapi-v1-inset--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-inset--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-inset--id-"></code></pre>
</div>
<div id="execution-error-GETapi-v1-inset--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-inset--id-"></code></pre>
</div>
<form id="form-GETapi-v1-inset--id-" data-method="GET" data-path="api/v1/inset/{id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-inset--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-inset--id-" onclick="tryItOut('GETapi-v1-inset--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-inset--id-" onclick="cancelTryOut('GETapi-v1-inset--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-inset--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/inset/{id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="GETapi-v1-inset--id-" data-component="url" required  hidden>
<br>

</p>
</form>


## Create insets

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://brand.media.test/api/v1/inset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"nesciunt","status":9}'

```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/inset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "nesciunt",
    "status": 9
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-inset" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-inset"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-inset"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-inset" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-inset"></code></pre>
</div>
<form id="form-POSTapi-v1-inset" data-method="POST" data-path="api/v1/inset" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-inset', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-inset" onclick="tryItOut('POSTapi-v1-inset');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-inset" onclick="cancelTryOut('POSTapi-v1-inset');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-inset" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/inset</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-inset" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-inset" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="POSTapi-v1-inset" data-component="body" required  hidden>
<br>
Название организации
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="status" data-endpoint="POSTapi-v1-inset" data-component="body"  hidden>
<br>
Статус отображения (1-отображается, 0-скрыто)
</p>

</form>


## Update insets

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X PUT \
    "http://brand.media.test/api/v1/inset/quidem" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"placeat","status":8}'

```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/inset/quidem"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "placeat",
    "status": 8
}

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-PUTapi-v1-inset--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTapi-v1-inset--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-inset--id-"></code></pre>
</div>
<div id="execution-error-PUTapi-v1-inset--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-inset--id-"></code></pre>
</div>
<form id="form-PUTapi-v1-inset--id-" data-method="PUT" data-path="api/v1/inset/{id}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-inset--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTapi-v1-inset--id-" onclick="tryItOut('PUTapi-v1-inset--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTapi-v1-inset--id-" onclick="cancelTryOut('PUTapi-v1-inset--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTapi-v1-inset--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>api/v1/inset/{id}</code></b>
</p>
<p>
<label id="auth-PUTapi-v1-inset--id-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="PUTapi-v1-inset--id-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="PUTapi-v1-inset--id-" data-component="url" required  hidden>
<br>

</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="PUTapi-v1-inset--id-" data-component="body" required  hidden>
<br>
Название организации
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="status" data-endpoint="PUTapi-v1-inset--id-" data-component="body"  hidden>
<br>
Статус отображения (1-отображается, 0-скрыто)
</p>

</form>


## Delete specified insets

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X DELETE \
    "http://brand.media.test/api/v1/inset/cum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/inset/cum"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response => response.json());
```


<div id="execution-results-DELETEapi-v1-inset--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEapi-v1-inset--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-inset--id-"></code></pre>
</div>
<div id="execution-error-DELETEapi-v1-inset--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-inset--id-"></code></pre>
</div>
<form id="form-DELETEapi-v1-inset--id-" data-method="DELETE" data-path="api/v1/inset/{id}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-inset--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEapi-v1-inset--id-" onclick="tryItOut('DELETEapi-v1-inset--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEapi-v1-inset--id-" onclick="cancelTryOut('DELETEapi-v1-inset--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEapi-v1-inset--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>api/v1/inset/{id}</code></b>
</p>
<p>
<label id="auth-DELETEapi-v1-inset--id-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="DELETEapi-v1-inset--id-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="DELETEapi-v1-inset--id-" data-component="url" required  hidden>
<br>

</p>
</form>


## List of insets




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/app/insets?page=13&sort=dolorem&search=blanditiis&status=amet" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/app/insets"
);

let params = {
    "page": "13",
    "sort": "dolorem",
    "search": "blanditiis",
    "status": "amet",
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
{
    "current_page": 13,
    "data": [],
    "first_page_url": "http:\/\/localhost\/api\/v1\/app\/insets?page=1",
    "from": null,
    "last_page": 1,
    "last_page_url": "http:\/\/localhost\/api\/v1\/app\/insets?page=1",
    "links": [
        {
            "url": "http:\/\/localhost\/api\/v1\/app\/insets?page=12",
            "label": "&laquo; Назад",
            "active": false
        },
        {
            "url": "http:\/\/localhost\/api\/v1\/app\/insets?page=1",
            "label": "1",
            "active": false
        },
        {
            "url": null,
            "label": "Вперёд &raquo;",
            "active": false
        }
    ],
    "next_page_url": null,
    "path": "http:\/\/localhost\/api\/v1\/app\/insets",
    "per_page": 1,
    "prev_page_url": "http:\/\/localhost\/api\/v1\/app\/insets?page=12",
    "to": null,
    "total": 0
}
```
<div id="execution-results-GETapi-v1-app-insets" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-app-insets"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-app-insets"></code></pre>
</div>
<div id="execution-error-GETapi-v1-app-insets" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-app-insets"></code></pre>
</div>
<form id="form-GETapi-v1-app-insets" data-method="GET" data-path="api/v1/app/insets" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-app-insets', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-app-insets" onclick="tryItOut('GETapi-v1-app-insets');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-app-insets" onclick="cancelTryOut('GETapi-v1-app-insets');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-app-insets" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/app/insets</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-app-insets" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-app-insets" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
<p>
<b><code>search</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="search" data-endpoint="GETapi-v1-app-insets" data-component="query"  hidden>
<br>
Строка, которая должна содержаться в результатах выдачи
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="status" data-endpoint="GETapi-v1-app-insets" data-component="query"  hidden>
<br>
Статус отображения (возможные значения visible, hidden)
</p>
</form>


## Image Upload




> Example request:

```bash
curl -X POST \
    "http://brand.media.test/api/v1/app/insets/image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"image":"qui"}'

```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/app/insets/image"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "image": "qui"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-app-insets-image" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-app-insets-image"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-app-insets-image"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-app-insets-image" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-app-insets-image"></code></pre>
</div>
<form id="form-POSTapi-v1-app-insets-image" data-method="POST" data-path="api/v1/app/insets/image" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-app-insets-image', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-app-insets-image" onclick="tryItOut('POSTapi-v1-app-insets-image');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-app-insets-image" onclick="cancelTryOut('POSTapi-v1-app-insets-image');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-app-insets-image" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/app/insets/image</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>image</code></b>&nbsp;&nbsp;<small>required</small>     <i>optional</i> &nbsp;
<input type="text" name="image" data-endpoint="POSTapi-v1-app-insets-image" data-component="body"  hidden>
<br>
Файл картинки
</p>

</form>



