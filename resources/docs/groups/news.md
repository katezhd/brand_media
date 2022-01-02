# News

API для работы с новостями.

## Image Upload




> Example request:

```bash
curl -X POST \
    "http://brand_media.test/api/v1/news/image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"image":"mollitia"}'

```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/news/image"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "image": "mollitia"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-news-image" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-news-image"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-news-image"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-news-image" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-news-image"></code></pre>
</div>
<form id="form-POSTapi-v1-news-image" data-method="POST" data-path="api/v1/news/image" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-news-image', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-news-image" onclick="tryItOut('POSTapi-v1-news-image');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-news-image" onclick="cancelTryOut('POSTapi-v1-news-image');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-news-image" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/news/image</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>image</code></b>&nbsp;&nbsp;<small>required</small>     <i>optional</i> &nbsp;
<input type="text" name="image" data-endpoint="POSTapi-v1-news-image" data-component="body"  hidden>
<br>
Файл картинки
</p>

</form>


## Image Delete




> Example request:

```bash
curl -X DELETE \
    "http://brand_media.test/api/v1/news/image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"image":"delectus"}'

```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/news/image"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "image": "delectus"
}

fetch(url, {
    method: "DELETE",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-DELETEapi-v1-news-image" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEapi-v1-news-image"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-news-image"></code></pre>
</div>
<div id="execution-error-DELETEapi-v1-news-image" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-news-image"></code></pre>
</div>
<form id="form-DELETEapi-v1-news-image" data-method="DELETE" data-path="api/v1/news/image" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-news-image', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEapi-v1-news-image" onclick="tryItOut('DELETEapi-v1-news-image');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEapi-v1-news-image" onclick="cancelTryOut('DELETEapi-v1-news-image');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEapi-v1-news-image" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>api/v1/news/image</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>image</code></b>&nbsp;&nbsp;<small>required</small>     <i>optional</i> &nbsp;
<input type="text" name="image" data-endpoint="DELETEapi-v1-news-image" data-component="body"  hidden>
<br>
Файл картинки
</p>

</form>


## Youtube Image Upload




> Example request:

```bash
curl -X POST \
    "http://brand_media.test/api/v1/news/youtube" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"youtube_id":"cumque"}'

```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/news/youtube"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "youtube_id": "cumque"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-news-youtube" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-news-youtube"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-news-youtube"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-news-youtube" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-news-youtube"></code></pre>
</div>
<form id="form-POSTapi-v1-news-youtube" data-method="POST" data-path="api/v1/news/youtube" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-news-youtube', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-news-youtube" onclick="tryItOut('POSTapi-v1-news-youtube');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-news-youtube" onclick="cancelTryOut('POSTapi-v1-news-youtube');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-news-youtube" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/news/youtube</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>youtube_id</code></b>&nbsp;&nbsp;<small>required</small>     <i>optional</i> &nbsp;
<input type="text" name="youtube_id" data-endpoint="POSTapi-v1-news-youtube" data-component="body"  hidden>
<br>
ID видео на Youtube
</p>

</form>


## List of news




> Example request:

```bash
curl -X GET \
    -G "http://brand_media.test/api/v1/news?page=14&sort=perferendis&search=blanditiis&category_id=13&tag_id=16&author_id=9&from=eius&till=aut&status=optio" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/news"
);

let params = {
    "page": "14",
    "sort": "perferendis",
    "search": "blanditiis",
    "category_id": "13",
    "tag_id": "16",
    "author_id": "9",
    "from": "eius",
    "till": "aut",
    "status": "optio",
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
<div id="execution-results-GETapi-v1-news" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-news"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-news"></code></pre>
</div>
<div id="execution-error-GETapi-v1-news" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-news"></code></pre>
</div>
<form id="form-GETapi-v1-news" data-method="GET" data-path="api/v1/news" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-news', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-news" onclick="tryItOut('GETapi-v1-news');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-news" onclick="cancelTryOut('GETapi-v1-news');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-news" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/news</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-news" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-news" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
<p>
<b><code>search</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="search" data-endpoint="GETapi-v1-news" data-component="query"  hidden>
<br>
Строка, которая должна содержаться в результатах выдачи
</p>
<p>
<b><code>category_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="category_id" data-endpoint="GETapi-v1-news" data-component="query"  hidden>
<br>
ID категории
</p>
<p>
<b><code>tag_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="tag_id" data-endpoint="GETapi-v1-news" data-component="query"  hidden>
<br>
ID тега
</p>
<p>
<b><code>author_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="author_id" data-endpoint="GETapi-v1-news" data-component="query"  hidden>
<br>
ID автора
</p>
<p>
<b><code>from</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="from" data-endpoint="GETapi-v1-news" data-component="query"  hidden>
<br>
Начало периода в формате 'YYYY-mm-dd HH:ii:ss'
</p>
<p>
<b><code>till</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="till" data-endpoint="GETapi-v1-news" data-component="query"  hidden>
<br>
Окончание периода в формате 'YYYY-mm-dd HH:ii:ss'
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="status" data-endpoint="GETapi-v1-news" data-component="query"  hidden>
<br>
Статус отображения (возможные значения visible, hidden)
</p>
</form>


## Get specified News




> Example request:

```bash
curl -X GET \
    -G "http://brand_media.test/api/v1/news/dignissimos" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/news/dignissimos"
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
<div id="execution-results-GETapi-v1-news--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-news--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-news--id-"></code></pre>
</div>
<div id="execution-error-GETapi-v1-news--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-news--id-"></code></pre>
</div>
<form id="form-GETapi-v1-news--id-" data-method="GET" data-path="api/v1/news/{id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-news--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-news--id-" onclick="tryItOut('GETapi-v1-news--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-news--id-" onclick="cancelTryOut('GETapi-v1-news--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-news--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/news/{id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="GETapi-v1-news--id-" data-component="url" required  hidden>
<br>

</p>
</form>


## Create news

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://brand_media.test/api/v1/news" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"qui","text":"ad","category_id":20,"author_id":18,"image":"quia","meta:title":"totam","meta:description":"odit","tag_id":"quis","position":11,"is_promo":18}'

```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/news"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "qui",
    "text": "ad",
    "category_id": 20,
    "author_id": 18,
    "image": "quia",
    "meta:title": "totam",
    "meta:description": "odit",
    "tag_id": "quis",
    "position": 11,
    "is_promo": 18
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-news" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-news"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-news"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-news" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-news"></code></pre>
</div>
<form id="form-POSTapi-v1-news" data-method="POST" data-path="api/v1/news" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-news', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-news" onclick="tryItOut('POSTapi-v1-news');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-news" onclick="cancelTryOut('POSTapi-v1-news');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-news" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/news</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-news" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-news" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="POSTapi-v1-news" data-component="body" required  hidden>
<br>
Название новости
</p>
<p>
<b><code>text</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="text" data-endpoint="POSTapi-v1-news" data-component="body"  hidden>
<br>
optional Текст новости
</p>
<p>
<b><code>category_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="category_id" data-endpoint="POSTapi-v1-news" data-component="body"  hidden>
<br>
ID категории новости
</p>
<p>
<b><code>author_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="author_id" data-endpoint="POSTapi-v1-news" data-component="body"  hidden>
<br>
ID автора новости
</p>
<p>
<b><code>image</code></b>&nbsp;&nbsp;<small>optional</small>     <i>optional</i> &nbsp;
<input type="text" name="image" data-endpoint="POSTapi-v1-news" data-component="body"  hidden>
<br>
Картинка в base64
</p>
<p>
<b><code>meta:title</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="meta:title" data-endpoint="POSTapi-v1-news" data-component="body"  hidden>
<br>
optional Содержимое тега <title>
</p>
<p>
<b><code>meta:description</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="meta:description" data-endpoint="POSTapi-v1-news" data-component="body"  hidden>
<br>
optional Содержимое тега <meta name="description">
</p>
<p>
<b><code>tag_id</code></b>&nbsp;&nbsp;<small>array</small>     <i>optional</i> &nbsp;
<input type="text" name="tag_id" data-endpoint="POSTapi-v1-news" data-component="body"  hidden>
<br>
Массив IDs тегов новости
</p>
<p>
<b><code>position</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="position" data-endpoint="POSTapi-v1-news" data-component="body"  hidden>
<br>
Позиция новости в плашке
</p>
<p>
<b><code>is_promo</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="is_promo" data-endpoint="POSTapi-v1-news" data-component="body"  hidden>
<br>
Промо (возможные значения 1, 0)
</p>

</form>


## Update News

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X PUT \
    "http://brand_media.test/api/v1/news/omnis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"vero","text":"quibusdam","category_id":16,"author_id":1,"image":"voluptatum","meta:title":"id","meta:description":"ad","tag_id":"qui","position":13,"is_promo":9}'

```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/news/omnis"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vero",
    "text": "quibusdam",
    "category_id": 16,
    "author_id": 1,
    "image": "voluptatum",
    "meta:title": "id",
    "meta:description": "ad",
    "tag_id": "qui",
    "position": 13,
    "is_promo": 9
}

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-PUTapi-v1-news--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTapi-v1-news--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-news--id-"></code></pre>
</div>
<div id="execution-error-PUTapi-v1-news--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-news--id-"></code></pre>
</div>
<form id="form-PUTapi-v1-news--id-" data-method="PUT" data-path="api/v1/news/{id}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-news--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTapi-v1-news--id-" onclick="tryItOut('PUTapi-v1-news--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTapi-v1-news--id-" onclick="cancelTryOut('PUTapi-v1-news--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTapi-v1-news--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>api/v1/news/{id}</code></b>
</p>
<p>
<label id="auth-PUTapi-v1-news--id-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="PUTapi-v1-news--id-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="PUTapi-v1-news--id-" data-component="url" required  hidden>
<br>

</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="PUTapi-v1-news--id-" data-component="body" required  hidden>
<br>
Название новости
</p>
<p>
<b><code>text</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="text" data-endpoint="PUTapi-v1-news--id-" data-component="body"  hidden>
<br>
optional Текст новости
</p>
<p>
<b><code>category_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="category_id" data-endpoint="PUTapi-v1-news--id-" data-component="body"  hidden>
<br>
ID категории новости
</p>
<p>
<b><code>author_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="author_id" data-endpoint="PUTapi-v1-news--id-" data-component="body"  hidden>
<br>
ID автора новости
</p>
<p>
<b><code>image</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="image" data-endpoint="PUTapi-v1-news--id-" data-component="body"  hidden>
<br>
optional Картинка в base64
</p>
<p>
<b><code>meta:title</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="meta:title" data-endpoint="PUTapi-v1-news--id-" data-component="body"  hidden>
<br>
optional Содержимое тега <title>
</p>
<p>
<b><code>meta:description</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="meta:description" data-endpoint="PUTapi-v1-news--id-" data-component="body"  hidden>
<br>
optional Содержимое тега <meta name="description">
</p>
<p>
<b><code>tag_id</code></b>&nbsp;&nbsp;<small>array</small>     <i>optional</i> &nbsp;
<input type="text" name="tag_id" data-endpoint="PUTapi-v1-news--id-" data-component="body"  hidden>
<br>
Массив IDs тегов новости
</p>
<p>
<b><code>position</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="position" data-endpoint="PUTapi-v1-news--id-" data-component="body"  hidden>
<br>
Позиция новости в плашке
</p>
<p>
<b><code>is_promo</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="is_promo" data-endpoint="PUTapi-v1-news--id-" data-component="body"  hidden>
<br>
Промо (возможные значения 1, 0)
</p>

</form>


## Delete specified News

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X DELETE \
    "http://brand_media.test/api/v1/news/aperiam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/news/aperiam"
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


<div id="execution-results-DELETEapi-v1-news--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEapi-v1-news--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-news--id-"></code></pre>
</div>
<div id="execution-error-DELETEapi-v1-news--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-news--id-"></code></pre>
</div>
<form id="form-DELETEapi-v1-news--id-" data-method="DELETE" data-path="api/v1/news/{id}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-news--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEapi-v1-news--id-" onclick="tryItOut('DELETEapi-v1-news--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEapi-v1-news--id-" onclick="cancelTryOut('DELETEapi-v1-news--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEapi-v1-news--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>api/v1/news/{id}</code></b>
</p>
<p>
<label id="auth-DELETEapi-v1-news--id-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="DELETEapi-v1-news--id-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="DELETEapi-v1-news--id-" data-component="url" required  hidden>
<br>

</p>
</form>



