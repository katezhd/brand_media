# inset_contents

API для работы с тегами.

## List of inset_contents




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/inset_contents?page=1&sort=est&search=ad&status=ut" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/inset_contents"
);

let params = {
    "page": "1",
    "sort": "est",
    "search": "ad",
    "status": "ut",
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
<div id="execution-results-GETapi-v1-inset_contents" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-inset_contents"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-inset_contents"></code></pre>
</div>
<div id="execution-error-GETapi-v1-inset_contents" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-inset_contents"></code></pre>
</div>
<form id="form-GETapi-v1-inset_contents" data-method="GET" data-path="api/v1/inset_contents" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-inset_contents', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-inset_contents" onclick="tryItOut('GETapi-v1-inset_contents');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-inset_contents" onclick="cancelTryOut('GETapi-v1-inset_contents');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-inset_contents" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/inset_contents</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-inset_contents" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-inset_contents" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
<p>
<b><code>search</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="search" data-endpoint="GETapi-v1-inset_contents" data-component="query"  hidden>
<br>
Строка, которая должна содержаться в результатах выдачи
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="status" data-endpoint="GETapi-v1-inset_contents" data-component="query"  hidden>
<br>
Статус отображения (возможные значения visible, hidden)
</p>
</form>


## Get specified inset_contents




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/inset_content/aliquid" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/inset_content/aliquid"
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
<div id="execution-results-GETapi-v1-inset_content--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-inset_content--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-inset_content--id-"></code></pre>
</div>
<div id="execution-error-GETapi-v1-inset_content--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-inset_content--id-"></code></pre>
</div>
<form id="form-GETapi-v1-inset_content--id-" data-method="GET" data-path="api/v1/inset_content/{id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-inset_content--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-inset_content--id-" onclick="tryItOut('GETapi-v1-inset_content--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-inset_content--id-" onclick="cancelTryOut('GETapi-v1-inset_content--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-inset_content--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/inset_content/{id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="GETapi-v1-inset_content--id-" data-component="url" required  hidden>
<br>

</p>
</form>


## Create inset_contents

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://brand.media.test/api/v1/inset_content" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"ab","status":16}'

```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/inset_content"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "ab",
    "status": 16
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-inset_content" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-inset_content"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-inset_content"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-inset_content" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-inset_content"></code></pre>
</div>
<form id="form-POSTapi-v1-inset_content" data-method="POST" data-path="api/v1/inset_content" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-inset_content', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-inset_content" onclick="tryItOut('POSTapi-v1-inset_content');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-inset_content" onclick="cancelTryOut('POSTapi-v1-inset_content');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-inset_content" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/inset_content</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-inset_content" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-inset_content" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="POSTapi-v1-inset_content" data-component="body" required  hidden>
<br>
Название организации
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="status" data-endpoint="POSTapi-v1-inset_content" data-component="body"  hidden>
<br>
Статус отображения (1-отображается, 0-скрыто)
</p>

</form>


## Update inset_contents

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X PUT \
    "http://brand.media.test/api/v1/inset_content/repellat" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"quo","status":1}'

```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/inset_content/repellat"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "quo",
    "status": 1
}

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-PUTapi-v1-inset_content--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTapi-v1-inset_content--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-inset_content--id-"></code></pre>
</div>
<div id="execution-error-PUTapi-v1-inset_content--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-inset_content--id-"></code></pre>
</div>
<form id="form-PUTapi-v1-inset_content--id-" data-method="PUT" data-path="api/v1/inset_content/{id}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-inset_content--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTapi-v1-inset_content--id-" onclick="tryItOut('PUTapi-v1-inset_content--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTapi-v1-inset_content--id-" onclick="cancelTryOut('PUTapi-v1-inset_content--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTapi-v1-inset_content--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>api/v1/inset_content/{id}</code></b>
</p>
<p>
<label id="auth-PUTapi-v1-inset_content--id-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="PUTapi-v1-inset_content--id-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="PUTapi-v1-inset_content--id-" data-component="url" required  hidden>
<br>

