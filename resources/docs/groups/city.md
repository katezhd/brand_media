# city

API для работы с тегами.

## List of cities




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/app/weather_cities?page=11&sort=quis&search=aut&status=alias" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/app/weather_cities"
);

let params = {
    "page": "11",
    "sort": "quis",
    "search": "aut",
    "status": "alias",
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
[
    {
        "id": 1,
        "name": "Кривий Ріг"
    },
    {
        "id": 2,
        "name": "Покровськ"
    },
    {
        "id": 3,
        "name": "Маріуполь"
    },
    {
        "id": 4,
        "name": "Макіївка"
    },
    {
        "id": 5,
        "name": "Запоріжжя"
    },
    {
        "id": 6,
        "name": "Авдіївка"
    }
]
```
<div id="execution-results-GETapi-v1-app-weather_cities" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-app-weather_cities"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-app-weather_cities"></code></pre>
</div>
<div id="execution-error-GETapi-v1-app-weather_cities" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-app-weather_cities"></code></pre>
</div>
<form id="form-GETapi-v1-app-weather_cities" data-method="GET" data-path="api/v1/app/weather_cities" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-app-weather_cities', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-app-weather_cities" onclick="tryItOut('GETapi-v1-app-weather_cities');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-app-weather_cities" onclick="cancelTryOut('GETapi-v1-app-weather_cities');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-app-weather_cities" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/app/weather_cities</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-app-weather_cities" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-app-weather_cities" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
<p>
<b><code>search</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="search" data-endpoint="GETapi-v1-app-weather_cities" data-component="query"  hidden>
<br>
Строка, которая должна содержаться в результатах выдачи
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="status" data-endpoint="GETapi-v1-app-weather_cities" data-component="query"  hidden>
<br>
Статус отображения (возможные значения visible, hidden)
</p>
</form>



