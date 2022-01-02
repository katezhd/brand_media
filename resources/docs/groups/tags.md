# Tags

API для работы с тегами.

## List of Tags




> Example request:

```bash
curl -X GET \
    -G "http://brand_media.test/api/v1/tags?page=16&sort=quae&search=itaque&status=omnis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/tags"
);

let params = {
    "page": "16",
    "sort": "quae",
    "search": "itaque",
    "status": "omnis",
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
<div id="execution-results-GETapi-v1-tags" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-tags"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-tags"></code></pre>
</div>
<div id="execution-error-GETapi-v1-tags" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-tags"></code></pre>
</div>
<form id="form-GETapi-v1-tags" data-method="GET" data-path="api/v1/tags" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-tags', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-tags" onclick="tryItOut('GETapi-v1-tags');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-tags" onclick="cancelTryOut('GETapi-v1-tags');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-tags" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/tags</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-tags" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-tags" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
<p>
<b><code>search</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="search" data-endpoint="GETapi-v1-tags" data-component="query"  hidden>
<br>
Строка, которая должна содержаться в результатах выдачи
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="status" data-endpoint="GETapi-v1-tags" data-component="query"  hidden>
<br>
Статус отображения (возможные значения visible, hidden)
</p>
</form>


## Get specified Tags




> Example request:

```bash
curl -X GET \
    -G "http://brand_media.test/api/v1/tag/adipisci" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/tag/adipisci"
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
<div id="execution-results-GETapi-v1-tag--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-tag--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-tag--id-"></code></pre>
</div>
<div id="execution-error-GETapi-v1-tag--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-tag--id-"></code></pre>
</div>
<form id="form-GETapi-v1-tag--id-" data-method="GET" data-path="api/v1/tag/{id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-tag--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-tag--id-" onclick="tryItOut('GETapi-v1-tag--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-tag--id-" onclick="cancelTryOut('GETapi-v1-tag--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-tag--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/tag/{id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="GETapi-v1-tag--id-" data-component="url" required  hidden>
<br>

</p>
</form>


## Create Tags

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://brand_media.test/api/v1/tag" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"provident","status":9,"meta_title":"quasi","meta_description":"dolor","is_system":19}'

```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/tag"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "provident",
    "status": 9,
    "meta_title": "quasi",
    "meta_description": "dolor",
    "is_system": 19
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-tag" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-tag"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-tag"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-tag" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-tag"></code></pre>
</div>
<form id="form-POSTapi-v1-tag" data-method="POST" data-path="api/v1/tag" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-tag', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-tag" onclick="tryItOut('POSTapi-v1-tag');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-tag" onclick="cancelTryOut('POSTapi-v1-tag');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-tag" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/tag</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-tag" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-tag" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="POSTapi-v1-tag" data-component="body" required  hidden>
<br>
Название тега
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="status" data-endpoint="POSTapi-v1-tag" data-component="body"  hidden>
<br>
Статус отображения (1-отображается, 0-скрыто)
</p>
<p>
<b><code>meta_title</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="meta_title" data-endpoint="POSTapi-v1-tag" data-component="body" required  hidden>
<br>
Тег title
</p>
<p>
<b><code>meta_description</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="meta_description" data-endpoint="POSTapi-v1-tag" data-component="body" required  hidden>
<br>
Тег description
</p>
<p>
<b><code>is_system</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="is_system" data-endpoint="POSTapi-v1-tag" data-component="body"  hidden>
<br>
Видимость тега (1-системный, 0-видимый)
</p>

</form>


## Update Tags

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X PUT \
    "http://brand_media.test/api/v1/tag/reiciendis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"tempora","status":18,"meta_title":"quia","meta_description":"et","is_system":4}'

```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/tag/reiciendis"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "tempora",
    "status": 18,
    "meta_title": "quia",
    "meta_description": "et",
    "is_system": 4
}

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-PUTapi-v1-tag--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTapi-v1-tag--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-tag--id-"></code></pre>
</div>
<div id="execution-error-PUTapi-v1-tag--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-tag--id-"></code></pre>
</div>
<form id="form-PUTapi-v1-tag--id-" data-method="PUT" data-path="api/v1/tag/{id}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-tag--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTapi-v1-tag--id-" onclick="tryItOut('PUTapi-v1-tag--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTapi-v1-tag--id-" onclick="cancelTryOut('PUTapi-v1-tag--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTapi-v1-tag--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>api/v1/tag/{id}</code></b>
</p>
<p>
<label id="auth-PUTapi-v1-tag--id-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="PUTapi-v1-tag--id-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="PUTapi-v1-tag--id-" data-component="url" required  hidden>
<br>