</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="PUTapi-v1-inset_content--id-" data-component="body" required  hidden>
<br>
Название организации
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="status" data-endpoint="PUTapi-v1-inset_content--id-" data-component="body"  hidden>
<br>
Статус отображения (1-отображается, 0-скрыто)
</p>

</form>


## Delete specified inset_contents

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X DELETE \
    "http://brand.media.test/api/v1/inset_content/necessitatibus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/inset_content/necessitatibus"
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


<div id="execution-results-DELETEapi-v1-inset_content--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEapi-v1-inset_content--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-inset_content--id-"></code></pre>
</div>
<div id="execution-error-DELETEapi-v1-inset_content--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-inset_content--id-"></code></pre>
</div>
<form id="form-DELETEapi-v1-inset_content--id-" data-method="DELETE" data-path="api/v1/inset_content/{id}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-inset_content--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEapi-v1-inset_content--id-" onclick="tryItOut('DELETEapi-v1-inset_content--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEapi-v1-inset_content--id-" onclick="cancelTryOut('DELETEapi-v1-inset_content--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEapi-v1-inset_content--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>api/v1/inset_content/{id}</code></b>
</p>
<p>
<label id="auth-DELETEapi-v1-inset_content--id-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="DELETEapi-v1-inset_content--id-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="DELETEapi-v1-inset_content--id-" data-component="url" required  hidden>
<br>

</p>
</form>


## List of inset_contents




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/joke_imports?page=6&sort=necessitatibus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/joke_imports"
);

