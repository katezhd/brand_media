# Pages

API для работы со статическимим страницами

## Image Upload




> Example request:

```bash
curl -X POST \
    "http://brand.media.test/api/v1/page/image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"image":"nihil"}'

```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/page/image"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "image": "nihil"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-page-image" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-page-image"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-page-image"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-page-image" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-page-image"></code></pre>
</div>
<form id="form-POSTapi-v1-page-image" data-method="POST" data-path="api/v1/page/image" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-page-image', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-page-image" onclick="tryItOut('POSTapi-v1-page-image');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-page-image" onclick="cancelTryOut('POSTapi-v1-page-image');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-page-image" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/page/image</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>image</code></b>&nbsp;&nbsp;<small>required</small>     <i>optional</i> &nbsp;
<input type="text" name="image" data-endpoint="POSTapi-v1-page-image" data-component="body"  hidden>
<br>
Файл картинки
</p>

</form>


## Image Delete




> Example request:

```bash
curl -X DELETE \
    "http://brand.media.test/api/v1/page/image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"image":"incidunt"}'

```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/page/image"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "image": "incidunt"
}

fetch(url, {
    method: "DELETE",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-DELETEapi-v1-page-image" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEapi-v1-page-image"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-page-image"></code></pre>
</div>
<div id="execution-error-DELETEapi-v1-page-image" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-page-image"></code></pre>
</div>
<form id="form-DELETEapi-v1-page-image" data-method="DELETE" data-path="api/v1/page/image" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-page-image', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEapi-v1-page-image" onclick="tryItOut('DELETEapi-v1-page-image');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEapi-v1-page-image" onclick="cancelTryOut('DELETEapi-v1-page-image');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEapi-v1-page-image" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>api/v1/page/image</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>image</code></b>&nbsp;&nbsp;<small>required</small>     <i>optional</i> &nbsp;
<input type="text" name="image" data-endpoint="DELETEapi-v1-page-image" data-component="body"  hidden>
<br>
Файл картинки
</p>

</form>


## Youtube Image Upload




> Example request:

```bash
curl -X POST \
    "http://brand.media.test/api/v1/page/youtube" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"youtube_id":"eos"}'

```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/page/youtube"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "youtube_id": "eos"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-page-youtube" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-page-youtube"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-page-youtube"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-page-youtube" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-page-youtube"></code></pre>
</div>
<form id="form-POSTapi-v1-page-youtube" data-method="POST" data-path="api/v1/page/youtube" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-page-youtube', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-page-youtube" onclick="tryItOut('POSTapi-v1-page-youtube');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-page-youtube" onclick="cancelTryOut('POSTapi-v1-page-youtube');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-page-youtube" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/page/youtube</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>youtube_id</code></b>&nbsp;&nbsp;<small>required</small>     <i>optional</i> &nbsp;
<input type="text" name="youtube_id" data-endpoint="POSTapi-v1-page-youtube" data-component="body"  hidden>
<br>
ID видео на Youtube
</p>

</form>


## List of pages

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/pages?page=5&sort=inventore&search=voluptatum&uri=magnam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/pages"
);

let params = {
    "page": "5",
    "sort": "inventore",
    "search": "voluptatum",
    "uri": "magnam",
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
<div id="execution-results-GETapi-v1-pages" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-pages"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-pages"></code></pre>
</div>
<div id="execution-error-GETapi-v1-pages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-pages"></code></pre>
</div>
<form id="form-GETapi-v1-pages" data-method="GET" data-path="api/v1/pages" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-pages', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-pages" onclick="tryItOut('GETapi-v1-pages');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-pages" onclick="cancelTryOut('GETapi-v1-pages');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-pages" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/pages</code></b>
</p>
<p>
<label id="auth-GETapi-v1-pages" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-v1-pages" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-pages" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-pages" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
<p>
<b><code>search</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="search" data-endpoint="GETapi-v1-pages" data-component="query"  hidden>
<br>
Строка, которая должна содержаться в результатах выдачи
</p>
<p>
<b><code>uri</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="uri" data-endpoint="GETapi-v1-pages" data-component="query"  hidden>
<br>
Путь, по которому должна открываться страница в приложении
</p>
</form>


## Create a page

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://brand.media.test/api/v1/page" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"soluta","text":"quisquam","image":"totam","meta_title":"hic","meta_description":"commodi","status":15}'

```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/page"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "soluta",
    "text": "quisquam",
    "image": "totam",
    "meta_title": "hic",
    "meta_description": "commodi",
    "status": 15
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-page" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-page"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-page"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-page" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-page"></code></pre>
</div>
<form id="form-POSTapi-v1-page" data-method="POST" data-path="api/v1/page" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-page', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-page" onclick="tryItOut('POSTapi-v1-page');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-page" onclick="cancelTryOut('POSTapi-v1-page');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-page" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/page</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-page" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-page" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="POSTapi-v1-page" data-component="body" required  hidden>
<br>
Название страницы
</p>
<p>
<b><code>text</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="text" data-endpoint="POSTapi-v1-page" data-component="body"  hidden>
<br>
Описание приложения
</p>
<p>
<b><code>image</code></b>&nbsp;&nbsp;<small>optional</small>     <i>optional</i> &nbsp;
<input type="text" name="image" data-endpoint="POSTapi-v1-page" data-component="body"  hidden>
<br>
Картинка в base64
</p>
<p>
<b><code>meta_title</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="meta_title" data-endpoint="POSTapi-v1-page" data-component="body"  hidden>
<br>
Содержимое тега title
</p>
<p>
<b><code>meta_description</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="meta_description" data-endpoint="POSTapi-v1-page" data-component="body"  hidden>
<br>
Содержимое тега meta name="description"
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="status" data-endpoint="POSTapi-v1-page" data-component="body"  hidden>
<br>
Статус отображения (1-отображается, 0-скрыто)
</p>

</form>


## Get specified page




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/page/voluptatem" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/page/voluptatem"
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
<div id="execution-results-GETapi-v1-page--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-page--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-page--id-"></code></pre>
</div>
<div id="execution-error-GETapi-v1-page--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-page--id-"></code></pre>
</div>
<form id="form-GETapi-v1-page--id-" data-method="GET" data-path="api/v1/page/{id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-page--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-page--id-" onclick="tryItOut('GETapi-v1-page--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-page--id-" onclick="cancelTryOut('GETapi-v1-page--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-page--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/page/{id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="GETapi-v1-page--id-" data-component="url" required  hidden>
<br>

</p>
</form>


## Update specified page

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X PUT \
    "http://brand.media.test/api/v1/page/laboriosam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"dolor","text":"cupiditate","image":"assumenda","meta_title":"libero","meta_description":"enim","status":14}'

```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/page/laboriosam"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "dolor",
    "text": "cupiditate",
    "image": "assumenda",
    "meta_title": "libero",
    "meta_description": "enim",
    "status": 14
}

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-PUTapi-v1-page--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTapi-v1-page--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-page--id-"></code></pre>
</div>
<div id="execution-error-PUTapi-v1-page--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-page--id-"></code></pre>
</div>
<form id="form-PUTapi-v1-page--id-" data-method="PUT" data-path="api/v1/page/{id}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-page--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTapi-v1-page--id-" onclick="tryItOut('PUTapi-v1-page--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTapi-v1-page--id-" onclick="cancelTryOut('PUTapi-v1-page--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTapi-v1-page--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>api/v1/page/{id}</code></b>
</p>
<p>
<label id="auth-PUTapi-v1-page--id-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="PUTapi-v1-page--id-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="PUTapi-v1-page--id-" data-component="url" required  hidden>
<br>

</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="PUTapi-v1-page--id-" data-component="body" required  hidden>
<br>
Название страницы
</p>
<p>
<b><code>text</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="text" data-endpoint="PUTapi-v1-page--id-" data-component="body"  hidden>
<br>
Описание приложения
</p>
<p>
<b><code>image</code></b>&nbsp;&nbsp;<small>optional</small>     <i>optional</i> &nbsp;
<input type="text" name="image" data-endpoint="PUTapi-v1-page--id-" data-component="body"  hidden>
<br>
Картинка в base64
</p>
<p>
<b><code>meta_title</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="meta_title" data-endpoint="PUTapi-v1-page--id-" data-component="body"  hidden>
<br>
Содержимое тега title
</p>
<p>
<b><code>meta_description</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="meta_description" data-endpoint="PUTapi-v1-page--id-" data-component="body"  hidden>
<br>
Содержимое тега meta name="description"
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="status" data-endpoint="PUTapi-v1-page--id-" data-component="body"  hidden>
<br>
Статус отображения (1-отображается, 0-скрыто)
</p>

</form>


## Delete specified page

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X DELETE \
    "http://brand.media.test/api/v1/page/neque" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/page/neque"
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


<div id="execution-results-DELETEapi-v1-page--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEapi-v1-page--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-page--id-"></code></pre>
</div>
<div id="execution-error-DELETEapi-v1-page--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-page--id-"></code></pre>
</div>
<form id="form-DELETEapi-v1-page--id-" data-method="DELETE" data-path="api/v1/page/{id}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-page--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEapi-v1-page--id-" onclick="tryItOut('DELETEapi-v1-page--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEapi-v1-page--id-" onclick="cancelTryOut('DELETEapi-v1-page--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEapi-v1-page--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>api/v1/page/{id}</code></b>
</p>
<p>
<label id="auth-DELETEapi-v1-page--id-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="DELETEapi-v1-page--id-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="DELETEapi-v1-page--id-" data-component="url" required  hidden>
<br>

</p>
</form>


## Get specified page by its uri




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/app/page/rerum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/app/page/rerum"
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
<div id="execution-results-GETapi-v1-app-page--uri-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-app-page--uri-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-app-page--uri-"></code></pre>
</div>
<div id="execution-error-GETapi-v1-app-page--uri-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-app-page--uri-"></code></pre>
</div>
<form id="form-GETapi-v1-app-page--uri-" data-method="GET" data-path="api/v1/app/page/{uri}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-app-page--uri-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-app-page--uri-" onclick="tryItOut('GETapi-v1-app-page--uri-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-app-page--uri-" onclick="cancelTryOut('GETapi-v1-app-page--uri-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-app-page--uri-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/app/page/{uri}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>uri</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="uri" data-endpoint="GETapi-v1-app-page--uri-" data-component="url" required  hidden>
<br>

</p>
</form>