</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="PUTapi-v1-tag--id-" data-component="body" required  hidden>
<br>
Название тега
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="status" data-endpoint="PUTapi-v1-tag--id-" data-component="body"  hidden>
<br>
Статус отображения (1-отображается, 0-скрыто)
</p>
<p>
<b><code>meta_title</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="meta_title" data-endpoint="PUTapi-v1-tag--id-" data-component="body" required  hidden>
<br>
Тег title
</p>
<p>
<b><code>meta_description</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="meta_description" data-endpoint="PUTapi-v1-tag--id-" data-component="body" required  hidden>
<br>
Тег description
</p>
<p>
<b><code>is_system</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="is_system" data-endpoint="PUTapi-v1-tag--id-" data-component="body"  hidden>
<br>
Видимость тега (1-системный, 0-видимый)
</p>

</form>


## Delete specified Tags

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X DELETE \
    "http://brand_media.test/api/v1/tag/omnis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/tag/omnis"
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


<div id="execution-results-DELETEapi-v1-tag--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEapi-v1-tag--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-tag--id-"></code></pre>
</div>
<div id="execution-error-DELETEapi-v1-tag--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-tag--id-"></code></pre>
</div>
<form id="form-DELETEapi-v1-tag--id-" data-method="DELETE" data-path="api/v1/tag/{id}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-tag--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEapi-v1-tag--id-" onclick="tryItOut('DELETEapi-v1-tag--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEapi-v1-tag--id-" onclick="cancelTryOut('DELETEapi-v1-tag--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEapi-v1-tag--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>api/v1/tag/{id}</code></b>
</p>
<p>
<label id="auth-DELETEapi-v1-tag--id-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="DELETEapi-v1-tag--id-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="DELETEapi-v1-tag--id-" data-component="url" required  hidden>
<br>

</p>
</form>


## List of Tags




> Example request:

```bash
curl -X GET \
    -G "http://brand_media.test/api/v1/app/tags?page=18&sort=quidem&search=tempore&status=enim" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/app/tags"
);

let params = {
    "page": "18",
    "sort": "quidem",
    "search": "tempore",
    "status": "enim",
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
    "current_page": 18,
    "data": [],
    "first_page_url": "http:\/\/localhost\/api\/v1\/app\/tags?page=1",
    "from": null,
    "last_page": 1,
    "last_page_url": "http:\/\/localhost\/api\/v1\/app\/tags?page=1",
    "links": [
        {
            "url": "http:\/\/localhost\/api\/v1\/app\/tags?page=17",
            "label": "&laquo; Назад",
            "active": false
        },
        {
            "url": "http:\/\/localhost\/api\/v1\/app\/tags?page=1",
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
    "path": "http:\/\/localhost\/api\/v1\/app\/tags",
    "per_page": 30,
    "prev_page_url": "http:\/\/localhost\/api\/v1\/app\/tags?page=17",
    "to": null,
    "total": 0
}
```
<div id="execution-results-GETapi-v1-app-tags" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-app-tags"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-app-tags"></code></pre>
</div>
<div id="execution-error-GETapi-v1-app-tags" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-app-tags"></code></pre>
</div>
<form id="form-GETapi-v1-app-tags" data-method="GET" data-path="api/v1/app/tags" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-app-tags', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-app-tags" onclick="tryItOut('GETapi-v1-app-tags');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-app-tags" onclick="cancelTryOut('GETapi-v1-app-tags');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-app-tags" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/app/tags</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-app-tags" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-app-tags" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
<p>
<b><code>search</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="search" data-endpoint="GETapi-v1-app-tags" data-component="query"  hidden>
<br>
Строка, которая должна содержаться в результатах выдачи
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="status" data-endpoint="GETapi-v1-app-tags" data-component="query"  hidden>
<br>
Статус отображения (возможные значения visible, hidden)
</p>
</form>


## Get specified Tags




> Example request:

```bash
curl -X GET \
    -G "http://brand_media.test/api/v1/app/tag/delectus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/app/tag/delectus"
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
<div id="execution-results-GETapi-v1-app-tag--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-app-tag--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-app-tag--id-"></code></pre>
</div>
<div id="execution-error-GETapi-v1-app-tag--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-app-tag--id-"></code></pre>
</div>
<form id="form-GETapi-v1-app-tag--id-" data-method="GET" data-path="api/v1/app/tag/{id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-app-tag--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-app-tag--id-" onclick="tryItOut('GETapi-v1-app-tag--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-app-tag--id-" onclick="cancelTryOut('GETapi-v1-app-tag--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-app-tag--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/app/tag/{id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="GETapi-v1-app-tag--id-" data-component="url" required  hidden>
<br>

</p>
</form>