let params = {
    "page": "6",
    "sort": "necessitatibus",
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
<div id="execution-results-GETapi-v1-joke_imports" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-joke_imports"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-joke_imports"></code></pre>
</div>
<div id="execution-error-GETapi-v1-joke_imports" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-joke_imports"></code></pre>
</div>
<form id="form-GETapi-v1-joke_imports" data-method="GET" data-path="api/v1/joke_imports" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-joke_imports', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-joke_imports" onclick="tryItOut('GETapi-v1-joke_imports');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-joke_imports" onclick="cancelTryOut('GETapi-v1-joke_imports');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-joke_imports" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/joke_imports</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-joke_imports" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-joke_imports" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
</form>


## Update inset_contents

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X PUT \
    "http://brand.media.test/api/v1/joke_import/nemo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"voluptatem","status":17}'

```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/joke_import/nemo"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "voluptatem",
    "status": 17
}

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-PUTapi-v1-joke_import--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTapi-v1-joke_import--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-joke_import--id-"></code></pre>
</div>
<div id="execution-error-PUTapi-v1-joke_import--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-joke_import--id-"></code></pre>
</div>
<form id="form-PUTapi-v1-joke_import--id-" data-method="PUT" data-path="api/v1/joke_import/{id}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-joke_import--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTapi-v1-joke_import--id-" onclick="tryItOut('PUTapi-v1-joke_import--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTapi-v1-joke_import--id-" onclick="cancelTryOut('PUTapi-v1-joke_import--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTapi-v1-joke_import--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>api/v1/joke_import/{id}</code></b>
</p>
<p>
<label id="auth-PUTapi-v1-joke_import--id-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="PUTapi-v1-joke_import--id-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="PUTapi-v1-joke_import--id-" data-component="url" required  hidden>
<br>

</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="PUTapi-v1-joke_import--id-" data-component="body" required  hidden>
<br>
Название организации
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="status" data-endpoint="PUTapi-v1-joke_import--id-" data-component="body"  hidden>
<br>
Статус отображения (1-отображается, 0-скрыто)
</p>

</form>


## Delete specified inset_contents

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X DELETE \
    "http://brand.media.test/api/v1/joke_import/neque" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/joke_import/neque"
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


<div id="execution-results-DELETEapi-v1-joke_import--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEapi-v1-joke_import--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-joke_import--id-"></code></pre>
</div>
<div id="execution-error-DELETEapi-v1-joke_import--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-joke_import--id-"></code></pre>
</div>
<form id="form-DELETEapi-v1-joke_import--id-" data-method="DELETE" data-path="api/v1/joke_import/{id}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-joke_import--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEapi-v1-joke_import--id-" onclick="tryItOut('DELETEapi-v1-joke_import--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEapi-v1-joke_import--id-" onclick="cancelTryOut('DELETEapi-v1-joke_import--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEapi-v1-joke_import--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>api/v1/joke_import/{id}</code></b>
</p>
<p>
<label id="auth-DELETEapi-v1-joke_import--id-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="DELETEapi-v1-joke_import--id-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="DELETEapi-v1-joke_import--id-" data-component="url" required  hidden>
<br>

</p>
</form>


## List of inset_contents




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/quote_imports?page=12&sort=est" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/quote_imports"
);

let params = {
    "page": "12",
    "sort": "est",
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
<div id="execution-results-GETapi-v1-quote_imports" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-quote_imports"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-quote_imports"></code></pre>
</div>
<div id="execution-error-GETapi-v1-quote_imports" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-quote_imports"></code></pre>
</div>
<form id="form-GETapi-v1-quote_imports" data-method="GET" data-path="api/v1/quote_imports" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-quote_imports', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-quote_imports" onclick="tryItOut('GETapi-v1-quote_imports');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-quote_imports" onclick="cancelTryOut('GETapi-v1-quote_imports');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-quote_imports" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/quote_imports</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-quote_imports" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-quote_imports" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
</form>


## Update inset_contents

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X PUT \
    "http://brand.media.test/api/v1/quote_import/qui" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"ducimus","status":5}'

```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/quote_import/qui"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "ducimus",
    "status": 5
}

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-PUTapi-v1-quote_import--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTapi-v1-quote_import--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-quote_import--id-"></code></pre>
</div>
<div id="execution-error-PUTapi-v1-quote_import--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-quote_import--id-"></code></pre>
</div>
<form id="form-PUTapi-v1-quote_import--id-" data-method="PUT" data-path="api/v1/quote_import/{id}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-quote_import--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTapi-v1-quote_import--id-" onclick="tryItOut('PUTapi-v1-quote_import--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTapi-v1-quote_import--id-" onclick="cancelTryOut('PUTapi-v1-quote_import--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTapi-v1-quote_import--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>api/v1/quote_import/{id}</code></b>
</p>
<p>
<label id="auth-PUTapi-v1-quote_import--id-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="PUTapi-v1-quote_import--id-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="PUTapi-v1-quote_import--id-" data-component="url" required  hidden>
<br>

</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="PUTapi-v1-quote_import--id-" data-component="body" required  hidden>
<br>
Название организации
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="status" data-endpoint="PUTapi-v1-quote_import--id-" data-component="body"  hidden>
<br>
Статус отображения (1-отображается, 0-скрыто)
</p>

</form>


## Delete specified inset_contents

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X DELETE \
    "http://brand.media.test/api/v1/quote_import/vel" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/quote_import/vel"
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


<div id="execution-results-DELETEapi-v1-quote_import--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEapi-v1-quote_import--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-quote_import--id-"></code></pre>
</div>
<div id="execution-error-DELETEapi-v1-quote_import--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-quote_import--id-"></code></pre>
</div>
<form id="form-DELETEapi-v1-quote_import--id-" data-method="DELETE" data-path="api/v1/quote_import/{id}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-quote_import--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEapi-v1-quote_import--id-" onclick="tryItOut('DELETEapi-v1-quote_import--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEapi-v1-quote_import--id-" onclick="cancelTryOut('DELETEapi-v1-quote_import--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEapi-v1-quote_import--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>api/v1/quote_import/{id}</code></b>
</p>
<p>
<label id="auth-DELETEapi-v1-quote_import--id-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="DELETEapi-v1-quote_import--id-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="DELETEapi-v1-quote_import--id-" data-component="url" required  hidden>
<br>

</p>
</form>



