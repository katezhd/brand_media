# sign

API для работы с тегами.

## List of signs




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/app/horoscope_signs?page=8&sort=aut&search=et&status=hic" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/app/horoscope_signs"
);

let params = {
    "page": "8",
    "sort": "aut",
    "search": "et",
    "status": "hic",
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
        "name": "Овен",
        "slug": "aries"
    },
    {
        "id": 2,
        "name": "Телец",
        "slug": "taurus"
    },
    {
        "id": 3,
        "name": "Близнецы",
        "slug": "gemini"
    },
    {
        "id": 4,
        "name": "Рак",
        "slug": "cancer"
    },
    {
        "id": 5,
        "name": "Лев",
        "slug": "leo"
    },
    {
        "id": 6,
        "name": "Дева",
        "slug": "virgo"
    },
    {
        "id": 7,
        "name": "Весы",
        "slug": "libra"
    },
    {
        "id": 8,
        "name": "Скорпион",
        "slug": "scorpio"
    },
    {
        "id": 9,
        "name": "Стрелец",
        "slug": "sagittarius"
    },
    {
        "id": 10,
        "name": "Козерог",
        "slug": "capricorn"
    },
    {
        "id": 11,
        "name": "Водолей",
        "slug": "aquarius"
    },
    {
        "id": 12,
        "name": "Рыбы",
        "slug": "pisces"
    }
]
```
<div id="execution-results-GETapi-v1-app-horoscope_signs" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-app-horoscope_signs"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-app-horoscope_signs"></code></pre>
</div>
<div id="execution-error-GETapi-v1-app-horoscope_signs" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-app-horoscope_signs"></code></pre>
</div>
<form id="form-GETapi-v1-app-horoscope_signs" data-method="GET" data-path="api/v1/app/horoscope_signs" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-app-horoscope_signs', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-app-horoscope_signs" onclick="tryItOut('GETapi-v1-app-horoscope_signs');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-app-horoscope_signs" onclick="cancelTryOut('GETapi-v1-app-horoscope_signs');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-app-horoscope_signs" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/app/horoscope_signs</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-app-horoscope_signs" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-app-horoscope_signs" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
<p>
<b><code>search</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="search" data-endpoint="GETapi-v1-app-horoscope_signs" data-component="query"  hidden>
<br>
Строка, которая должна содержаться в результатах выдачи
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="status" data-endpoint="GETapi-v1-app-horoscope_signs" data-component="query"  hidden>
<br>
Статус отображения (возможные значения visible, hidden)
</p>
</form>



