# Web News

API для работы с просмотром новости на сайте.

## List of news




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/app/news?page=14&sort=quod&category_id=15&author_id=19&status=accusantium" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/app/news"
);

let params = {
    "page": "14",
    "sort": "quod",
    "category_id": "15",
    "author_id": "19",
    "status": "accusantium",
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
    "news": {
        "current_page": 14,
        "data": [],
        "first_page_url": "http:\/\/localhost\/api\/v1\/app\/news?page=1",
        "from": null,
        "last_page": 1,
        "last_page_url": "http:\/\/localhost\/api\/v1\/app\/news?page=1",
        "links": [
            {
                "url": "http:\/\/localhost\/api\/v1\/app\/news?page=13",
                "label": "&laquo; Назад",
                "active": false
            },
            {
                "url": "http:\/\/localhost\/api\/v1\/app\/news?page=1",
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
        "path": "http:\/\/localhost\/api\/v1\/app\/news",
        "per_page": 13,
        "prev_page_url": "http:\/\/localhost\/api\/v1\/app\/news?page=13",
        "to": null,
        "total": 0
    }
}
```
<div id="execution-results-GETapi-v1-app-news" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-app-news"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-app-news"></code></pre>
</div>
<div id="execution-error-GETapi-v1-app-news" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-app-news"></code></pre>
</div>
<form id="form-GETapi-v1-app-news" data-method="GET" data-path="api/v1/app/news" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-app-news', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-app-news" onclick="tryItOut('GETapi-v1-app-news');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-app-news" onclick="cancelTryOut('GETapi-v1-app-news');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-app-news" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/app/news</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-app-news" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-app-news" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
<p>
<b><code>category_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="category_id" data-endpoint="GETapi-v1-app-news" data-component="query"  hidden>
<br>
ID категории (для получения списка новостей по категории)
</p>
<p>
<b><code>author_id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="author_id" data-endpoint="GETapi-v1-app-news" data-component="query"  hidden>
<br>
ID автора (для получения списка новостей одного автора)
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="status" data-endpoint="GETapi-v1-app-news" data-component="query"  hidden>
<br>
Статус отображения (возможные значения visible, hidden)
</p>
</form>


## Get specified News




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/app/news/sunt" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/app/news/sunt"
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
<div id="execution-results-GETapi-v1-app-news--uri-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-app-news--uri-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-app-news--uri-"></code></pre>
</div>
<div id="execution-error-GETapi-v1-app-news--uri-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-app-news--uri-"></code></pre>
</div>
<form id="form-GETapi-v1-app-news--uri-" data-method="GET" data-path="api/v1/app/news/{uri}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-app-news--uri-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-app-news--uri-" onclick="tryItOut('GETapi-v1-app-news--uri-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-app-news--uri-" onclick="cancelTryOut('GETapi-v1-app-news--uri-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-app-news--uri-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/app/news/{uri}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>uri</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="uri" data-endpoint="GETapi-v1-app-news--uri-" data-component="url" required  hidden>
<br>

</p>
</form>



